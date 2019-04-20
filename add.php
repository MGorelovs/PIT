<?php
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    if ($name == '') {
        unset($name);
    }
}

include("db.php");

$result2 = $db->query ("INSERT INTO tabula (name, expiration_date) VALUES('$name', now())");

header("Location: sacensibas.php");
exit();
?>