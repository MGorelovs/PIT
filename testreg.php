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

    include ("bd.php");

    $result = $db ->query("SELECT * FROM users WHERE email='$email'");
    $myrow = mysqli_fetch_array($result);
    if (empty($myrow['password']))
    {
        exit ("Ievadīts e-pasts vai parole ir nepareizs");
    }
    else {
        if ($myrow['password']==$password) {
            $_SESSION['email']=$myrow['email'];
            $_SESSION['id']=$myrow['id'];
            $_SESSION['userType']=$myrow['userType'];
            header("Location: index.php");
            exit();
        }
        else {

            exit ("Ievadīts e-pasts vai parole ir nepareizs\"");
        }
    }
?>