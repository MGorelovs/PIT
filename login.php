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


    <!-- Login Form -->

    <div class="loginform">

      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Registrācija</a></li>
        <li class="tab"><a href="#login">Autorizācija</a></li>
      </ul>

      <div class="tab-content">
        <div id="signup">

          <form action="save_user.php" method="post">

            <div class="top-row">
              <div class="field-wrap">
                <input name="firstname" type="text" placeholder="Vārds" required autocomplete="off" />
              </div>

              <div class="field-wrap">
                <input name="lastname" type="text" placeholder="Uzvārds" required autocomplete="off"/>
              </div>
            </div>

            <div class="field-wrap">
              <input name="email" type="email" placeholder="E-pasta Adrese" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
              <input name="password" type="password" placeholder="Parole" required autocomplete="off"/>
            </div>

            <button type="submit" class="button1 button-block"/>Reģistrēties</button>

          </form>

        </div>

        <div id="login">

          <form action="testreg.php" method="post">

            <div class="field-wrap">
              <input name="email" type="email" placeholder="E-pasta Adrese" required autocomplete="off"/>
            </div>

            <div class="field-wrap">
              <input name="password" type="password" placeholder="Parole" required autocomplete="off"/>
            </div>


            <button class="button1 button-block"/>Autorizēties</button>

          </form>


        </div>

      </div><!-- tab-content -->

    </div> <!-- /form -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>



    <script  src="js/index.js"></script>


    <?php
    include ("footer.php");
    ?>

    </body>
</html>