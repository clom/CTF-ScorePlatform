<?php
	session_start();
	require_once("../conf.php");

	// post
	$id = $_POST['id'];
	$_SESSION['msg'] = "";

	//check empty
	if(empty($_POST['flags'])){
		$site="../solve.php?id=".$id;
		$_SESSION['msg'] = "空欄が存在します";
	}
	else{
		// sql challenge
		$db = mysql_connect($db_url,$db_user,$db_pass);
		$con = mysql_select_db ($db_use, $db);
		$con = mysql_query('SET NAMES utf8', $db);

		$con = mysql_query("select * from challenge where id=".$id."", $db);

		while ($row = mysql_fetch_assoc($con)){
			$c_id = $row['id'];
			$flag = $row['flag'];
			$score = $row['score'];
		}
		
		//flag check
		$c_flag = htmlspecialchars($_POST['flags']);
		if(strcmp($c_flag,$flag) == 0 && $db){
			$sql = "INSERT INTO `rank`(`challengeid`, `userid`, `username`, `plusscore`) VALUES (".$c_id.",".$_SESSION['cn'].",'".$_SESSION['id']."',".$score.")";
			$con = mysql_query($sql, $db);
			$sql ="INSERT INTO `solvelog`(`challengeid`, `userid`, `solve`, `check`) VALUES (".$c_id.",".$_SESSION['cn'].",'".$c_flag."',1)";
			$con = mysql_query($sql, $db) or die($sql);
			$site="../success.php";
		}
		else{
			$sql ="INSERT INTO `solvelog`(`challengeid`, `userid`, `solve`, `check`) VALUES (".$c_id.",".$_SESSION['cn'].",'".$c_flag."',0)";
			$con = mysql_query($sql, $db) or die($sql);
			$_SESSION['fail'] = $id;
			$site="../fail.php";
		}
	}

	header("Location:".$site);
?>