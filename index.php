<?php

require("db.php");

$works = new db("works");
$works->go();

$pie = new db("pie");
$pie->go();

$action = $_POST["action"];

?>
<html>
<head>
	<title>Fllat</title>
</head>
<body>
	<section>
		<h1>Sign up.</h1>
		<form action="#" method="POST">
			<input name="un" type="text" placeholder="Username">
			<input name="pass" type="password" placeholder="Password">
			<input name="confirm" type="password" placeholder="Password">
			<input name="action" type="hidden" value="create">
			<button type="submit">Create</button>
		</form>
	</section>
	<section>
		<h1>Login</h1>
		<form action="#" method="POST">
			<input name="un" type="text" placeholder="Username">
			<input name="pass" type="password" placeholder="Password">
			<input name="action" type="hidden" value="login">
			<button type="submit">Login</button>
		</form>
	</section>
	<p>
		<?php
		$time_start = microtime(true); 
		if ($action=="create") {
			if ($_POST["pass"] !== $_POST["confirm"]) {
				echo "The two passwords you entered did not match!";
				return false;
			}
			$arr = array("u"=>$_POST["un"],"p"=>md5($_POST["pass"]));
			$works->add($arr);
			echo "Successfully created.";
		}
		elseif ($action=="login") {
			if (md5($_POST["pass"]) === $works->get("p","u",$_POST["un"])) {
				echo "Welcome, ".ucfirst($_POST["un"])."!";
			}
			else {
				echo "Oops, you entered your username or password wrong!";
			}
		};
		$time_end = microtime(true);
		$execution_time = ($time_end - $time_start);
		echo '<br><b>Total Execution Time:</b> '.$execution_time.' Seconds';
		?>
	</p>
</body>