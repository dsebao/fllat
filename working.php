<?php

require("db.php");
$pie = new Database("pie");
echo $pie->go() . "\n";
echo $pie->go() . "\n";

$users = array(array("first" => "Bob", "last" => "Smith"), array("first" => "John", "last" => "Doe"));
$pie -> rw($users);
$pie -> add(array("first" => "Jane", "last" => "Doe"));
$pie -> add(array("first" => "Tom", "last" => "Wales"));

print_r($pie -> in(array(), "last", array("Smith", "Wales")));

?>