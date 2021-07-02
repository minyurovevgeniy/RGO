<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");

	$generalDate = implode("-",array_reverse(explode("-",$_POST['date'])));
	$generalPlace = iconv("utf-8","cp1251",$_POST['place']);
	$generalTime = iconv("utf-8","cp1251",$_POST['time']);
	$generalEndTime = iconv("utf-8","cp1251",$_POST['end_time']);
	$description = iconv("utf-8","cp1251",$_POST['description']);
	$id = $_POST['id'];

	
	$stmt=$pdo->prepare("UPDATE `general_meeting_of_members` SET `general_date`=?,`general_place`=?, `general_time`=?, `general_end_time`=?, `general_description`=? WHERE `general_id`=?");
	$stmt->execute(array($generalDate,$generalPlace,$generalTime,$generalEndTime,$description,$id));
	
	echo json_encode(array("OK"=>"ok"));

?>