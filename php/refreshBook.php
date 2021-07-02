<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $id=$_POST['id'];
  //$id=$_GET['id'];

  $stmt=$pdo->prepare("SELECT * FROM `books` WHERE `book_id`=?");
  $stmt->execute(array($id));

  $response=array();
  $row=$stmt->fetch(PDO::FETCH_LAZY);
  $response['book']=array
  (
    'id'=>$row['book_id'],
    'title'=>iconv("cp1251","utf-8",$row['book_title']),
    'authors'=>iconv("cp1251","utf-8",$row['book_authors']),
    'coauthors'=>iconv("cp1251","utf-8",$row['book_coauthors']),
    'publisher'=>iconv("cp1251","utf-8",$row['book_publisher']),
    'year'=>$row['book_year'],
    'volume'=>$row['book_volume'],
    'url'=>iconv("cp1251","utf-8",$row['book_url'])
  );

  include("./disconnect.php");

  echo json_encode($response);
  ?>
