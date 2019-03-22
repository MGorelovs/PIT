<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maksims Gorelovs, 161RDB251</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
    </noscript>

</head>

<body>

<?php
include ("header.php");
?>

<!-- Playlist -->
<div align="center" class="play">
    <iframe src="https://open.spotify.com/embed/album/1JeygrHOHs9LJj3nhwehb8" width="400" height="480" frameborder="2" allowtransparency="true" allow="encrypted-media"></iframe>
</div>

<?php
include ("footer.php");
?>

</body>
</html>