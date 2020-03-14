<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>Análise e Desenvolvimento de Sistemas – Programação Web</title>
	
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	
 
<script type="text/javascript"  src="js/index.js"></script> 
	

</head>
<body>

		<div class="container">
				<a>
					<img src="img\carteira.jpg" width="90" height="90" class="d-inline-block align-top">
				</a>
				<h1>Pec&#250;nia</h1>
		</div>			
		
		<?php
			if (isset($_GET['erro']) AND $_GET['erro'] == 1) {
					echo "<h2 style='position:absolute; top:20%; left:45%'>Erro ao logar</h2>";
					unset($_GET);			
			} 
		?>

	<form class="container"  id="login" method="post"  style="position:absolute; top:30%; left:33%; padding: 2em;">
		<div>
			<div>
			<label style="display: inline-block;  width: 80px; text-align: right;">usuário:</label>
			<input type="text" class="input_geral" style="font: 1em sans-serif; width: 300px; -moz-box-sizing: border-box;box-sizing: border-box; border: 1px solid #999;">
			</div>
			<div style=" margin-top: 1em;">
			<label style="display: inline-block;  width: 80px; text-align: right;">senha:</label>
			<input type="password"  class="input_geral" style="font: 1em sans-serif; width: 300px; -moz-box-sizing: border-box;box-sizing: border-box; border: 1px solid #999;">
			</div>
			<div>
			
				<button type="submit" class="bt" style="position: relative; top: 8px; left: 150px; background-color: MintCream;">ENTRAR</button>
			</div>
		</div>
	</form>

</body>
</html>