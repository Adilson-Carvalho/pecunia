<?php
require ('../class.php/conta.class.php');

echo "<table>";

error_reporting(0);

$con = new Sql();

$menu = $con->menu();

$array_conta = array_unique(array_column($menu, 'conta', 'id_conta'));

$id_menu = 1000;

foreach ($array_conta as $contas) {

    $conta = new Conta($id_menu, null, null, $contas); // o id da classe conta é usado para colocar o id do menu e não da conta ... gamb

    echo $conta->__toString();

    $id_menu += 1;
}

echo "</table>";

$top = 5; // faz o sub menu aparecer em locais diferentes

for ($i = 1000; $i < $id_menu; $i ++) {

    $sub_menu_id_conta = key($array_conta);

    echo "<div id='$i' class='bt' style='display:none; position:absolute; left:107px; top:" . $top . "px'>";
    $top += 23;

    echo "<table>";

    foreach ($menu as $sub_menu) {

        if ($array_conta[$sub_menu_id_conta] == $sub_menu[conta]) {

            $teste = new Conta($sub_menu[id_conta], null, null, null, $sub_menu[sub_conta]);

            echo $teste->__toString();
        }
    }

    next($array_conta);

    echo "</table>";
    echo "</div>";
}

?>					
