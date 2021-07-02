<?php
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `books`");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $response['books'][]=array
    (
      'id'=>$row['book_id'],
      'book_title'=>iconv("cp1251","utf-8",$row['book_title']),
      'book_authors'=>iconv("cp1251","utf-8",$row['book_authors']),
      'book_coauthors'=>iconv("cp1251","utf-8",$row['book_coauthors']),
      'book_publisher'=>iconv("cp1251","utf-8",$row['book_publisher']),
      'book_year'=>$row['book_year'],
      'book_volume'=>$row['book_volume'],
      'book_url'=>$row['book_url']
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
