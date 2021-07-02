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
		<link type="text/css" rel="stylesheet" href="./css/council.css">
		<title>Расписание Совета областного отделения РГО</title>
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/council.js"></script>
	</head>
	<body>
		<div id="header">
		<?include("./header.php"); ?>
		</div>
		<div id="content">
			<h1>Расписание Совета областного отделения РГО</h1>
			<iframe src="./loadCouncilFromFile.php"></iframe>
			<div id="timetable">
				<table>
					<tr><td>Пароль для ввода</td><td><input type="password" id="add_password"></td></tr>
					<tr><td>Пароль для изменения</td><td><input type="password" id="save_password"></td></tr>
					<tr><td>Пароль для удаления</td><td><input type="password" id="delete_password"></td></tr>
				</table>
				<div>
					<input class="btn" type="button" id="refreshCouncilsList" value="Обновить список событий">
					<h3>Выбранное заседание</h3>
					<div class="row">
						<div class="col-sm-11 col-md-11 col-sm-11 col-xs-11 choose">
							<b><select id="council-list"></select></b>
						</div>
						<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 choose">
							<input class="btn" type="button" id="choose" value="Выбрать">
						</div>
					</div>
				</div>
				<div>Ввод заседания</div>
				<div>
					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Дата</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="council-date" type="text" placeholder="Дата" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Время начала</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="council-time" type="text" placeholder="Время начала" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Время окончания</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="end-time" type="text" placeholder="Время окончания" value="">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Повестка дня</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="agenda" type="text" placeholder="Повестка дня" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Место</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="place" type="text" placeholder="Место" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Ответственный</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="responsible" type="text" placeholder="Ответственный" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Описание</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="description" type="text" placeholder="Описание" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Анонс</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="announcement" type="text" placeholder="Анонс" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 date"></div>
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 add">
							<input class="btn" type="button" id="addCouncilManually" value="Добавить">
						</div>
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 save">
							<input class="btn" type="button" id="saveCouncilManually" value="Сохранить">
						</div>
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 delete">
							<input class="btn" type="button" id="deleteCouncil" value="Удалить">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html>
