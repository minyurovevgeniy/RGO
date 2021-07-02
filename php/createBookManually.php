<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  //header("Content-Type: text/html; charset=utf-8");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");
  
  $bookTitle=iconv("utf-8","cp1251",$_POST['book_title']);
  $bookAuthors=iconv("utf-8","cp1251",$_POST['book_authors']);
  $bookCoauthors=iconv("utf-8","cp1251",$_POST['book_coauthors']);
  $bookPublisher=iconv("utf-8","cp1251",$_POST['book_publisher']);
  $bookYear=iconv("utf-8","cp1251",$_POST['book_year']);
  $bookVolume=iconv("utf-8","cp1251",$_POST['book_volume']);
  $bookUrl=iconv("utf-8","cp1251",$_POST['book_url']);


  $stmt=$pdo->prepare("SELECT `book_id` FROM `books` WHERE `book_title`=? AND `book_authors`=? AND `book_coauthors`=? AND `book_publisher`=? AND `book_year`=? AND `book_volume`=? AND `book_url`=?");
  $stmt->execute(array($bookTitle,$bookAuthors,$bookCoauthors,$bookPublisher,$bookYear,$bookVolume,$bookUrl));
  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['book_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `books` SET `book_title`=?, `book_authors`=?, `book_coauthors`=?, `book_publisher`=?, `book_year`=?, `book_volume`=?, `book_url`=?");
    $stmt->execute(array($bookTitle,$bookAuthors,$bookCoauthors,$bookPublisher,$bookYear,$bookVolume,$bookUrl));
  }
  else
  {
    die("Такое событие уже есть");
  }

  include("./disconnect.php");

  echo json_encode(array("ok"=>"ok"));
 ?>
