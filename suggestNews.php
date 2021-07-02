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
		<script type="text/javascript" src="./js/suggestNews.js"></script>
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
				<h3>Выбранная новость</h3>
				<div class="row">
					<div class="col-sm-11 col-md-11 col-sm-11 col-xs-11 choose">
						<select id="news-list"></select>
					</div>
					<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 choose">
						<input class="btn" type="button" id="choose" value="Выбрать">
					</div>
				</div>

				<hr>
				<div>
          <div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Дата</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="news-date" type="text" placeholder="Дата" value="">
						</div>
					</div>

          <div class="row">
            <div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Заголовок</div>
            <div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
              <input id="text-heading" type="text" placeholder="Заголовок" value="">
            </div>
          </div>

          <div class="row">
            <div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Текст</div>
            <div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
              <textarea id="text-news"></textarea>
            </div>
          </div>

        </div>
			</div>
    </div>
		<div id="footer"></div>
	</body>
</html>
