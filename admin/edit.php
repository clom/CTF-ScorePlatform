<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['admflag'])
		header("Location:./");

	// sql challenge
	$db = mysql_connect($db_url,$db_user,$db_pass);
	$con = mysql_select_db ($db_use, $db);
	$con = mysql_query('SET NAMES utf8', $db);
	$id = mysql_real_escape_string($_GET['id']);
	$con = mysql_query("select * from challenge where id=".$id."", $db);

	while ($row = mysql_fetch_assoc($con)) {
		$id = $row['id'];
		$title = $row['title'];
		$word = $row['discription'];
		$flag = $row['flag'];
		$score = $row['score'];
	}

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
					<?php
					if($_SESSION['admflag']){
						echo'
					<li><a href="./notice.php">Notice</a></li>
					<li class="active"><a href="./challenge.php">Challenge</a></li>
					<li><a href="./log.php">Solve Log</a></li>
					';
					}
					?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container">

	<h1> Challenge Edit</h1>
	<hr>
	<?php echo $_SESSION['err']; ?>
	
	<form action="./auth/chaedit.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		Title:<input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $title; ?>"><br>
		Discription(html): <textarea class="form-control" rows="7" name="word"><?php echo $word; ?></textarea>
		Flag:<input type="text" class="form-control" name="flags" placeholder="Flags" value="<?php echo $flag; ?>"><br>
		Score:<input type="text" class="form-control" name="score" placeholder="Score" value="<?php echo $score; ?>"><br>
		<button type="submit" class="btn btn-info" onclick="DisableButton(this);">submit</button>
	</form>
	<br> <br>
	<hr>
	<button class="btn btn-danger" data-toggle="modal" href="#delete">delete</button>

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
				I will clear the problem. Would you like?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><br><br>
					<form action="./auth/delete.php" method="post">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="hidden" name="service" value="challenge">
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
