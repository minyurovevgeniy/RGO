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
		<link type="text/css" rel="stylesheet" href="./css/book.css">
		<title>Издания</title>
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/books.js"></script>
	</head>
	<body>
		<div id="header">
		<?include("./header.php"); ?>
		</div>
		<div id="content">
			<h1>Издания</h1>
			<?//<iframe src="./loadBookFromFile.php"></iframe>?>
			<div id="timetable">
				<table>
					<tr><td>Пароль для ввода</td><td><input type="password" id="add_password"></td></tr>
					<tr><td>Пароль для изменения</td><td><input type="password" id="save_password"></td></tr>
					<tr><td>Пароль для удаления</td><td><input type="password" id="delete_password"></td></tr>
				</table>
				<div>
					<input class="btn" type="button" id="refreshBooksList" value="Обновить список книг">
					<h3>Выбранная книга</h3>
					<div class="row">
						<div class="col-sm-11 col-md-11 col-sm-11 col-xs-11 choose">
							<b><select id="book-list"></select></b>
						</div>
						<div class="col-sm-1 col-md-1 col-sm-1 col-xs-1 choose">
							<input class="btn" type="button" id="choose" value="Выбрать">
						</div>
					</div>
				</div>
				<div>Ввод книги</div>
				<div>
					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Наименование</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="book-title" type="text" placeholder="Наименование" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Автор(ы)</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="book-authors" type="text" placeholder="Автор(ы)" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Соавторы</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="book-coauthors" type="text" placeholder="Соавторы" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Издательство</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="book-publisher" type="text" placeholder="Издательство" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Год издания</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="book-year" type="text" placeholder="Год издания" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Объем, страниц</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="book-volume" type="text" placeholder="Объем" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2">Ссылка</div>
						<div class="col-sm-10 col-md-10 col-sm-10 col-xs-10">
							<input id="book-url" type="text" placeholder="Ссылка" value="">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-2 col-md-2 col-sm-2 col-xs-2 date"></div>
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 add">
							<input class="btn" type="button" id="addBookManually" value="Добавить">
						</div>
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 save">
							<input class="btn" type="button" id="saveBookManually" value="Сохранить">
						</div>
						<div class="col-sm-3 col-md-3 col-sm-3 col-xs-3 delete">
							<input class="btn" type="button" id="deleteBook" value="Удалить">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="footer">
		</div>
	</body>
</html>
