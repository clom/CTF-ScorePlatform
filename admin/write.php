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
	<?php

	$title = $_GET['title'];
	
	$_SESSION['title'] = $title;
	
	$con = mysql_connect($db_url, $db_user, $db_pass);
	$result = mysql_select_db($db_use, $con);
	$result = mysql_query('SET NAMES utf8', $con);
	$result = mysql_query("SELECT * FROM notice WHERE title='".$title."'", $con);
	$rows = mysql_num_rows($result);
	
	if($rows){
		while($row = mysql_fetch_array($result)) {
			$id = $row['id'];
			$value = htmlspecialchars_decode($row['editor']);
		}
	}
	?>

	<h1> notice : <?php echo $title; ?> </h1>
		<form action="./auth/edit.php" method="post">
			<textarea id="editor1" name="editor1" rows="10" cols="80"> <?php echo $value; ?> </textarea>
			<br>
			<p><button type="submit" class="btn btn-primary btn-lg">Save</button></p>
		</form>

		<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="./ckfinder/ckfinder.js"></script>
		<script type="text/javascript">
		if ( typeof CKEDITOR == 'undefined' )
		{}
		else
		{
			var editor = CKEDITOR.replace( 'editor1' );
			editor.setData();
		}
	</script>

	<br> <br>
	<hr>
	<button class="btn btn-danger" data-toggle="modal" href="#delete">delete</button>
	
	<?php
	$con = mysql_close($con);
	?>

	<footer>
		Copyright (C) 2014 clom-networks. All Rights Reserved.
	</footer>

	</div> <!-- /container -->
	<!-- Modal -->
	<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="LoLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="LoLabel">Caution!</h4>
				</div>
				<div class="modal-body">
				I will clear the notice. Would you like?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><br><br>
					<form action="./auth/delete.php" method="post">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="service" value="notice">
						<button type="submit" class="btn btn-danger" onclick="DisableButton(this);">Delete</button>
					</form>
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
