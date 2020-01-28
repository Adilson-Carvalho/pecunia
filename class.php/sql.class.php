<?php
require_once ('conexao.class.php');

class Sql
{

    private $valor;

    private $data;

    private $id_conta;

    private $sql;

    public function __construct($valor = NULL, $data = NULL, $id_conta = NULL)
    {
        $this->valor = $valor;
        $this->data = $data;
        $this->id_conta = $id_conta;
        $this->sql = new Conexao();
    }

    public static function cadastrar($registro)
    {
        $conexao = new Conexao();
        $resultado = $conexao->conectar()->prepare("INSERT INTO `tb_movimentacoes` (id_registro, fk_conta, valor, data) VALUES (NULL, :id_conta, :valor, :data);");
       
        $valor =  $registro->getValor();
        $data =  $registro->getData();
        $fk = $registro->getId_conta();
          
        $resultado->bindParam(":id_conta", $fk);
        $resultado->bindParam(":valor", $valor);
        $resultado->bindParam(":data", $data);
        
        $resultado->execute();
    }

    public static function editar($registro)
    {
        $conexao = new Conexao();
       
        $resultado = $conexao->conectar()->prepare("UPDATE `tb_movimentacoes` SET `pago` = :pago, `valor` = :valor, `data` = :data WHERE `tb_movimentacoes`.`id_registro` = :id;"); 

        $pago = $registro->getPago();
        $valor = $registro->getValor();
        $data = $registro->getData();
        $id = $registro->getId();
        
        $resultado->bindParam(":pago", $pago);
        $resultado->bindParam(":id", $id);
        $resultado->bindParam(":valor", $valor);
        $resultado->bindParam(":data", $data);

       $resultado->execute();      
    }

    public function pesquisar()
    {
        $statement = $this->sql->conectar()->prepare("SELECT tb_movimentacoes.id_registro, tb_movimentacoes.data, tb_movimentacoes.pago, tb_plano_de_contas.natureza, tb_plano_de_contas.conta, tb_plano_de_contas.sub_conta,tb_movimentacoes.valor 
                FROM tb_movimentacoes, tb_plano_de_contas WHERE tb_movimentacoes.fk_conta = tb_plano_de_contas.id_conta
                    AND tb_movimentacoes.data BETWEEN :dataInicial AND :dataFinal;");

        $dataInicial = $this->data . "-01";
        $dataFinal = $this->data . "-31";

        $statement->bindParam(':dataInicial', $dataInicial);
        $statement->bindParam(':dataFinal', $dataFinal);

        $statement->execute();

        $resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function excluir($id)
    {
        $excluir = $this->sql->conectar()->prepare("DELETE FROM `tb_movimentacoes` WHERE `tb_movimentacoes`.`id_registro` = :id");

        $excluir->bindParam(":id", $id);
        $excluir->execute();
    }

    public function menu()
    {
        $menu = $this->sql->conectar()->prepare("SELECT * FROM `tb_plano_de_contas` ");

        $menu->execute();

        $resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }

    public function contaPaga()
    {
      
        $pago = $this->sql->conectar()->prepare("UPDATE `tb_movimentacoes` SET `data` = CURRENT_DATE, `pago` = 'sim' WHERE `tb_movimentacoes`.`id_registro` = :id;");
        
        $pago->bindParam(":id", $this->id_conta);
        $pago->execute();
    }

    public function comecoMes()
    {
        $inicio = $this->sql->conectar()->prepare("INSERT INTO tb_movimentacoes (fk_conta, data) SELECT tb_plano_de_contas.id_conta, CURRENT_DATE FROM tb_plano_de_contas WHERE tb_plano_de_contas.classificacao = 'fixo';");
        $inicio->execute();
    }
    
    public function __toString(){
        return "ID = ".$this->id_conta." - DATA = ".$this->data." - VALOR = ".$this->valor;
    }
    
}

?>