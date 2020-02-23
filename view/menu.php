<?php
require_once ('../class.php/conta.class.php');

echo "<div>";

error_reporting(0);

$menu = Query::menu();

$array_conta = array_unique(array_column($menu, 'conta', 'id_conta'));

$id_menu = 1000;
$top = 3;

foreach ($array_conta as $contas) {

    echo "<div class='linha_tabela' onMouseOver='menuLateral($id_menu, 1) , menuLateral($id_menu-1, 2), menuLateral($id_menu+1, 2)' >" . $contas . "</div>";

    $id_menu += 1;    
}

echo "</div>";




for ($i = 1000; $i < $id_menu; $i ++) {

    $sub_menu_id_conta = key($array_conta);

    echo "<div id='$i' class='bt' style='display:none; position:absolute; left:107px; top:" . $top . "px'>";
    $top += 18;

    foreach ($menu as $sub_menu) {

        if ($array_conta[$sub_menu_id_conta] == $sub_menu[conta]) {
           
            echo "<div class='linha_tabela' style='white-space:nowrap' onclick='menuDescricacao(" . $sub_menu_id_conta . "," . "\"" . $sub_menu[sub_conta] . "\"" . ")''>" . $sub_menu[sub_conta] . "</div>";
        }
    }

    next($array_conta);


    echo "</div>";
}



?>					