<BODY > 
<?php 

//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 



if ($todo=="*"){

echo "<b>Se eliminaron Todos los Horarios</b>";
$sSQL="Delete From horarios where Usado_horario=ncita_horario and Cmed_horario='$rut1a'  and Cserv_horario='$rut2a' and ((Fecha_horario>='$rut3a')and (Fecha_horario<='$rut4a'))";
mysql_query($sSQL);

}


if ($seleccion<>"")
	{

		$cont=0;
		foreach($_POST['seleccion'] as $seleccion) { 
		//echo "Indices eliminados: $seleccion <br>"; //muestra los indices eliminados
		$cont=$cont+1;
                //Creamos la sentencia SQL y la ejecutamos
                $sSQL="Delete From horarios Where ID_horario ='$seleccion'";
                mysql_query($sSQL);




       } 


echo "<center><h4>Se eliminaron  $cont  horario(s)</h4></center>";

}
 
if($todo<>"*" and $seleccion==""){

echo "<b>No se realizo ninguna Operacion</b>";
}



 ?>



