<?php
	session_start();
	//if ($_SESSION['mdf843hrk52']<=0 or !isset($_SESSION['mdf843hrk52'])) die("OK");
	header("Content-Type: text/html; charset=utf-8");
?>
<html>
	<head>
		<link rel="stylesheet" type="type/css" href="./css/bootstrap.css">
		<link rel="stylesheet" type="type/css" href="./css/common.css">
		<script type="text/javascript" src="./js/jquery.js"></script>
	</head>
	<body>
		<div id="header"></div>
		<div id="content">
			<form action="./addGrant_result.php" method="post" enctype="multipart/form-data">
				<input type="file" name="grant_file"><br>
				<table>
					<tr>
						<td>Пароль для ввода</td><td><input type="password" name="input_password"></td>
					</tr>
				</table>
				<input type="submit" value="Загрузить" id="upload-grant">
			</form>
		</div>
		<div id="footer"></div>
	</body>
</html>