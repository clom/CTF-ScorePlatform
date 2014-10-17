<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	$title = $_GET['title'];

	$con = mysql_connect($db_url, $db_user, $db_pass);
	$result = mysql_select_db($db_use, $con);
	$result = mysql_query('SET NAMES utf8', $con);
	$result = mysql_query("SELECT * FROM notice WHERE title='".$title."'", $con);
	$rows = mysql_num_rows($result);

  include 'header.html';
	?>

	<div class="container">
	<h1> Announcement: <?php echo $title; ?></h1>
	<hr>

	<p>
	
	<?php
	if($rows){
		while($row = mysql_fetch_array($result)) {
			$value = htmlspecialchars_decode($row['editor']);
			echo $value;
		}
	}

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
