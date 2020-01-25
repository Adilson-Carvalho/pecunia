<?php 

function excluirDados(){

	require('../class.php/sql.class.php');

	$id = $_GET['id'];//pega a ide da lina a ser excluida

	$sql = new Sql();
	$sql->excluir($id);

	header('Location: main.php'); 
	
}

function contaPaga(){
    
    require('../class.php/sql.class.php');
    
    $id = $_GET['id'];//pega a ide da linha
    
    $sql = new Sql(null,null,$id);
    $sql->contaPaga();
    
    header('Location: main.php');
    
}

function logoff(){

	setcookie('usuNome', "", time()-3600); //destroi o cookie
	header('Location: ../index.php');// index
	
}



if(isset($_GET)) {// verifica se existe o array
	$opcao = $_GET['opcao'];

	switch ($opcao) {
		case "excluir":
		    excluirDados();
		     break;
		case "pago":
		    contaPaga();
		    break;
		case "logoff":
		    logoff();
		    break;
	}
}
	
?>