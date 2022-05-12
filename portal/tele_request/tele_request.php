<?php

# 1 = Patient Tele request Created
# 2 = User not availble
# 3 = Provider Reject
# 4 = Provider Accept
# 5 = Waiting
# 6 = Error Accured

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


//Check Users availibility and create New tele consultation 
if(!empty($_POST['form_provider_id']) && !empty($_POST['form_pid']) && $_GET['get'] == 'request'){
    //$status = array();

    $userAvailabilityCheck = sqlQuery('select status,username from users where id = ?',$_POST['form_provider_id']);
    if($userAvailabilityCheck['status'] == 1) {
       
    //Reject previous request while patient make repeated request
    $checkStatus = sqlQuery("update tele_request set status = 'Reject' where pid = ? AND status = 'Waiting'",$_POST['form_pid']);

    $formValues = array($_POST['form_pid'],$_POST['form_date'],$_POST['form_provider_id'],$_POST['form_reason'],'single');
    $requestInsert = sqlInsert("insert into tele_request (pid,date,request_provider_id,reason,request_type) values (?,?,?,?,?)",$formValues);

     //Change user status as unavailable for preventing another patient tele requests
     $updateuserstatus = sqlQuery("update users set status = 0 where id = ?",$_POST['form_provider_id']);
          
     $status['response_code'] = 1;
     $status['response_id'] = $requestInsert; 
        echo json_encode($status);
    } else {
        $status['response_code'] = 2;
        echo json_encode($status);
    }
    
    //Check the response if the request was send to the provider
}elseif(!empty($_POST['response_id']) && $_GET['get'] == 'response'){
    //$status = array();

    $checkStatus = sqlQuery('select * from tele_request where id = ?',$_POST['response_id']);

    if($checkStatus['status'] == 'Reject') {
        $status['response_code'] = 3;
    }elseif($checkStatus['status'] == 'Accept') {
        $status['response_code'] = 4;
        $status['patient_uri'] = $checkStatus['patient_uri'];
    }
    elseif($checkStatus['status'] == 'Waiting' || $checkStatus['status'] == 'partial_reject'){
        $status['response_code'] = 5;
    }
    else{
        $status['response_code'] = 6;
    }

    echo json_encode($status);
}else{
       $status['response_code'] = 2;
        echo json_encode($status);
}

?>