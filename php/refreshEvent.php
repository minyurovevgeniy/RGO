<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $id=$_POST['id'];

  $stmt=$pdo->prepare("SELECT * FROM `events` WHERE `event_id`=?");
  $stmt->execute(array($id));

  $response=array();
  $row=$stmt->fetch(PDO::FETCH_LAZY);
  $response['event']=array
  (
    'id'=>$row['event_id'],
    'place'=>iconv("cp1251","utf-8",$row['event_place']),
    'date'=>implode("-",array_reverse(explode("-",$row['event_date']))),
    'end_time'=>iconv("cp1251","utf-8",$row['event_end_time']),
    'time'=>iconv("cp1251","utf-8",$row['event_time']),
    'description'=>iconv("cp1251","utf-8",$row['event_description']),
    'announcement'=>iconv("cp1251","utf-8",$row['event_announcement']),
    'responsible'=>iconv("cp1251","utf-8",$row['event_responsible'])
  );

  include("./disconnect.php");

  echo json_encode($response);
  ?>
