<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `suggested_news` ORDER BY `suggest_news_date` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['news'][]=array
    (
      'id'=>$row['suggested_news_id'],
      'date'=>implode("-",array_reverse(explode("-",$row['suggest_news_date']))),
      'heading'=>iconv("cp1251","utf-8",$row['suggest_news_heading']),
      'text'=>iconv("cp1251","utf-8",$row['suggest_news_text'])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
