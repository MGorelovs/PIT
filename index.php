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

    <!-- One -->
    <section id="one" class="wrapper style1 special">
        <div class="container">
            <header class="major">
                <h2>Latvijas Sporta deju federācija </h2>
                <p>Laipni lūdzam Latvijas Sporta deju federācijas mājas lapā!</p>
            </header>
            <div class="row 150%">
                <div class="4u 12u$(medium)">
                    <section class="box">
                        <i class="icon big rounded color1 fa-cloud"></i>
                        <h3>Ziņas 3 virsraksts</h3>
                        <p>Pēdejas ziņas īss apraksts ar linku... <a href="article3.php">Lasīt tālāk</a> </p>
                    </section>
                </div>
                <div class="4u 12u$(medium)">
                    <section class="box">
                        <i class="icon big rounded color9 fa-desktop"></i>
                        <h3>Ziņas 2 virsraksts</h3>
                        <p>Priekšpēdejas ziņas īss apraksts ar linku... <a href="article2.php">Lasīt tālāk</a></p>
                    </section>
                </div>
                <div class="4u$ 12u$(medium)">
                    <section class="box">
                        <i class="icon big rounded color6 fa-rocket"></i>
                        <h3>Ziņas 1 virsraksts</h3>
                        <p>Pirmas ziņas īss apraksts ar linku... <a href="article1.php">Lasīt tālāk</a></p>
                    </section>
                </div>
            </div>
        </div>
    </section>



    <?php
    include ("footer.php");
    ?>


    </body>
</html>