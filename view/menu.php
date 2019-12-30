<?php

echo "<table>";

error_reporting(0);

$con = new Sql();

$menu = $con->menu();

$array_conta = array_unique(array_column($menu, 'conta', 'id_conta'));

$id_menu = 1000;

foreach ($array_conta as $contas) {

    echo "<tr class='linha_tabela' onMouseOver='menuLateral($id_menu, 1) , menuLateral($id_menu-1, 2), menuLateral($id_menu+1, 2)' ><td>" . $contas . "</td></tr>";

    $id_menu += 1;
}

echo "</table>";

$top = 5;

for ($i = 1000; $i < $id_menu; $i ++) {

    $sub_menu_id_conta = key($array_conta);

    echo "<div id='$i' class='bt' style='display:none; position:absolute; left:107px; top:" . $top . "px'>"; 
    $top += 23;

    echo "<table>";

    foreach ($menu as $sub_menu) {

        if ($array_conta[$sub_menu_id_conta] == $sub_menu[conta]) {

            echo "<tr class='linha_tabela'><td onclick='menuDescricacao(" . $sub_menu[id_conta] . "," . "\"" . $sub_menu[sub_conta] . "\"" . ")''>" . $sub_menu[sub_conta] . "</td></tr>";
        }
    }

    next($array_conta);

    echo "</table>";
    echo "</div>";
}

?>					
