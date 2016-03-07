<?php include('app/controllers/verify.php'); ?>
<?php include('app/view/partials/head.php'); ?>
<?php include('app/view/partials/header.php'); ?>
<?php include('app/controllers/library.php'); ?>
<?php include('app/controllers/config.php'); ?>
<?php include('app/controllers/connection.php'); ?>

	<?php

		$insta = new API_Instagram();
		if(isset($_GET['hashtag'])){
			$insta->GetPhotosByTag($_GET['hashtag']);
		}
		$images = $insta->GetImages();

	?>

<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<strong>Lista com todas as imagens da hashtag informada</strong>
	  </div>
	  <div class="panel-body">
	  	<div class="input-group">
	  		<input type="text" class="form-control" id="hashtag" placeholder="#diariodonordeste">
	  		<span class="input-group-btn">
	  			<button class="btn btn-primary" type="button" id="updateImages">Atualizar!</button>
	  		</span>
	  	</div>
	  </div>
	  <table class="table">
    		<th>imagem</th>
    		<th>url</th>
	 		<th>ação</th>
	 		<?php $insta->Embed( $images ); ?>
		</table>
	</div>
</div>
<?php include('app/view/partials/footer.php'); ?>

<script type="text/javascript">
$(function(){
	$('#updateImages').click(function(){
			if($('#hashtag').val()==''){
				alert('Informe uma hashtag')	
			}else{
				newHashtag($('#hashtag').val())
			}
			
		})

		function newHashtag(tag){
			$.ajax({
				url:"https://api.instagram.com/v1/tags/"+tag+"/media/recent?access_token=<?php echo $insta->GetToken(); ?>",
		        method: 'GET',
		        dataType: 'jsonp',
		        jsonp: 'callback',
		        crossDomain: true,
		        jsonpCallback: 'jsonpcallback',
		        success: function(response){
		        	saveImages(response);
		        }
			})
		}

		function saveImages(dados){
			$.post('app/library/api.php', dados);
		}

		$('.status').click(function(){
			$.ajax({
				url:'app/library/api.php',
				method:'get', 
				data:{id:$(this).data('id'),status:$(this).data('status'), action:'updateStatus'},
				success: function(){
					alert('Alterado com sucesso!');
				}})
		})
})
</script>