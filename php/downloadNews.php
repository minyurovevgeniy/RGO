<?php
	session_start();
	include("./connect.php");
	include("./simple_html_dom.php");
	$source=new simple_html_dom();
	date_default_timezone_set('Asia/Yekaterinburg');
	$source=file_get_html('https://www.rgo.ru/ru/ekaterinburg/novosti');
	$news=$source->find('div.view-articles',0)->find('div.view-content',0)->find('div.views-row');

	$stmt=$pdo->prepare("TRUNCATE TABLE `news`");
	$stmt->execute();

	foreach($news as $value)
	{
		$newsDate=$value->find('div.views-field-field-event-datetime',0)->find('div.field-content',0)->plaintext;

		$newsDate=explode(" ",$newsDate);

		$monthInWord=$newsDate[1];
		$monthInDate=0;

		switch ($monthInWord)
		{
			case "января":
				$monthInDate=01;
				break;
			case "февраля":
				$monthInDate=02;
				break;
			case "март":
				$monthInDate=03;
				break;
			case "апреля":
				$monthInDate=04;
				break;
			case "мая":
				$monthInDate=05;
				break;
			case "июня":
				$monthInDate=06;
				break;
			case "июля":
				$monthInDate=07;
				break;
			case "августа":
				$monthInDate=08;
				break;
			case "сентября":
				$monthInDate=09;
				break;
			case "октября":
				$monthInDate=10;
				break;
			case "ноября":
				$monthInDate=11;
				break;
			case "декабря":
				$monthInDate=12;
				break;
		}

		$newsDate[1]=$monthInDate;
		$newsDate=implode("-",(array_reverse($newsDate)));

		$newsText=$value->find('div.views-field-body',0)->find('div.field-content',0)->find('p',0)->innertext;
		$newsHeading=$value->find('div.views-field-title',0)->find('span.field-content',0)->find('a',0)->innertext;

		$stmt=$pdo->prepare("INSERT INTO `news` SET `news_date`=?, `news_text`=?, `news_heading`=?");
		$stmt->execute(array($newsDate,iconv("utf-8","cp1251",$newsText),iconv("utf-8","cp1251",$newsHeading)));
	}

	echo json_encode(array("ok"=>"ok"));
?>
