	

	function onloadForm(){ // coloca dada e hora atual no form
		
		document.getElementById('opcao').value = 'gravar';
		
		var data = new Date;
		
		var mes = data.getMonth();
		mes = mes+1;
			
		document.getElementById('data').value = data.getFullYear()+"-"
			+mes.toString().padStart(2, '0')+
			"-"+data.getDate().toString().padStart(2, '0');// formata a data
															// dois digitos
		
		document.getElementById('valor').value = "";

		document.getElementById('bt_cadastrar').innerHTML = "Cadastrar";

	} 

	function optionDataHoraAtual(mes, ano){ // carrega o comobox com a data atual
											

		var optionMes = document.getElementById("option_mes");
		option_mes.selectedIndex = (mes -1);

		var optionAno = document.getElementById("option_ano");
		option_ano.text = ano;
	} 

	function editar(id){
		
		// input hidden
		var inputOpcao = document.getElementById('opcao');
		inputOpcao.value = 'editar'; // atribui a opção editra ao input
										// hidden opcao
		// input hidden
		var inputId = document.getElementById('id_editar');
		inputId.value = id; // atribui o valor do id ao input hidden id

		// carrega o form com o valor a ser editado
		var celulaHora = id+" hora_linha";
		document.getElementById('hora').value = document.getElementById(celulaHora).innerHTML.substring(0, 5);
		
		var celulaData = id+" data_linha";
		document.getElementById('data').value = document.getElementById(celulaData).innerHTML;

		var celulaDescricao = id+" descricao_linha";
		document.getElementById('descricao').value = document.getElementById(celulaDescricao).innerHTML;
		
		var celulaValor = id+" valor_linha";
		document.getElementById('valor').value =  document.getElementById(celulaValor).innerHTML.substring(3); // tira
																												// o
																												// R$.

		document.getElementById('bt_cadastrar').innerHTML = "Editar";
	
	}

	function excluir(id){
		location.href = 'controller.get.php?id='+id+'&opcao=excluir'; // redireciona
																		// pg
																		// controller.get
																		// com
																		// get
																		// da id
	}

	function logoff(){
		location.href = 'controller.get.php?opcao=logoff' // redireciona pg de
															// logoff.php
	}

	$(function() { // coloca a mascara de moeda no input valor.
				$('#valor').maskMoney();
	})

	function canvas(){

		// recupera os valores das celulas retira as palavras e os cifrões e a
		// virgula
		var receita = ((document.getElementById('canvas_receita').innerHTML).substring(10)).replace(".","");
		var despesa = (document.getElementById('canvas_despesa').innerHTML).substring(12).replace(".","");
		var receita = parseFloat(receita);
		var despesa =  parseFloat(despesa);

		var saldo = receita - despesa;

		var canvas = document.getElementById("canvas");
		      		
		    if (canvas.getContext) {
				var ctx = canvas.getContext("2d");

				var alturaReceita = -280;
				if(receita == 0){// cria uma referencia quando não há receita
					alturaReceita = 0;
					receita = 1;
				}

				ctx.fillStyle = "rgb(144,238,144)";
				ctx.fillRect (10, 300, 120, alturaReceita);

				ctx.fillStyle = "rgb(255, 99, 71)";
				ctx.fillRect (155, 300, 120, -((despesa/receita) * 280));//cria uma altura porcentage relativa a altura da receita

				ctx.fillStyle = "rgb(0, 191, 255)";
				ctx.fillRect (300, 300, 120, -((saldo/receita) * 280));/*
																		 * cria
																		 * uma
																		 * altura
																		 * porcentage
																		 * relativa
																		 * a
																		 * altura
																		 * da
																		 * receita
																		 */
			}
	}
	
function menuDescricacao(conta, sub_conta){
		
		// input hidden
		var inputOpcao = document.getElementById('subConta');
		inputOpcao.value = conta; // atribui a valor input hidden descricao
		
		document.getElementById('span_descricao').innerHTML = sub_conta;

}


function menuLateral(menus, opcao){
	
	// $teste.contentEditable = true; //torna editável
	// input hidden

	var menu = document.getElementById(menus);

		if(opcao == 1 && menu !== null){
		menu.style.display = "inline"; // altera o estilo para visível
		} 
		else if( opcao == 2 && menu !== null) {
		menu.style.display ="none"; // altera o estilo para visível
		}

}
