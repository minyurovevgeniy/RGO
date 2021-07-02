<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $id=intval($_POST['id']);
  //$id=1;

  $stmt=$pdo->prepare("SELECT * FROM `suggested_news` WHERE `suggested_news_id`=?");
  $stmt->execute(array($id));
  $row=$stmt->fetch(PDO::FETCH_LAZY);
  $response=array();

  $response=array
  (
    'id'=>$row['suggested_news_id'],
    'heading'=>iconv("cp1251","utf-8",$row['suggest_news_heading']),
    'date'=>implode("-",array_reverse(explode("-",$row['suggest_news_date']))),
    'text'=>iconv("cp1251","utf-8",$row['suggest_news_text'])
  );

  include("./disconnect.php");

  echo json_encode($response);
  ?>
