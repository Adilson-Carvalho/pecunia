<?php

function consultaUsuario(){ //pesquisa se o usuario e senha existe

	require('../class.php/usuario.class.php');
	
	$nome = $_POST['nome'];
	$senha = $_POST['senha'];

	unset($_POST);
	
	$usuario = new Usuario($nome, $senha);
	$usuario->usuario();
}


function gravarDados(){

	require('../class.php/sql.class.php');

	printf($_POST['descricao']);//apagar
	
	$cadastraDado = new Sql( $_POST['natureza'],  str_replace(',', '.', $_POST['valor']), $_POST['descricao'], $_POST['data'], $_POST['hora']);// str_replace substitui a virgula por ponto

	$cadastraDado->cadastrar();
	
	unset($_POST);

	header('Location: pgPrincipal.php');
	
}


function editarDados(){

	require('../class.php/sql.class.php');

	$cadastraDado = new Sql( $_POST['natureza'],  str_replace(',', '.', $_POST['valor']), $_POST['decricao'], $_POST['data'], $_POST['hora']); // str_replace substitui a virgula por ponto
	
	$cadastraDado->editar($_POST['id_editar']);//o id é passado por paremetro
	
	unset($_POST);

	header('Location: pgPrincipal.php');

}

if(isset($_POST)) {// verifica se existe o array
	$opcao = $_POST['opcao'];

	switch ($opcao) {
		case "usuario":
		    consultaUsuario();
		     break;
		case "gravar":
		    gravarDados();
		    break;
		case "editar":
		    editarDados();
		    break;
		}
	}
	
?>