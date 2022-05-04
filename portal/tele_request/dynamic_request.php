<?php

# 1 = Patient Tele request Created
# 2 = User not availble
# 3 = Provider Reject
# 4 = Provider Accept
# 5 = Waiting
# 6 = Error Accured
# 7 = Request Shuffled

require_once(__DIR__ . "/../../src/Common/Session/SessionUtil.php");
OpenEMR\Common\Session\SessionUtil::portalSessionStart();

require_once("./../../library/pnotes.inc");

//landing page definition -- where to go if something goes wrong
$landingpage = "../index.php?site=" . urlencode($_SESSION['site_id']);
//

// kick out if patient not authenticated
if (isset($_SESSION['pid']) && isset($_SESSION['patient_portal_onsite_two'])) {
    $pid = $_SESSION['pid'];
} else {
    OpenEMR\Common\Session\SessionUtil::portalSessionCookieDestroy();
    header('Location: ' . $landingpage . '&w');
    exit;
}

$ignoreAuth_onsite_portal = true;
global $ignoreAuth_onsite_portal;

require_once("../../interface/globals.php");
require_once("$srcdir/patient.inc");
require_once("$srcdir/forms.inc");

$status = array();


if($_GET['req'] == 'newrequest' || $_GET['req'] == 'shufflerequest'){

    $response =  $_GET['req']();
    echo $response;
}else{
    $status['response_code'] = 6;
}



// Functions Area
function newrequest(){

    $userAvailabilityCheck = sqlQuery('select status,username from users where id = ?',$_POST['provider']);
    if($userAvailabilityCheck['status'] == 1) {
    $formValues = array($_POST['pid'],$_POST['date'],$_POST['provider'],$_POST['reason'],'dynamic',json_encode($_POST['users']));
    $requestInsert = sqlInsert("insert into tele_request (pid,date,request_provider_id,reason,request_type,userids) values (?,?,?,?,?,?)",$formValues);

     //Change user status as unavailable for preventing another patient tele requests
     $updateuserstatus = sqlQuery("update users set status = 0 where id = ?",$_POST['provider']);
          
     $status['response_code'] = 1;
     $status['response_id'] = $requestInsert; 
        
    } else {
        $status['response_code'] = 2;
        
    }
    return json_encode($status);
}


function shufflerequest(){

    //Previous provider set as available
    $updateuserstatus = sqlQuery("update users set status = 1 where id = ?",$_POST['prevprovId']);
    
    //Current provider set status asunavailable
    $shuffleanotherprovider = sqlQuery("update tele_request set request_provider_id = ?,request_type = ? where id = ? AND status = 'Waiting'",array($_POST['provider'],$_POST['request_type'],$_POST['requestId']));
    $updateuserstatus = sqlQuery("update users set status = 0 where id = ?",$_POST['provider']);

    $status['response_code'] = 7;

    return json_encode($status);
}

?>