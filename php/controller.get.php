<?php 

require_once ('../class.php/Query.class.php');

function excluirDados(){
    
	Query::excluir($_GET['id']);

	header('Location: main.php'); 
	
}

function contaPaga(){
   
    Query::contaPaga($_GET['id']);
      
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