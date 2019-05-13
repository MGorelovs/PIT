<?php
// TODO Добавить ссылки и присвоение SESSION для авторизованного юзера (на данный момент работает только без авторизации)
// TODO Добавить Add/Edit/Delete функционал
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$db = mysqli_connect("127.0.0.1", "root", "0000", "mydb");
$db->query("SET NAMES utf8mb4");
$grID = $_GET['group'];
$query = "SELECT * FROM sacensibu_grupas WHERE grID = $grID";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$query = "
  SELECT dp.dejparID AS dejparID, d1.dejotVardsUzvards AS vVardsUzvards, d2.dejotVardsUzvards AS sVardsUzvards
  FROM registretie_pari rp
  JOIN deju_pari dp ON rp.fk_dejparID = dp.dejparID
  JOIN dejotaji d1 ON dp.dejparPartneraID = d1.dejotID
  JOIN dejotaji d2 ON dp.dejparPartneresID = d2.dejotID
  WHERE rp.fk_grID = $grID
";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LSDF - <?php echo "${row["grVecumaGrupa"]} ${row["grKlase"]}"; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery.tabledit.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="locales/bootstrap-datepicker.lv.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/skel-layers.min.js"></script>
    <script src="js/init.js"></script>
    <noscript><
        <link rel="stylesheet" href="css/skel.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/style-xlarge.css"/>
    </noscript>
</head>

<body>

<?php
include ("header.php");
?>

<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">

        <header class="major">
            <h2><?php echo "${row["grVecumaGrupa"]} ${row["grKlase"]}" ?></h2>
            <p>Informācija</p>
        </header>


        <!-- Table -->
        <section>
            <h3>Grupas informācijas</h3>
            <div class="table-wrapper">
                <table id="dp" style="text-align: left; font-size:10pt">

                    <tr>
                        <td style="width:400px">Grupas ID:</td>
                        <td><?php echo $row["grID"]?></td>
                    </tr>

                    <tr>
                        <td style="width:400px">Grupa</td>
                        <td><?php echo "${row["grVecumaGrupa"]} ${row["grKlase"]}"; ?></td>
                    </tr>


                </table>
            </div>

        </section>
        <br>
        <br>
        <!-- Table -->
        <section>
            <h3>Grupas</h3>
            <div class="table-wrapper">
                <table id="grupas" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Pāra ID</th>
                        <th>Partnera Vārds un Uzvārds</th>
                        <th>Partnere Vārds un Uzvārds</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    while($grupa = mysqli_fetch_array($result))
                    {
                        echo '
                        <tr>
                            <td>'.$grupa["dejparID"].'</td>
                            <td>'.$grupa["vVardsUzvards"].'</td>
                            <td>'.$grupa["sVardsUzvards"].'</td>
                        </tr>
                        ';

                    }
                    ?>
                    </tbody>

                </table>
            </div>

        </section>
        <br>
        <br>


    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>