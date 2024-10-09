 <?php 

echo '<FORM METHOD="POST" ACTION="rescheck.php">Nombre<br>';
 $aDatos=array(1=>"Primero",2=>"Segundo",3=>"Tercero"); 
 foreach($aDatos as $id=>$nombre) { 
 echo "<input type='checkbox' name='seleccion[]' value='$id' />$nombre <br />"; 
 } 


 ?>

</form>
<INPUT TYPE="SUBMIT" value="Actualizar">
