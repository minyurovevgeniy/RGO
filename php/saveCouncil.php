<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");

	$councilDate = implode("-",array_reverse(explode("-",$_POST['date'])));
	$councilPlace = iconv("utf-8","cp1251",$_POST['place']);
	$councilTime = iconv("utf-8","cp1251",$_POST['time']);
	$councilEventTime = iconv("utf-8","cp1251",$_POST['end_time']);
	$councilEventTime = iconv("utf-8","cp1251",$_POST['end_time']);
	$description = iconv("utf-8","cp1251",$_POST['description']);
	$agenda = iconv("utf-8","cp1251",$_POST['agenda']);
	$id = $_POST['id'];

	
	$stmt=$pdo->prepare("UPDATE `council_of_regional_department` SET `council_date`=?,`council_place`=?, `council_time`=?, `council_end_time`=?, `council_description`=?, `council_agenda`=? WHERE `council_id`=?");
	$stmt->execute(array($councilDate,$councilPlace,$councilTime,$councilEventTime,$description,$agenda,$id));
	
	echo json_encode(array("OK"=>"ok"));

?>