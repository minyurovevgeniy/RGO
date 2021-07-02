<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `expeditions` ORDER BY `expedition_date` ASC, `expedition_time` ASC, `expedition_end_time` ASC, `expedition_description` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['expeditions'][]=array
    (
      'id'=>$row['expedition_id'],
      'date'=>$row['expedition_date'],
      'description'=>iconv("cp1251","utf-8",$row['expedition_description'])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
