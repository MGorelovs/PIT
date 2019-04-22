<?php
$mysqli = new mysqli('127.0.0.1', 'root', '0000', 'mydb');
$mysqli->query("SET NAMES utf8mb4");

if (mysqli_connect_errno()) {
    echo json_encode(array('mysqli' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
    exit;
}

header('Content-Type: application/json');
$input = filter_input_array(INPUT_POST);


if ($input['action'] == 'edit') {
    $mysqli->query("UPDATE sacensibas SET sacNosaukums='" . $input['sacNosaukums'] . "', sacDatums='" . $input['sacDatums'] . "', sacVieta='" . $input['sacVieta'] . "'  WHERE sacID='" . $input['sacID'] . "'");
} else if ($input['action'] == 'delete') {
    $mysqli->query("DELETE FROM sacensibas WHERE sacID='" . $input['sacID'] . "'");
    echo "<meta http-equiv='refresh' content='0'>";
}

echo json_encode($input);

?>
