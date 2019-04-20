<?php
    session_start();
    if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} }
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }

    if (empty($email) or empty($password))
        {
            exit ("Aizpildiet visus laukus!");
        }

    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);

    $email = trim($email);
    $password = trim($password);

    include("db.php");

$result = $db->query("SELECT * FROM darbinieki WHERE darbEpasts='$email'");
    $myrow = mysqli_fetch_array($result);
if (empty($myrow['darbParole']))
    {
        exit ("Ievadīts e-pasts vai parole ir nepareizs");
    }
    else {
        if ($myrow['darbParole'] == $password) {
            $_SESSION['email'] = $myrow['darbEpasts'];
            $_SESSION['id'] = $myrow['darbID'];
//            $_SESSION['userType']=$myrow['userType'];
            header("Location: index.php");
            exit();
        }
        else {

            exit ("Ievadīts e-pasts vai parole ir nepareizs\"");
        }
    }
?>