<?php
	date_default_timezone_set('Asia/Yekaterinburg');
	include("./connect.php");

	$id=$_POST['id'];
	//$id=1;

	$stmt=$pdo->prepare("SELECT `photo_src` FROM `photos` WHERE `photo_id`=?");
	$stmt->execute(array($id));
	$row=$stmt->fetch(PDO::FETCH_LAZY);

	unlink(".".$row['photo_src']);

	$stmt=$pdo->prepare("DELETE FROM `photos` WHERE `photo_id`=?");
	$stmt->execute(array($id));

	echo json_encode(array("ok"=>"ok"));
?>
