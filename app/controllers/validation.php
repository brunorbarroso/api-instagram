<?php
session_start();

include('config.php');
include('connection.php');

$login = $_POST['login']; 
$senha = md5($_POST['senha']); 
$hash  = $_GET['sid'];

$result = mysql_query("SELECT * FROM `users` WHERE `user` = '$login' AND `password`= '$senha'");

if( (mysql_num_rows($result) > 0) ) {
	$_SESSION['login'] = $login; 
 	$_SESSION['senha'] = $senha; 
 	header('location:'.$config['redirectURI'].'/index.php?sid='.$config['hash']);	
}else{
	unset ($_SESSION['login']); 
 	unset ($_SESSION['senha']); 
	header('location:'.$config['redirectURI'].'/login.php');
}

mysql_close($con);

?>