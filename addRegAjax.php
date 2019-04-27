<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include ("db.php");

if (isset($_POST['comp'])) {
    $comp = $_POST['comp'];
    $query = "SELECT * FROM sacensibas WHERE sacID = $comp";
    $result = $db-> query($query);
    $comps = mysqli_fetch_all($result,MYSQLI_ASSOC);

    echo json_ecnode($comps);
}

if  (isset($_POST['dancer'])) {
    $dancer = $_POST['dancer'];
    $query = "
    SELECT dpID,prtneraID,prtneresID,prtneraVardsUzvards, dejotVardsUzvards as prtneresVardsUzvards FROM
    (SELECT dpID,prtneraID,prtneresID,dejotVardsUzvards as prtneraVardsUzvards 
    FROM
    (SELECT dejparID as dpID,dejparPartneraID as prtneraID,dejparPartneresID as prtneresID
    from deju_pari
    WHERE deju_pari.dejparPartneraID = 1 OR dejparPartneresID =1) as dejparTable,
    dejotaji
    WHERE dejotID=prtneraID) as prtneraTable,
    dejotaji
    WHERE dejotID=prtneresID;
        ";
    $result = $db-> query($query);
    $dancepair = mysqli_fetch_all($result,MYSQLI_ASSOC);
    echo json_encode($dancepair);
}



