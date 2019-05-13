<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LSDF - Autorizācija</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <!--[if lte IE 8]>
    <script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="css/skel.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/style-xlarge.css"/>
    </noscript>

</head>

<body>

<?php
include("header.php");
?>


<!-- Login Form -->

<div class="loginform">

    <div id="login">
        <?php
        if (isset($_GET['error'])){
            if ($_GET['error'] == 'wrongPassOrEmail')
            {
                if (isset($_GET['attempts']))
                {
                    echo "<p style='color:red'>Ievadīts e-pasts vai parole ir nepareizs (".$_GET['attempts']."\\3 meģinajumi)</p>";
                }
                else
                {
                    echo "<p style='color:red'>Ievadīts e-pasts vai parole ir nepareizs </p>";
                }
            }
            else {
                echo "<p style='color:red'>Bloķets! </br> Lai atbloķētu profilu, ir jāvēršas pie sistēmas administratora.</p>";
            }

        }

        ?>
        <form action="testreg.php" method="post">

            <div class="field-wrap">
                <input name="email" type="email" placeholder="E-pasta Adrese" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
                <input name="password" type="password" placeholder="Parole" required autocomplete="off"/>
            </div>


            <button class="button1 button-block"/>
            Autorizēties</button>

        </form>


    </div>

</div>

<!-- /form -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


<script src="js/index.js"></script>


<?php
include("footer.php");
?>

</body>
</html>