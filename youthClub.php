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
		<title>Молодежный клуб РГО</title>
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/youthClub.js"></script>
	</head>
	<body>
		<div id="header">
		<?include("./header.php"); ?>
		</div>
		<div id="content">
			<h1>Молодежный клуб РГО</h1>
			<iframe src="./loadYouthFromFile.php"></iframe>
			<div id="timetable">
				<table>
					<tr><td>Пароль для ввода</td><td><input type="password" id="add_password"></td></tr>
					<tr><td>Пароль для изменения</td><td><input type="password" id="save_password"></td></tr>
					<tr><td>Пароль для удаления</td><td><input type="password" id="delete_password"></td></tr>
				</table>
				<div>Ввод события</div>
				<table>
					<tr><td>Дата			</td><td><input type="text" id="newDate"></td></tr>
					<tr><td>Время начала	</td><td><input type="text" id="newTime"></td></tr>
					<tr><td>Время окончания	</td><td><input type="text" id="newEndTime"></td></tr>
					<tr><td>Место			</td><td><input type="text" id="newPlace"></td></tr>
					<tr><td>Описание			 </td><td><textarea cols="20" rows="5" id="newDescription"></textarea></td></tr>
					<tr><td>				</td><td><input type="button" id="newYouth" value="Создать событие"></td></tr>
				</table>
				<div id="event-header">
					<input type="button" id="refreshYouth" value="Обновить список событий">
					<div class="row">
						<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 id">№</div>
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 date">Дата</div>
						<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 start_time">Время начала</div>
						<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 end_time">Время окончания</div>
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 description">Описание</div>
						<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 cancel">Отменить</div>
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 place">Место</div>
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Действия</div>
					</div>
				</div>
				<div id="youth-list"></div>
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html>
