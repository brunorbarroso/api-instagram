<?php include('app/controllers/check_login.php'); ?>
<?php include('app/view/partials/head.php'); ?>
<?php include('app/view/partials/header.php'); ?>
<?php include('app/config.php'); ?>


<div class="container">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<div class="jumbotron">
		  <h1>Gerar Token</h1>
		  <p>Caso suas imagens não estejam atualizadas, favor, gerar novo token.</p>
		  <p><a href="https://instagram.com/oauth/authorize/?client_id=<?php echo $client_id; ?>&redirect_uri=<?php echo $redirect_uri; ?>&response_type=token" class="btn btn-danger btn-lg" id="gerar_token">Gerar</a></p>
		</div>
	  </div>
	</div>
</div>

<?php include('app/thema/footer.php'); ?>

<script type="text/javascript">
$(function(){
	if( window.location.hash ) {
		var hash = window.location.hash.split('=')
		if(hash)
		$.ajax({url:'app/api.php', method:'GET', data: {token:hash[1],action:'setToken'} })
	}
})
</script>