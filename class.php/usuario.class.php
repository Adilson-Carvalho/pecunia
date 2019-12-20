<?php

require ('conexao.class.php');

class Usuario{
	private $sql;
	private $id;
	private $nome;
	private $senha;


	function __construct($nome, $senha){
		$this->sql = new Conexao();
		$this->nome = $nome;
		$this->senha = $senha;
	}

	public function usuario(){ 
			
			$statement = $this->sql->conectar()->prepare("SELECT * FROM `tb_usuarios` WHERE nome_usuario = :nome AND senha_usuario = :senha"); //query usuário e senha

			$nome = $this->nome;
			$senha = $this->senha;
		
			$statement->bindParam(":nome", $nome);
			$statement->bindParam(":senha", $senha);
			$statement->execute();

			$resultado = $statement->fetch(PDO::FETCH_ASSOC);

			unset($_POST);

			if (isset( $resultado['nome_usuario'])) { // query = true cria o cookie e redireciona p pgPrincipal
				setcookie('usuNome', $nome, time()+3600);
				header('Location: ../php/pgPrincipal.php');
			}else{
				header('Location: ../index.php?erro=1');// query = false index com mensagem de erro
			}
			
		}
}

?>