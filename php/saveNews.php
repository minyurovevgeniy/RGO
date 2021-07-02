<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");


	$text = iconv("utf-8","cp1251", $_POST['text']);
	$id = $_POST['id'];

	$newsDate = implode("-",array_reverse(explode("-",$_POST['date'])));
  $newsHeading = iconv("utf-8","cp1251",$_POST['heading']);
  $newsText = iconv("utf-8","cp1251",$_POST['text']);

	/*
	$text = iconv("utf-8","cp1251", "Грант №3");
	$id = 2;
	*/

	$stmt=$pdo->prepare("UPDATE `news` SET `news_date`=?, `news_text`=?,`news_heading`=? WHERE `news_id`=?");
	$stmt->execute(array($newsDate,$newsText,$newsHeading,$id));

	echo json_encode(array("OK"=>"ok"));

?>
