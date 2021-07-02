<?php
	session_start();
	//if ($_SESSION['mdf842hrk52']<=0 or !isset($_SESSION['mdf842hrk52'])) die("OK");
	header("Content-Type: text/html; charset=utf-8");
	date_default_timezone_set('Asia/Yekaterinburg');
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="./css/common.css">
		<link type="text/css" rel="stylesheet" href="./css/events.css">
		<title>Новости</title>
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/news.js"></script>
	</head>
	<body>
		<div id="header"><?include("./header.php"); ?></div>
		<div id="content">
			<h1>Новости</h1>
			<div id="timetable">
				<table>
					<tr><td>Пароль для удаления</td><td><input type="password" id="delete_password"></td></tr>
				</table>
				<div>Ввод новости</div>
				<hr>
				<input class="btn" type="button" id="refreshNewsList" value="Обновить список новостей">
				<input class="btn" type="button" id="downloadNews" value="Загрузить список новостей с сайта">

    </div>
		<div id="footer"></div>
	</body>
</html>
