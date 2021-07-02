<?php
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");



  $stmt=$pdo->prepare("SELECT * FROM `news` ORDER BY `news_date` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $timestamp=strtotime("23:59:59 ".$row['news_date']);
    $time=time();

    $shouldDisplay=0;

    if ($time<=$timestamp)
    {
      $shouldDisplay=1;
    }

    if ($shouldDisplay>0)
    {
      $response['news'][]=array
      (
        'date'=>implode("-",array_reverse(explode("-",$row['news_date']))),
        'text'=>iconv("cp1251","utf-8",$row['news_text']),
        'heading'=>iconv("cp1251","utf-8",$row['news_heading'])
      );
    }
  }

  echo json_encode($response);
?>
