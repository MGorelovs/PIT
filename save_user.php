<?php
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if ($email == '') {
            unset($email);
        }
    }

    if (isset($_POST['password'])) {
        $password=$_POST['password'];
        if ($password =='') {
            unset($password);
        }
    }

    if (isset($_POST['firstname'])) {
        $firstname=$_POST['firstname'];
        if ($firstname =='') {
            unset($firstname);
        }
    }

    if (isset($_POST['lastname'])) {
        $lastname=$_POST['lastname'];
        if ($lastname =='') {
            unset($lastname);
        }
    }

    if (empty($email) or empty($password) or empty($firstname) or empty($lastname)) {
        exit ("Dažie lauki nav aizpildīti.");
    }

    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $firstname = stripslashes($firstname);
    $firstname = htmlspecialchars($firstname);
    $lastname = stripslashes($lastname);
    $lastname = htmlspecialchars($lastname);

    $email = trim($email);
    $password = trim($password);
    $firstname = trim($firstname);
    $lastname = trim($lastname);


    include ("bd.php");


    $result = $db->query("SELECT id FROM users WHERE email='$email'");
    $myrow = mysqli_fetch_array($result);

    if (!empty($myrow['id'])) {
        exit ("Lietotājs ar tādu e-pastu jau eksistē!");
}

    $result2 = $db->query ("INSERT INTO users (email,password, fn, ln, userType) VALUES('$email','$password','$firstname','$lastname',0)");

    if ($result2=='TRUE') {
        echo "Reģistrācija ir veiksmīgi pabeigta. Jūs varāt atgriezties sākumā <a href='index.php'>Sākums</a>";
    }
    else {
        echo "Kļūda! Jūs neesat piereģistrēts.";
    }
?>