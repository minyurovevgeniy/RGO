<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");

	/*
	if ($_POST['input_password']!="MVS2Mv7SzojC1Ok")
	{
		die("Неверный пароль");
	}
	*/

	include("./php/connect.php");
	//include("./php/checkEvent.php");

	header("Content-Type: text/html; charset=utf-8");
	date_default_timezone_set('Asia/Yekaterinburg');
	require_once './php/PHPExcel/Classes/PHPExcel.php';
//	include("./php/loadData.php");

	$backUrl='<a href="loadGeneralFromFile.php">Попробуйте ещё раз</a><br>';

	$fileName=$_FILES['general_file']['tmp_name'];

	if ($_FILES['general_file']['size']<=0)
	{
		echo $backUrl;
		die("Файл пустой");
	}

	$objPHPExcel = PHPExcel_IOFactory::load($fileName);

	// Номер листа
	$worksheet=$_POST['worksheet_number']-1;
	$dateColumnNumber=$_POST["date_column_number"]-1;
	$timeColumnNumber=$_POST["time_column_number"]-1;
	$endTimeColumnNumber=$_POST["end_time_column_number"]-1;
	$placeColumnNumber=$_POST["place_column_number"]-1;
	$shouldEmpty=$_POST["shouldEmpty"];
	$descriptionColumnNumber=$_POST["description_column_number"]-1;

	$MIN_ROW=$_POST['min_row'];
	$MAX_ROW=$_POST['max_row'];

	if (mb_strtolower($shouldEmpty)=="да")
	{
		$stmt=$pdo->prepare("TRUNCATE `general_meeting_of_members`");
		$stmt->execute(array($event));
	}

	$sheet=$objPHPExcel->getSheet($worksheet);

	$nonDigitPattern='/\D/i';

	for($rowNumber=$MIN_ROW;$rowNumber<=$MAX_ROW;$rowNumber++)
	{
		$rowNumberReport="<br>Ошибка в строке №".$rowNumber.'<br>';

		$date=$sheet->getCellByColumnAndRow($dateColumnNumber, $rowNumber)->getValue();

		$description = $sheet->getCellByColumnAndRow($descriptionColumnNumber, $rowNumber)->getValue();
		$fullDescription = preg_replace('/\s{1,}/i','',$description);
		
		if (mb_strlen($fullDescription)<1)
		{
			echo $rowNumberReport;
			echo $backUrl;
			die("Введите описание");
		}
		
		$dateDetailed=explode("_", $date);

		if (count($dateDetailed)!=3)
		{
			echo 'Дни, месяцы и годы должны быть разделены символом "_"<br>';
			echo $rowNumberReport;
			echo $backUrl;
			die("Ошибка");
		}
		else
		{
			$year=$dateDetailed[2];
			if (preg_match($nonDigitPattern,$year)>0 or (mb_strlen($year)>4) or (mb_strlen($year)<1))
			{
				echo 'Год '.$year.' должен содержать 4 цифры<br>';
				echo $rowNumberReport;
				echo $backUrl;
				die("Ошибка");
			}
			else
			{
				$month=$dateDetailed[1];
				if (preg_match($nonDigitPattern,$month)>0 or ($month>12) or ($month<1))
				{
					echo 'Месяц '.$month.' должен быть в диапазоне от 1 до 12 включительно и иметь ведущий 0 при необходимости<br>';
					echo $rowNumberReport;
					echo $backUrl;
					die("Ошибка");
				}
				else
				{
					$days=array(31,28,31,30,31,30,31,31,30,31,30,31);
					$day=$dateDetailed[0];
				  if ((($year % 4 == 0) && ($year % 100 != 0)) || ($year % 400 == 0))
					{
						$days[1]=29;
					}

					if (($day<1) or $day>$days[$month-1] or preg_match($nonDigitPattern,$day	)>0)
					{
						echo 'День месяца '.$day.' должен быть в диапазоне от 1 до '.$days[$month-1].' включительно<br>';
						echo $rowNumberReport;
						echo $backUrl;
						die("Ошибка");
					}
				}
			}
		}

		$dateToWrite=implode("-",array_reverse($dateDetailed));
		//echo $dateToWrite."<br>";

		//$weekday=iconv("utf-8","cp1251",mb_strtolower($sheet->getCellByColumnAndRow($weekdayColumnNumber, $rowNumber)->getValue()));

		//Convert the date string into a unix timestamp.
		$unixTimestamp = strtotime($dateToWrite);

		$startTime=$sheet->getCellByColumnAndRow($timeColumnNumber, $rowNumber)->getValue();

		$startTimeDetailed=explode("_",$startTime);

		if (count($startTimeDetailed)!=3)
		{
			echo 'Время '.$startTime.' должно быть записано в формате ЧЧ_ММ_СС<br>';
			echo $backUrl;
			echo $rowNumberReport;
			die("Ошибка");
		}

		$startTimeHour=$startTimeDetailed[0];
		$startTimeMinutes=$startTimeDetailed[1];
		$startTimeSeconds=$startTimeDetailed[2];

		if (preg_match($nonDigitPattern,$startTimeHour)>0 or ($startTimeHour>23) or ($startTimeHour<0))
		{
			echo 'Час начала '.$startTimeHour.' должен быть в диапазоне от 0 до 23 включительно<br>';
			echo $rowNumberReport;
			echo $backUrl;
			die("Ошибка");
		}
		else
		{
			if (preg_match($nonDigitPattern,$startTimeMinutes)>0 or ($startTimeMinutes>59) or ($startTimeMinutes<0))
			{
				echo 'Минуты начала '.$startTimeMinutes.' должны быть в диапазоне от 0 до 59 включительно<br>';
				echo $rowNumberReport;
				echo $backUrl;
				die("Ошибка");
			}
			else
			{
				if (preg_match($nonDigitPattern,$startTimeSeconds)>0 or ($startTimeSeconds>59) or ($startTimeSeconds<0))
				{
					echo 'Секунды начала '.$startTimeSeconds.' должны быть в диапазоне от 0 до 59 включительно<br>';
					echo $rowNumberReport;
					echo $backUrl;
					die("Ошибка");
				}
			}
		}

		$startTimeToWrite=implode(":",$startTimeDetailed);
		//echo $startTimeToWrite."<br>";

		$endTime=$sheet->getCellByColumnAndRow($endTimeColumnNumber, $rowNumber)->getValue();

		$endTimeDetailed=explode("_",$endTime);

		if (count($endTimeDetailed)!=3)
		{
			echo 'Время конца занятия '.$endTime.' должно быть записано в формате ЧЧ_ММ_СС<br>';
			echo $rowNumberReport;
			echo $backUrl;
			die("Ошибка");
		}

		$endTimeHour=$endTimeDetailed[0];
		$endTimeMinutes=$endTimeDetailed[1];
		$endTimeSeconds=$endTimeDetailed[2];

		if (preg_match($nonDigitPattern,$endTimeHour)>0 or ($endTimeHour>23) or ($endTimeHour<0))
		{
			echo 'Час конца занятия '.$endTimeHour.' должен быть в диапазоне от 0 до 23 включительно<br>';
			echo $rowNumberReport;
			echo $backUrl;
			die("Ошибка");
		}
		else
		{
			if (preg_match($nonDigitPattern,$endTimeMinutes)>0 or ($endTimeMinutes>59) or ($endTimeMinutes<0))
			{
				echo 'Минуты конца занятия '.$endTimeMinutes.' должен быть в диапазоне от 0 до 59 включительно <br>';
				echo $rowNumberReport;
				die("Ошибка");
			}
			else
			{
				if (preg_match($nonDigitPattern,$endTimeSeconds)>0 or ($endTimeSeconds>59) or ($endTimeSeconds<0))
				{
					echo 'Секунды окончания '.$endTimeSeconds.' должны быть в диапазоне от 0 до 59 включительно<br>';
					echo $rowNumberReport;
					echo $backUrl;
					die("Ошибка");
				}
			}
		}

		$endTimeToWrite=implode(":",$endTimeDetailed);
		//echo $endTimeToWrite."<br>";

		if($endTimeToWrite<=$startTimeToWrite)
		{
			echo 'Время конца занятия должно быть больше времени начала занятия';
			echo $rowNumberReport;
			echo $backUrl;
			die("Ошибка");
		}

		$place=iconv("utf-8","cp1251",$sheet->getCellByColumnAndRow($placeColumnNumber, $rowNumber)->getValue());
		$description=iconv("utf-8","cp1251",$sheet->getCellByColumnAndRow($descriptionColumnNumber, $rowNumber)->getValue());

		$stmt=$pdo->prepare("SELECT COUNT(*) FROM `general_meeting_of_members` WHERE `general_date`=? AND `general_time`=? AND `general_end_time`=? AND `general_description`=?");
		$stmt->execute(array($dateToWrite,$startTimeToWrite,$endTimeToWrite,$description));
		$row=$stmt->fetch(PDO::FETCH_LAZY);
		if ($row['COUNT(*)']<=0)
		{
			$stmt=$pdo->prepare("INSERT INTO `general_meeting_of_members` SET `general_date`=?, `general_time`=?, `general_end_time`=?,`general_place`=?, `general_description`=?");
			$stmt->execute(array($dateToWrite,$startTimeToWrite,$endTimeToWrite,$place,$description));
		}
	}

	include("./php/disconnect.php");
	echo 'Загрузка прошла успешно<br>';
	echo '<a href="./loadGeneralFromFile.php">Загрузить ещё события</a><br>';
?>
