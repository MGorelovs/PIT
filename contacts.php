<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LSDF - Kontakti</title>
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

<!-- Two -->
<section id="two" class="wrapper style2 special">
    <div class="container">
        <header class="major">
            <h2>Mūsu komanda</h2>
            <p>Darbinieki, kas strāda federācijā</p>
        </header>
        <section class="profiles">
            <div class="row">
                <section class="3u 6u(medium) 12u$(xsmall) profile">
                    <img src="images/profile_placeholder.gif" alt="" />
                    <h4>Maksims Gorelovs</h4>
                    <p>Administrators</p>
                </section>
                <section class="3u 6u$(medium) 12u$(xsmall) profile">
                    <img src="images/profile_placeholder.gif" alt="" />
                    <h4>Danils Grics</h4>
                    <p>Dokumentācija</p>
                </section>
                <section class="3u 6u(medium) 12u$(xsmall) profile">
                    <img src="images/profile_placeholder.gif" alt="" />
                    <h4>Kirils Savinihs</h4>
                    <p>IT darbinieks</p>
                </section>
            </div>
        </section>
    </div>
</section>




<?php
include ("footer.php");
?>


</body>
</html>
