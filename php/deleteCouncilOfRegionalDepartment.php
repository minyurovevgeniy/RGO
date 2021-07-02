<?php
	date_default_timezone_set('Asia/Yekaterinburg');
	include("./connect.php");

	$id=$_POST['id'];
	//$id=7;
	
	$stmt=$pdo->prepare("DELETE FROM `council_of_regional_department` WHERE `council_id`=?");
	$stmt->execute(array($id));
	
	echo json_encode(array("ok"=>"ok"));
?>