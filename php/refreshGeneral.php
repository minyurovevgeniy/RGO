<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");
  
  $stmt=$pdo->prepare("SELECT * FROM `general_meeting_of_members` ORDER BY `general_date` DESC, `general_time` DESC, `general_end_time` DESC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
	if ($row['general_cancel']>0)
	{
		$cancel=1;
	}
	else
	{
		$cancel=0;
	}
    $response['general'][]=array
    (
      'id'=>$row['general_id'],
      'date'=>implode("-",array_reverse(explode("-",$row['general_date']))),
      'place'=>iconv("cp1251","utf-8",$row['general_place']),
      'start_time'=>iconv("cp1251","utf-8",$row['general_time']),
      'end_time'=>iconv("cp1251","utf-8",$row['general_end_time']),
	  'description'=>iconv("cp1251","utf-8",$row['general_description']),
      'general_cancel'=>$cancel
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>