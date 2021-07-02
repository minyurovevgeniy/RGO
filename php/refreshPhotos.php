<?php
	date_default_timezone_set('Asia/Yekaterinburg');

  include("./connect.php");

  $response=array();

  $stmt=$pdo->prepare("SELECT * FROM photos");
  $stmt->execute();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['photos'][]=array
    (
			'id'=>$row['photo_id'],
      "description"=>iconv("cp1251","utf-8",$row['photo_comment']),
      "src"=>$row['photo_src']
    );
  }

  echo json_encode($response);
 ?>
