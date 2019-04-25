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
    sleep(1); //Atbildes laiks uz autentifikācijas pieprasījumu nedrīkst būt mazāks par 1 (vienu) sekundi, lai novērstu brute force uzbrukuma iespējamību.


include("db.php");

    $result = $db->query("SELECT * FROM darbinieki WHERE darbEpasts='$email'");
    $myrow = mysqli_fetch_array($result);


    echo $myrow['blocked'];
        if ($myrow['blocked'] == true)
        {
            header("Location: login.php?error=blocked");
        }
        else if ($myrow['darbParole'] == $password) {
            $_SESSION['email'] = $myrow['darbEpasts'];
            $_SESSION['id'] = $myrow['darbID'];
            $_SESSION['authorized'] = "Yes";
            $db -> query("UPDATE darbinieki set attempts = 0 where darbEpasts ='".$myrow['darbEpasts']."';");
            $db->close();
            header("Location: index.php");
            exit();
        }
        else {
            $result = $db->query("SELECT * FROM darbinieki WHERE darbEpasts='$email'");
            $row = mysqli_fetch_array($result);
            if ($row == null)
            {
                header("Location: login.php"."?error=wrongPassOrEmail");
            }
            else if ($row['attempts'] == null || ($row['attempts']<2 && $row['attempts'] >=0))
            {
                $attempts = 0;
                if($row['attempts'] != null)
                {
                    $attempts = $row['attempts'];
                }

                $attempts ++;
//                echo $attempts;
                $db -> query("UPDATE darbinieki set attempts = $attempts where darbEpasts = '$email'");
                header("Location: login.php"."?error=wrongPassOrEmail&attempts=$attempts");
            }
            else {
                $db -> query("UPDATE darbinieki set blocked = 1, attempts = 3 where darbEpasts = '$email'");

                header("Location: login.php"."?error=blocked");
            }


        }

?>