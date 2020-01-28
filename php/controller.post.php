<?php
require_once('../class.php/sql.class.php');

function consultaUsuario(){ //pesquisa se o usuario e senha existe

	require_once('../class.php/usuario.class.php');
	
	$nome = $_POST['nome'];
	$senha = $_POST['senha'];

	unset($_POST);
	
	$usuario = new Usuario($nome, $senha);
	$usuario->usuario();
}


function gravarDados(){
 
   require_once('../class.php/registro.class.php');
    
   $registro = new Registro($_POST['valor'], $_POST['data'], null, null, $_POST['subConta']);
   
   Sql::cadastrar($registro);
   
   header('Location: main.php');
	
}

function editarDados(){
    
    require_once('../class.php/registro.class.php');
    
    $registro = new Registro($_POST['valor'], $_POST['data'], $_POST['id'], $_POST['pago']);
    
    Sql::editar($registro); 
    
    header('Location: main.php');
    
}

function inicioDespesasFixas(){
    
    require_once('../class.php/sql.class.php');
    
    $inicioDoMes = new Sql(); // 
    
    $inicioDoMes->comecoMes();//
    
    unset($_POST);
    
   header('Location: main.php');
    
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
		case "inicio_de_mes":
		    inicioDespesasFixas();
		    break;
		case "editar":
		    editarDados();
		    break;
		}
	}
	
?>