<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  header("Content-Type: text/html; charset=utf-8");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");


  $newsDate = implode("-",array_reverse(explode("-",$_POST['date'])));
  $newsHeading = iconv("utf-8","cp1251",$_POST['heading']);
  $newsText = iconv("utf-8","cp1251",$_POST['text']);

  $stmt=$pdo->prepare("SELECT `news_id` FROM `news` WHERE `news_date`=? AND `news_text`=? AND `news_heading`=?");
  $stmt->execute(array($newsDate,$newsText,$newsHeading));
  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['news_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `news` SET `news_date`=?, `news_text`=?, `news_heading`=?");
    $stmt->execute(array($newsDate,$newsText,$newsHeading));
  }
  else
  {
    //die("Такое событие уже есть");
  }
  include("./disconnect.php");

  echo json_encode(array("OK"=>"OK"));
 ?>
