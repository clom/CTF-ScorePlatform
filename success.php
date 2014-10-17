<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['flag'])
		header("Location:./");
  include 'header.html';
?>

	<h1> Solve </h1>
	<hr>

	<h2>This Challenge Clear!!!!</h2>

<?php include 'footer.html';?>
