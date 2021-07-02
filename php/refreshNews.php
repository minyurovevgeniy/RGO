<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $id=$_POST['id'];

  $stmt=$pdo->prepare("SELECT * FROM `news` WHERE `news_id`=?");
  $stmt->execute(array($id));

  $response=array();
  $row=$stmt->fetch(PDO::FETCH_LAZY);
  $response['news']=array
  (
    'id'=>$row['grant_id'],
    'heading'=>iconv("cp1251","utf-8",$row['news_heading']),
    'date'=>implode("-",array_reverse(explode("-",$row['news_date']))),
    'text'=>iconv("cp1251","utf-8",$row['news_text'])
  );

  include("./disconnect.php");

  echo json_encode($response);
  ?>
