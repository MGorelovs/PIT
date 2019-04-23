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
            header("Location: login.php"."?error=wrongPassOrEmail");
//            exit ("Ievadīts e-pasts vai parole ir nepareizs");
        }
    else {
        if ($myrow['darbParole'] == $password) {
            $_SESSION['email'] = $myrow['darbEpasts'];
            $_SESSION['id'] = $myrow['darbID'];
            $_SESSION['authorized'] = "Yes";
            sleep(1); //Atbildes laiks uz autentifikācijas pieprasījumu nedrīkst būt mazāks par 1 (vienu) sekundi, lai novērstu brute force uzbrukuma iespējamību.
            header("Location: index.php");
            exit();
        }
        else {
            header("Location: login.php"."?error=wrongPassOrEmail");
//            exit ("Ievadīts e-pasts vai parole ir nepareizs\"");
        }
    }
?>