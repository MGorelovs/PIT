<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("db.php");

if (isset($_POST['comp']) && isset($_POST['age'])) {
    $comp = $_POST['comp'];
    $age = $_POST['age'];

    $query = "SELECT * FROM sacensibu_grupas WHERE fk_sacID = $comp AND grVecumaGrupa = $age";
    $result = $db->query($query);
    $comps = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($comps);
}

if (isset($_POST['dancer'])) {
    $dancer = $_POST['dancer'];
    $query = "
    SELECT dp.dejparID as dpID, dp.dejparPartneraID as prtneraID, d1.dejotVardsUzvards as prtneraVardsUzvards, d1.dejotKlase as prtneraKlase, dp.dejparPartneresID as prtneresID, d2.dejotVardsUzvards as prtneresVardsUzvards, (CASE WHEN (d1.dejotVecumaGrupa > d2.dejotVecumaGrupa) THEN d1.dejotVecumaGrupa ELSE d2.dejotVecumaGrupa END) as paraVecGr
    FROM deju_pari dp
         JOIN dejotaji d1 ON d1.dejotID = dp.dejparPartneraID
         JOIN dejotaji d2 ON d2.dejotID = dp.dejparPartneresID
    WHERE dp.dejparPartneraID = $dancer OR dp.dejparPartneresID = $dancer;
        ";
    $result = $db->query($query);
    $dancepair = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($dancepair);
}

if (isset($_POST['r_pair']) && isset($_POST['r_comp']) && isset($_POST['r_groups'])) {
    $pair = $_POST['r_pair'];
    $comp = $_POST['r_comp'];
    $groups = json_decode($_POST['r_groups']);


    foreach ($groups as $i) {
        $db->query("INSERT INTO registretie_pari VALUES (null,$comp,$pair,$i)");
    }
    echo $db->error;


}
?>


