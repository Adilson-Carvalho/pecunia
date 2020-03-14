onload = function onloadForm(){ // coloca dada e hora atual no form
		

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
		
		
		
		
		var fm = document.getElementById("form_pesquisa");
		
		var combobox = document.getElementById('cx_opcao');
		
		var options = combobox.getElementsByTagName("option");
		
		options[0].onclick = function atualiza(){
			document.getElementById('bt_opcao').innerHTML = 'Atualizar mês';
			fm.action="";}
		
		options[1].onclick = function inicio(){
			var hid = fm.getElementsByTagName("input");
			hid[0].value = "inicio_de_mes";
			fm.action="controller.post.php";
			document.getElementById('bt_opcao').innerHTML = 'Cadastrar mês'
			}
		
	} 

	function optionDataHoraAtual(mes, ano){ // carrega o comobox com a data
											// atual
								
		var optionMes = document.getElementById("option_mes");
		option_mes.selectedIndex = (mes -1);

		var optionAno = document.getElementById("option_ano");
		option_ano.selectedIndex = (ano - 2019);
	} 

	function editar(id){
			
		var valor = document.getElementById(id+" valor_linha");
		var temp = ((valor.innerText).substring(2,(valor.innerText).length)).replace(",",".");
		valor.innerText = '';
		
		var input = document.createElement('input');
		valor.appendChild(input);
		input.id = 'alterar_valor'+id;
		$(function() {$('#alterar_valor'+id).maskMoney({decimal:".",thousands:"" });})
		input.value = temp;
		// ((valor.innerHTML).substring(2,(valor.innerHTML).indexOf("<"))).replace(",",".");
			
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
	location.href = 'controller.get.php?id='+id+'&opcao=excluir'; 
																	
	}

	function logoff(){
		location.href = 'controller.get.php?opcao=logoff' // redireciona pg de
															// logoff.php
	}
	
$(function() {$('#valor').maskMoney({decimal:".",thousands:"" });})
		
function canvas_detalhada(canv, arr, title){
	try{
		
		var canvas = document.getElementById(canv);
		var alturaBarras = 345;
		canvas.height= alturaBarras + arr.length * 25;
		
		var maior = 0; //arr[0].reduce(function(x,y){return x>y?x:y});
		for (var y = 0; y <= (arr.length-1); y++){
			if (arr[y][0] > maior){
				maior = parseFloat(arr[y]);	
			}
		} 
		
		if (canvas.getContext){ 
			var graphic = canvas.getContext("2d");
		}
				
		var vertical = 5;
		var horizontal = 355;
		
			for (var i = 0; i <= (arr.length-1); i++){
			// números
			graphic.font = "15px Arial Black";
			graphic.fillStyle = "#000000";
			graphic.fillText(i,vertical+canvas.width/(arr.length)/2.7,318);		
			// barras
			graphic.fillStyle = "rgba("+Math.floor(Math.random() * 100)+","+Math.floor(Math.random() * 200)+","+Math.floor(Math.random() * 100)+" ,0.3)";	// último número é a transparência																																																																		// transparencia
			graphic.fillRect (vertical, 320, (canvas.width/(arr.length))-5, -arr[i][0]/maior*290 ); //proporção em relação a altura		
			vertical += (canvas.width/(arr.length));
			//legenda		
			graphic.font = "18px Arial";
			graphic.fillStyle = "#000000";
			graphic.fillText(i+" - "+arr[i][1]+ " = " + "R$ "+ arr[i][0].toFixed(2),10, horizontal);
			horizontal += 25;
			}	
			
			for(var z = 0; z< alturaBarras-20; z += 20){
				//grade
				graphic.moveTo(0,z);
				graphic.lineTo(canvas.width, z);			
			}		
			graphic.strokeStyle = 'rgba(139, 69, 19, 0.3)';
			graphic.stroke();
			
			//título
			graphic.font = "18px Arial Black";
			graphic.fillStyle = "#000000";
			graphic.textAlign = "center";
			graphic.fillText(title, canvas.width/2, 20);
		
		}
		
		catch(e){
			console.log(e);
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
