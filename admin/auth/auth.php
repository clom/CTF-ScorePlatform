<?php
session_start();
require_once("../conf.php");
header("Location:../");

	$id = $_POST['user'];
	$pass = $_POST['pass'];
 
	$hash = sha1($pass);

	$_SESSION['admflag'] = 0;

	$_SESSION['msg'] = "";
	$flag=0;
	
	//secret
	$secrethash = sha1($secret);
	$c_secret = sha1($_POST['secret']);

	if(empty($POST['user']) && empty($_POST['pass'])){
		$_SESSION['msg']="空欄が存在します";
	}
	else{
		$db = mysql_connect($db_url,$db_user,$db_pass);
		$con = mysql_select_db ($db_use, $db);
		$con = mysql_query('SET NAMES utf8', $db);
		$con = mysql_query("select * from auth", $db);

		while ($row = mysql_fetch_assoc($con)) {
			if($id == $row['account'] && $hash == $row['passwd'] && $c_secret == $secrethash){
				$flag=1;
				$_SESSION['admflag'] = 1;
				$_SESSION['cn'] = $row['id'];
				$_SESSION['id'] = $_POST['user'];
				$_SESSION['name'] = $row['displayname'];
		}
	}
	if(!$flag){
		$_SESSION['msg']="認証情報が間違っています";
		}
	}
	
	$con = mysql_close($con);

?>
