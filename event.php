<?php
// TODO Добавить ссылки и присвоение SESSION для авторизованного юзера (на данный момент работает только без авторизации)
// TODO Добавить Add/Edit/Delete функционал
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if ( isset($_GET['group']) ) { $_SESSION['group'] = $_GET['group'];
    }
    else {
        $_SESSION['group']=0;
    }
}

$db = mysqli_connect("127.0.0.1", "root", "0000", "mydb");
$db->query("SET NAMES utf8mb4");
$sacID = $_GET['event'];
$query = "SELECT * FROM sacensibas WHERE sacID = $sacID";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_array($result);
$query = "
  SELECT DISTINCT (sg.grID) as grID, sg.grVecumaGrupa as grVecumaGrupa, sg.grKlase as grKlase,
    (SELECT COUNT(regID) FROM registretie_pari WHERE fk_sacID = $sacID) as regParuSk
  FROM sacensibu_grupas sg
  LEFT JOIN registretie_pari rp ON rp.fk_sacID = sg.fk_sacID
  WHERE sg.fk_sacID = $sacID";
$result = mysqli_query($db, $query);
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
            <h3>Sacensību informācijas</h3>
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
        <br>
        <br>
        <!-- Table -->
        <section>
            <h3>Grupas</h3>
            <div class="table-wrapper">
                <table id="grupas" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Grupa</th>
                        <th>Reģistrēto pāru skaits</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    while($grupa = mysqli_fetch_array($result))
                    {
                        echo '<tr>';
                        echo'<td>'.$grupa["grID"].'</td>';
                        echo'<td>';
                        echo'<a href="registered.php?group='.$grupa["grID"].'">'.$grupa["grVecumaGrupa"].' '.$grupa["grKlase"].'</a>';
                        echo '</td>';
                        echo'<td>'.$grupa["regParuSk"].'</td>';
                        echo'</tr>';

                    }
                    ?>
                    </tbody>

                </table>
            </div>

        </section>

        <?php if(isset($_SESSION['authorized'])): ?>
            <section id="three" class="wrapper style3 special">
                <div class="table-wrapper">
                    <form action="addGroup.php?event=<?php echo $row["sacID"]; ?>" method="post">
                        <div>
                            <div>
                                <div>
                                    <table>
                                        <tr>
                                            <td>
                                                <select id="grVecumaGrupa" name = "grVecumaGrupa">
                                                    <option selected value = "Bērni 1">Bērni 1</option>
                                                    <option value = "Bērni 2">Bērni 2</option>
                                                    <option value = "Juniori 1">Juniori 1</option>
                                                    <option value = "Juniori 2">Juniori 2</option>
                                                    <option value = "Jaunieši">Jaunieši</option>
                                                    <option value = "Pieaugušie">Pieaugušie</option>
                                                </select>
                                            </td>

                                            <td>
                                                <select id="grKlase" name = "grKlase">
                                                    <option selected value = "Iesācēji 1">Iesācēji 1</option>
                                                    <option value = "Iesācēji 2">Iesācēji 2</option>
                                                    <option value = "Iesācēji 3">Iesācēji 3</option>
                                                    <option value = "E4">E4</option>
                                                    <option value = "E6">E6</option>
                                                    <option value = "D">D</option>
                                                    <option value = "C">C</option>
                                                    <option value = "B">B</option>
                                                    <option value = "A">A</option>
                                                    <option value = "S">S</option>
                                                </select>
                                            </td>

                                        </tr>
                                    </table>
                                </div>

                            </div>
                            <div class="12u$">
                                <ul class="actions">
                                    <li><input id="submit" value="Pievienot" class="special big" type="submit"></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        <?php endif; ?>

        <br>
        <br>


    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>
