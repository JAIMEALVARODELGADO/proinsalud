 <?php 

 $id_persona=1; // para este ejemplo, la persona a la cual le serán asignados los valores de "seleccion" 
 foreach($_POST['seleccion'] as $seleccion) { 
echo "seleccion: $seleccion15";
 
} 

$aLista=array_keys($_POST['seleccion']); 
  foreach($aLista as $iId) { 
   
 
  echo "$iId<br>"; 
 } 

$dos="mario"; 
echo $dos;


 ?>



<?php 

 //if(!empty($_POST['seleccion'])) { 
   
  $aLista=array_keys($_POST['seleccion']); 
  foreach($aLista as $iId) { 
   
  echo "dos";
  echo "$iId<br>"; 
 } 

 ?>
