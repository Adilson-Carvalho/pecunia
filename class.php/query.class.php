<?php
require_once ('conexao.class.php');

class Query
{

  
    public static function cadastrar($registro)
    {
        $conexao = new Conexao();
        $resultado = $conexao->conectar()->prepare("INSERT INTO `tb_movimentacoes` (id_registro, fk_conta, valor, data, pago) VALUES (NULL, :id_conta, :valor, :data, 'sim');");
       
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

    public static function pesquisar($data)
    {
        $conexao = new Conexao();
        
        $pesquisa = $conexao->conectar()->prepare("SELECT tb_movimentacoes.id_registro, tb_movimentacoes.data, tb_movimentacoes.pago, tb_plano_de_contas.natureza, tb_plano_de_contas.conta, tb_plano_de_contas.sub_conta,tb_movimentacoes.valor 
                FROM tb_movimentacoes, tb_plano_de_contas WHERE tb_movimentacoes.fk_conta = tb_plano_de_contas.id_conta
                    AND tb_movimentacoes.data BETWEEN :dataInicial AND :dataFinal;");

        $dataInicial = $data . "-01";
        $dataFinal = $data . "-31";

        $pesquisa->bindParam(':dataInicial', $dataInicial);
        $pesquisa->bindParam(':dataFinal', $dataFinal);

        $pesquisa->execute();

        $resultado = $pesquisa->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }

    public static function excluir($id)
    {
        $conexao = new Conexao();   
        $excluir = $conexao->conectar()->prepare("DELETE FROM `tb_movimentacoes` WHERE `tb_movimentacoes`.`id_registro` = :id");

        $excluir->bindParam(":id", $id);
        $excluir->execute();
    }

    public static function menu()
    {
        $conexao = new Conexao();
        $menu = $conexao->conectar()->prepare("SELECT * FROM `tb_plano_de_contas` ");

        $menu->execute();

        $resultado = $menu->fetchAll(PDO::FETCH_ASSOC);

        return $resultado;
    }

    public static function contaPaga($id)
    {
        $conexao = new Conexao();
        $pago = $conexao->conectar()->prepare("UPDATE `tb_movimentacoes` SET `data` = CURRENT_DATE, `pago` = 'sim' WHERE `tb_movimentacoes`.`id_registro` = :id;");
        
        $pago->bindParam(":id", $id);
        $pago->execute();
    }

    public static function comecoMes()
    {
        $conexao = new Conexao();
        $inicio = $conexao->conectar()->prepare("INSERT INTO tb_movimentacoes (fk_conta, data) SELECT tb_plano_de_contas.id_conta, CURRENT_DATE FROM tb_plano_de_contas WHERE tb_plano_de_contas.classificacao = 'fixo';");
        $inicio->execute();
    }
    
}

?>