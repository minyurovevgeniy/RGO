<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	header("Content-Type: text/html; charset=utf-8");
?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="./css/bootstrap.min.css">
		<link type="text/css" rel="stylesheet" href="./css/common.css">
		<script type="text/javascript" src="./js/jquery.js"></script>
		<script type="text/javascript" src="./js/index.js"></script>
	</head>
	<body>
		<div id="header"></div>
		<div id="content">
		<h1>Загрузка фотографий</h1>
			<form action="./createPhoto_result.php" method="post" enctype="multipart/form-data">
				<table>
					<tr><td>Изображение</td><td><input type="file" name="photo" accept="image/jpeg"></td></tr>
					<tr><td>Комментарий</td><td><textarea rows="5" name="comment"></textarea></td></tr>
					<tr><td>Пароль для ввода</td><td><input type="password" name="input_password"></td></tr>
				</table>
				<input type="submit" value="Сохранить">
			</form>
		</div>
		<div id="footer"></div>
	</body>
</html>
