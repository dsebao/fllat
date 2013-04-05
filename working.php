<?php

require("db.php");
$pie = new db("pie");
$pie->go();

echo json_encode($pie->select(array("name","n")));
echo "<hr>";
echo json_encode($pie->select(array()));

?>