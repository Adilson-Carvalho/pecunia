
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Análise e Desenvolvimento de Sistemas – Programação Web</title>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.maskMoney.js"></script>
<script type="text/javascript" src="../js/javascript.js"></script>

<link rel="stylesheet" type="text/css" href="../css/estilo.css">

<?php require('../class.php/sql.class.php'); ?>


<?php
if (! (isset($_COOKIE['usuNome']))) { // verifica se cookie foi iniciado, se não pg erro
    header('Location: ../index.php?erro=1');
}

?>

	</head>

<body onload="onloadForm(); canvas();">
	
	<div class="container" style="height: 40">
		<h1 style="position: relative; left:70px">Pecunia</h1>
		<a> <img src="../img/carteira.jpg" width="50" height="50" style="position: relative; left:-100px"> <img
			class="icone_sair" src="" onclick="logoff()" width="20" height="20"
			style="position: absolute; top: 3%; left: 95%">

		</a>
	</div>

	<!-- div mais externa envolve a tabela e o grafico. -->
	<div class='container'
		style='height: auto; width: 46%; position: relative; float: left;'>

		<table>

			<tr class='linha_tabela' style='position: relative; top: 10px;'
				bgcolor='white'>
				<th colspan='8'>


					<form id="form_principal" method="post"
						action="controller.post.php">
						<div style='position: relative; top: 10px;'>
							<label>Cadastrar Movimentação</label> <input id="data"
								name="data" class="input_geral" type="date">

							<!-- Menu suspensso  -->

							<div class=" bt dropdown">
								<span id="span_descricao"> Descricacao </span> <input
									type="hidden" id="conta" name="conta"> <input type="hidden"
									id="subConta" name="subConta">


								<div class="dropdown-content bt">
			
                    <?php
                    include '../view/menu.php';
                    ?>	
       	
						</div>

							</div>

							<!-- Fim do Menu suspensso  -->


							<div style="display: inline">
								<input id="valor" data-thousands="" data-decimal=","
									name="valor" type="text" placeholder="R$ - Valor "> <input
									type="hidden" id="opcao" name="opcao" value="gravar"> <input
									type="hidden" id="id_editar" name="id_editar">
								<button id="bt_cadastrar" type="submit" class="bt">Cadastrar</button>
							</div>
						</div>
					</form>

				</th>
			
			
			<tr class='linha_tabela' style='position: relative; top: 10px;'
				bgcolor='white'>
				<th colspan='8'>
					<form id="form_pesquisa" method="post">
						<div style='position: relative; top: 10px;'>
							<label>Movimentação dos mês:</label> <select id="option_mes"
								name="mes">
								<option value='01'>Janeiro</option>
								<option value='02'>Fevereiro</option>
								<option value='03'>Março</option>
								<option value='04'>Abril</option>
								<option value='05'>Maio</option>
								<option value='06'>Junho</option>
								<option value='07'>Julho</option>
								<option value='08'>Agosto</option>
								<option value='09'>Setembro</option>
								<option value='10'>Outubro</option>
								<option value='11'>Novembro</option>
								<option value='12'>Dezembro</option>
							</select> <select id="option_ano" name="ano">
								<option value='2019'>2019</option>
								<option value='2020'>2020</option>
								<option value='2021'>2021</option>
							</select> <input type="hidden" id="opcao" name="opcao"
								value="pesquisar">
							<button id="bt_atualizar_pesquiza">Atualizar</button>
						</div>
					</form>
				</th>
			
			
			<tr class='linha_tabela' style='position: relative; top: 10px;'
				bgcolor='white'>
				<th>Data:</th>
				<th>Pago:</th>
				<th>Natureza:</th>
				<th>Conta:</th>
				<th>Sub Conta:</th>
				<th>Valor:</th>
				<th>Editar</th>
				<th>Excluir</th>

					<?php
    // carrega a pgprincipal com as movimentações do mês corrente

    if (isset($_POST['ano'])) { // verifica se o post foi carregado
        $data = $_POST['ano'] . "-" . $_POST['mes'];
        $mes = $_POST['mes'];
        $ano = $_POST['ano'];
    } else { // atribui data atual se o post for vazio
        $data = date('Y-m');
        $mes = date('m');
        $ano = date('Y');
    }

    echo "<script>optionDataHoraAtual($mes, $ano)</script>"; // option com a data do if retro

    $pesquisarDado = new Sql(NULL, $data);

    $resultado = $pesquisarDado->pesquisar();

    unset($_POST);

    $i = 0;
    $receita = 0;
    $despesa = 0;
    foreach ($resultado as $value) {
        $cor = (($i % 2 == 0) ? "#F2FBEF" : "#DCDCDC"); // cria a tabela zebrada.
        $id_linha = $value["id_registro"];

        // Monta a tabela
        echo "<tr class='linha_tabela' style='position: relative; top:10px;' bgcolor='$cor'>";
        echo "<th id='$id_linha data_linha'>" . $value['data'] . "</th>" . "<th onclick='pago($id_linha)' style='cursor:pointer'>" . $value['pago'] . "</th>" . "<th>" . $value['natureza'] . "</th>" . "<th>" . $value['conta'] . "</th>" . "<th>" . $value['sub_conta'] . "</th>" . "<th id='$id_linha valor_linha'>" . "R$ " . number_format($value['valor'], 2, ',', '.') . "</th>" . // formata de float para moeda.

        "<th>" . "<a> <img id='$id_linha' class='icone_tabela' name='img_editar' src='../img/editar.jpg' onclick='editar($id_linha)' width='18' height='18' class='d-inline-block align-top'></a>" . "</th>" . "<th>" . "<a> <img id='$id_linha' class='icone_tabela' name='img_excluir' src='../img/excluir.jpg' onclick='excluir($id_linha)' width='18' height='18' class='d-inline-block align-top'></a>" . "</th>";
        ?>
			</tr>
								
	<?php

        $i ++;
        if ($value["natureza"] == "Receita") { // guarda separa as despesas e receitas em variáveis
            $receita += $value["valor"];
        } else {
            $despesa += $value["valor"];
        }
    } // fechamento do foreach
    ?>	
					
	</table>
	</div>

	<!-- tabela dos valorea do canvas, grafico -->
	<div class='container'
		style='position: relative; float: left; width: 47%; height: 100%;'>
		<table>
			<tr class='linha_tabela' style='position: relative; top: 10px;'>

	<?php
    $saldo = $receita - $despesa;

    echo "<th id='canvas_receita' style='background-color:#90EE90'>" 
    . "Receita R$ " . number_format($receita, 2, ',', '.') . "</th>" 
    . "<th id='canvas_despesa' style='background-color:#FF6347'>" . "Despesas R$ " . number_format($despesa, 2, ',', '.') 
    . "</th>" . "<th style='background-color:#00BFFF'>" . "Saldo R$ " . number_format($saldo, 2, ',', '.') . "</th>";
    ?>
				
		</table>

		<canvas id='canvas' width='428' height='300'></canvas>

	</div>



</body>
</html>