<?php
	date_default_timezone_set('Asia/Yekaterinburg');
	include("./connect.php");

	$id=$_POST['id'];
	
	$stmt=$pdo->prepare("DELETE FROM `general_meeting_of_members` WHERE `general_id`=?");
	$stmt->execute(array($id));
	
	echo json_encode(array("ok"=>"ok"));
?>