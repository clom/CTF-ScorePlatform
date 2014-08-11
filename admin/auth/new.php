<?php
	session_start();
	require_once("../conf.php");

	mb_language("uni");
	mb_internal_encoding("utf-8");
	mb_http_input("auto");
	mb_http_output("utf-8");

	$_SESSION['err'] = "";
	$site = "../challenge.php";


	if(empty($_POST["title"]) || empty($_POST["score"]) || empty($_POST["flags"]) || empty($_POST["word"])){
		$_SESSION['err'] = "Blank exists.";
		$site = "../new.php";
	}
	else{
		$title = htmlspecialchars( $_POST["title"] );
		$score = $_POST["score"];
		$flags = htmlspecialchars( $_POST["flags"] );
		$word = htmlspecialchars( $_POST["word"] );
	
		$link = mysql_connect( $db_url, $db_user, $db_pass );
		$sdb = mysql_select_db( $db_use, $link );
		$sql = "INSERT INTO `challenge`(`title`, `discription`, `flag`, `score`) VALUES ('".$title."','".$word."','".$flags."',".$score.")";
		$result = mysql_query( $sql, $link ) or die($sql);
		mysql_close($link);
	}
	header("Location:$site");
?>