<?php
	session_start();
	require_once("../conf.php");

	if (!isset($_POST) || $_POST["title"] == "" || $_POST["title"] == " "){
		$_SESSION["error"] = "空欄が存在します";
		$site = "../notice.php";
		header("Location:$site");
	}
	else{
		$_SESSION["error"] = "";
		$title =htmlspecialchars($_POST["title"]);
		$site = "../write.php?title=".$title."";
		header("Location:$site");

		mb_language("uni");
		mb_internal_encoding("utf-8");
		mb_http_input("auto");
		mb_http_output("utf-8");

		if (!empty($_POST))
		{

			$link = mysql_connect( $db_url, $db_user, $db_pass );
			$sdb = mysql_select_db( $db_use, $link );
			$sql = "select `title` from notice where title='".$title."";
			$result = mysql_query( $sql, $link);
			$rows = mysql_num_rows($result);
			if($rows){
				while($row = mysql_fetch_array($result)) {
					$value = htmlspecialchars_decode($row['editor']);
				}
			}
		 else{
			 $sql = "INSERT INTO `$db_use`.`notice` (`title`) VALUES('".$title."')";
			 $result = mysql_query( $sql, $link );
			 mysql_close($link);
		}
	
		}
	
	}

?>
