<?php
$connect = mysqli_connect("127.0.0.1", "root", "0000", "mydb");
$connect->query("SET NAMES utf8mb4");
$query = "SELECT * FROM sacensibas ORDER BY sacDatums ASC";
$result = mysqli_query($connect, $query);
?>
<html>
<head>
    <title>Live Table Data Edit Delete using Tabledit Plugin in PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery.tabledit.min.js"></script>
</head>
<body>
<div class="container">
    <br />
    <br />
    <br />
    <div class="table-responsive">
        <h3 align="center">Live Table Data Edit Delete using Tabledit Plugin in PHP</h3><br />
        <table id="editable_table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>SacNOS</th>
                <th>SacDarums</th>
                <th>SacVieta</th>
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
       <td>'.$row["sacVieta"]/'</td>
      </tr>
      ';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#editable_table').Tabledit({
            url:'action.php',
            columns:{
                identifier:[0, "sacID"],
                editable:[[1, "sacNosaukums"], [2, 'sacDatums'], [3, "sacVieta"]]
            },
            onSuccess:function(data, textStatus, jqXHR)
            {
                if(data.action == 'delete')
                {
                    $('#'+data.id).remove();
                }
            }
        });

    });
</script>
