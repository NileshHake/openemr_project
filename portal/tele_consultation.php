<?php

# 1 = Patient Tele request Created
# 2 = User not availble
# 3 = Provider Reject
# 4 = Provider Accept
# 5 = Waiting
# 6 = Error Accured

require_once(__DIR__ . "/../src/Common/Session/SessionUtil.php");
OpenEMR\Common\Session\SessionUtil::portalSessionStart();

require_once("./../library/pnotes.inc");

//landing page definition -- where to go if something goes wrong
$landingpage = "index.php?site=" . urlencode($_SESSION['site_id']);
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

require_once("../interface/globals.php");
require_once("$srcdir/patient.inc");
require_once("$srcdir/forms.inc");

$patientid = $_GET['pid'];
$today = date("Y-m-d");
// If we have a patient ID, get the name and phone numbers to display.
if ($patientid) {
    $prow = sqlQuery("SELECT lname, fname, phone_home, phone_biz, DOB,state " .
        "FROM patient_data WHERE pid = ?", array($patientid));
    $patientname = $prow['lname'] . ", " . $prow['fname'];
    if ($prow['phone_home']) {
        $patienttitle .= " H=" . $prow['phone_home'];
    }

    if ($prow['phone_biz']) {
        $patienttitle .= " W=" . $prow['phone_biz'];
    }
}

// Get the providers list.
   $ures = sqlStatement("SELECT `id`, `username`, `fname`, `lname`, `mname`, `specialty`,`status` FROM `users` WHERE " .
    "`authorized` != 0 AND `active` = 1 AND `username` > '' ORDER BY FIELD(state,'".$prow['state']."') DESC");

?>
<link rel="stylesheet" href="<?php echo $GLOBALS['themes_static_relative']?>/misc/providers_carousel.css">

<style>
.savebtn {
    margin-left:44%;
}
/* .card{
    border:1;
    border-color:red;
} */
</style>
<form method='post' name='theaddform' id='consultationForm'>
            <div class="col-12">
                
                <div class="row form-group">
                <div class="input-group col-12 col-md-6">
                        <label class="mr-2" for="form_patient"><?php echo xlt('Patient'); ?>:</label>
                        <input class="form-control mb-1" type='text' id='form_patient' name='form_patient' value='<?php echo attr($patientname); ?>' title='Patient' readonly />
                        <input type='hidden' name='form_pid' id="form_pid" value='<?php echo attr($patientid); ?>' />
                    </div>
                    <div class="input-group col-12 col-md-6">
                        <label class="mr-2" for="form_date"><?php echo xlt('Date'); ?>:</label>
                        <input class="form-control mb-1" type='text' name='form_date' readonly id='form_date' value='<?php echo $today;?>' />
                    </div>
                </div>
                <!-- Reason -->
                <input type="hidden" name='form_provider_id' id='form_provider_id'>
                <div class="row">
                    <div class="input-group col-12">
                        <label class="mr-2"><?php echo xlt('Reason'); ?>:</label>
                        <input class="form-control" type='text' size='40' name='form_reason' id="form_reason" value='' title='<?php echo xla('Optional information about this event'); ?>' />
                    </div>
                </div><br>
                <!-- Checkbox -->
                <div class="row form-group">
                <div class="custom-control custom-radio col-12 col-md-6">
                        <input type="radio" class="custom-control-input" id="particular_provider" name="tele_request_type">
                        <label class="mr-2 custom-control-label" for="particular_provider"><strong><?php echo xlt('Consult with particular provider'); ?></strong></label>
                    </div>
                    <div class="custom-control custom-radio col-12 col-md-6">
                        <input type="radio" class="custom-control-input" id="dynamic_provider" name="tele_request_type">
                        <label class="mr-2 custom-control-label" for="dynamic_provider"><strong><?php echo xlt('Consult with most popular providers'); ?></strong></label>
                    </div>
                </div>
