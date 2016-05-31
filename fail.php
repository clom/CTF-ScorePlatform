<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['flag'])
		header("Location:./");
  include 'header.html';
?>

	<h1>  not Solve </h1>
	<hr>

	<h2>This Challenge not clear. You can redo...</h2>

<?php include 'footer.html';?>
