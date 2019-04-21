<?php
//action.php
$connect = mysqli_connect('127.0.0.1', 'root', '0000', 'testing');

$input = filter_input_array(INPUT_POST);

$sacNosaukums = mysqli_real_escape_string($connect, $input["sacNosaukums"]);
$sacDatums = mysqli_real_escape_string($connect, $input["sacDatums"]);
$sacVieta = mysqli_real_escape_string($connect, $input["sacVieta"]);

if($input["action"] === 'edit')
{
    $query = "
 UPDATE sacensibas 
 SET sacNosaukums = '".$sacNosaukums."', 
 sacDatums = '".$sacDatums."',
 sacVieta = '".$sacVieta."' 
 WHERE sacID = '".$input["sacID"]."'
 ";

    mysqli_query($connect, $query);

}
if($input["action"] === 'delete')
{
    $query = "
 DELETE FROM sacensibas 
 WHERE sacID = '".$input["sacID"]."'
 ";
    mysqli_query($connect, $query);
}

echo json_encode($input);

?>
