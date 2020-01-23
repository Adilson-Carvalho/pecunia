<?php

require ('conta.class.php');

class Registro
{
    private $valor;
    
    private $data;
    
    private $id;
    
    private $conta;
    
    public function __construct($valor = NULL, $data = NULL, $id = NULL)
    {
        $this->valor = $valor;
        $this->data = $data;
        $this->id = $id;
        $this->conta = Conta::class;      
    }
    
    public function getValor()
    {
        return $this->valor;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getConta()
    {
        return $this->conta;
    }
    
    public function __toString(){
        return $this->conta." - ".$this->id." - ".$this->valor." - ".$this->conta;
    }
}

