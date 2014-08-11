<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['admflag'])
		header("Location:./");

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

	<h1> Challenge Create</h1>
	<hr>
	<?php echo $_SESSION['err']; ?>
	<form action="./auth/new.php" method="post">
		Title:<input type="text" class="form-control" name="title" placeholder="Title"><br>
		Discription: <textarea class="form-control" rows="7" name="word"></textarea>
		Flag:<input type="text" class="form-control" name="flags" placeholder="Flags"><br>
		Score:<input type="text" class="form-control" name="score" placeholder="Score"><br>
		<button type="submit" class="btn btn-info" onclick="DisableButton(this);">submit</button>
	</form>

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
