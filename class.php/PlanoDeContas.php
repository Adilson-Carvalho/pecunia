<?php

class PlanoDeContas
{

    private $id_conta;

    private $classificacao;

    private $natureza;

    private $conta;

    private $sub_conta;
    
    public function __construct($id_conta = null, $classificacao = null, $natureza = null, $conta = null, $sub_conta = null){
        $this->id_conta = $id_conta;
        $this->classificacao = $classificacao;
        $this->natureza = $natureza;
        $this->conta = $conta;
        $this->sub_conta = $sub_conta;
    }

    public function getId_conta()
    {
        return $this->id_conta;
    }

    public function getClassificacao()
    {
        return $this->classificacao;
    }

    public function getNatureza()
    {
        return $this->natureza;
    }

    public function getConta()
    {
        return $this->conta;
    }

    public function getSub_conta()
    {
        return $this->sub_conta;
    }
    
    public function __toString($opcao){
        if($opcao == "menu"){
            return "<tr class='linha_tabela' onMouseOver='menuLateral($id_menu, 1) , menuLateral($id_menu-1, 2), menuLateral($id_menu+1, 2)' ><td>" . $this->conta . "</td></tr>";
        }
        elseif ($opcao == "sub_Menu"){
            return "<tr class='linha_tabela'><td onclick='menuDescricacao(" .  $this->id_conta . "," . "\"" .  $this->sub_conta. "\"" . ")''>" .  $this->sub_conta . "</td></tr>";
    }
}
}
