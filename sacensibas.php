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
    <noscript><
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
<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">

        <header class="major">
            <h2>Sacensības</h2>
            <p>Sacensību saraksts</p>
        </header>


        <!-- Table -->
        <section>
            <h3>Tabula</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th>Sacensību nosaukums</th>
                        <th>Datums</th>
                        <th>Vieta/Adrese</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $db->query("SET NAMES utf8mb4");
                    $result = $db->query("SELECT * FROM sacensibas ORDER BY sacDatums DESC");
                    echo "</br>" . $db->error;


                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($_SESSION['authorized'] == "Yes") {

                            echo "<tr>";
                            echo "<th>" . $row['sacNosaukums'] . "</th>" . "<th>" . $row['sacDatums'] . "</th>" . "<th>" . $row['sacVieta'] . "</th>" . "<th><a class=\"icon fa-edit\"></a></th>";
                            echo "</tr>";

                        } else {

                            echo "<tr>";
                            echo "<th>" . $row['sacNosaukums'] . "</th>" . "<th>" . $row['sacDatums'] . "</th>" . "<th>" . $row['sacVieta'] . "</th>";
                            echo "</tr>";

                        }

                    }
                    $db->close();
                    ?>

                    </tbody>
                </table>
            </div>

        </section>
        <?php if ($_SESSION['authorized'] == "Yes") { ?>
        <section id="three" class="wrapper style3 special">
            <div class="table-wrapper">
                <form action="add.php" method="post">
                    <div>
                        <div>
                            <div>
                                <table>
                                    <tr>
                                        <td><input id="sacNosaukums" name="sacNosaukums" type="text"
                                                   placeholder="Sacensibu nosaukums"></td>
                                        <td><input id="sacDatums" name="sacDatums" type="date"
                                                   placeholder="Sacensibu nosaukums"></td>
                                        <td><input id="sacVieta" name="sacVieta" type="text"
                                                   placeholder="Sacensibu vieta">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <div class="12u$">
                            <ul class="actions">
                                <li><input id="submit" value="Pievienot" class="special big" type="submit"></li>
                                <script>
                                    $('#submit').click(function () {
                                        if ($('#sacNosaukums').val().length == 0 || $('#sacDatums').val().length == 0 || $('#sacVieta').val().length == 0) {
                                            alert("Ne visi lauki ir aizpilditi!");
                                        }
                                    })
                                </script>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <?php } ?>
    <?php
    include("footer.php");
    ?>
</body>
</html>