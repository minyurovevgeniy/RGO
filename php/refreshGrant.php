<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $id=$_POST['id'];

  $stmt=$pdo->prepare("SELECT * FROM `grants` WHERE `grant_id`=?");
  $stmt->execute(array($id));

  $response=array();
  $row=$stmt->fetch(PDO::FETCH_LAZY);
  $response['grant']=array
  (
    'id'=>$row['grant_id'],
    'title'=>iconv("cp1251","utf-8",$row['grant_title']),
    'supervisor'=>iconv("cp1251","utf-8",$row['grant_supervisor']),
    'deadline'=>iconv("cp1251","utf-8",$row['grant_deadline']),
    'annotation'=>iconv("cp1251","utf-8",$row['grant_annotation']),
    'cost'=>iconv("cp1251","utf-8",$row['grant_cost']),
    'status'=>iconv("cp1251","utf-8",$row['grant_status'])
  );

  include("./disconnect.php");

  echo json_encode($response);
  ?>
