<?php include('app/view/partials/head.php'); ?>
<?php include('app/config.php'); ?>

<div class="container">
	<form action="app/controllers/validation.php?token=<?php echo $hash; ?>" method="post" accept-charset="utf-8" class="form-signin" role="form">
	<center><h2 class="form-signin-heading">Admin - API Instagram</h2></center>
    <input type="text" size="20" id="usuario" name="login" class="form-control" placeholder="Informe o usuário" required="" autofocus="">
	<input type="password" size="20" id="senha" name="senha" class="form-control" placeholder="Informe a senha" required="">
 	<input type="submit" value="Entrar" class="btn btn-lg btn-primary btn-block">
 	 	<br>
 	<center>
</form>
</div>
<?php include('app/view/partials/footer.php'); ?>