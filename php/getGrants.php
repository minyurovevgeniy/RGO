<?php
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `grants` ORDER BY `grant_id` ASC");
  $stmt->execute();

  $statuses=array();
  $stmt2=$pdo->prepare("SELECT * FROM `grant_statuses`");
  $stmt2->execute();
  while($row2=$stmt2->fetch(PDO::FETCH_LAZY))
  {
    $statuses[$row2['grant_status_id']]=$row2['grant_status_value'];
  }

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['grants'][]=array
    (
      'title'=>iconv("cp1251","utf-8",$row['grant_title']),
      'supervisor'=>iconv("cp1251","utf-8",$row['grant_supervisor']),
      'deadline'=>iconv("cp1251","utf-8",$row['grant_deadline']),
      'annotation'=>iconv("cp1251","utf-8",$row['grant_annotation']),
      'cost'=>iconv("cp1251","utf-8",$row['grant_cost']),
      'status'=>iconv("cp1251","utf-8",$statuses[$row['grant_status']])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