<!-- Provider Carousel -->
                <div class="row provider_carousel">
                <div class="top-content">
    <div class="container-fluid">
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner row w-100 mx-auto" role="listbox">
            <?php
             require_once('./tele_request/available_times.php');
            $x = 1;
            $providerIds = array();
            while ($urow = sqlFetchArray($ures)) {
                if($urow['status'] == 1)
                $providerIds [] = $urow['id'];

                if($x == 1){
                    echo '<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">';
                }else{
                    echo '<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">';
                }

                //Provider Availibility slots
                $providerSlots = findSlot($urow['id'],$today);
                //patient booking slots
                $appointments = appointmentSlots($urow['id'],$today);
                //print_r($appointments);
                if(!empty($appointments)){
                //Filter only availability slots ignor the booked slot
                $arrayDiff = array_diff($providerSlots['slots'],$appointments);
                $t = date("h:i A",time());
                //  print_r('current time'.$t);
                $slot = FindNearbySlot($arrayDiff,$t);
                 //print_r('closesttime'.$slot);
                $diffs = differenceInHours($t,$slot);
                }
                   
            ?>
                <div class="card d-none d-md-block">
                <h5 class="card-title text-primary m-2"><?= text(ucwords($urow['lname']) . ($urow['fname'] ? ','. ucwords($urow['fname']) : '')); ?></h5>
              <div class="card-body">
              <div class="col-md-12 row">
                 <div class="col-md-6">
                  <img src="<?php echo $GLOBALS['images_static_relative']?>/doctor.png" class="img-fluid mx-auto d-block img" alt="img1">
                 </div>
                 <div class="col-md-6">
                   <span class="badge badge-primary "><i class="fa fa-stethoscope"></i> <?= (ucwords($urow['specialty']) ? $urow['specialty'] : 'Family Medicine'); ?></span>
                   <?php if($providerSlots['response_code'] == 1)echo '<span class="badge badge-success ">AVAILABLE TODAY</span>'?>
                 </div>
              </div><br>
              <div style="min-height:45px;text-align:center">
                         <?php if(($diffs['hr'] != 0 || $diffs['min'] != 0) && $providerSlots['response_code'] == 1){
                           $minOrHr =  $diffs['hr'] == 0 ? $diffs['min'] . ' Min ' : $diffs['hr'] . ' Hours ' . $diffs['min'] . ' Minutes ';
                             echo '<strong class="card-text">Provider will be available in '. $minOrHr .'</strong>';
                         }else{
                            echo '<strong class="card-text">Provider not available</strong>';
                         }?>   
              </div>
        </div>
        <!-- Sample provider id input -->
        <input type="hidden" class="provider_reuse" value="<?= $urow['id']?>">
        <!-- Footer Area -->
        <div class="card-footer bg-white footer_div">
        <!-- <a class="btn btn-primary availaible_btn" data-provider='<?= $urow['id'] ?>' onclick='checkAvailabileSlots(this)'>Check Available</a> -->
        </div>
      </div>
                </div>
                <?php $x++; } 
         $providerIds = json_encode($providerIds);
                ?>
            </div>
            <a class="carousel-control-prev carousel-btn" href="#carousel-example" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next carousel-btn" href="#carousel-example" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
                </div><br>
                
                <div class="row input-group my-1">
                    <button type='button' name='form_save' class='btn btn-success savebtn' onsubmit='return false' onclick="request()"/><span class="spinner-grow spinner-grow-sm" id ="loadingspan"></span> <span id="loadingtext">Make Consultation</span></button>
                </div>
            </div>
        </form>

<script type='text/javascript'>
$(document).ready(function(){
    $('#loadingspan').hide();
    $('.provider_carousel').hide();
    $('.savebtn').hide();

    $("input[name=tele_request_type]").click(function(){
        if ($("#particular_provider").is(":checked")) {
        // alert('vanakkam da mapla particular provider la irunthu');
        $('#form_provider_id').val('');
        $('.provider_carousel').show();
        $('.savebtn').hide();
        // changeTeleRequestUI();
        }else if($("#dynamic_provider").is(":checked")){
            // alert('vanakkam da mapla dynamic provider la irunthu');
            $('#form_provider_id').val('');
            $('.provider_carousel').hide();
            $('.savebtn').show();
        }
    });
    
});
function changeTeleRequestUI(){

}
function tele_request_type(){
    var particular_provider;
    var dynamic_provider;
}
function request(){
    var provId = $('#form_provider_id').val();
    if(provId != ''){
        buttonClicked();
    var form = $('#consultationForm');
$.ajax({
   type: "POST",
   url: "./tele_request/tele_request.php?get=request",
   data: form.serialize(),
   success: function(msg){
    var obj = jQuery.parseJSON( msg );
     if(obj.response_code == '1'){
        setTimeout(doctorAvailable,3000,obj.response_id);
     }else if(obj.response_code == '2'){
        setTimeout(doctorNotAvilable, 3000,'Provider not availble kindly try another provider');
     }
   }
 });
    }else{
        //If provider are not selected we send request to all providers
        buttonClicked();
       var providerIds = <?php echo $providerIds;?>;
       
       var pid = $('#form_pid').val();
       var date = $('#form_date').val();
       var reason = $('#form_reason').val();
       var previousproviderId = '';
       var requestId = '';
       var requestType = '';
       if(!jQuery.isEmptyObject( providerIds )){
       var providerIdlength = Object.keys(providerIds).length - 1;    
           count = 0;
       $.each(providerIds, function(key, value, i) {
           if(providerIdlength == value){
            requestType = 'single';
           }else{
               requestType = 'dynamic';
           }
           setTimeout(function(){
           if(key > 0){
            var data = {pid:pid,date:date,reason:reason,provider:value,requestId:requestId,prevprovId:previousproviderId,request_type:requestType};
            var shuffleRequest = dynamicRequest('shufflerequest',data);
            previousproviderId = value;
           }else{
            previousproviderId = value;
            var data = {pid:pid,date:date,reason:reason,provider:value,users:providerIds}
            var newRequest = dynamicRequest('newrequest',data);

            var nrr = jQuery.parseJSON( newRequest );//New request response
            if(nrr.response_code == 1){
              
              requestId = nrr.response_id;
              doctorAvailable(requestId);

            }
           }
        }, count * 10000);
        count++;
        
    }); 
       }else{
        doctorNotAvilable('No more providers are available');
       }
   
    }
}

