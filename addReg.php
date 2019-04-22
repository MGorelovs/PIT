<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include ("db.php");
$eventID = $_POST['event'];
$dancerID = $_POST['dancer'];
$_SESSION['form_sacID'] = $eventID;
$_SESSION['form_dejotID']= $dancerID;
$_SESSION['form_grID_array'] = $_POST['form_group'];


echo 'sacensibas:</br>';
echo $_SESSION['form_sacID'].'</br>';
echo 'dejotaji:</br>';
echo $_SESSION['form_dejotID'].'</br>';
echo 'grupas:</br>';
echo print_r($_SESSION['form_grID']);



//echo print_r($_SESSION);

if (isset($_POST['getPairs']))
{
    $query = $db ->query("SELECT * FROM deju_pari where dejparPartneraID = $dancerID OR dejparPartneresID = $dancerID");
    
    while($row = mysqli_fetch_array($query))
    {
        $_SESSION['form_dejparID']=$row['dejparID'];
        $_SESSION['form_dejparPartneraID'] = $row['dejparPartneraID'];
        $_SESSION['form_dejparPartneresID'] = $row['dejparPartneresID'];
        $_SESSION['form_dejparDibinasanasDatums'] = $row['dejparDibinasanasDatums'];
        $_SESSION['form_dejparLikvidacijasDatums'] = $row['dejparLikvidacijasDatums'];
    }

    $query = $db ->query("SELECT * FROM dejotaji where dejotID = ".$_SESSION['form_dejparPartneraID']);
    while($row = mysqli_fetch_array($query))
    {
        $_SESSION['form_dejparPartneraVardsUzvards'] = $row['dejotVardsUzvards'];
        $_SESSION['form_dejparPartneraDzimsanasDatums'] = $row['dejotDzimsanasDatums'];
        $_SESSION['form_dejparPartneraDzimums'] = $row['dejotDzimums'];
        $_SESSION['form_dejparPartneraVecumaGrupa'] = $row['dejotVecumaGrupa'];
        $_SESSION['form_dejparPartneraKlase'] = $row['dejotKlase'];
    }


    $query = $db ->query("SELECT * FROM dejotaji where dejotID = ".$_SESSION['form_dejparPartneresID']);
    while($row = mysqli_fetch_array($query))
    {
        $_SESSION['form_dejparPartneresVardsUzvards'] = $row['dejotVardsUzvards'];
        $_SESSION['form_dejparPartneresDzimsanasDatums'] = $row['dejotDzimsanasDatums'];
        $_SESSION['form_dejparPartneresDzimums'] = $row['dejotDzimums'];
        $_SESSION['form_dejparPartneresVecumaGrupa'] = $row['dejotVecumaGrupa'];
        $_SESSION['form_dejparPartneresKlase'] = $row['dejotKlase'];
    }
    

}
else if (isset($_POST['reg']))
{
    $db ->query("insert into pieteikumi values (null,'test',".$_SESSION['form_sacID'].",".$_SESSION['form_dejparID'].",".$_SESSION['form_grID_array'][0].",false)");
//    echo "insert into pieteikumi values (null,'test',".$_SESSION['form_sacID'].",".$_SESSION['form_dejparID'].",".$_SESSION['form_grID_array'][0].",'false')";
    echo $db->error;
}
header("Location: registracija.php");

