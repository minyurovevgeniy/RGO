<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	header("Content-Type: text/html; charset=utf8");
	date_default_timezone_set('Asia/Yekaterinburg');
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="./css/common.css">
		<link type="text/css" rel="stylesheet" href="./css/events.css">
		<title>Фотографии</title>
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/photo.js"></script>
	</head>
	<body>
		<div id="header">
		<?include("./header.php"); ?>
		</div>
		<div id="content">
			<h1>Фотографии</h1>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-sm-6 col-xs-6 date">
						<iframe src="./createPhoto.php"></iframe>
					</div>
					<div class="col-sm-6 col-md-6 col-sm-6 col-xs-6 date">
						<iframe src="./changePhoto.php"></iframe>
					</div>
				</div>
			<div id="timetable">
				<table>
					<tr><td>Пароль для ввода</td><td><input type="password" id="input_password"></td></tr>
					<tr><td>Пароль для изменения</td><td><input type="password" id="save_password"></td></tr>
					<tr><td>Пароль для удаления</td><td><input type="password" id="delete_password"></td></tr>
					<tr><td>Ручное обновление</td><td><input type="checkbox" id="manual_mode"></td></tr>
				</table>
				<div id="photos-header">
					<input type="button" id="refreshPhotos" value="Обновить список фотографий">
					<div class="row">
						<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 id">№</div>
						<div class="col-sm-4 col-md-4 col-sm-4 col-xs-4 date">Фото</div>
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 comment">Комментарий</div>
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3">Действия</div>
					</div>
				</div>
				<div id="photos-list">

				</div>
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html>
