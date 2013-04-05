<?php

$time_start = microtime(true);

require("db.php");

$works = new db("works");
$works->go();

$pie = new db("pie");
$pie->go();

$action = $_POST["action"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Fllat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A flat-file database system">
	<meta name="author" content="Alfred Xing">

	<!-- Le styles -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href='//fonts.googleapis.com/css?family=Lato:100,400' rel='stylesheet' type='text/css'>
	<style type="text/css">
	body {
		padding-top: 40px;
		padding-bottom: 40px;
		background-color: #f5f5f5;
		font-family: "Lato", "Helvetica Nueue", sans-serif;
	}

	.form-signin {
		display: inline-block;
		vertical-align: top;
		max-width: 300px;
		padding: 19px 29px 29px;
		margin: 0 auto 20px;
		background-color: #fff;
		border: 1px solid #e5e5e5;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
		box-shadow: 0 1px 2px rgba(0,0,0,.05);
	}
	.form-signin .form-signin-heading,
	.form-signin .checkbox {
		margin-bottom: 10px;
	}
	.form-signin input[type="text"],
	.form-signin input[type="password"] {
		font-size: 16px;
		height: auto;
		margin-bottom: 15px;
		padding: 7px 9px;
	}

	header {
		position: fixed;
		width: 100%;
		background: #1B1B1B;
		top: 0;
		padding: 10px 0;
	}

	header form {
		margin: 0;
	}

	.main {
		margin-top: 50px;
	}

	.alert-info:empty {
		display: none;
	}

	#logo {
		position: absolute;
		color: #FFFFFF;
		line-height: 50px;
		font: 100 1.75em "Lato", "Helvetica Nueue", sans-serif;
	}

	</style>
	<link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

</head>
<body>

	<header>
		<div class="container">
			<span id="logo">fllat.</span>
			<form class="form-inline pull-right" action="#" method="POST">
				<input name="action" type="hidden" value="login">
				<input type="text" name="un" id="lun" class="input-small" placeholder="Username">
				<input type="password" name="pass" class="input-small" placeholder="Password">
				<button class="btn" type="submit">Sign in</button>
			</form>
		</div>
	</header>

	<div class="container main">

		<?php if ($action) { ?>
		<div class="alert alert-info alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>
				<?php
				$time_start = microtime(true); 
				if ($action=="create") {
					if ($_POST["pass"] !== $_POST["confirm"]) {
						echo "The two passwords you entered did not match!";
					} else {
						$arr = array("u"=>$_POST["un"],"p"=>md5($_POST["pass"]));
						$works->add($arr);
						echo "Successfully created.";
					}
				}
				elseif ($action=="login") {
					if (md5($_POST["pass"]) === $works->get("p","u",$_POST["un"])) {
						echo "Welcome, ".ucfirst($_POST["un"])."!";
					}
					else {
						echo "Oops, you entered your username or password wrong!";
					}
				};
				?>
			</h4>
		</div>
		<?php } else { ?>
		<div class="alert alert-info alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>Hey there! Feel free to peek around and create an account (don't use your real password though, even if it's hashed).</h4>
		</div>
		<?php }; ?>

		<form class="form-signin pull-right" action="#" method="POST">
			<h2 class="form-signin-heading">Sign up!</h2>
			<input name="action" type="hidden" value="create">
			<input type="text" name="un" class="input-block-level" placeholder="Username">
			<input type="password" name="pass" class="input-block-level" placeholder="Password">
			<input type="password" name="confirm" class="input-block-level" placeholder="Confirm Password">
			<button class="btn btn-large btn-primary" type="submit">Create account</button>
		</form>

		<p>
			<?php
			$time_end = microtime(true);
			$execution_time = ($time_end - $time_start);
			echo '<b>Total PHP execution time:</b> '.$execution_time.' seconds';
			?>
		</p>

	</div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="//twitter.github.com/bootstrap/assets/js/bootstrap-alert.js"></script>
    <script>$("#lun").focus();</script>

</body>
</html>
