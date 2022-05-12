<?php
# 2 = No Slots Availbele
if($_POST['includes'] == 'yes'){
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

//Check InOffice for provider while Ajax
if(!empty($_POST['providerId']) && !empty($_POST['eventDate'])){
    $status = findSlot($_POST['providerId'],$_POST['eventDate']);
    echo json_encode($status);
}else{
    $status['response_code'] = 2;
    echo json_encode($status);
}

}

//Functions Area

function findSlot($providerId,$eventDate){
    $status = array();
    $inoffice = sqlQuery('select pc_catid from openemr_postcalendar_categories where pc_constant_id = ?',array('in_office'));
    $calendarInterval = sqlQuery('select gl_value from globals where gl_name = ?',array('calendar_interval'));
    
    $inOfficeStartTime = sqlQuery('select pc_eid,pc_startTime from openemr_postcalendar_events WHERE pc_aid = ? AND pc_eventDate = ? AND pc_catid = ?',array($providerId,$eventDate,$inoffice['pc_catid']));
    if(!empty($inOfficeStartTime)){
        $outOfficeEid = $inOfficeStartTime['pc_eid'] + 1;
        $outOfficeStartTime = sqlQuery('select pc_startTime from openemr_postcalendar_events where pc_eid = ?',array($outOfficeEid));

        $slots = createSlots($inOfficeStartTime['pc_startTime'],$outOfficeStartTime['pc_startTime'],$calendarInterval['gl_value']);
        $status['response_code'] = 1;
        $status['slots'] = $slots;

        return $status;
    }else{
       $status['response_code'] = 2;
       return $status;
    }
}

function CreateSlots($startTime,$endTime,$interval){
    $returnArray = array ();
    $startTime    = strtotime ($startTime);
    $endTime      = strtotime ($endTime);

    $addMins  = $interval * 60;

    while ($startTime <= $endTime) 
    {
        $returnArray[] = date ("h:i A", $startTime);
        $startTime += $addMins;
    }
    return $returnArray;
}

function appointmentSlots($providerId,$eventDate){
    $patientSlotTime = sqlstatement('select pc_eid,pc_startTime,pc_endTime from openemr_postcalendar_events WHERE pc_aid = ? AND pc_eventDate = ? AND pc_pid  = ""',array($providerId,$eventDate));
  //  print_r($patientSlotTime);
    $returnArray = array();
    while($ures = sqlFetchArray($patientSlotTime)){

        //$return['eid'] = $fetch['pc_eid'];
        $returnArray[]  = date ('h:i A',strtotime ($ures['pc_startTime']));
        //$return['endTime'] = date ('H:i A',strtotime ($fetch['pc_endTime']));
        //$returnArray[] = $return;
    }

    return $returnArray;
}

function FindNearbySlot($timeslots,$expected_time){
// $expected_time = "2018-12-15T18:00:00.0000000";
$timestamp = strtotime($expected_time);//It's a current time as expected time
$diff = null;
$index = null;

foreach ($timeslots as $key => $time) {
    $currDiff = abs($timestamp - strtotime($time));
    if (is_null($diff) || $currDiff < $diff) {
        $index = $key;
        $diff = $currDiff;
    }
}
return $timeslots[$index];
}

function differenceInHours($startdate,$enddate){
	$time1 = new DateTime($startdate);
    $time2 = new DateTime($enddate);
    $timediff = $time1->diff($time2);
    $returnArray['hr'] =     $timediff->format('%h');
    $returnArray['min'] =     $timediff->format('%i');
    return $returnArray;
	//return $difference;
}
?>