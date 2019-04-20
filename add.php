<?php

$sacNosaukums = $_POST['sacNosaukums'];
$sacDatums = $_POST['sacDatums'];
$sacVieta = $_POST['sacVieta'];

include("db.php");

$result2 = $db->query("INSERT INTO sacensibas VALUES (null, '$sacNosaukums','$sacDatums','$sacVieta')");

header("Location: sacensibas.php");
exit();
?>