<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");
  
  $stmt=$pdo->prepare("SELECT * FROM `expeditions` ORDER BY `expedition_date` ASC, `expedition_time` ASC, `expedition_end_time` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
	if ($row['expedition_cancel']>0)
	{
		$cancel=1;
	}
	else
	{
		$cancel=0;
	}
    $response['expeditions'][]=array
    (
      'id'=>$row['expedition_id'],
      'date'=>implode("-",array_reverse(explode("-",$row['expedition_date']))),
      'place'=>iconv("cp1251","utf-8",$row['expedition_place']),
      'start_time'=>$row['expedition_time'];
      'end_time'=>$row['expedition_end_time'],
      'cancel'=>$cancel,
      'description'=>iconv("cp1251","utf-8",$row['expedition_description']),
	  'responsible'=>iconv("cp1251","utf-8",$row['expedition_responsible']),
	  'announcement'=>iconv("cp1251","utf-8",$row['expedition_announcement'])
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>