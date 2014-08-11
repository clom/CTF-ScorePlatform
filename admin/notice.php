<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");
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
					<?php
					if($_SESSION['admflag']){
						echo'
					<li class="active"><a href="./notice.php">Notice</a></li>
					<li><a href="./challenge.php">Challenge</a></li>
					<li><a href="./log.php">Solve Log</a></li>
					';
					}
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">
	<h1> Announcement </h1>
	<hr>
	<?php
	
	$con = mysql_connect($db_url, $db_user, $db_pass);
	$result = mysql_select_db($db_use, $con);
	$result = mysql_query('SET NAMES utf8', $con);
	$result = mysql_query("SELECT title, time FROM notice", $con);
	?>

	<form action="./auth/create.php" method="post">
		<input type="text" class="form-control" id="title" name="title" placeholder="Enter title"><br>
		<button type="submit" class="btn btn-primary" >create</button>
	</form>
	<br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Article</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
		<?php
		while ($data = mysql_fetch_array($result)) {
			echo "<tr>";
			echo "<td>";echo "<a href="; echo "./write.php?title="; echo urlencode($data["title"]); echo ">" .$data["title"]. "</a>"; echo "</td>";
			echo "<td>";echo $data["time"]; echo "</td>";
			echo "</tr>";
		}
		?>
	</table>

	<?php
		$con = mysql_close($con);
	?>

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
