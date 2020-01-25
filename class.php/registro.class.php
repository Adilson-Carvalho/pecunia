<?php

//require ('conta.class.php');

class Registro
{
    private $valor;
    
    private $data;
    
    private $id;
    
    private $pago;
    
 //   private $conta;
    
    public function __construct($valor = NULL, $data = NULL, $id = NULL, $pago = null)
    {
        $this->valor = $valor;
        $this->data = $data;
        $this->id = $id;
        $this->pago = $pago;
   //     $this->conta = Conta::class;      
    }
    
    public function getValor()
    {
        return str_replace(',', '.', $this->valor);
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

    public function getConta()
    {
        return $this->conta;
    }
    
    public function __toString(){
        return $this->conta." - ".$this->id." - ".$this->valor." - ".$this->conta;
    }
}

