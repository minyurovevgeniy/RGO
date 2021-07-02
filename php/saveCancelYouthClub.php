<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
	header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");


	$id = $_POST['id'];
	$state=$_POST['state'];

	$stmt=$pdo->prepare("UPDATE `youth_club` SET `youth_cancel`=? WHERE `youth_id`=?");
	$stmt->execute(array($state,$id));
	
	echo json_encode(array("OK"=>"ok"));
?>