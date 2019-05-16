<?php

$grVecumaGrupa = $_POST['grVecumaGrupa'];
$grKlase = $_POST['grKlase'];
$sacID = $_GET['event'];

include("db.php");

$result2 = $db->query("INSERT INTO sacensibu_grupas VALUES (null, '$grVecumaGrupa','$grKlase','$sacID')");

header("Location: event.php?event=${sacID}");
exit();
?>