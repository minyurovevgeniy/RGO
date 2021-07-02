<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  header("Content-Type: text/html; charset=utf-8");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");


  $eventDate = implode("-",array_reverse(explode("-",iconv("utf-8","cp1251",$_POST['date']))));
  $eventPlace = iconv("utf-8","cp1251",$_POST['place']);
  $eventTime = iconv("utf-8","cp1251",$_POST['time']);
  $eventEndTime = iconv("utf-8","cp1251",$_POST['end_time']);
  $description = iconv("utf-8","cp1251",$_POST['description']);
  $responsible = iconv("utf-8","cp1251",$_POST['responsible']);
  $announcement = iconv("utf-8","cp1251",$_POST['announcement']);

  $stmt=$pdo->prepare("SELECT `event_id` FROM `events` WHERE `event_place`=? AND `event_date`=? AND `event_time`=? AND `event_end_time`=? AND `event_description`=? AND `event_responsible`=? AND `event_announcement`=?");
  $stmt->execute(array($eventPlace,$eventDate,$eventTime,$eventEndTime,$description,$responsible,$announcement));
  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['event_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `events` SET `event_date`=?, `event_place`=?, `event_time`=?, `event_end_time`=?, `event_description`=?, `event_responsible`=?, `event_announcement`=?");
    $stmt->execute(array($eventDate,$eventPlace,$eventTime,$eventEndTime,$description,$responsible,$announcement));
  }
  else
  {
    //die("Такое событие уже есть");
  }
  include("./disconnect.php");

  echo json_encode(array("OK"=>"OK"));
 ?>
