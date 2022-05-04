<?php

if ($_GET['from'] != 'provider' && $_GET['from'] != 'patient') {
  die('You are not a authorized user');
}
//die('not authorized user found!');
// require 'twilio-php-master/src/Twilio/autoload.php';
$ignoreAuth = true;
require_once(dirname(__file__) . './../interface/globals.php');

require $GLOBALS['vendor_dir'] . '/twilio/sdk/src/Twilio/autoload.php';

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

// Required for all Twilio access tokens
$twilioAccountSid = $GLOBALS['twilio_account_sid'];
$twilioApiKey = $GLOBALS['twilio_api_key'];
$twilioApiSecret = $GLOBALS['twilio_secret_key'];




// Required for Video grant

$roomName = htmlentities($_GET['room']);
//Find provider Id using room
$teleRequest = sqlQuery('select id from tele_request where room = ?', $roomName);

// An identifier for your app - can be anything you'd like
$identity = $_GET['identity'];
$from = $_GET['from'];
if ($from == 'provider') {
  $doctorName = $identity;
}
if ($from == 'patient') {
  $explodeName = explode('_', $_GET['identity']);
  $implodeName = implode(' ', $explodeName);
  $identity = $implodeName;
}
// Create access token, which we will serialize and send to the client
$token = new AccessToken(
  $twilioAccountSid,
  $twilioApiKey,
  $twilioApiSecret,
  3600,
  $identity
);

// Create Video grant
$videoGrant = new VideoGrant();
$videoGrant->setRoom($roomName);

// Add grant to token
$token->addGrant($videoGrant);

// render token to string
//echo $token->toJWT();



?>
<html>
<title>Video Consult</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
<script src="//media.twiliocdn.com/sdk/js/video/releases/2.1.0/twilio-video.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
  header#header {
    height: 80px;
    padding: 15px 0;
    background-color: #fff;
    box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.3);
  }

  a.logo_set {
    display: flex;
  }

  img.logo_one {
    height: 50px;
  }

  img.logo_two {
    height: 50px;
  }

  video {
    width: 100% !important;
  }

  .ico-button {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 100px;
    outline: none;
    background-color: #3c4043;
    color: white;
    cursor: pointer;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
  }

  .d-flex {
    display: flex;
    justify-content: center;
  }

</style>

<body>
  <header id="header" class="header-scrolled">
    <div class="container">
      <div class="logo float-left">
        <a href="https://bootstrapmade.com/" rel="home" class="logo_set">
          <!-- <img class="logo_one" src=""> -->
        </a>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
          <div class='panel-heading'>
            <h4 class='text-center'><span class="card-title" id="card-title-doctor"></span></h4>
          </div>
          <div class="panel-body">

            <div id="remote-media"></div>

          </div><!-- card image -->
        </div>
      </div>
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
          <div class='panel-heading'>
            <h4 class='text-center'><span class="card-title" id="card-title-patient"></span></h4>
          </div>
          <div class="panel-body">

            <div id="local-media"></div>

          </div><!-- card image -->
        </div>
      </div>
      <!-- Buttons Div Start -->
      <div class="text-center btn-toolbar d-flex" id="leave-meeting-div">
        <button class="btn btn-secondary ico-button" id="muteAudio" style="background: #3c4043;" title="Mute Audio"><i class="fa fa-microphone"></i></button>
        <button class="btn btn-secondary ico-button" id="unmuteAudio" style="background: red;display:none;" title="Unmute Audio"><i class="fa fa-microphone-slash"></i></button>
        <button class="btn btn-secondary ico-button" id="stopVideo" style="background: #3c4043;" title="Turn off camera"><i class="fa fa-video-camera"></i></button>
        <button class="btn btn-secondary ico-button" id="startVideo" style="background: red;display:none;" title="Turn on camera"><i class="fa fa-video-slash"></i></button>
        <?php if ($from == 'patient') { ?>
          <button id="leave-meeting" class="btn btn-danger btn-lg ico-button" title="Leave Meeting" style="background:red"><i class='fa fa-sign-out'></i></button>
        <?php } elseif ($from == 'provider') { ?>
          <button id="share_screen" class="btn btn-info ico-button" title="Share screen"><i class="fa fa-desktop"></i></button>
          <button id="end-meeting" class="btn btn-danger ico-button" title="End Consultation" style="transform: rotate(134deg);background: red;"><i class="fa fa-phone"></i></button>

        <?php } ?>
      </div>
    </div>
    <!--<div class="row col-md-12">
<div id='local-media' class="col-md-6"></div>
<div  class="col-md-1"></div>

