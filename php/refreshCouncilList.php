<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `council_of_regional_department` ORDER BY `council_date` ASC, `council_time` ASC, `council_end_time` ASC, `council_description` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['council'][]=array
    (
      'id'=>$row['council_id'],
      'date'=>$row['council_date'],
      'description'=>iconv("cp1251","utf-8",$row['council_description'])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
