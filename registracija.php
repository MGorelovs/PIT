<!--TODO сделать проверку на совпадение класса группы и класса пары-->
<!--TODO сделать проверку даты регистрации-->

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

<script>
    var dancerChosen = false;
    var compChosen = false;
    var groupChosen = false;

    // var pairLoaded = false;
    // var groupsLoaded = false;
</script>


<!-- Two -->
<section id="two" class="wrapper style2 special">
    <div class="container">

        <form action="addReg.php" method="post">

            <table style="margin-bottom: 0px">
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

                                echo "<option data-closeDate='" . $closeDate->format('Y-m-d H:i:s') . "' value='" . $row['sacID'] . "'>" . $row['sacNosaukums'] . " | " . $row['sacDatums'] . " | " . $row['sacVieta'] . "  (Reģistrācija beigsies: " . $closeDate->format('Y-m-d H:i:s') . ")</option>";
                            }
                            if (!isset($_SESSION['form_sacID']))
                                echo "<option value=\"\" selected disabled hidden>Izveleties...</option>";
                            else
                                echo "<script> document.getElementById('event').value = '" . $_SESSION['form_sacID'] . "' </script>";
                            ?>
                        </select>
                    </td>
                </tr>

            </table>

            <script>
                var dejparID;
                var dejparPartneraID;
                var dejparPartneresID;
                var dejparPartneraVardsUzvards;
                var dejparPartneresVardsUzvards;
                var dejparPartneraKlase;
                var dejparPartneresKlase;
                var dejparPrtneraDzimsanasDatums;
                var dejparPrtneresDzimsanasDatums;

                document.getElementById("dancer").addEventListener("change", getPair)
                document.getElementById("event").addEventListener("change", getComp)

                function getPair() {

                    dancerChosen = true;

                    document.getElementById("placeholder1").hidden = true;
                    document.getElementById("dp").hidden = false;

                    var dancer = document.getElementById("dancer").value;
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'addReg.php', true)
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    var param = "dancer=" + dancer;

                    xhr.onload = function () {
                        if (this.status == 200) {
                            var resp = JSON.parse(this.responseText);

                            dejparID = resp[0].dpID;
                            dejparPartneraID = resp[0].prtneraID;
                            dejparPartneresID = resp[0].prtneresID;
                            dejparPartneraVardsUzvards = resp[0].prtneraVardsUzvards;
                            dejparPartneresVardsUzvards = resp[0].prtneresVardsUzvards;
                            dejparPartneraKlase = resp[0].prtneraKlase;
                            dejparPartneresKlase = resp[0].prtneresKlase;
                            dejparPrtneraDzimsanasDatums = resp[0].prtneraDzimsanasDatums;
                            dejparPrtneresDzimsanasDatums = resp[0].prtneresDzimsanasDatums;

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

                    compChosen = true;

                    document.getElementById("placeholder2").hidden = true;
                    document.getElementById("gr").hidden = false;

                    var comp = document.getElementById("event").value;
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'addReg.php', true)
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    var param = "comp=" + comp;

                    xhr.onload = function () {
                        if (this.status == 200) {

                            var resp = JSON.parse(this.responseText);

                            document.getElementById("gr").innerHTML = "";
                            for (let i of resp) {
                                document.getElementById("gr").innerHTML +=
                                    "<tr>" +
                                    "<td>" +
                                    "<input data-grVecumaGrupa='" + i['grVecumaGrupa'] + "' type=checkbox name=\"form_group[]\" value=" + i['grID'] + ">" +
                                    "</td>" +
                                    "<td>" +
                                    i['grVecumaGrupa'] +
                                    "</td>" +
                                    "<td>" +
                                    i['grKlase'] +
                                    "</td>" +
                                    "</tr>"

                                var checks = document.querySelectorAll('input[type=checkbox]')

                                for (c of checks) {
                                    c.addEventListener("click", function () {
                                        groupChosen = false;
                                        for (c of checks) {
                                            if (c.checked)
                                                groupChosen = true;
                                        }
                                        errorChecking();
                                    })
                                }
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
                            }

                            ;
                            #gr tr {
                                height: 20px
                            }

                            ;
                        </style>
                        <div id="placeholder2">Jāizvelas vienu no sacensībam...</div>
                        <table id="gr" hidden>
                            <tr>
                                <th style="width:20px"></th>
                                <th>Vecuma Grupa</th>
                                <th>Klase</th>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <input disabled id="register" type="button" value="Reģistrēt" name="reg">

            <div id="errorWrapper" hidden style="color:red">

                <div>Kļudas:</div>

                <div id="error">
                </div>
            </div>
            <script>

                document.getElementById('dancer').addEventListener('change', errorChecking);
                document.getElementById('event').addEventListener('change', errorChecking);

                function errorChecking() {
                    var errorHTML = "";
                    var dateValid = false;

                    var closeDate = $("#event").find("option:selected").data("closedate");
                    closeDate = new Date(closeDate);
                    var today = new Date();

                    if (today > closeDate)
                        dateValid = false;
                    else
                        dateValid = true;

                    var groupValid = true;


                    var selGroups = $("input[type=checkbox]:checked").toArray();
                    var prtneraVecums = new Date().getFullYear() - new Date(dejparPrtneraDzimsanasDatums).getFullYear()
                    var prtneresVecums = new Date().getFullYear() - new Date(dejparPrtneresDzimsanasDatums).getFullYear()

                    var vg;

                    for (gr of selGroups) {

                        vg = gr.getAttribute("data-grVecumaGrupa")

                        switch (vg) {
                            case "Child 1":
                                if (prtneraVecums > 9 || prtneresVecums > 9)
                                    groupValid = false;
                                break
                            case "Child 2":
                                if ((prtneraVecums > 11 || prtneraVecums < 10) || (prtneresVecums > 11 || prtneresVecums < 10))
                                    groupValid = false;
                                break
                            case "Junior 1":
                                if ((prtneraVecums > 13 || prtneraVecums < 12) || (prtneresVecums > 13 || prtneresVecums < 12))
                                    groupValid = false;
                                break
                            case "Junior 2":
                                if ((prtneraVecums > 15 || prtneraVecums < 14) || (prtneresVecums > 15 || prtneresVecums < 14))
                                    groupValid = false;
                                break
                            case "Teen":
                                if ((prtneraVecums > 18 || prtneraVecums < 16) || (prtneresVecums > 18 || prtneresVecums < 16))
                                    groupValid = false;
                                break
                            case "Adult":
                                if (prtneraVecums < 18 || prtneresVecums < 18)
                                    groupValid = false;
                                break

                        }


                    }


                    if (compChosen && dancerChosen && groupChosen && dateValid && groupValid) {
                        errorHTML = "";
                        document.getElementById('register').disabled = false;
                        document.getElementById('errorWrapper').hidden = true;
                    } else {
                        if (!compChosen) {
                            errorHTML += "Nav izvelēta sacensība</br>"
                        }

                        if (!dancerChosen) {
                            errorHTML += "Nav izvelēts dejotājs<br>"
                        }

                        if (!groupChosen) {
                            errorHTML += "Nav izvelēta grupa<br>"
                        }

                        if (!dateValid) {
                            errorHTML += "Šai sacensibai reģistracija ir beigusies<br>"
                        }

                        if (!groupValid)
                            errorHTML += "Izveletas grupas nepieļauj šo deju pari pec vecuma grupas<br>"


                        document.getElementById('register').disabled = true;
                        document.getElementById('errorWrapper').hidden = false;
                    }

                    document.getElementById('error').innerHTML = errorHTML;
                }


                document.getElementById('register').addEventListener('click', function () {
                    var grID_array = [];
                    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked')

                    if (checkboxes.length == 0) {
                        alert("Nav izveleta grupa!");
                        return
                    }

                    for (let i of checkboxes) {
                        grID_array.push(i.value);
                    }

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'addReg.php', true)
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                    var pair = document.getElementById('dejparID').innerHTML;
                    var comp = document.getElementById('event').value;
                    var groups = JSON.stringify(grID_array);


                    var param = "r_pair=" + pair + "&" + "r_comp=" + comp + "&" + "r_groups=" + groups;

                    xhr.onload = function () {
                        if (this.status == 200) {
                            alert("Reģistrēts!");
                            alert(this.responseText);
                        }
                    };

                    xhr.send(param);


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