<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['id']);
unset($_SESSION['userType']);
header("Location: index.php");
exit();
?>
