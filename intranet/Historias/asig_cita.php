<?
session_register('Gnombre');
session_register('Gidenti');
session_register('Gtipoafi');
session_register('Gestado');
session_register('Gcodi');
session_register('Gcontra');
session_register('Gcodmed');
session_register('Gfeini');
session_register('Gffini');
session_register('Garea');
session_register('Ghora');
session_register('Gtodos');
?> 

<BODY > 
<?php 

//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 


$cont=0;
foreach($_POST['seleccion'] as $seleccion) { 

//echo "Indices eliminados: $seleccion <br>"; //muestra los indices eliminados

$cont=$cont+1;
//Creamos la sentencia SQL y la ejecutamos


$cera=0;




$sSQL="select Usado_horario From horarios Where ID_horario ='$seleccion'";
mysql_query($sSQL);

$result=mysql_query($sSQL);

while ($row=mysql_fetch_array($result)){

$valor=$row["Usado_horario"];
///echo "valor1:$valor";
}

if ($valor=="0")
{

	echo "<center><h4>La Cita ya fue Asignada</h4></center>"; 


}

else

{

	if (valor>"0")
	{
		$valor=$valor-1;
		///echo "valor2: $valor";


		$cedg=$Gcodi;
		$controg=$Gcontra;
		$tipotg=$Gtipoafi;



		$dateh=date("Y")."-".date("m")."-".date("d");
		$hor=date("H").":".date("i").":".date("s");
		$esta="1";

		$sSQL="Update horarios Set Usado_horario ='$valor' Where ID_horario='$seleccion'";
		mysql_query($sSQL);

		mysql_query("insert into citas (ID_horario,Idusu_citas,Tusua_citas,Cotra_citas,Clase_citas,Fsolusu_citas,Esta_cita,Hora_cita,bono_cita,REF ) values ('$seleccion','$cedg','$tipotg','$controg','$tipoci','$dateh','$esta', '$hor','$bono','$REF')");

		////vitacora


		$ss2="select * from citas where ID_horario=$seleccion and Clase_citas<=5";
		mysql_query($ss2);
		$re=mysql_query($ss2);
		while ($row=mysql_fetch_array($re)){

		$valor=$row["id_cita"];
		///echo "valor1:$valor";
		}


		$co= $Gcocita;
		$opera="sistemas";
		$op="CREATE";


		mysql_query("insert into vitacora (Codci_Vitaco ,Fopera_Vitaco ,Operacio_Vitaco, pete_vitaco ,Cod_oper_vitaco) values ('$valor','$dateh','$op','$tipoci','$opera')");



		echo "<center><h4>la cita se asigno correctamente</h4></center>";

	    } 
	else
		{
		echo "no se asigno la cita";

		}


}

}

 ?>



