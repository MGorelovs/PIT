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

    SELECT dpID,prtneraID,prtneraVardsUzvards,prtneraKlase,prtneresID,dejotVardsUzvards as prtneresVardsUzvards,dejotKlase as prtneresKlase,dejotDzimsanasDatums as prtneresDzimsanasDatums, prtneraDzimsanasDatums FROM
(SELECT dpID,prtneraID,prtneresID,dejotVardsUzvards as prtneraVardsUzvards,dejotKlase as prtneraKlase,dejotDzimsanasDatums as prtneraDzimsanasDatums
FROM
(SELECT dejparID as dpID,dejparPartneraID as prtneraID,dejparPartneresID as prtneresID
from deju_pari
WHERE deju_pari.dejparPartneraID = $dancer OR dejparPartneresID =$dancer) as dejparTable,
dejotaji
WHERE dejotID=prtneraID) as prtneraTable,
dejotaji
WHERE dejotID=prtneresID;

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


