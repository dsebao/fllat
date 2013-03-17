<?php

require("db.php");
$action = $_POST["action"];

?>
<html>
<body>
	<section>
		<h1>Create</h1>
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
		if ($action=="create") {
			if ($_POST["pass"] !== $_POST["confirm"]) {
				echo "The two passwords you entered did not match!";
				return false;
			}
			$arr = array($_POST["un"]=>md5($_POST["pass"]));
			$wylst->add($arr);
			echo "Successfully created.";
		}
		elseif ($action=="login") {
			if (md5($_POST["pass"]) === $wylst->get($_POST["un"])) {
				echo "Welcome, ".ucfirst($_POST["un"])."!";
			}
			else {
				echo "Try again.";
			}
		}
		?>
	</p>
</body>