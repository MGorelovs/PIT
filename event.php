<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$db = mysqli_connect("127.0.0.1", "root", "0000", "mydb");
$db->query("SET NAMES utf8mb4");
$sacID = $_GET['role'];
$query = "SELECT * FROM sacensibas WHERE sacID = $sacID";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LSDF - <?php echo $row["sacNosaukums"]; ?></title>
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
            <h2><?php echo $row["sacNosaukums"]?></h2>
            <p>Informācija</p>
        </header>


        <!-- Table -->
        <section>
            <h3>Tabula</h3>
            <div class="table-wrapper">
                <table id="dp" style="text-align: left; font-size:10pt">

                    <tr>
                        <td style="width:400px">Sacensību ID:</td>
                        <td><?php echo $row["sacID"]?></td>
                    </tr>

                    <tr>
                        <td style="width:400px">Sacensību nosaukums</td>
                        <td><?php echo $row["sacNosaukums"]?></td>
                    </tr>

                    <tr>
                        <td style="width:400px">Sacensību datums</td>
                        <td><?php echo $row["sacDatums"]?></td>
                    </tr>

                    <tr>
                        <td style="width:400px">Norises vieta</td>
                        <td><?php echo $row["sacVieta"]?></td>
                    </tr>

                </table>
            </div>

        </section>


    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>