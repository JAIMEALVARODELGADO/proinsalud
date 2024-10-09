<HTML>
<HEAD>
<TITLE>Insertar.html</TITLE>
</HEAD>
<BODY>
<div align="center">
<h1>Insertar un registro</h1>
<br>
<FORM METHOD="POST" ACTION="rescheck.php">
Nombre<br>

 <?php 
$yx=0;
$xx=10;

while($yx<=$xx){

$valor=1;//recupera este
$nombre="mario";

// $aDatos=array(1=>"Primero",2=>"Segundo",3=>"Tercero"); 
 
$aDatos=array($valor=>$nombre); 
 foreach($aDatos as $id=>$nombre) { 
 echo "<input type='checkbox' name='seleccion[]' value='$id' />$nombre <br />"; 
 } 

$yx=$yx+1;

}
 ?>



<INPUT TYPE="TEXT" NAME="nombre"><br>
Teléfono<br>
<INPUT TYPE="TEXT" NAME="telefono"><br>
<INPUT TYPE="SUBMIT" value="Insertar">
</FORM>
</div>
</BODY>
</HTML> 