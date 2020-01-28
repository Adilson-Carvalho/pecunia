	

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
		option_ano.selectedIndex = (ano - 2019);
	} 

	function editar(id){
		
		var valor = document.getElementById(id+" valor_linha");
		
		var input = document.createElement('input');
		valor.appendChild(input);
		input.id = 'alterar_valor'+id;
		$(function() {$('#alterar_valor'+id).maskMoney({decimal:".",thousands:"" });})
		input.value = ((valor.innerHTML).substring(2,(valor.innerHTML).indexOf("<"))).replace(",",".");
		
		var data = document.getElementById(id+" data_linha");
		data.innerHTML = "";
		
		var calendario = document.createElement('input');
		data.appendChild(calendario).type = "date";	
		calendario.id = 'alterar_data'
			
		var celula = document.getElementById(id+" pago");
		celula.innerHTML = "";
		
		var select = document.getElementById("select_pago");
		celula.appendChild(select);
		select.style.display = "inline";
		console.log(select.value)
				
		var editar = document.getElementById(id+" editar");
		editar.class='icone_tabela';  
		editar.src='../img/salvar.png';

		editar.onclick= function (){
			document.getElementById('pago').value = select.value;
			document.getElementById('data').value = calendario.value;
			document.getElementById('valor').value = input.value;
			document.getElementById('opcao').value = "editar";
			document.getElementById('id_editar').value = id;
			
			var form = document.getElementById("form_principal");
			form.submit();
			
		}
	}
	

	function excluir(id){
		location.href = 'controller.get.php?id='+id+'&opcao=excluir'; // redireciona pg controller.get id
																	
	}

	function logoff(){
		location.href = 'controller.get.php?opcao=logoff' // redireciona pg de
															// logoff.php
	}
	
	$(function() {$('#valor').maskMoney({decimal:".",thousands:"" });})
	
	function canvas(){

		// recupera os valores das celulas retira as palavras e os cifrões e a virgula
		var receita = ((document.getElementById('canvas_receita').innerHTML).substring(10)).replace(".","");
		var despesa = (document.getElementById('canvas_despesa').innerHTML).substring(12).replace(".","");
		var receita = parseFloat(receita);
		var despesa =  parseFloat(despesa);

		var saldo = receita - despesa;

		var canvas = document.getElementById("canvas");
		      		
		    if (canvas.getContext) {
				var ctx = canvas.getContext("2d");

				var alturaReceita = -290;
				if(receita == 0){// cria uma referencia quando não há receita
					alturaReceita = 0;
					receita = 1;
				}

				ctx.fillStyle = "rgb(144,238,144)";
				ctx.fillRect (10, 300, 120, alturaReceita);

				ctx.fillStyle = "rgb(255, 99, 71)";
				ctx.fillRect (155, 300, 120, -((despesa/receita) * 290));//cria uma altura porcentage relativa a altura da receita

				ctx.fillStyle = "rgb(0, 191, 255)";
				ctx.fillRect (300, 300, 120, -((saldo/receita) * 290));// cria uma altura porcentagem realativa a altura da receita
																		
			}
	}
	
	
	function canvas_detalhada(arr){
		
		var canvas_det = document.getElementById("canvas_det");
			
		if (canvas_det.getContext) 
			var ctx_d = canvas_det.getContext("2d");
		
		var i = 0;
		var position = 5;
		
		for ( i = 0; i <= arr.length; i++){
			//números
			ctx_d.fillStyle = 'black';
			ctx_d.font = "15px Arial";
			ctx_d.fillText(i,position+canvas_det.width/(arr.length)/2.7,290);
			//barras
			ctx_d.fillStyle = "rgba("+Math.floor(Math.random() * 100)+","+Math.floor(Math.random() * 200)+","+Math.floor(Math.random() * 100)+" ,0.3)";	//último número é a transparencia		
			ctx_d.fillRect (position, 300, (canvas_det.width/(arr.length))-5, - arr[i]);
			
			position += (canvas_det.width/(arr.length));
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

	var menu = document.getElementById(menus);

		if(opcao == 1 && menu !== null){
		menu.style.display = "inline"; // altera o estilo para visível
		} 
		else if( opcao == 2 && menu !== null) {
		menu.style.display ="none"; // altera o estilo para visível
		}

}

function pago(id){
	
	location.href = 'controller.get.php?id='+id+'&opcao=pago ';
	
}