<?php
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `youth_club` ORDER BY `youth_date` ASC, `youth_time` ASC, `youth_end_time` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $startTimestamp=strtotime($row['youth_time']." ".$row['youth_date']);
    $endTimestamp=strtotime($row['youth_end_time']." ".$row['youth_date']);

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

	if ($row['youth_cancel']>0)
    {
      $status="Отменено";
    }

    if ($shouldDisplay>0)
    {
      $response['youth'][]=array
      (
        'id'=>$row['youth_id'],
        'date'=>implode("-",array_reverse(explode("-",$row['youth_date']))),
        'place'=>iconv("cp1251","utf-8",$row['youth_place']),
        'status'=>$status,
        'time'=>iconv("cp1251","utf-8",$row['youth_time']),
        'description'=>iconv("cp1251","utf-8",$row['youth_description']),
        'end_time'=>iconv("cp1251","utf-8",$row['youth_end_time'])
      );
    }
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
