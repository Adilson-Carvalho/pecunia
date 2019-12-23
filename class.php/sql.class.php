<?php

require ('conexao.class.php');
	
	class Sql{
		private $valor;
		private $data;
		private $id_conta;
		private $sql;

		public function __construct($valor = NULL, $data = NULL, $id_conta = NULL){  
			$this->valor =  $valor;
			$this->data = $data;
			$this->id_conta = $id_conta;
			$this->sql = new Conexao();
		} 


		public function cadastrar(){

			$resultado = $this->sql->conectar()->prepare("INSERT INTO `tb_movimentacoes` (id_registro, fk_conta, valor, data) VALUES (NULL, :id_conta, :valor, :data);");

			$id_conta_p = $this->id_conta;
			$valor_p = $this->valor;
			$data_p =  $this->data; 

			$resultado->bindParam(":id_conta", $id_conta_p);
			$resultado->bindParam(":valor", $valor_p);
			$resultado->bindParam(":data", $data_p);
			

			$resultado->execute();
				
				if($resultado){
					$retorno = true;
				} else{
					$retorno = false;
				}
	
			return $retorno; 
		}


		public function editar($id){//Edita a linha com o id passado por parametro

			$resultado = $this->sql->conectar()->prepare("UPDATE `tb_movimentacoes` SET natureza = :natureza, valor = :valor, descr_registro = :descricao, data = :data, hora = :hora WHERE id_registro = :id ;");

			$natureza_p = $this->natureza;
			$valor_p = $this->valor;
			$descricao_p = $this->descricao;
			$data_p =  $this->data; 
			$hora_p =  $this->hora;

			$resultado->bindParam(":id", $id);
			$resultado->bindParam(":natureza", $natureza_p);
			$resultado->bindParam(":valor", $valor_p);
			$resultado->bindParam(":descricao", $descricao_p);
			$resultado->bindParam(":data", $data_p);
			$resultado->bindParam(":hora", $hora_p);

			$resultado->execute();

		}


		public function pesquisar(){
			
		    $statement = $this->sql->conectar()->prepare("SELECT * FROM `tb_movimentacoes` WHERE data > ':dataInicial' ");//"SELECT * FROM `tb_movimentacoes` WHERE data BETWEEN ':dataInicial-01' AND ':dataInicial-31' ORDER BY id_registro desc");

			//$dataInicial = $this->data."-"."01";
			$dataInicial = $this->data."-%";
			
			$dataFinal = $this->data."-"."31";
			
			$statement->bindParam(":dataInicial", $dataInicial);
			$statement->bindParam(":dataFinal", $dataFinal);
			
			$statement->execute();

			$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
			
			return $resultado;

		}

		public function menu(){
		    
		   $menu = $this->sql->conectar()->prepare("SELECT * FROM `tb_plano_de_contas` ");
		   
		   $menu->execute();
		    
		   $resultado = $menu->fetchAll(PDO::FETCH_ASSOC);
		    
		   return $resultado;
		    
		}
		
		public function excluir($id){
			 $excluir = $this->sql->conectar()->prepare("DELETE FROM `tb_movimentacoes` WHERE `tb_movimentacoes`.`id_registro` = :id");

			$id = $id;
			$excluir->bindParam(":id", $id);
			$excluir->execute();


		}

	}

?>