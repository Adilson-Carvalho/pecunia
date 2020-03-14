onload = function (){
	
	var formLogin = document.getElementById('login');
	formLogin.action = '\php\\controller.post.php';
	
	var hidden = document.createElement("input");
	formLogin.appendChild(hidden);
	
	hidden.type = "hidden";
	hidden.name = "opcao";
	hidden.value="usuario";
			
	var inputs = document.getElementsByTagName('input');
	inputs[0].name = "nome";
	inputs[1].name = "senha";
		
}