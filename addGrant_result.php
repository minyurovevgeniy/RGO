<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	header("Content-Type: text/html; charset=utf8");
	date_default_timezone_set('Asia/Yekaterinburg');
	
	$grantString="";
	$fileName=$_FILES['grant_file']['tmp_name'];
	$file = fopen($fileName, "r") or exit("Невозможно открыть файл");
	//Output a line of the file until the end is reached
	while(!feof($file))
	{
		$grantString.=fgets($file);
	}
	fclose($file);
	
	$grantString=iconv("utf-8","cp1251",$grantString);
	
	include("./php/connect.php");
	$stmt=$pdo->prepare("INSERT INTO `grants` SET `grant_description`=?");
	$stmt->execute(array($grantString));
	echo '<a href="./addGrant.php">Загрузить ещё гранты</a>'
?>