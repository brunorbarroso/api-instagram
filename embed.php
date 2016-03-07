<html>
<head>
	<title>Embed Instagram</title>
</head>
<body>
<div class="content">
<ul class="list"></ul>
<button class="see-more">see more</button>
</div>
</body>
<?php include('app/view/partials/footer.php'); ?>
</html>
<script type="text/javascript">
	$(function(){function n(n,t,c){for(s=o,i=o;i<c+o;i++)i<n.length&&l(t,n[i].url);o=s+c,c+=3}function t(){$.ajax({url:"http://hotsite.diariodonordeste.com.br/especiais/instagram/app/library/api.php?action=all&status=ativo",dataType:"json",success:function(i){u=i,c(i,a,o)}})}function c(n,t,c){for($(t).html(),i=0;i<c;i++)l(t,n[i].url)}function l(i,n){$(i).append('<li><img src="'+n+'"></li>')}t();var a="ul.list",o=5,u={},r=3,s=0;$(".see-more").click(function(){n(u,a,r)})});
</script>