<?php
	session_start();
	require_once("../conf.php");

	$title = htmlspecialchars($_SESSION['title']);
	mb_language("uni");
	mb_internal_encoding("utf-8");
	mb_http_input("auto");
	mb_http_output("utf-8");

	$site = "../notice.php";
	header("Location:$site");
	

	
	if (!empty($_POST))
	{
		$value = htmlspecialchars( $_POST["editor1"] );
		
		$link = mysql_connect( $db_url, $db_user, $db_pass );
		$sdb = mysql_select_db( $db_use, $link );
		$sql = "UPDATE `notice` SET `editor` = '".$value."' WHERE `title` = '".$title."'";
		$result = mysql_query( $sql, $link );
		mysql_close($link);
	}

?>