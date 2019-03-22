<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(empty($_SESSION['id'])){
    header("Location: index.php");
    exit();
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
    <noscript><
        <link rel="stylesheet" href="css/skel.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-xlarge.css" />
    </noscript>
</head>

<body>

<?php
include ("header.php");
?>

<?php
include ("bd.php");
?>
<!-- Main -->
<section id="main" class="wrapper">
    <div class="container">

        <header class="major">
            <h2>Ieraksti</h2>
            <p>Šeit ir attēloti ieraksti, kas ir izmantoti datubāzē</p>
        </header>


        <!-- Table -->
        <section>
            <h3>Tabula</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Expiration date</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    $result = $db->query("SELECT * FROM tabula");
                    echo "</br>".$db->error;

                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<th>".$row['id']."</th>"."<th>".$row['name']."</th>"."<th>".$row['expiration_date']."</th>";
                        echo "</tr>";
                    }


                    $db->close();
                    ?>

                    </tbody>
                </table>
            </div>

        </section>
    </div>
</section>
<?php if($_SESSION['userType'] == 1){  ?>
<section id="three" class="wrapper style3 special">
    <div class="container 50%">
        <form action="add.php" method="post">
            <div class="row uniform">
                <div class="12u$">
                    <textarea name="name" id="message" placeholder="Name" rows="1" maxlength="32"></textarea>
                </div>
                <div class="12u$">
                    <ul class="actions">
                        <li><input value="Pievienot" class="special big" type="submit"></li>
                    </ul>
                </div>
            </div>
        </form>
    </div>
</section>
<?php } ?>

<?php
include ("footer.php");
?>
</body>
</html>