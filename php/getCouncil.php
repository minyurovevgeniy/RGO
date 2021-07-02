<?php
  date_default_timezone_set('Asia/Yekaterinburg');
  include("./connect.php");

  $stmt=$pdo->prepare("SELECT * FROM `council_of_regional_department` ORDER BY `council_date` ASC, `council_time` ASC, `council_end_time` ASC");
  $stmt->execute();

  $response=array();
  while($row=$stmt->fetch(PDO::FETCH_LAZY))
  {
    $startTimestamp=strtotime($row['council_time']." ".$row['council_date']);
    $endTimestamp=strtotime($row['council_end_time']." ".$row['council_date']);

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


    //if ($shouldDisplay>0)
    //{
      $response['council'][]=array
      (
        'id'=>$row['council_id'],
        'date'=>implode("-",array_reverse(explode("-",$row['council_date']))),
        'place'=>iconv("cp1251","utf-8",$row['council_place']),
        'time'=>iconv("cp1251","utf-8",$row['council_time']),
        'agenda'=>iconv("cp1251","utf-8",$row['council_agenda']),
        'status'=>$status,
        'description'=>iconv("cp1251","utf-8",$row['council_description']),
        'end_time'=>iconv("cp1251","utf-8",$row['council_end_time'])
      );
    //}
  }
  include("./disconnect.php");

  echo json_encode($response);
  ?>
