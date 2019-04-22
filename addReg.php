<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include ("db.php");
$eventID = $_POST['event'];
$dancerID = $_POST['dancer'];
$_SESSION[form_sacID] = $eventID;
$_SESSION[form_dejotID]=$dancerID;

if ($_POST['getPairs'])
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
    
    
    
header("Location: registracija.php");
}
else if ($_POST('reg'))
{

}

