<?php

echo "<div class='dropdown bt'>"
<span> Descricacao </span>
<input type="hidden" id="conta" name="conta">
<input type="hidden" id="subConta" name="subConta">

<div class="dropdown-content bt" >
<table>

<?php

error_reporting(0);

$con = new Sql();

$menu = $con->menu();

$id_menu = 50;


foreach ($menu as $result){
    
    $array[] = "";
    
    if (!in_array( $result[conta], $array)) {
        
        echo"<tr class='linha_tabela' onMouseOver='menuLateral($id_menu, 1), menuLateral($id_menu-1, 2), menuLateral($id_menu+1, 2)' ><td onclick='menuDescricacao('Ganhos')' >".$result[conta]."</td></tr>";
        
        $id_menu += 1;
        
        array_push($array, $result[conta]);
        
        
        
    }
    
};

?>
                                		
                                		
                                		</table>
                                		
                                		
                                		
                                		<?php
                                
                                		echo "<div style='display:none; position:absolute; left:112px; top:1px' id='50' class='bt'>";
                                		
                                		foreach ($menu as $teste){
                                		  
                                		   ?>
                                		   
                                		    <table>
                                		    <tbody>
                                		    
                                		  <?php
                                		    
                                		    if ($teste[conta] == "Ganhos") {
                                		        echo "<tr class='linha_tabela'><td>$teste[sub_conta]</td></tr>";
                                		    }
                                		    
                                		}
                                		
                                		
                                		
        								?>
        										 
        										</tbody>
        									</table>
        								</div>
        								
                                		<!-- <div style="display:none; position:absolute; left:112px; top:25px" id="51" class="bt">
        									<table >
        										<tbody>
        										<tr class="linha_tabela"><td>Lanche</td></tr>
        										<tr class="linha_tabela"><td>Mercado</td></tr>
        										</tbody>
        									</table>  
        								</div> -->
                                		
                                		
                                		
                					</div>
                					
                					
                				</div>
                				
                				
                				
                				?>