function dynamicRequest(reqType,data){
    var response = '';
    $.ajax({
        type:'POST',
        async:false,
        url:"./tele_request/dynamic_request.php?req="+reqType,
        data:data,
        success: function(resMsg){
            response = resMsg
            //return resMsg;
        }
    });
    return response;
}

function doctorNotAvilable(text){
    alert(text);
    resetBtn();
}

function doctorAvailable(recordId){
    
    $.ajax({  
         type:"POST",  
         url:"./tele_request/tele_request.php?get=response",  
         data:{response_id:recordId},  
         success: function(msg){
         var obj = jQuery.parseJSON( msg );
         if(obj.response_code == 3){
            doctorNotAvilable('Provider not availble kindly try another provider');
         }else if(obj.response_code == 4 &&  obj.patient_uri != ''){
           var popup = window.open(obj.patient_uri, '_blank');
           resetBtn();
         }
         else if(obj.response_code == 5){
            setTimeout(doctorAvailable,2000,recordId);
         }else{
             alert("Error kindly contact your provider");
             resetBtn();
         }
         }
        });  
}


function resetBtn(){
    $('.savebtn').prop('disabled',false);
    $('#loadingspan').hide();
    $('#loadingtext').text('Make Consultation');
    $('.close').click();
    //$('#modal').modal('toggle');
}

function buttonClicked(){
    $('.savebtn').prop('disabled',true);
    $('#loadingspan').show();
    $('#loadingtext').text('Please Wait...');
}

//Check Availibility slots for providers
function checkAvailabileSlots(data){
$(data).hide();
var providerId = data.getAttribute('data-provider');
var eventDate = $('#form_date').val();

$.ajax({
   type: "POST",
   url: "./tele_request/available_times.php",
   data: {providerId:providerId,eventDate:eventDate,includes:'yes'},
   success: function(msg){
    var obj = jQuery.parseJSON( msg );
    if(obj.response_code == '1'){
        $.each(obj.slots,function (key,val){
            if(key < 6){
           $(data).parent(".footer_div").append("<a class='btn btn-primary col-sm-5' style='margin:5px;padding-left:0;padding-right:0'>"+val+"</a>");
            }
        });
        
    }else if(obj.response_code == '2'){
        $(data).parent(".footer_div").html("<p>No available slots found</p>");
    } 
   }
 });
}

$('.card').on('click',function(){
    $(".card").css({"border":"1px solid #3c8dbc", "box-shadow":"none"})
    $(this).css({"box-shadow":"0 10px 22px 0 rgb(0 0 0 / 46%), 0 28px 44px 0 rgb(0 0 0 / 43%)"});
    var provId = $(this).find('.provider_reuse').val();
    $('#form_provider_id').val(provId);
    $('.savebtn').show();
});
/*
    Carousel
*/
$('.carousel').carousel({
  interval: false,
});
$('#carousel-example').on('slide.bs.carousel', function (e) {
    /*
        CC 2.0 License Iatek LLC 2018 - Attribution required
    */
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});
</script>
