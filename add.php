<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    if ($name == '') {
        unset($name);
    }
}

include ("bd.php");

$result2 = $db->query ("INSERT INTO tabula (name, expiration_date) VALUES('$name', now())");

header("Location: databases.php");
exit();
?>