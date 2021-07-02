<?php
  include("./connect.php");
  date_default_timezone_set('Asia/Yekaterinburg');


  $date=implode("-",array_reverse(explode("-",$_POST['data'])));
  $heading=iconv("utf-8","cp1251",$_POST['heading']);
  $text=iconv("utf-8","cp1251",$_POST['text']);

/*
  $date=implode("-",array_reverse(explode("-",$_GET['date'])));
  $heading=iconv("utf-8","cp1251",$_GET['heading']);
  $text=iconv("utf-8","cp1251",$_GET['text']);
*/
  $stmt=$pdo->prepare("SELECT `suggested_news_id` FROM `suggested_news` WHERE `suggest_news_date`=? AND `suggest_news_heading`=? AND `suggest_news_text`=?");
  $stmt->execute(array($date,$heading,$text));

  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['suggested_news_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `suggested_news` SET `suggest_news_date`=?, `suggest_news_heading`=?, `suggest_news_text`=?");
    $stmt->execute(array($date,$heading,$text));
  }

  include("./disconnect.php");

 ?>
