<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");

	$state=$_POST['state'];
	$id = $_POST['id'];

	
	$stmt=$pdo->prepare("UPDATE `general_meeting_of_members` SET `general_cancel`=? WHERE `general_id`=?");
	$stmt->execute(array($state,$id));
	
	echo json_encode(array("OK"=>"ok"));

?>