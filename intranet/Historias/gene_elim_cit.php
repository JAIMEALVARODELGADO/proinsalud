<?
session_register('Gcocita');

?>

<BODY > 
<?php 

//Conexion con la base
mysql_connect("localhost","root","");

//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud"); 



if ($seleccion2<>"")
	{

		$cont=0;
		foreach($_POST['seleccion2'] as $seleccion2)
		 { 
	
			$cont=$cont+1;
                	
			$result=mysql_query("select * from horarios where ID_horario ='$seleccion2'");
			while ($row=mysql_fetch_array($result))
				{

					$citao=$row["Usado_horario"];
				
	
				}
        


		}


$citao=$citao+1;
	 
$sSQL="Update horarios Set Usado_horario ='$citao' Where ID_horario='$seleccion2'";
mysql_query($sSQL);


$sSQL2="Update citas Set Clase_citas  ='$tipoci' Where ID_horario='$seleccion2'";
mysql_query($sSQL2);

////vitacora
$co= $Gcocita;
$opera="sistemas";
$op="DELETE";

$dateh=date("Y")."-".date("m")."-".date("d");



mysql_query("insert into vitacora (Codci_Vitaco ,Fopera_Vitaco ,Operacio_Vitaco, pete_vitaco ,Cod_oper_vitaco) values ('$co','$dateh','$op','$tipoci','$opera')");


	
echo "<center><h4>Se eliminaron  $cont  Cita(s)</h4></center>";

}
 
if($seleccion2==""){
echo "<b>No se realizo ninguna Operacion</b>";
}








 ?>



