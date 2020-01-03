<?php 

function excluirDados(){

	require('../class.php/sql.class.php');

	$id = $_GET['id'];//pega a ide da lina a ser excluida

	$sql = new Sql( NULL, NULL,NULL,NULL,NULL);
	$sql->excluir($id);

	header('Location: pgPrincipal.php'); 
	
}

function contaPaga(){
    
    require('../class.php/sql.class.php');
    
    $id = $_GET['id'];//pega a ide da lina a ser excluida
    
    $sql = new Sql( NULL, NULL,NULL,NULL,NULL);
    $sql->contaPaga($id);
    
    header('Location: pgPrincipal.php');
    
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