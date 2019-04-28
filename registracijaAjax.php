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


        <form action="addRegAjax.php" method="post">

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
                    </td>
                </tr>
            </table>

            <script>
                document.getElementById("dancer").addEventListener("change", getPair)
                document.getElementById("event").addEventListener("change", getComp)

                function getPair() {

                    document.getElementById("placeholder1").hidden = true;
                    document.getElementById("dp").hidden = false;

                    var dancer = document.getElementById("dancer").value;
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'addRegAjax.php', true)
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    var param = "dancer=" + dancer;

                    xhr.onload = function () {
                        if (this.status == 200) {
                            var resp = JSON.parse(this.responseText);

                            var dejparID = resp[0].dpID;
                            var dejparPartneraID = resp[0].prtneraID;
                            var dejparPartneresID = resp[0].prtneresID;
                            var dejparPartneraVardsUzvards = resp[0].prtneraVardsUzvards;
                            var dejparPartneresVardsUzvards = resp[0].prtneresVardsUzvards;
                            var dejparPartneraKlase = resp[0].prtneraKlase;
                            var dejparPartneresKlase = resp[0].prtneresKlase;

                            document.getElementById("dejparID").innerHTML = dejparID;
                            document.getElementById("prtneraID").innerHTML = dejparPartneraID;
                            document.getElementById("prtneresID").innerHTML = dejparPartneresID;
                            document.getElementById("prtneraVardsUzvards").innerHTML = dejparPartneraVardsUzvards;
                            document.getElementById("prtneresVardsUzvards").innerHTML = dejparPartneresVardsUzvards;
                            document.getElementById("dejparClass").innerHTML = "</br>Partnera: " + dejparPartneraKlase + "</br>Partneres: " + dejparPartneresKlase;
                        }
                    };
                    xhr.send(param);
                }

                function getComp() {

                    document.getElementById("placeholder2").hidden = true;
                    document.getElementById("gr").hidden = false;

                    var comp = document.getElementById("event").value;
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'addRegAjax.php', true)
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    var param = "comp=" + comp;

                    xhr.onload = function () {
                        if (this.status == 200) {

                            var resp = JSON.parse(this.responseText);

                            for (let i of resp) {
                                document.getElementById("gr").innerHTML +=
                                    "<tr>" +
                                    "<td>" +
                                    "<input type=checkbox name=\"form_group[]\" value="+i['grID']+">" +
                                    "</td>" +
                                    "<td>" +
                                    i['grVecumaGrupa'] +
                                    "</td>" +
                                    "<td>" +
                                    i['grKlase'] +
                                    "</td>" +
                                    "</tr>"
                            }
                        }
                    };
                    xhr.send(param);


                }


            </script>


            <style>
                #dp td {
                    padding: 0px 0px 0px 0px;
                }
            </style>

            <table>
                <tr>
                    <td style="width:100px">Deju pāris:</td>
                    <td>
                        <div id="placeholder1">Jāizvelas vienu no dejotājiem...</div>
                        <table hidden id="dp" style="text-align: left; font-size:10pt">

                            <tr>
                                <td style="width:400px">
                                    Deju pāra ID:
                                </td>
                                <td id="dejparID">
                                    ...
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Deju para klase:
                                </td>
                                <td id="dejparClass">
                                    ...
                                </td>
                            </tr>

                            <!--Partnera-->
                            <tr>
                                <td>
                                    Partnera ID:
                                </td>
                                <td id="prtneraID">
                                    ...
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Partnera Vārds Uzvārds:
                                </td>
                                <td id="prtneraVardsUzvards">
                                    ...
                                </td>
                            </tr>

                            <!--Partneres-->
                            <tr>
                                <td>
                                    Partneres ID:
                                </td>
                                <td id="prtneresID">
                                    ...
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Partneres Vārds Uzvārds:
                                </td>
                                <td id="prtneresVardsUzvards">
                                    ...
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
                            };
                            #gr tr {
                                height: 20px
                            };
                        </style>
                        <div id="placeholder2">Jāizvelas vienu no sacensībam...</div>
                        <table id="gr" hidden>
                            <tr>
                                <th style ="width:20px"></th>
                                <th>Vecuma Grupa</th>
                                <th>Klase</th>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <input id="register" type="button" value="Reģistrēt" name="reg">

            <script>
                document.getElementById('register').addEventListener('click',function (){
                    var grID_array = [];
                    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

                    for (let i of checkboxes)
                    {
                        grID_array.push(i.value);
                    }
                })


            </script>

        </form>
    </div>
</section>

<?php
include("footer.php");
?>
</body>
</html>