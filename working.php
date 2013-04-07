<?php

require("db.php");
$pie = new Database("pie");
echo $pie->go() . "\n";
echo $pie->go() . "\n";

$users = array(array("first" => "Bob", "last" => "Smith"), array("first" => "John", "last" => "Doe"));
$pie -> rw($users);
$pie -> add(array("first" => "Jane", "last" => "Doe"));

if ($pie -> exists("last", "Smith")) {
	echo "Exists";
} else {
	echo "Does not exist";
}

if ($pie -> exists("last", "Brown")) {
	echo "Exists";
} else {
	echo "Does not exist";
}

?>