<?php

/**
 * Handles extra claims required for SMART on FHIR requests
 * @see http://hl7.org/fhir/smart-app-launch/scopes-and-launch-context/index.html
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Stephen Nielson <stephen@nielson.org>
 * @copyright Copyright (c) 2020 Stephen Nielson <stephen@nielson.org>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Common\Auth\OpenIDConnect;

use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Encoding\JoseEncoder;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use LogicException;
use OpenEMR\Common\Logging\SystemLogger;
use OpenEMR\FHIR\SMART\SmartLaunchController;
use OpenEMR\FHIR\SMART\SMARTLaunchToken;
use OpenEMR\Services\PatientService;
use OpenIDConnectServer\ClaimExtractor;
use OpenIDConnectServer\IdTokenResponse;
use OpenIDConnectServer\Repositories\IdentityProviderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class IdTokenSMARTResponse extends IdTokenResponse
{
    const SCOPE_SMART_LAUNCH = 'launch';
    const SCOPE_OFFLINE_ACCESS = 'offline_access';
    const SCOPE_SMART_LAUNCH_PATIENT = 'launch/patient';
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var boolean
     */
    private $isAuthorizationGrant;

    public function __construct(
        IdentityProviderInterface $identityProvider,
        ClaimExtractor $claimExtractor
    ) {
        $this->isAuthorizationGrant = false;
        $this->logger = new SystemLogger();
        parent::__construct($identityProvider, $claimExtractor);
    }

    public function markIsAuthorizationGrant()
    {
        $this->isAuthorizationGrant = true;
    }

    /**
     * {@inheritdoc}
     */
    public function generateHttpResponse(ResponseInterface $response)
    {
        // if we have offline_access then we allow the refresh token and everything to proceed as normal
        // if we don't have offline access we need to remove the refresh token
        // offline_access should only be granted to confidential clients (that can keep a secret) so we don't need
        // to check the client type here.
        // unfortunately League right now isn't supporting offline_access so we have to duplicate this code here
        // @see https://github.com/thephpleague/oauth2-server/issues/1005 for the oauth2 discussion on why they are
        // not handling oauth2 offline_access with refresh_tokens.
        if ($this->hasScope($this->accessToken->getScopes(), self::SCOPE_OFFLINE_ACCESS)) {
            return parent::generateHttpResponse($response);
        }

        $expireDateTime = $this->accessToken->getExpiryDateTime()->getTimestamp();

        $responseParams = [
            'token_type'   => 'Bearer',
            'expires_in'   => $expireDateTime - \time(),
            'access_token' => (string) $this->accessToken,
        ];

        // we don't allow the refresh token if we don't have the offline capability
        $responseParams = \json_encode(\array_merge($this->getExtraParams($this->accessToken), $responseParams));

        if ($responseParams === false) {
            throw new LogicException('Error encountered JSON encoding response parameters');
        }

        $response = $response
            ->withStatus(200)
            ->withHeader('pragma', 'no-cache')
            ->withHeader('cache-control', 'no-store')
            ->withHeader('content-type', 'application/json; charset=UTF-8');

        $response->getBody()->write($responseParams);

        return $response;
    }

    protected function getExtraParams(AccessTokenEntityInterface $accessToken)
    {
        $extraParams = parent::getExtraParams($accessToken);

        $scopes = $accessToken->getScopes();
        $this->logger->debug("IdTokenSMARTResponse->getExtraParams() params from parent ", ["params" => $extraParams]);

        if ($this->isStandaloneLaunchPatientRequest($scopes)) {
            // patient id that is currently selected in the session.
            if (!empty($_SESSION['pid'])) {
                $extraParams['patient'] = $_SESSION['pid'];
                $extraParams['need_patient_banner'] = true;
                $extraParams['smart_style_url'] = $this->getSmartStyleURL();
            } else {
                throw new OAuthServerException("launch/patient scope requested but patient 'pid' was not present in session", 0, 'invalid_patient_context');
            }
        } else if ($this->isLaunchRequest($scopes)) {
            $this->logger->debug("launch scope requested");
            if (!empty($_SESSION['launch'])) {
                $this->logger->debug("IdTokenSMARTResponse->getExtraParams() launch set in session", ['launch' => $_SESSION['launch']]);
                // this is where the launch context is deserialized and we extract any SMART context state we wanted to
                // pass on as part of the EHR request, we only have encounter and patient at this point
                try {
                    // TODO: adunsulag do we want any kind of hmac signature to verify the request hasn't been
                    // tampered with?  Not sure that it matters as the ACL's will verify that the app only has access
                    // to the data the currently authorized oauth2 user can access.
                    $launchToken = SMARTLaunchToken::deserializeToken($_SESSION['launch']);
                    $this->logger->debug("IdTokenSMARTResponse->getExtraParams() decoded launch context is", ['context' => $launchToken]);

                    // we assume that if a patient is provided we are already displaying the patient
                    // we may in the future need to adjust the need_patient_banner depending on the 'intent' chosen.
                    if (!empty($launchToken->getPatient())) {
                        $extraParams['patient'] = $launchToken->getPatient();
                        $extraParams['need_patient_banner'] = false;
                    }
                    if (!empty($launchToken->getEncounter())) {
                        $extraParams['encounter'] = $launchToken->getEncounter();
                    }
                    if (!empty($launchToken->getIntent())) {
                        $extraParams['intent'] = $launchToken->getIntent();
                    }
                    $extraParams['smart_style_url'] = $this->getSmartStyleURL();
                } catch (\Exception $ex) {
                    $this->logger->error("IdTokenSMARTResponse->getExtraParams() Failed to decode launch context parameter", ['error' => $ex->getMessage()]);
                    throw new OAuthServerException("Invalid launch parameter", 0, 'invalid_launch_context');
                }
            }
        }

        // response should return the scopes we authorized inside the accessToken to be smart compatible
        // I would think this would be better put in the id_token but to be spec compliant we have to have this here
        $extraParams['scope'] = $this->getScopeString($accessToken->getScopes());

        $this->logger->debug("IdTokenSMARTResponse->getExtraParams() final params", ["params" => $extraParams]);
        return $extraParams;
    }

    /**
     * Needed for OpenEMR\FHIR\SMART\Capability::CONTEXT_STYLE support
     * TODO: adunsulag do we want to try and read from the scss files and generate some kind of styles...
     * Reading the SMART FHIR spec author forums so few app writers are actually using this at all, it seems like we
     * can just use defaults without getting trying to load up based upon which skin we have, or using node &
     * gulp to auto generate a skin.
     */
    private function getSmartStyleURL()
    {
        return $GLOBALS['site_addr_oath'] . $GLOBALS['web_root'] . "/public/smart-styles/smart-light.json";
    }

    /**
     * @param ScopeEntityInterface[] $scopes
     * @return bool
     */
    private function isLaunchRequest($scopes)
    {
        // if we are not in an authorization grant context we don't support SMART launch context params
        if (!$this->isAuthorizationGrant) {
            return false;
        }

        return $this->hasScope($scopes, 'launch');
    }

    /**
     * @param ScopeEntityInterface[] $scopes
     * @return bool
     */
    private function isStandaloneLaunchPatientRequest($scopes)
    {
        // if we are not in an authorization grant context we don't support SMART launch context params
        if (!$this->isAuthorizationGrant) {
            return false;
        }
        return $this->hasScope($scopes, 'launch/patient');
    }

    private function hasScope($scopes, $searchScope)
    {
        // Verify scope and make sure openid exists.
        $valid  = false;

        foreach ($scopes as $scope) {
            if ($scope->getIdentifier() == $searchScope) {
                $valid = true;
                break;
            }
        }

        return $valid;
    }

    private function getScopeString($scopes)
    {
        $scopeList = [];
        foreach ($scopes as $scope) {
            $scopeId = $scope->getIdentifier();
            // don't include scopes like site:default
            // they still get bundled into the AccessToken but for ONC certification
            // it won't allow custom scope permissions even though this is valid per Open ID Connect spec
            // so we will just skip listing in the 'scopes' response that is sent back to
            // the client.
            if (strpos($scopeId, ':') === false) {
                $scopeList[] = $scopeId;
            }
        }
        return implode(' ', $scopeList);
    }

    protected function getBuilder(AccessTokenEntityInterface $accessToken, UserEntityInterface $userEntity): Builder
    {
        $claimsFormatter = ChainedFormatter::withUnixTimestampDates();
        $builder = new Builder(new JoseEncoder(), $claimsFormatter);

        // Add required id_token claims
        return $builder
            ->permittedFor($accessToken->getClient()->getIdentifier())
            ->issuedBy($GLOBALS['site_addr_oath'] . $GLOBALS['webroot'] . "/oauth2/" . $_SESSION['site_id'])
            ->issuedAt(new \DateTimeImmutable('@' . time()))
            ->expiresAt(new \DateTimeImmutable('@' . $accessToken->getExpiryDateTime()->getTimestamp()))
            ->relatedTo($userEntity->getIdentifier());
    }
}
