<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  header("Content-Type: text/html; charset=utf-8");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");


  $grantTitle = iconv("utf-8","cp1251",$_POST['title']);
  $grantSupervisor = iconv("utf-8","cp1251",$_POST['supervisor']);
  $grantDeadline = iconv("utf-8","cp1251",$_POST['deadline']);
  $grantAnnotation = iconv("utf-8","cp1251",$_POST['annotation']);
  $grantCost = iconv("utf-8","cp1251",$_POST['cost']);
  $grantStatus = iconv("utf-8","cp1251",$_POST['status']);

  $stmt=$pdo->prepare("SELECT `grant_id` FROM `grants`
                      WHERE `grant_title`=? AND `grant_supervisor`=? AND `grant_deadline`=?
                        AND `grant_annotation`=? AND `grant_cost`=? AND `grant_status`=?");
  $stmt->execute(array($grantTitle,$grantSupervisor,$grantDeadline,$grantAnnotation,$grantCost,$grantStatus));
  $row=$stmt->fetch(PDO::FETCH_LAZY);

  if ($row['grant_id']<1)
  {
    $stmt=$pdo->prepare("INSERT INTO `grants` SET `grant_title`=?, `grant_supervisor`=?,
                                    `grant_deadline`=?,`grant_annotation`=?,
                                    `grant_cost`=?,  `grant_status`=?");
    $stmt->execute(array($grantTitle,$grantSupervisor,$grantDeadline,$grantAnnotation,$grantCost,$grantStatus));
  }
  else
  {
    //die("Такое событие уже есть");
  }
  include("./disconnect.php");

  echo json_encode(array("OK"=>"OK"));
 ?>
