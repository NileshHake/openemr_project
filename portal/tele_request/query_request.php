<?php

require_once("../../interface/globals.php");
require_once($GLOBALS['srcdir'] . '/patient.inc');
require_once($GLOBALS['srcdir'] . '/encounter_events.inc.php');

use OpenEMR\Common\Acl\AclMain;
use OpenEMR\Core\Header;
use OpenEMR\Events\Appointments\AppointmentSetEvent;
use OpenEMR\Events\Appointments\AppointmentRenderEvent;


//Check if any tele request are received
if($_GET['use'] == 'request'){
    
$requestData = sqlQuery("select * from tele_request where request_provider_id = ? and status = 'waiting'",$_POST['userid']);   

if(!empty($requestData)){
    $patientName = sqlQuery("select concat(lname,' ',fname) as patientname from patient_data where pid = ?",$requestData['pid']);
    $requestData['patientname'] = $patientName['patientname'];
    $requestData = array_map('ucfirst', $requestData);
echo json_encode($requestData);
}else{
    echo "false";
}

//Update the provider accept/Reject response to the patient
}elseif(!empty($_POST) && $_GET['use'] == 'statusupdate'){
    $response = array();

    if($_POST['status'] == 'reject'){
        $requestType = sqlQuery('select request_type,userids,request_provider_id from tele_request where id = ?',$_POST['requestId']);
        $userids = json_decode($requestType['userids']);
        if(($requestType['request_type'] == 'dynamic') && (!empty($userids)) && (count($userids) > 1)){
        $status = 'Waiting';
        //array_shift($userids);
        if (($key = array_search($requestType['request_provider_id'], $userids)) !== false) {
            unset($userids[$key]);
            
        }
            $useridsReIndex = array_values($userids);
            $nxtRequestProviderId = $useridsReIndex[$key] ? $useridsReIndex[$key] : $useridsReIndex[0];
        $updateDoctorResponce = sqlQuery("update tele_request set userids = ?,request_provider_id = ?  where id = ?",array(json_encode($useridsReIndex),$nxtRequestProviderId,$_POST['requestId']));                    
        }else
        $status = 'Reject';
    //User Reject to change user status as availble
    $updateuserstatus = sqlQuery("update users set status = 1 where id = ?",$_SESSION['authUserID']);
    $updateDoctorResponce = sqlQuery("update tele_request set status = ? where id = ?",array($status,$_POST['requestId']));

    $response['response_code'] = 3;

    }else {
    $status = 'Accept';
        
    //$eventResponseEid = addEventWithLifemesh($_POST); 
    $prov_name=sqlQuery("select username from users where id = ?",array($_POST['providerid'])); 
    $room = createTwilioRoom($_POST['providerid'],$_POST['requestId'],$prov_name['username']); 
    $patientName = sqlQuery("select concat(lname,'_',fname) as patientname from patient_data where pid = ?",$_POST['pid']);
    $patientRoomURL = $GLOBALS['twilio_patient_link'].'?room='.$room.'&identity='.$patientName['patientname'].'&from=patient';
    $providerRoomURL = $GLOBALS['twilio_patient_link'].'?room='.$room.'&identity='.$prov_name['username'].'&from=provider';
    // $lifemashChimeSession = sqlQuery('select * from lifemesh_chime_sessions where pc_eid = ?',$eventResponseEid);

    $updateDoctorResponce = sqlQuery("update tele_request set status = ?,patient_uri = ?,provider_uri = ?,room = ?,attend_provider_id = ? where id = ?",array($status,$patientRoomURL,$providerRoomURL,$room,$_SESSION['authUserID'],$_POST['requestId']));

    $response['response_code'] = 4;
    $response['provider_uri'] = $providerRoomURL;

    }


    echo json_encode($response);
    
}elseif(!empty($_POST['tele_request_id']) && $_GET['use'] == 'end_meeting'){

    $data_twilio = sqlQuery("UPDATE twilio_rooms set status = 1 where tele_request_id = ?",$_POST['tele_request_id']);

    //User end meeting to change user status as availble
    $updateuserstatus = sqlQuery("update users set status = 1 where id = ?",$_SESSION['authUserID']);

    //$updateTwilioRoom = updateTwilioRoom($_POST['room_name'],'completed');
    echo 'success';
    
}else{
    $status['response_code'] = 2;
     echo json_encode($status);
}