<div id='remote-media' class="col-md-5"></div>
</div>-->
</body>
<script>
  var token = '<?php echo $token->toJWT() ?>';
  var room = '<?php echo $roomName ?>';
  var identity = '<?php echo $identity ?>';
  var from = '<?php echo $from ?>';
  var drname = '<?php echo $doctorName; ?>';
  // Video connect
  var Video = Twilio.Video;

  var activeRoom;
  var previewTracks;
  var identity;
  var roomName;

  // Attach the Track to the DOM.
  function attachTrack(track, container) {
    container.appendChild(track.attach());
  }

  // Attach array of Tracks to the DOM.
  function attachTracks(tracks, container) {
    tracks.forEach(function(track) {
      attachTrack(track, container);
    });
  }

  // Detach given track from the DOM.
  function detachTrack(track) {
    track.detach().forEach(function(element) {
      element.remove();
    });
  }

  // Appends remoteParticipant name to the DOM.
  function appendName(identity, container) {
    $('#card-title-doctor').text(identity.replace(/_/g, ' '));
    $((from == "provider") ? "<span id='doc-span' style='padding-right:5px;'><i class='fa fa-user-o'></i></span> " : "<span id='doc-span' style='padding-right:5px;'><i class='fa fa-user-md'></i></span> ").insertBefore("#card-title-doctor");
  }

  //Append End button after participants connected
  function appendEndButton() {
    $('leave-meeting-div').show();
    //container = document.getElementById('leave-meeting-div');
    //const name = document.createElement('button');
    //name.id = 'leave-meeting';
    //name.className = 'btn btn-danger';
    //name.textContent = 'Leave Meeting';
    //container.appendChild(name);
  }

  // Removes remoteParticipant container from the DOM.
  function removeName(participant) {
    if (participant) {
      let {
        identity
      } = participant;
      const container = document.getElementById(
        `participantContainer-${identity}`
      );
      container.parentNode.removeChild(container);
    }
  }

  // A new RemoteTrack was published to the Room.
  function trackPublished(publication, container) {
    if (publication.isSubscribed) {
      attachTrack(publication.track, container);
    }
    publication.on('subscribed', function(track) {
      console.log('Subscribed to ' + publication.kind + ' track');
      attachTrack(track, container);
    });
    publication.on('unsubscribed', detachTrack);
  }

  // A RemoteTrack was unpublished from the Room.
  function trackUnpublished(publication) {
    console.log(publication.kind + ' track was unpublished.');
  }

  // A new RemoteParticipant joined the Room
  function participantConnected(participant, container) {

    let selfContainer = document.createElement('div');
    selfContainer.id = `participantContainer-${participant.identity}`;

    container.appendChild(selfContainer);
    appendName(participant.identity, selfContainer);

    appendEndButton();

    participant.tracks.forEach(function(publication) {
      trackPublished(publication, selfContainer);
    });
    participant.on('trackPublished', function(publication) {
      trackPublished(publication, selfContainer);
    });
    participant.on('trackUnpublished', trackUnpublished);
  }

  // Detach the Participant's Tracks from the DOM.
  function detachParticipantTracks(participant) {
    var tracks = getTracks(participant);
    tracks.forEach(detachTrack);
  }
  // When we are about to transition away from this page, disconnect
  // from the room, if joined.
  window.addEventListener('beforeunload', leaveRoomIfJoined);


  // join Room.
  function JoinRoom(roomName, token) {
    if (!roomName) {
      alert('Please Specify a room name.');
      return;
    }

    var connectOptions = {
      name: roomName,
    };

    if (previewTracks) {
      connectOptions.tracks = previewTracks;
    }

    // Join the Room with the token from the server and the
    // LocalParticipant's Tracks.
    Video.connect(token, connectOptions).then(roomJoined, function(error) {
      alert('Could not connect to Video Channel: ' + error.message);
    });
  };

  // Bind button to leave Room.
  $('#leave-meeting').on('click', function() {
    //console.log('Leaving room...');
    var end_teleconsult = confirm("Are you sure you want to Leave TeleConsultation?");
    if (end_teleconsult == true) {
      activeRoom.disconnect();
      window.close();
    }
  });

  // Bind button to leave Room.
  $('#end-meeting').on('click', function() {
    //console.log('Leaving room...');
    var end_teleconsult = confirm("Are you sure you want to Leave TeleConsultation?");
    if (end_teleconsult == true) {
      var teleRequestId = parseInt(<?php echo $teleRequest['id']; ?>);
      var roomname = '<?php echo $roomName ?>';
      $.ajax({
        type: 'post',
        url: './tele_request/query_request.php?use=end_meeting',
        data: {
          tele_request_id: teleRequestId,
          room_name: roomname
        },
        success: function(data) {
          if (data == 'success') {} else {
            alert('Error');
          }
        },
        // error: function (request, status, error) {
        //     alert(request.responseText);
        // }
      });
      activeRoom.disconnect();
    }
  });

  // Get the Participant's Tracks.
  function getTracks(participant) {
    return Array.from(participant.tracks.values()).filter(function(publication) {
      return publication.track;
    }).map(function(publication) {
      return publication.track;
    });
  }

  // Successfully connected!
  function roomJoined(room) {
    window.room = activeRoom = room;

    $('#card-title-patient').text(identity.replace(/_/g, ' '));
    $((from == "provider") ? "<span style='padding-right:5px;'><i class='fa fa-user-md'></i></span>" : "<span style='padding-right:5px;'><i class='fa fa-user-o'></i></span>").insertBefore("#card-title-patient");

    // Attach LocalParticipant's Tracks, if not already attached.
    var previewContainer = document.getElementById('local-media');
    if (!previewContainer.querySelector('video')) {
      attachTracks(getTracks(room.localParticipant), previewContainer);
    }
    if (room.participants.size < 1 && from == 'patient') {
      alert('Doctor Not Connected...Please wait or try again...');
    } else if (room.participants.size < 1 && from == 'provider') {
      alert('Patient Not Connected...Please wait or try again...');
    }

    // Attach the Tracks of the Room's Participants.
    var remoteMediaContainer = document.getElementById('remote-media');
    room.participants.forEach(function(participant) {
      //console.log("Already in Room: '" + participant.identity + "'");
      participantConnected(participant, remoteMediaContainer);
    });

    // When a Participant joins the Room, log the event.
    room.on('participantConnected', function(participant) {
      //console.log("Joining: '" + participant.identity + "'");
      participantConnected(participant, remoteMediaContainer);
    });

    // When a Participant leaves the Room, detach its Tracks.
    room.on('participantDisconnected', function(participant) {
      //console.log("RemoteParticipant '" + participant.identity + "' left the room");
      detachParticipantTracks(participant);
      removeName(participant);
      $('#card-title-doctor').text('');
      $('#doc-span').remove();
      if (from == 'provider') {
        alert('Patient has disconnected from Teleconsulation');
      } else if (from == 'patient') {
        alert('Doctor has disconnected from Teleconsulation');
      }
    });

    // Once the LocalParticipant leaves the room, detach the Tracks
    // of all Participants, including that of the LocalParticipant.
    room.on('disconnected', function() {
      //console.log('Left');
      if (previewTracks) {
        previewTracks.forEach(function(track) {
          track.stop();
        });
        previewTracks = null;
      }
      detachParticipantTracks(room.localParticipant);
      room.participants.forEach(detachParticipantTracks);
      room.participants.forEach(removeName);
      activeRoom = null;
      // window.open('#','_self');
    });
  }

  // Activity log.
  /*function log(message) {
    var logDiv = document.getElementById('log');
    logDiv.innerHTML += '<p>&gt;&nbsp;' + message + '</p>';
    logDiv.scrollTop = logDiv.scrollHeight;
  }*/

  // Leave Room.
  function leaveRoomIfJoined() {
    if (activeRoom) {
      activeRoom.disconnect();
    }
  }


  $(document).ready(function() {
    $('leave-meeting-div').hide();
    JoinRoom(room, token);
  });

  //Screen share
  <?php if ($from == 'provider') { ?>
    var shareScreen = document.getElementById('share_screen');
    var screenTrack;
    shareScreen.addEventListener('click', shareScreenHandler);
  <?php } ?>

  function shareScreenHandler() {
    event.preventDefault();
    if (!screenTrack) {
      navigator.mediaDevices.getDisplayMedia().then(stream => {
        screenTrack = new Twilio.Video.LocalVideoTrack(stream.getTracks()[0]);
        room.localParticipant.publishTrack(screenTrack);
        shareScreen.style.background = '#5bc0de';
        screenTrack.mediaStreamTrack.onended = () => {
          shareScreenHandler()
        };
      }).catch(() => {
        alert('Could not share the screen.');
      });
    } else {
      room.localParticipant.unpublishTrack(screenTrack);
      screenTrack.stop();
      screenTrack = null;
      shareScreen.style.background = '#3c4043';
    }
  };

  const startvideo = document.getElementById('startVideo');
  startvideo.addEventListener('click', startVideo);

  const stopvideo = document.getElementById('stopVideo');
  stopvideo.addEventListener('click', stopVideo);

  const muteaudio = document.getElementById('muteAudio');
  muteaudio.addEventListener('click', muteAudio);

  const unmuteaudio = document.getElementById('unmuteAudio');
  unmuteaudio.addEventListener('click', unmuteAudio);

  function muteAudio() {
    room.localParticipant.audioTracks.forEach(track => {
      track.track.disable();
      muteaudio.style.display = 'none';
      unmuteaudio.style.display = 'block';
    });
  }

  function unmuteAudio() {
    room.localParticipant.audioTracks.forEach(track => {
      track.track.enable();
      unmuteaudio.style.display = 'none';
      muteaudio.style.display = 'block';
    });
  }

  function startVideo() {
    room.localParticipant.videoTracks.forEach(function(track) {
      track.track.enable();
      startvideo.style.display = 'none';
      stopvideo.style.display = 'block';
    });
  }



  function stopVideo() {
    room.localParticipant.videoTracks.forEach(function(track) {
      track.track.disable();
      stopvideo.style.display = 'none';
      startvideo.style.display = 'block';

    });
  }
</script>

</html>