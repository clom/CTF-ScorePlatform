<?php
	session_start();
	require_once(dirname(__FILE__) . "/conf.php");

	if(!$_SESSION['flag'])
		header("Location:./");

	// sql rank
	$db = mysql_connect($db_url,$db_user,$db_pass);
	$con = mysql_select_db ($db_use, $db);
	$con = mysql_query('SET NAMES utf8', $db);
	$con = mysql_query("SELECT `displayname`,sum(`plusscore`) FROM `auth`,`rank` WHERE auth.id=rank.userid group by userid order by sum(`plusscore`) desc", $db);

  include 'header.html';
?>

	<h1> Ranking </h1>
	<hr>

	<table class="table table-bordered">
		<tr>
			<td>No</td>
			<td>name</td>
			<td>Point</td>
		</tr>
		<?php
		$count = 0;
		while ($row = mysql_fetch_assoc($con)) {
			$name = $row['displayname'];
			$score = $row['sum(`plusscore`)'];
			$count++;
		echo "<tr><td>".$count."</td><td>".$name."</td><td>".$score."</td></tr>";
		}
		?>
	</table>

<?php include 'footer.html';?>
