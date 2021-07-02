<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `grants` ORDER BY `grant_id` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['grants'][]=array
    (
      'id'=>$row['grant_id'],
      'annotation'=>iconv("cp1251","utf-8",$row['grant_annotation'])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
