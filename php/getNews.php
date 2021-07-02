<?php
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");



  $stmt=$pdo->prepare("SELECT * FROM `news` ORDER BY `news_date` DESC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
      $response['news'][]=array
      (
        'date'=>implode("-",array_reverse(explode("-",$row['news_date']))),
        'text'=>iconv("cp1251","utf-8",$row['news_text']),
        'heading'=>iconv("cp1251","utf-8",$row['news_heading'])
      );
  }

  echo json_encode($response);
?>
