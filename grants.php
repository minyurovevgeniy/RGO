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
		<title>Гранты</title>
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/grants.js"></script>
	</head>
	<body>
		<div id="header">
		<?include("./header.php"); ?>
		</div>
		<div id="content">
			<h1>Гранты</h1>
			<div id="timetable">
				<table>
					<tr><td>Пароль для удаления</td><td><input type="password" id="delete_password"></td></tr>
				</table>
				<div>Ввод гранта</div>
				<?//<iframe src="./addGrant.php"></iframe>?>

				<?php// Участие в грантовом конкурсе: например написать грантовый конкурс РГО 2020 года.?>

				<?php// : на рассмотрение, отклонен, поддержан.?>
				<hr>
				<input class="btn" type="button" id="refreshGrantsList" value="Обновить список грантов">
				<h3>Выбранный грант</h3>
				<div class="row">
					<div class="col-sm-11 col-md-11 col-sm-11 col-xs-11 choose">
						<select id="grants-list"></select>
					</div>
					<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 choose">
						<input class="btn" type="button" id="choose" value="Выбрать">
					</div>
				</div>

				<hr>
					<div id="grant-form" class="form">
							<div class="row">
								<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 title">Наименование</div>
								<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10 title">
									<input id="title" type="text" placeholder="Наименование" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 supervisor">Руководитель</div>
								<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10 supervisor">
									<input id="supervisor" type="text" placeholder="Руководитель">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 implementation-time">Сроки реализации</div>
								<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10 implementation-time">
									<input id="deadline" type="text" placeholder="Сроки реализации" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 annotation">Аннотация</div>
								<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10 annotation">
									<textarea cols="50" id="annotation"></textarea>
									<? //<input id="" type="text" placeholder="Аннотация проекта" value="">?>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 cost">Cтоимость</div>
								<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10 cost">
									<input id="cost" type="text" placeholder="Cтоимость" value="">
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 date">Статус</div>
								<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10 title">
									<select id="status"></select>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 date"></div>
								<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 add">
									<input class="btn" type="button" id="addGrantManually" value="Добавить">
								</div>
								<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 save">
									<input class="btn" type="button" id="saveGrantManually" value="Сохранить">
								</div>
								<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 delete">
									<input class="btn" type="button" id="delete" value="Удалить">
								</div>
							</div>
					</div>
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html>
