<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $id=$_POST['id'];

  $stmt=$pdo->prepare("SELECT * FROM `expeditions` WHERE `expedition_id`=?");
  $stmt->execute(array($id));

  $response=array();
  $row=$stmt->fetch(PDO::FETCH_LAZY);
  $response['expedition']=array
  (
    'id'=>$row['expedition_id'],
    'place'=>iconv("cp1251","utf-8",$row['expedition_place']),
    'date'=>implode("-",array_reverse(explode("-",$row['expedition_date']))),
    'end_time'=>iconv("cp1251","utf-8",$row['expedition_end_time']),
    'time'=>iconv("cp1251","utf-8",$row['expedition_time']),
    'description'=>iconv("cp1251","utf-8",$row['expedition_description']),
    'announcement'=>iconv("cp1251","utf-8",$row['expedition_announcement']),
    'responsible'=>iconv("cp1251","utf-8",$row['expedition_responsible'])
  );

  include("./disconnect.php");

  echo json_encode($response);
  ?>
