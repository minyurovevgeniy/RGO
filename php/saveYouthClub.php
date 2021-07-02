<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
	header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");

	
	$youthDate = implode("-",array_reverse(explode("-",$_POST['date'])));
	$youthPlace = iconv("utf-8","cp1251",$_POST['place']);
	$youthTime = iconv("utf-8","cp1251",$_POST['time']);
	$youthEndTime = iconv("utf-8","cp1251",$_POST['end_time']);
	$description = iconv("utf-8","cp1251",$_POST['description']);
	$id = $_POST['id'];

	$stmt=$pdo->prepare("UPDATE `youth_club` SET `youth_date`=?,`youth_place`=?, `youth_time`=?, `youth_end_time`=?, `youth_description`=? WHERE `youth_id`=?");
	$stmt->execute(array($youthDate,$youthPlace,$youthTime,$youthEndTime,$description,$id));
	
	echo json_encode(array("OK"=>"ok"));
?>