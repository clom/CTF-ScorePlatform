<?php
	session_start();
	require_once("../conf.php");

	mb_language("uni");
	mb_internal_encoding("utf-8");
	mb_http_input("auto");
	mb_http_output("utf-8");

	$id = $_POST["id"];
	$site = "../".$_POST["service"].".php";

	$link = mysql_connect( $db_url, $db_user, $db_pass );
	$sdb = mysql_select_db( $db_use, $link );
	$sql = "DELETE FROM `".$_POST["service"]."` WHERE id=".$id."";
	$result = mysql_query( $sql, $link );
	mysql_close($link);

	header("Location:$site");
?>