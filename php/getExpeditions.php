<?php
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `expeditions` ORDER BY `expedition_date` ASC, `expedition_time` ASC, `expedition_end_time` ASC");
  $stmt->execute();


  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $startTimestamp=strtotime($row['expedition_time']." ".$row['expedition_date']);

	   $endTimestamp=strtotime($row['expedition_end_time']." ".$row['expedition_date']);
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

	if ($row['expedition_cancel']>0)
    {
      $status="Отменено";
    }

    //if ($shouldDisplay>0)
    //{
      $response['expeditions'][]=array
      (
        'id'=>$row['expedition_id'],
        'date'=>implode("-",array_reverse(explode("-",$row['expedition_date']))),
        'time'=>iconv("cp1251","utf-8",$row['expedition_time']),
        'end_time'=>iconv("cp1251","utf-8",$row['expedition_end_time']),
        'status'=>$status,
        'place'=>iconv("cp1251","utf-8",$row['expedition_place']),
        'description'=>iconv("cp1251","utf-8",$row['expedition_description']),
        'announcement'=>iconv("cp1251","utf-8",$row['expedition_announcement']),
        'responsible'=>iconv("cp1251","utf-8",$row['expedition_responsible'])

      );
    //}
  }
  include("./disconnect.php");
  echo json_encode($response);
  ?>
