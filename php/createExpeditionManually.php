<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  header("Content-Type: text/html; charset=utf-8");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");
  
  
  $expeditionDate = implode("-",array_reverse(explode("-",iconv("utf-8","cp1251",$_POST['date']))));
  $expeditionPlace = iconv("utf-8","cp1251",$_POST['place']);
  $expeditionTime = iconv("utf-8","cp1251",$_POST['time']);
  $expeditionEndTime = iconv("utf-8","cp1251",$_POST['end_time']);
  $description = iconv("utf-8","cp1251",$_POST['description']);
  $responsible = iconv("utf-8","cp1251",$_POST['responsible']);
  $announcement = iconv("utf-8","cp1251",$_POST['announcement']);

  $stmt=$pdo->prepare("SELECT `expedition_id` FROM `expeditions` WHERE `expedition_date`=? AND `expedition_time`=? AND `expedition_end_time`=? AND `expedition_description`=? AND `expedition_responsible`=? AND `expedition_announcement`=?");
  $stmt->execute(array($expeditionDate,$expeditionTime,$expeditionEndTime,$description,$responsible,$announcement));
  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['expedition_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `expeditions` SET `expedition_date`=?, `expedition_place`=?, `expedition_time`=?, `expedition_end_time`=?, `expedition_description`=?, `expedition_responsible`=?, `expedition_announcement`=?");
    $stmt->execute(array($expeditionDate,$expeditionPlace,$expeditionTime,$expeditionEndTime,$description,$responsible,$announcement));
  }
  else
  {
    //die("Такое событие уже есть");
  }
  include("./disconnect.php");

  echo json_encode(array("OK"=>"OK"));
 ?>
