<?php
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `general_meeting_of_members` ORDER BY `general_date` ASC, `general_time` ASC, `general_end_time` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $startTimestamp=strtotime($row['general_time']." ".$row['general_date']);
	$endTimestamp=strtotime($row['general_end_time']." ".$row['general_date']);

    $time=time();

	$shouldDisplay=1;

    if ($time<$startTimestamp)
    {
      $status="Ожидается";
    }
    else
    {
      if (($time>=$startTimestamp) and ($time<=$endTimestamp))
      {
        $status="В процессе";
      }
      else
      {
        if ($time<=3600+$endTimestamp)
        {
          $status="Завершена ".floor(($time-$endTimestamp)/60)." минут (минуты) назад";
        }
        else
        {
          $status="Завершена";
          $shouldDisplay=0;
        }
      }
    }

	if ($row['general_cancel']>0)
    {
      $status="Отменено";
    }

    if ($shouldDisplay>0)
    {
      $response['general'][]=array
      (
        'id'=>$row['general_id'],
        'date'=>implode("-",array_reverse(explode("-",$row['general_date']))),
        'place'=>iconv("cp1251","utf-8",$row['general_place']),
        'time'=>iconv("cp1251","utf-8",$row['general_time']),
        'end_time'=>iconv("cp1251","utf-8",$row['general_end_time']),
        'description'=>iconv("cp1251","utf-8",$row['general_description']),
		    'status'=>$status
      );
    }
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
