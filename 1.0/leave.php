<?php
	session_start();
	$_SESSION['loginCode']='';
	header('location:index.php');
	exit;
?>