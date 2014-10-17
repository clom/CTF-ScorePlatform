<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['flag'])
		header("Location:./");

	// sql challenge
	$db = mysql_connect($db_url,$db_user,$db_pass);
	$con = mysql_select_db ($db_use, $db);
	$con = mysql_query('SET NAMES utf8', $db);
	$id = mysql_real_escape_string($_GET['id']);
	$con = mysql_query("select * from challenge where id=".$id."", $db);
  include 'header.html';

?>

	<script>
	function DisableButton(b)
	{
		b.disabled = true;
		b.value = 'Progressing';
		b.form.submit();
	}
	</script>


	<div class="container">
	<?php
	if($con){
		while ($row = mysql_fetch_assoc($con)) {
			$id = $row['id'];
			$title = $row['title'];
			$word = htmlspecialchars_decode($row['discription']);
			$score = $row['score'];
		echo "<h1>".$id.": ".$title."</h1>";
		echo "<h3>Score: ".$score."</h3>";
		echo '<div class="well">'.$word.'</div>';
		}
	}

	$s_flag = 0;
	$sql = "SELECT * FROM `rank` WHERE challengeid=".$id." and userid=".$_SESSION['cn']." limit 1";
	$con = mysql_query($sql, $db);
	while ($row = mysql_fetch_assoc($con)) {
			$s_flag = 1;
	}
	if(!$s_flag){
		echo '<form action="./auth/check.php" method="post">
		<input type="hidden" name="id" value="'.$id.'">
		Flag:<input type="text" class="form-control" name="flags" placeholder="Flags"><br>
		<button type="submit" class="btn btn-info" onclick="DisableButton(this);">submit</button>
		</form>';
	}
	else{
		echo '<div class="panel panel-info">
		<div class="panel-heading">notice</div>
			<div class="panel-body">
			You solved challenge....
		</div>
	</div>';
	}



	?>
	<br><br>

<?php include 'footer.html';?>
