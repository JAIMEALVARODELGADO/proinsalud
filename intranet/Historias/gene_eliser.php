<BODY > 
<?php 

//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 



if ($seleccion<>"")
	{

		$cont=0;
		foreach($_POST['seleccion'] as $seleccion) { 
		echo "Indices eliminados: $seleccion <br>"; //muestra los indices eliminados
		$cont=$cont+1;
                //Creamos la sentencia SQL y la ejecutamos
                $sSQL="Delete From areas_medic  Where cod_ar='$seleccion'";
                mysql_query($sSQL);




       } 


echo "<center><h4>Se eliminaron  $cont  horario(s)</h4></center>";

}
 




 ?>



