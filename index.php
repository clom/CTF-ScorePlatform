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
					<li class="active"><a href="./">Home</a></li>
					<li><a href="./notice.php">Notice</a></li>
					<?php
					if($_SESSION['flag']){
						echo'
					<li><a href="./challenge.php">Challenge</a></li>
					<li><a href="./rank.php">Ranking</a></li>
					';
					}
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">

		<div class="well">
			<h1> Welcome to CTF Score Platform</h1>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="well">
					<?php
					if(!$_SESSION['flag']){
						echo $_SESSION['msg'];
						echo'
						<form action="./auth/auth.php" method="post">
						ID:<input type="text" class="form-control" name="user"><br>
						PASS:<input type="password" class="form-control" name="pass"><br>
						<button type="submit" class="btn btn-info">Login</button>
						</form>';
					}
					else{
						echo '<h2>welcome to '.$_SESSION["name"].'!</h2><br><br><br><br>
						<button class="btn btn-danger" data-toggle="modal" href="#logout">logout</button>';
					}
					?>
				</div>
			</div>
			<div class="col-md-6">
				<div class="well">
				<h2> This Challenge Limit time </h2>
				<?php
				//notice
				echo '<h3>Start time: '.date("Y/m/d/ H:i", $s_timestamp).'</h3> <br>
				<h3>End time: '.date("Y/m/d/ H:i", $timestamp).'</h3>';
				?>
				</div>
			</div>
		</div>
	<?php
	
	$con = mysql_connect($db_url, $db_user, $db_pass);
	$result = mysql_select_db($db_use, $con);
	$result = mysql_query("SET NAMES utf8", $con);
	$result = mysql_query("SELECT title, time FROM notice order by id desc limit 5", $con);
	?>
	<h2> CTF Announcement </h2>
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
			echo "<td>";echo "<a href="; echo "./read.php?title="; echo urlencode($data["title"]); echo ">" .$data["title"]. "</a>"; echo "</td>";
			echo "<td>";echo $data["time"]; echo "</td>";
			echo "</tr>";
		}
		?>
	</table>


	<footer>
		Copyright (C) 2014 clom-networks. All Rights Reserved.
	</footer>

	</div> <!-- /container -->


	<!-- Modal -->
	<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="LoLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="LoLabel">Caution!</h4>
				</div>
				<div class="modal-body">
				 ログアウトします。よろしいですか?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<a href="./auth/logout.php" role="button" class="btn btn-danger">ログアウト</a>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


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
