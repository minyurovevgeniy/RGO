<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");


	$text = iconv("utf-8","cp1251", $_POST['text']);
	$id = $_POST['id'];

	$grantTitle = iconv("utf-8","cp1251",$_POST['title']);
  $grantSupervisor = iconv("utf-8","cp1251",$_POST['supervisor']);
  $grantDeadline = iconv("utf-8","cp1251",$_POST['deadline']);
  $grantAnnotation = iconv("utf-8","cp1251",$_POST['annotation']);
  $grantCost = iconv("utf-8","cp1251",$_POST['cost']);
  $grantStatus = iconv("utf-8","cp1251",$_POST['status']);

	/*
	$text = iconv("utf-8","cp1251", "Грант №3");
	$id = 2;
	*/

	$stmt=$pdo->prepare("UPDATE `grants` SET `grant_title`=?, `grant_supervisor`=?,
																	`grant_deadline`=?,`grant_annotation`=?,
																	`grant_cost`=?,  `grant_status`=? WHERE `grant_id`=?");
	$stmt->execute(array($grantTitle,$grantSupervisor,$grantDeadline,$grantAnnotation,$grantCost,$grantStatus,$id));

	echo json_encode(array("OK"=>"ok"));

?>
