<?php
	
	session_start();
	unset($_SESSION['login']); 
 	unset($_SESSION['senha']);

	if( session_destroy() ){
		header('location:login.php'); 
	}