<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
	header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");

	$eventDate = implode("-",array_reverse(explode("-",$_POST['date'])));
	$eventPlace = iconv("utf-8","cp1251",$_POST['place']);
	$eventTime = iconv("utf-8","cp1251",$_POST['time']);
	$eventEventTime = iconv("utf-8","cp1251",$_POST['end_time']);
	$eventResponsible = iconv("utf-8","cp1251",$_POST['responsible']);
	$eventAnnouncement = iconv("utf-8","cp1251",$_POST['announcement']);
	$description = iconv("utf-8","cp1251",$_POST['description']);
	$id = $_POST['id'];


	$stmt=$pdo->prepare("UPDATE `events` SET `event_date`=?,`event_place`=?, `event_time`=?, `event_end_time`=?, `event_description`=?, `event_responsible`=?, `event_announcement`=? WHERE `event_id`=?");
	$stmt->execute(array($eventDate,$eventPlace,$eventTime,$eventEventTime,$description,$eventResponsible,$eventAnnouncement,$id));

	echo json_encode(array("OK"=>"ok"));

?>
