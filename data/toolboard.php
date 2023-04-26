<?php
$datum = date("d.m.Y");
$uhrzeit = date("H:i");
$txtDatumZeit = $datum." - ".$uhrzeit." Uhr";
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <title>RubiZockt bald wieder!</title>
  <link rel="stylesheet" href="css/rubStyle.css">
</head>
<body style="background:darkgrey">
<?php include('navbar.php'); ?>
<br>
Es ist der <?php echo $datum ?> und es ist <?php echo $uhrzeit."Uhr." ?>
