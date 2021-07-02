<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  //header("Content-Type: text/html; charset=utf-8");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");
  
 
  $councilDate = implode("-",array_reverse(explode("-",iconv("utf-8","cp1251",$_POST['date']))));
  $councilPlace = iconv("utf-8","cp1251",$_POST['place']);
  $councilTime = iconv("utf-8","cp1251",$_POST['time']);
  $councilEndTime = iconv("utf-8","cp1251",$_POST['end_time']);
  $description = iconv("utf-8","cp1251",$_POST['description']);
  $agenda = iconv("utf-8","cp1251",$_POST['agenda']);

  $stmt=$pdo->prepare("SELECT `council_id` FROM `council_of_regional_department` WHERE `council_date`=? AND `council_time`=? AND `council_end_time`=? AND `council_description`=? AND `council_agenda`=?");
  $stmt->execute(array($councilDate,$councilTime,$councilEndTime,$description,$agenda));
  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['council_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `council_of_regional_department` SET `council_date`=?, `council_place`=?, `council_time`=?, `council_end_time`=?, `council_description`=?, `council_agenda`=?");
    $stmt->execute(array($councilDate,$councilPlace,$councilTime,$councilEndTime,$description,$agenda));
  }
  else
  {
    die("Такое событие уже есть");
  }

  include("./disconnect.php");

  echo json_encode(array("ok"=>"ok"));
 ?>
