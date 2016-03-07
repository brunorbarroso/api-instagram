<?php

	// Including the library
	include('../controllers/library.php');
	// Instanced the object
	$API = new API_Instagram();
	// Verify request and calling the function specific
	if ( $_POST ) {
		$list = $_POST['data'];
		if( isset($list) ){
			$API->SetImages( $list );
		}
	}

	if( isset( $_GET['action'] ) ){
		switch ( $_GET['action'] ) {
			case 'all':
				print $API->GetImages(true,$_GET['status']);
				break;
			case 'setToken':
				$API->SetToken( $_GET['token'] );
				break;
			case 'updateImages':
				$API->GetPhotosByTag($_GET['hashtag']);
				break;
			case 'updateStatus':
				$API->UpdateImage($_GET['id'],$_GET['status']);
				break;
			default:
				print 'Recurso não existe.';
				break;	
		}
	}