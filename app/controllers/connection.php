<?php

	include 'config.php';
	
	$con = mysql_connect( $config['host'], $config['user'], $config['pass'] ) or die ("Sem conexão com o servidor");
	$select = mysql_select_db( $config['database'], $con) or die("Sem acesso ao DB, Entre em contato com o Administrador, brunobinfo@gmail.com"); 