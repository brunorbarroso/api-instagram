<?php

session_start();

include('config.php');

if ( !((!empty($_SESSION['login'])) && (!empty($_SESSION['senha'])) && ($config['hash']!==$_GET['sid'])) ) {
	if( ((empty($_SESSION['login'])) && (empty($_SESSION['senha']))) ) {
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location:'.$config['redirectURI'].'/login.php');
	}	
}

$logado = $_SESSION['login'];

?>
