<?php
	date_default_timezone_set('Asia/Yekaterinburg');
	include("./connect.php");

	$id=$_POST['id'];
	
	$stmt=$pdo->prepare("DELETE FROM `youth_club` WHERE `youth_id`=?");
	$stmt->execute(array($id));
	
	echo json_encode(array("ok"=>"ok"));
?>