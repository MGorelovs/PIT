<?php
//TODO Найти способ сделать так, чтоб при перезагрузке страницы отображалось Izvēlēties... и т.п., но при нажатии Turpināt данные оставались выбранными
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


        <form action="addReg.php" method="post">

            <table style="margin-bottom: 0px">
                <tr>
                    <td style="width:200px">Sacensības:</td>
                    <td>
                        <select name="event" id="event">
                            <?php

                            $sacList = $db->query("SELECT * FROM sacensibas ORDER BY sacDatums ASC");
                            while ($row = mysqli_fetch_array($sacList)) {

                                $closeDate = date_create($row['sacDatums']);

//                                echo '<script>alert(\''.$closeDate->format('Y-m-d H:i:s').'\')</script>>';
                                date_sub($closeDate, date_interval_create_from_date_string("1 days"));
                                $closeDate->setTime(23, 59);

                                echo "<option value='" . $row['sacID'] . "'>" . $row['sacNosaukums'] . " | " . $row['sacDatums'] . " | " . $row['sacVieta'] . "  (Reģistrācija beigsies: " . $closeDate->format('Y-m-d H:i:s') . ")</option>";
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
                    <td style="width:200px">Dejotājs:</td>
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
            </table>

            <div style="padding:20px 20px 20px 20px">

                <input type="button" value="Turpināt" id="getInfo">

            </div>

            <script>
                document.getElementById("getInfo").addEventListener("click", getInfo)

                function getInfo() {

                    var comp = document.getElementById("event").value;
                    var dancer = document.getElementById("dancer").value;

                    var xhr1 = new XMLHttpRequest();
                    xhr1.open('POST', 'addRegAjax.php', true)
                    xhr1.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    var param1 = "comp=" + comp;

                    xhr1.onload = function () {

                    };

                    xhr1.send(param1);

                    var xhr2 = new XMLHttpRequest();
                    xhr2.open('POST', 'addRegAjax.php', true)
                    xhr2.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    var param2 = "dancer=" + comp;

                    xhr2.onload = function () {
                        if (this.status == 200) {
                            var resp = JSON.parse(this.responseText);

                            var dejparID = resp[0].dpID;
                            var dejparPartneraID = resp[0].prtneraID;
                            var dejparPartneresID = resp[0].prtneresID;
                            var dejparPartneraVardsUzvards = resp[0].prtneraVardsUzvards;
                            var dejparPartneresVardsUzvards = resp[0].prtneresVardsUzvards;

                            document.getElementById("dejparID").innerHTML = dejparID;
                            document.getElementById("prtneraID").innerHTML = dejparPartneraID;
                            document.getElementById("prtneresID").innerHTML = dejparPartneresID;
                            document.getElementById("prtneraVardsUzvards").innerHTML = dejparPartneraVardsUzvards;
                            document.getElementById("prtneresVardsUzvards").innerHTML = dejparPartneresVardsUzvards;
                        }


                    };

                    xhr2.send(param2);


                }


            </script>


            <style>
                #dp td {
                    padding: 0px 0px 0px 0px;
                }
            </style>
            <table>
                <tr>
                    <td style="width:200px">Deju pāris:</td>
                    <td>
                        <table id="dp" style="text-align: left; font-size:10pt">

                            <tr>
                                <td style="width:400px">
                                    Deju pāra ID:
                                </td>
                                <td id = "dejparID">

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Deju para klase:
                                </td>
                                <td id="dejparClass">

                                </td>
                            </tr>

                            <!--Partnera-->
                            <tr>
                                <td>
                                    Partnera ID:
                                </td>
                                <td id="prtneraID">

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Partnera Vārds Uzvārds:
                                </td>
                                <td id="prtneraVardsUzvards">

                                </td>
                            </tr>

                            <!--Partneres-->
                            <tr>
                                <td>
                                    Partneres ID:
                                </td>
                                <td id="prtneresID">

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Partneres Vārds Uzvārds:
                                </td>
                                <td id = "prtneresVardsUzvards">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>Grupas:</td>
                    <td>
                        <style>
                            #gr th {
                                text-align: center
                            }

                            ;
                            #gr tr {
                                height: 20px
                            }

                            ;
                        </style>
                        <table id="gr">
                            <tr>
                                <th></th>
                                <th>Vecuma Grupa</th>
                                <th>Klase</th>
                            </tr>

                            <?php
                            $grList = $db->query("SELECT * FROM sacensibu_grupas WHERE fk_sacID=" . $_SESSION['form_sacID']);
                            while ($row = mysqli_fetch_array($grList)) {
                                echo "<tr>

                                        <td>" .
                                    "<input type='checkbox' id='test' name=\"form_group[]\" value=" . $row['grID'] . ">"
                                    . "</td>
                                        <td>" .
                                    $row['grVecumaGrupa']
                                    . "</td>
                                        <td>" .
                                    $row['grKlase']
                                    . "</td>

                                </tr>";
                            }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
            <input id="register" type="submit" value="Reģistrēt" name="reg">
        </form>
    </div>
</section>

<?php
include("footer.php");
?>
</body>
</html>