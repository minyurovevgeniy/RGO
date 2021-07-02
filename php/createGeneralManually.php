<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  header("Content-Type: text/html; charset=utf-8");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");
  
  
  $generalDate = implode("-",array_reverse(explode("-",iconv("utf-8","cp1251",$_POST['date']))));
  $generalPlace = iconv("utf-8","cp1251",$_POST['place']);
  $generalTime = iconv("utf-8","cp1251",$_POST['time']);
  $generalEndTime = iconv("utf-8","cp1251",$_POST['end_time']);
  $description = iconv("utf-8","cp1251",$_POST['description']);
  

  $stmt=$pdo->prepare("SELECT `general_id` FROM `general_meeting_of_members` WHERE `general_date`=? AND `general_time`=? AND `general_end_time`=? AND `general_description`=?");
  $stmt->execute(array($generalDate,$generalTime,$generalEndTime,$description));
  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['general_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `general_meeting_of_members` SET `general_date`=?, `general_place`=?, `general_time`=?, `general_end_time`=?, `general_description`=?");
    $stmt->execute(array($generalDate,$generalPlace,$generalTime,$generalEndTime,$description));
  }
  else
  {
    die("Такое событие уже есть");
  }

  echo json_encode(array("ok"=>"ok"));
  include("./disconnect.php");
 ?>
