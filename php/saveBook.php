<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	date_default_timezone_set('Asia/Yekaterinburg');
header("Content-Type: text/html; charset=utf-8");
	include("./connect.php");

	$bookTitle=iconv("utf-8","cp1251",$_POST['book_title']);
	$bookAuthors=iconv("utf-8","cp1251",$_POST['book_authors']);
	$bookCoauthors=iconv("utf-8","cp1251",$_POST['book_coauthors']);
	$bookPublisher=iconv("utf-8","cp1251",$_POST['book_publisher']);
	$bookYear=iconv("utf-8","cp1251",$_POST['book_year']);
	$bookVolume=iconv("utf-8","cp1251",$_POST['book_volume']);
	$bookUrl=iconv("utf-8","cp1251",$_POST['book_url']);
	$id = $_POST['id'];
	
	$stmt=$pdo->prepare("UPDATE `books` SET `book_title`=?, `book_authors`=?, `book_coauthors`=?, `book_publisher`=?, `book_year`=?, `book_volume`=?, `book_url`=? WHERE `book_id`=?");
    $stmt->execute(array($bookTitle,$bookAuthors,$bookCoauthors,$bookPublisher,$bookYear,$bookVolume,$bookUrl,$id));
	
	echo json_encode(array("OK"=>"ok"));

?>