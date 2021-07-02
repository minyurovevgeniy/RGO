<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `grant_statuses`");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['statuses'][]=array
    (
      'id'=>$row['grant_status_id'],
      'status'=>iconv("cp1251","utf-8",$row['grant_status_value'])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
