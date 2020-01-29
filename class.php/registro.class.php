<?php

require_once ('conta.class.php');

class Registro extends Conta
{
    private $valor;
    
    private $data;
    
    private $id;
    
    private $pago;
    
    public function __construct($valor = NULL, $data = NULL, $id = NULL, $pago = null, $id_conta = null, $classificacao = null, $natureza = null, $conta = null, $sub_conta = null)
    {
        $this->valor = $valor;
        $this->data = $data;
        $this->id = $id;
        $this->pago = $pago;
        parent::__construct($id_conta, $classificacao, $natureza, $conta, $sub_conta);     
    }
    
    public function getValor()
    {
        if($this->valor != NULL){
            return floatval (str_replace('.', '',substr($this->valor,0, -3))+substr(str_replace(',', '.', $this->valor), -3));
        }
        else {
            return 0;
        }
    }

    public function getData()
    {
        if ($this->data){
            return $this->data;
        }else {
            return date('yy-m-d');
        }
    }

    public function getId()
    {
        return $this->id;
    }
    public function getPago()
    {
        return $this->pago;
    }
    
    public function __toString(){
        return $this->id." - ".$this->data." - ".$this->valor." - ".$this->pago." - ".$this->getId_conta()." - ".$this->getNatureza()." - ".$this->getConta()." - ".$this->getSub_conta();
    }
}

