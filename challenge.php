<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['flag'])
		header("Location:./");

	// sql challenge
	$db = mysql_connect($db_url,$db_user,$db_pass);
	$con = mysql_select_db ($db_use, $db);
	$con = mysql_query('SET NAMES utf8', $db);
	$con = mysql_query("select * from challenge", $db);
  include 'header.html';
?>

	<div class="container">

	<h1> Challenge </h1>
	<hr>
	<?php
	if(time() < $s_timestamp || time() >= $timestamp){
	echo '
	<div class="panel panel-info">
		<div class="panel-heading">notice</div>
		<div class="panel-body">
			There is no answer at the time
		</div>
	</div>';
	}
	else{
	echo'
	<h2> Select Challenge </h2>
	<table class="table table-bordered">
		<tr>
			<td>No</td>
			<td>Challenge</td>
			<td>Point</td>
		</tr>';
		if($con){
			while ($row = mysql_fetch_assoc($con)) {
				$id = $row['id'];
				$title = $row['title'];
				$score = $row['score'];
			echo '<tr><td>'.$id.'</td><td><a href="./solve.php?id='.$id.'">'.$title.'</a></td><td>'.$score.'</td></tr>';
			}
		}
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
