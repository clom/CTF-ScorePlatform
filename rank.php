<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['flag'])
		header("Location:./");

	// sql rank
	$db = mysql_connect($db_url,$db_user,$db_pass);
	$con = mysql_select_db ($db_use, $db);
	$con = mysql_query('SET NAMES utf8', $db);
	$con = mysql_query("SELECT `displayname`,sum(`plusscore`) FROM `auth`,`rank` WHERE auth.id=rank.userid group by userid order by sum(`plusscore`) desc", $db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Note there is no responsive meta tag here -->

	<link rel="shortcut icon" href="./assets/ico/favicon.png">

	<title>Project misaka</title>

	<!-- Bootstrap core CSS -->
	<link href="./dist/css/bootstrap.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="non-responsive.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="./assets/js/html5shiv.js"></script>
	<script src="./assets/js/respond.min.js"></script>
	<![endif]-->

	</head>

	<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="./">CTF Score Platform</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="./">Home</a></li>
					<li><a href="./notice.php">Notice</a></li>
					<?php
					if($_SESSION['flag']){
						echo'
					<li><a href="./challenge.php">Challenge</a></li>
					<li class="active"><a href="./rank.php">Ranking</a></li>
					';
					}
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">
	<h1> Ranking </h1>
	<hr>

	<table class="table table-bordered">
		<tr>
			<td>No</td>
			<td>name</td>
			<td>Point</td>
		</tr>
		<?php
		$count = 0;
		while ($row = mysql_fetch_assoc($con)) {
			$name = $row['displayname'];
			$score = $row['sum(`plusscore`)'];
			$count++;
		echo "<tr><td>".$count."</td><td>".$name."</td><td>".$score."</td></tr>";
		}
		?>
	</table>


	<footer>
		Copyright (C) 2014 clom-networks. All Rights Reserved.
	</footer>

	</div> <!-- /container -->




	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="./assets/js/jquery.js"></script>
	<script src="./dist/js/bootstrap.min.js"></script>
	<script>
	$('#myCarousel').carousel({
	interval: 3000;
	});
	</script>
	</body>
</html>
