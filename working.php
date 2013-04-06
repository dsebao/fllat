<?php

require("db.php");
$pie = new Database("pie");
$pie->go();

$slurp = array("name" => "smoothie", "price" => "4.99");
$chomp = array("name" => "cookie", "price" => "2.99");
$nom = array("name" => "bacon", "price" => "0.00");
$pie -> rw(array($slurp, $chomp, $nom));

echo $pie -> get("price", "name", "bacon") . "<br>";
echo json_encode($pie -> select(array())) . "<br>"; // Returns the whole thing (too long to list here)
echo json_encode($pie -> select(array("name")));

?>