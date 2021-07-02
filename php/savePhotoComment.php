<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
  header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");


	$text = iconv("utf-8","cp1251", $_POST['text']);
	$id = $_POST['id'];

// УрГПУ

	//$text = iconv("utf-8","cp1251", "УрГПУ");
	//$id = 1;//$_POST['id'];
	$stmt=$pdo->prepare("UPDATE `photos` SET `photo_comment`=? WHERE `photo_id`=?");
	$stmt->execute(array($text,$id));

	echo json_encode(array("OK"=>"ok"));

?>
