<?php
  session_start();
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `youth_club` ORDER BY `youth_date` DESC, `youth_time` DESC, `youth_end_time` DESC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
	if ($row['youth_cancel']>0)
	{
		$cancel=1;
	}
	else
	{
		$cancel=0;
	}
    $response['youth'][]=array
    (
      'id'=>$row['youth_id'],
      'date'=>implode("-",array_reverse(explode("-",$row['youth_date']))),
      'place'=>iconv("cp1251","utf-8",$row['youth_place']),
      'end_time'=>iconv("cp1251","utf-8",$row['youth_end_time']),
      'start_time'=>iconv("cp1251","utf-8",$row['youth_time']),
	  'description'=>iconv("cp1251","utf-8",$row['youth_description']),
      'youth_cancel'=>$cancel
    );
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
