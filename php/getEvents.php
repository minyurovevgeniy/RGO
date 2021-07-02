<?php
  //if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `events` ORDER BY `event_date` ASC, `event_time` ASC, `event_end_time` ASC");
  $stmt->execute();


  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $startTimestamp=strtotime($row['event_time']." ".$row['event_date']);

	   $endTimestamp=strtotime($row['event_end_time']." ".$row['event_date']);
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

	if ($row['event_cancel']>0)
    {
      $status="Отменено";
    }

    //if ($shouldDisplay>0)
    //{
      $response['events'][]=array
      (
        'id'=>$row['event_id'],
        'date'=>implode("-",array_reverse(explode("-",$row['event_date']))),
        'time'=>iconv("cp1251","utf-8",$row['event_time']),
        'end_time'=>iconv("cp1251","utf-8",$row['event_end_time']),
        'status'=>$status,
        'place'=>iconv("cp1251","utf-8",$row['event_place']),
        'description'=>iconv("cp1251","utf-8",$row['event_description']),
        'announcement'=>iconv("cp1251","utf-8",$row['event_announcement']),
        'responsible'=>iconv("cp1251","utf-8",$row['event_responsible'])
      );
    //}
  }
  include("./disconnect.php");
  echo json_encode($response);
  ?>
