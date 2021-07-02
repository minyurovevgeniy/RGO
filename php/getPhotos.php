<?php
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `photos`");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['photos_array'][]=array
    (
      'link'=>iconv("cp1251","utf-8",$row['photo_public_link']),
      'description'=>iconv("cp1251","utf-8",$row['photo_comment'])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
?>