function createTwilioRoom($providerId,$teleRequestId,$username){
    require_once($GLOBALS['srcdir'].'/twilio/config.php');
    $twilio_room = sha1($username.'_'.$teleRequestId);
    $room = $twilio->video->v1->rooms->create(["enableTurn" => True,"type" => "peer-to-peer","uniqueName" => $twilio_room]);
     if($room){
         $twilioRoomValues = array($twilio_room,$providerId,$teleRequestId,$room->url);
        sqlQuery("insert into twilio_rooms(room,provider_id,tele_request_id,url) value (?,?,?,?)",$twilioRoomValues);

        return $twilio_room;
     }   
}

function updateTwilioRoom($room,$text){

    require_once($GLOBALS['srcdir'].'/twilio/config.php');
    $room = $twilio->video->v1->rooms($room)->update($text);
    return $room;

}
// function addEventWithLifemesh($postval){

// $args['form_category'] = 5; //need to dynamic
// $args['form_provider'] = $postval['providerid'];
// $args['form_pid'] = $postval['pid'];
// $args['form_title'] = 'Office Visit - telehealth';
// $args['form_comments'] = $postval['reason'];
// $args['event_date'] = $postval['apptdate'];
// $args['form_enddate'] = '0000-00-00';
// $args['duration'] = 15 * 60;
// $args['recurrspec'] = unserialize('a:6:{s:17:"event_repeat_freq";s:1:"0";s:22:"event_repeat_freq_type";s:1:"0";s:19:"event_repeat_on_num";s:1:"1";s:19:"event_repeat_on_day";s:1:"0";s:20:"event_repeat_on_freq";s:1:"0";s:6:"exdate";s:0:"";}');
// $args['starttime'] = date('H:i', strtotime("+2 minutes", strtotime(date('H:i'))));
// $args['endtime'] = date('H:i', strtotime("+15 minutes", strtotime($args['starttime'])));
// $args['form_allday'] = 0;
// $args['form_apptstatus'] = '-';
// $args['form_prefcat'] = 0;
// $args['locationspec'] = 'a:6:{s:14:"event_location";s:0:"";s:13:"event_street1";s:0:"";s:13:"event_street2";s:0:"";s:10:"event_city";s:0:"";s:11:"event_state";s:0:"";s:12:"event_postal";s:0:"";}';
// $args['facility'] = 3; //need to dynamic
// $args['billing_facility'] = 3; //need to dynamic

// $splitTime = explode(':',$args['starttime']);
// $explodePatientName = explode(' ',$postval['patientname']);
// $implodePatientName = implode(',',$explodePatientName);

// $args['form_date'] = $postval['apptdate'];
// $args['form_hour'] = $splitTime[0];
// $args['form_minute'] = $splitTime[1];
// $args['form_patient'] = $implodePatientName;


// $eid = InsertEvent($args);

//         //Tell subscribers that a new single appointment has been set

//         /**
//         * @var EventDispatcherInterface $eventDispatcher
//         */
//         $eventDispatcher = $GLOBALS['kernel']->getEventDispatcher();
//         $patientAppointmentSetEvent = new AppointmentSetEvent($args);
//         $patientAppointmentSetEvent->eid = $eid;  //setting the appointment id to an object
//         $eventDispatcher->dispatch(AppointmentSetEvent::EVENT_HANDLE, $patientAppointmentSetEvent, 10);


//         return $eid;
// }
?>