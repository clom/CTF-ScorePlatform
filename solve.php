<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['flag'])
		header("Location:./");

	// sql challenge
	$db = mysql_connect($db_url,$db_user,$db_pass);
	$con = mysql_select_db ($db_use, $db);
	$con = mysql_query('SET NAMES utf8', $db);
	$id = mysql_real_escape_string($_GET['id']);
	$con = mysql_query("select * from challenge where id=".$id."", $db);

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

	<script>
	function DisableButton(b)
	{
		b.disabled = true;
		b.value = 'Progressing';
		b.form.submit();
	}
	</script>

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
					<li class="active"><a href="./challenge.php">Challenge</a></li>
					<li><a href="./rank.php">Ranking</a></li>
					';
					}
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">
	<?php
	if($con){
		while ($row = mysql_fetch_assoc($con)) {
			$id = $row['id'];
			$title = $row['title'];
			$word = htmlspecialchars_decode($row['discription']);
			$score = $row['score'];
		echo "<h1>".$id.": ".$title."</h1>";
		echo "<h3>Score: ".$score."</h3>";
		echo '<div class="well">'.$word.'</div>';
		}
	}

	$s_flag = 0;
	$sql = "SELECT * FROM `rank` WHERE challengeid=".$id." and userid=".$_SESSION['cn']." limit 1";
	$con = mysql_query($sql, $db);
	while ($row = mysql_fetch_assoc($con)) {
			$s_flag = 1;
	}
	if(!$s_flag){
		echo '<form action="./auth/check.php" method="post">
		<input type="hidden" name="id" value="'.$id.'">
		Flag:<input type="text" class="form-control" name="flags" placeholder="Flags"><br>
		<button type="submit" class="btn btn-info" onclick="DisableButton(this);">submit</button>
		</form>';
	}
	else{
		echo '<div class="panel panel-info">
		<div class="panel-heading">notice</div>
			<div class="panel-body">
			You solved challenge....
		</div>
	</div>';
	}



	?>
	<br><br>

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
