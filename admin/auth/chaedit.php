<?php
	session_start();
	require_once("../conf.php");

	mb_language("uni");
	mb_internal_encoding("utf-8");
	mb_http_input("auto");
	mb_http_output("utf-8");

	$id = $_POST["id"];
	$_SESSION['err'] = "";
	$site = "../challenge.php";


	if(empty($_POST["title"]) || empty($_POST["score"]) || empty($_POST["flags"]) || empty($_POST["word"])){
		$_SESSION['err'] = "Blank exists.";
		$site = "../edit.php?id=".$id;
	}
	else{
		$title = htmlspecialchars( $_POST["title"] );
		$score = $_POST["score"];
		$flags = htmlspecialchars( $_POST["flags"] );
		$word = htmlspecialchars( $_POST["word"] );
	
		$link = mysql_connect( $db_url, $db_user, $db_pass );
		$sdb = mysql_select_db( $db_use, $link );
		$sql = "UPDATE `challenge` SET `title`='".$title."',`discription`='".$word."',`flag`='".$flags."',`score`='".$score."' WHERE id=".$id."";
		$result = mysql_query( $sql, $link );
		mysql_close($link);
	}
	header("Location:$site");
?>