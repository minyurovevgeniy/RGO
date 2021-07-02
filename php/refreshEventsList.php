<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `events` ORDER BY `event_date` ASC, `event_time` ASC, `event_end_time` ASC, `event_description` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['events'][]=array
    (
      'id'=>$row['event_id'],
      'date'=>$row['event_date'],
      'description'=>iconv("cp1251","utf-8",$row['event_description'])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
