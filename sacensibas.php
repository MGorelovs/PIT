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
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery.tabledit.min.js"></script>
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
                <table id="sacensibas" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sacensību nosaukums</th>
                        <th>Datums</th>
                        <th>Vieta/Adrese</th>
                        <th class="tabledit-toolbar-column"></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $db->query("SET NAMES utf8mb4");
                    $result = $db->query("SELECT * FROM sacensibas ORDER BY sacDatums DESC");
                    echo "</br>" . $db->error;


                    while($row = mysqli_fetch_array($result))
                    {

                        if ($_SESSION['authorized'] == "Yes")
                        {

                            echo '
                                <tr>
	                                <td class="tabledit-view-mode">
		                                <span class="tabledit-span">'.$row["sacNosaukums"].'</span>
		                                <input class="tabledit-input form-control input-sm" type="text" name="nosaukums" value="'.$row["sacNosaukums"].'" style="display: none;" disabled="">
	                                </td>
	
	                                <td class="tabledit-view-mode">
		                                <span class="tabledit-span">'.$row["sacDatums"].'</span>
		                                <input class="tabledit-input form-control input-sm" type="text" name="datums" value="'.$row["sacDatums"].'" style="display: none;" disabled="">
	                                </td>

	                                <td class="tabledit-view-mode">
		                                <span class="tabledit-span">'.$row["sacVieta"].'</span>
		                                <input class="tabledit-input form-control input-sm" type="text" name="vieta" value="'.$row["sacVieta"].'" style="display: none;" disabled="">
	                                </td>
	
	                                <td style="white-space: nowrap; width: 1%;">
		                                <div class="tabledit-toolbar btn-toolbar" style="text-align: left;">
			                               <div class="btn-group btn-group-sm" style="float: none;">
				                                <button type="button" class="tabledit-edit-button btn btn-sm btn-default" style="float: none;">
					                                <span class="glyphicon glyphicon-pencil"></span>
				                                </button>
				                                <button type="button" class="tabledit-delete-button btn btn-sm btn-default active" style="float: none;">
					                                <span class="glyphicon glyphicon-trash"></span>
				                                </button>
			                                </div>
			                                <button type="button" class="tabledit-save-button btn btn-sm btn-success" style="display: none; float: none;">Save</button>
			                                <button type="button" class="tabledit-confirm-button btn btn-sm btn-danger" style="float: none;">Confirm</button>
			                                <button type="button" class="tabledit-restore-button btn btn-sm btn-warning" style="display: none; float: none;">Restore</button>
		                                </div>
	                                </td>
                                </tr>
                                ';

                        }
                        else
                        {

                            echo "<tr>";
                            echo "<td>" . $row['sacNosaukums'] . "</td>" . "<td>" . $row['sacDatums'] . "</td>" . "<td>" . $row['sacVieta'] . "</td>";
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
<script>
    $(document).ready(function)({
        $('#sacensibas').Tableedit(

            {
            url: 'action.php',
            columns:
            {
                identifier: [0, "sacID"],
                editable: [[1, "sacNosaukums"], [2, "sacDatums"], [3, "sacVieta"]]
            }
            restoreButton: false,
            onSuccess:function(data, textStatus, jqXHR){
                if(data.action == "delete")
                {
                    $('#'+data.id).remove();
                }
            }
        });
    });
</script>