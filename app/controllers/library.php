<?php

include 'connection.php';

Class API_Instagram {

	function GetPhotosByTag( $TAG ){
		return self::RequestCURL('https://api.instagram.com/v1/tags/'.$TAG.'/media/recent?access_token='.self::GetToken());
	}
	
	function RequestCURL( $URL ){ ?>

		<script type='text/javascript'>
				$(function(){
					$.ajax({
						url:'<?php echo $URL; ?>',
				        method: 'GET',
				        dataType: 'jsonp',
				        jsonp: 'callback',
				        crossDomain: true,
				        jsonpCallback: 'jsonpcallback',
				        success: function(response){
				        	request(response);
				        }
					})

					function request(dados){
						$.post('app/library/api.php', dados);
					}

				})
		</script>
	<?php }

	function SetImages( $LIST ){
		
		$response = array();
		
		mysql_query('delete from images;');

		$sql = "INSERT INTO `api_instagram`.`images` (`url`,`status`) VALUES ";
		
		foreach ($LIST as $image ) {
			if(isset($image['images']['standard_resolution']['url'])){
				$sql .= "('".$image['images']['standard_resolution']['url']."',1),";	
			}
		}

		$size = strlen($sql);
		$sql = substr($sql,0, $size-1);
		$sql .= ';';
		
		mysql_query($sql);
	}

	function GetImages( $json = false, $status = false, $hash = false ){
		$response = array();
		$sql = '';
		if( $status=='inativo' ){
			$sql = 'select * from images where status = 0;';	
		}else if( $status == 'ativo' ){
			$sql = 'select * from images where status = 1;';
		}else{
			$sql = 'select * from images;';
		}
		
		$result = mysql_query($sql);
		
		while($row = mysql_fetch_array($result))
		{
		    array_push( $response, array( 'id'=>$row['idimages'], 'url'=>$row['url'], 'status'=>$row['status'] ) );
		} 
		if($json){
			return json_encode($response);
		}else{
			return $response;
		}
		
	}

	function Embed( $data ){
		if (count($data)>0) {
			foreach ( $data as $item ) {
				if(!empty($item['url'])){
					echo '<tr>
						<td><img src="'.$item['url'].'" width="50"></td>
						<td><a href="'.$item['url'].'" target="_blank" class="btn btn-primary">Abrir da imagem</a></td>
						<td><span class="label label-'.(($item['status']==0)?'danger':'success').'">'.(($item['status']==0)?'Inativo':'Ativo').'</span></td>
			 			<td>
			 				<div class="btn-group">
			 					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Opções 
			 						<span class="caret"></span>
			 					</button>
			 						<ul class="dropdown-menu">
			 							<li><a href="#ativar" class="status" data-status="1" data-id="'.$item['id'].'">Ativar</a></li>
			 							<li><a href="#inativar" class="status" data-status="0" data-id="'.$item['id'].'">Inativar</a></li>
			 						</ul>
			 				</div>
			 			</td></tr>';
				}
 			}
		}else{
			echo '<tr>
					<td colspan="2">Nenhum item encontrado. Favor, insira uma hashtag e atualize!</td>
				  </tr>';
		}	
	}

	function SetToken( $token ){
		$fp = fopen( '/var/www/hotsite.diariodonordeste.com.br/especiais/instagram/app/files/token.json', 'w');
		fwrite($fp, json_encode( array( 'access_token'=> $token ) ));
		fclose($fp);
	}

	function GetToken(){
		$token_json = json_decode(file_get_contents( 'app/files/token.json' ));
		return $token_json->access_token;
	}

	function redirect( $url ){
		header('location:'.$config['redirectURI'].'/'.$url);
	}

	function UpdateImage( $id, $status ){
		$result = mysql_query('update images set status = '.$status.' where idimages = '.$id.';');
	}
}