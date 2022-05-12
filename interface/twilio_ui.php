<?php
require_once("./globals.php");

if($_GET['provider_uri']){
?>
<!doctype html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title><?php echo xlt('Lifemesh TeleConsultation') ?></title>
 
</head>
<body > 

<?php
    $teleRequestUri = $_GET['provider_uri']."&identity=".$_GET['identity']."&from=".$_GET['from'];
    header("Location: " . $teleRequestUri);
}
?>
</body>
</html>