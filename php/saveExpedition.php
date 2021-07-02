<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");

	include("./connect.php");

	$expeditionDate = implode("-",array_reverse(explode("-",$_POST['date'])));
	$expeditionPlace = iconv("utf-8","cp1251",$_POST['place']);
	$expeditionTime = iconv("utf-8","cp1251",$_POST['time']);
	$expeditionEventTime = iconv("utf-8","cp1251",$_POST['end_time']);
	$expeditionResponsible = iconv("utf-8","cp1251",$_POST['responsible']);
	$expeditionAnnouncement = iconv("utf-8","cp1251",$_POST['announcement']);
	$description = iconv("utf-8","cp1251",$_POST['description']);
	$id = intval($_POST['id']);


	$stmt=$pdo->prepare("UPDATE `expeditions` SET `expedition_date`=?,`expedition_place`=?, `expedition_time`=?, `expedition_end_time`=?, `expedition_description`=?, `expedition_responsible`=?, `expedition_announcement`=? WHERE `expedition_id`=?");
	$stmt->execute(array($expeditionDate,$expeditionPlace,$expeditionTime,$expeditionEventTime,$description,$expeditionResponsible,$expeditionAnnouncement,$id));

	echo json_encode(array("OK"=>"ok"));

?>
