<?php
	session_start();
	
	$login=$_POST['login'];
	$password=$_POST['password'];
	
	if ($login=="uspu" and $password=="uspu")
	{
		$_SESSION['mdf843hrk52']=3423423654;
	}
	else
	{
		die("OK");
	}
?>