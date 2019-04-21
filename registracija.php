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
<?php
include("db.php");
?>

<!-- Two -->
<section id="two" class="wrapper style2 special">
    <div class="container">
        <header class="major">
            <h2>Reģistrācija</h2>
            <p>Lūdzu ievadiet informāciju:</p>
        </header>
        <form action="addReg.php" method="post">
            <table>
                <tr>
                    <td style="width:200px">Sacensiba:</td>
                    <td>
                        <select name="event" id="event">
                            <?php
                            $sacList = $db->query("SELECT * FROM sacensibas ORDER BY sacDatums DESC");
                            while ($row = mysqli_fetch_array($sacList)) {
                                echo "<option value='" . $row['sacID'] . "'>" . $row['sacNosaukums'] . ' | ' . $row['sacDatums'] . ' | ' . $row['sacVieta'] . "</option>";
                            }
                            if (!isset($_SESSION['form_sacID']))
                                echo "<option value=\"\" selected disabled hidden>Izveleties...</option>";
                            else
                                echo "<script> document.getElementById('event').value = '" . $_SESSION['form_sacID'] . "' </script>";
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="width:200px">Dejotajs:</td>
                    <td>
                        <select name="dancer" id="dancer">
                            <?php
                            $dejList = $db->query("SELECT * FROM dejotaji ORDER BY dejotVardsUzvards ASC ");
                            while ($row = mysqli_fetch_array($dejList)) {
                                echo "<option value='" . $row['dejotID'] . "'>" . $row['dejotVardsUzvards'] . ' | ' . $row['dejotVecumaGrupa'] . ' | ' . $row['dejotKlase'] . "</option>";
                            }
                            if (!isset($_SESSION['form_dejotID']))
                                echo "<option value=\"\" selected disabled hidden>Izveleties...</option>";
                            else
                                echo "<script> document.getElementById('dancer').value = '" . $_SESSION['form_dejotID'] . "'</script>";
                            ?>
                        </select>
                        <input type="hidden" id="dejotID" name="dejotID" value="BLANK">
                        <script>

                            document.getElementById('dancer').addEventListener('change', function () {
                                var sel = document.getElementById('dancer');
                                for (var i = 0, len = sel.options.length; i < len; i++) {
                                    var opt = sel.options[i];
                                    if (opt.selected === true) {
                                        document.getElementById('dejotID').value = opt.value;
                                        break;
                                    }
                                }
                            })
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Get Pair" name="getPairs">
                    </td>
                </tr>
                <tr>
                    <td style="width:200px">Deju paris:</td>
                    <td>
                        <table style="text-align: left">
                            <tr>
                                <td style="width:400px">
                                    Deju para ID:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparID']))
                                        echo $_SESSION['form_dejparID'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr> <!--Partnera-->
                                <td>
                                    Deju para Partnera ID:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneraID']))
                                        echo $_SESSION['form_dejparPartneraID'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partnera Dzimsanas Datums:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneraDzimsanasDatums']))
                                        echo $_SESSION['form_dejparPartneraDzimsanasDatums'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partnera Vards Uzvards:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneraVardsUzvards']))
                                        echo $_SESSION['form_dejparPartneraVardsUzvards'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partnera dzimums:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneraDzimums']))
                                        echo $_SESSION['form_dejparPartneraDzimums'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partnera vecuma grupa:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneraVecumaGrupa']))
                                        echo $_SESSION['form_dejparPartneraVecumaGrupa'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partnera klase:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneraKlase']))
                                        echo $_SESSION['form_dejparPartneraKlase'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>

                            <tr> <!--Partneres-->
                                <td>
                                    Deju para Partneres ID:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneresID']))
                                        echo $_SESSION['form_dejparPartneresID'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partneres Dzimsanas Datums:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneresDzimsanasDatums']))
                                        echo $_SESSION['form_dejparPartneresDzimsanasDatums'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partneres Vards Uzvards:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneresVardsUzvards']))
                                        echo $_SESSION['form_dejparPartneresVardsUzvards'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partneres dzimums:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneresDzimums']))
                                        echo $_SESSION['form_dejparPartneresDzimums'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partneres vecuma grupa:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneresVecumaGrupa']))
                                        echo $_SESSION['form_dejparPartneresVecumaGrupa'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td >
                                    Deju para Partneres klase:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparPartneresKlase']))
                                        echo $_SESSION['form_dejparPartneresKlase'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Deju para Dibinasanas Datums:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparDibinasanasDatums']))
                                        echo $_SESSION['form_dejparDibinasanasDatums'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Deju para Likvidacijas Datums:
                                </td>
                                <td>
                                    <?php
                                    if (isset($_SESSION['form_dejparLikvidacijasDatums']))
                                        echo $_SESSION['form_dejparLikvidacijasDatums'];
                                    else
                                        echo "Izveleties..."
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>


        </form>
    </div>
</section>

<?php
include("footer.php");
?>

</body>
</html>