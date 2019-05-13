<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if ( isset($_GET['role']) ) { $_SESSION['role'] = $_GET['role'];
    }
    else {
        $_SESSION['role']=0;
    }
}

$db = mysqli_connect("127.0.0.1", "root", "0000", "mydb");
$db->query("SET NAMES utf8mb4");
$query = "SELECT * FROM sacensibas ORDER BY sacDatums ASC";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LSDF - Sacensību saraksts</title>
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
            <h2>Sacensības</h2>
            <p>Sacensību saraksts</p>
        </header>


        <!-- Table -->
        <section>
            <h3>Tabula</h3>
            <div class="table-wrapper">
                <table id="sacensibas" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Sacensību nosaukums</th>
                        <th>Datums</th>
                        <th>Vieta/Adrese</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result))
                        {
                            echo '
                                <tr>
                                    <td>'.$row["sacID"].'</td>
                                    <td>'.$row["sacNosaukums"].'</td>
                                    <td>'.$row["sacDatums"].'</td>
                                    <td>'.$row["sacVieta"].'</td>
                                </tr>
                            ';
                        }
                        ?>
                    </tbody>

                </table>
            </div>

        </section>

        <?php if(isset($_SESSION['authorized'])): ?>
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
                                                   placeholder="Sacensibu datums"></td>
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
        <?php endif; ?>
    </div>
    <?php
    include("footer.php");
    ?>
</body>
</html>
<script>
    <?php if(isset($_SESSION['authorized'])): ?>

    $(document).ready(function(){
        $('#sacensibas').Tabledit({
            url:'action.php',
            hideIdentifier: true,
            columns:{
                identifier:[0, 'sacID'],
                editable:[[1, "sacNosaukums"], [2, 'sacDatums'], [3, "sacVieta"]]
            },
            restoreButton: false,
            onSuccess:function(data, textStatus, jqXHR)
            {
                if(data.action === 'delete')
                {
                    $('#'+data.id).remove();
                }
                if (data.type && data.message) {
                    $('.alert-container').Alertiny(data.type, data.message);
                }
            },
            onDraw: function() {
                $('table tbody tr td:nth-child(3)').each(function() {
                    $(this).datepicker({
                        format: 'yyyy-mm-dd',
                        todayHighlight: true,
                        autoFocus: false,
                        startDate: '+1d',
                        weekStart: 1,
                        autoclose: true,
                        language: 'lv'
                    });
                });
            },
            onFail: function(jqXHR, textStatus, errorThrown) {
                console.log('onFail(jqXHR, textStatus, errorThrown)');
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            },
            onAjax: function(action, serialize) {
                console.log('onAjax(action, serialize)');
                console.log(action);
                console.log(serialize);
            }
        });

    });
    <?php endif; ?>
</script>