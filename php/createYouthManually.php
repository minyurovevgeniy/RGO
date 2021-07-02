<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  header("Content-Type: text/html; charset=utf-8");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");
  
  
  $youthDate = implode("-",array_reverse(explode("-",iconv("utf-8","cp1251",$_POST['date']))));
  $youthPlace = iconv("utf-8","cp1251",$_POST['place']);
  $youthTime = iconv("utf-8","cp1251",$_POST['time']);
  $youthEndTime = iconv("utf-8","cp1251",$_POST['end_time']);
  $description = iconv("utf-8","cp1251",$_POST['description']);
  
	/*
  $youthDate = implode("-",array_reverse(explode("-","12-04-2019")));
  $youthPlace = iconv("utf-8","cp1251","УрГПУ");
  $youthTime = "12:00:00";
*/

  $stmt=$pdo->prepare("SELECT `youth_id` FROM `youth_club` WHERE `youth_date`=? AND `youth_time`=? AND `youth_end_time`=? AND `youth_description`=? ");
  $stmt->execute(array($youthDate,$youthTime,$youthEndTime,$description));
  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['youth_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `youth_club` SET `youth_date`=?, `youth_place`=?, `youth_time`=?, `youth_end_time`=?, `youth_description`=?");
    $stmt->execute(array($youthDate,$youthPlace,$youthTime,$youthEndTime,$description));
  }
  else
  {
    die("Такое событие уже есть");
  }

  include("./disconnect.php");

  echo json_encode(array("ok"=>"ok"));
 ?>
