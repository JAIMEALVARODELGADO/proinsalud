<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
<link rel="stylesheet" href="style.css" type="text/css"/>
 <TITLE>New Document</TITLE>
 <script language="JavaScript">
	function salir()
	{		
		idsel=0;
		for(i=1;i<25;i++)
		{			
			opcion=eval("uno.sel"+i+".checked");
			
			if(opcion==true)
			{
				idsel=(idsel/1)+1;
			
			}		
		}
		if(idsel==0)
		{
			alert("Seleccione al menos una opcion");
		}
		else
		{
			uno.action="costo1.php";
			uno.target="";
			uno.submit();		
		}		
	}
	function selec()
	{
		 var item = document.getElementsByName("seltotal");
         for(var n=0; n<2; n++)
         {
             if(item[0].checked)
             {
				for(i=1;i<25;i++)
				{			
					eval("uno.sel"+i+".checked=true");				
				}                 
             }
			 if(item[1].checked)
             {
                for(i=1;i<25;i++)
				{			
					eval("uno.sel"+i+".checked=false");				
				}  
             }
             
         }
	}
	</script>	
</HEAD>
<BODY bgcolor=#FFFFFF>
<?php
	
	
	
	$anohoy=date('Y');
	$meshoy=date('m');	
	//echo $anoini.' '.$mesini;
	$conexion = mysql_connect("192.168.4.20","root","");
	mysql_select_db("formedica",$conexion);
	
	$bper=mysql_query("SELECT costos_final.ano, costos_final.mes
	FROM costos_final
	GROUP BY costos_final.ano, costos_final.mes
	ORDER BY costos_final.ano DESC , costos_final.mes DESC");
	
//echo mysql_num_rows($bper);
	
	echo"<br><br>
	<form name=uno method=post>
	<input type=hidden name=opcion>
	<table align=center class='tbl'>	
	<tr><th colspan=2>PERIODO A CONSULTAR<select name=periodo>";
	while($rper=mysql_fetch_array($bper))
	{
		$ano=$rper['ano'];
		$mesper=$rper['mes'];
		if($mesper=='01')$mes="ENERO";
		if($mesper=='02')$mes="FEBRERO";
		if($mesper=='03')$mes="MARZO";
		if($mesper=='04')$mes="ABRIL";
		if($mesper=='05')$mes="MAYO";
		if($mesper=='06')$mes="JUNIO";
		if($mesper=='07')$mes="JULIO";
		if($mesper=='08')$mes="AGOSTO";
		if($mesper=='09')$mes="SEPTIEMBRE";
		if($mesper=='10')$mes="OCTUBRE";
		if($mesper=='11')$mes="NOVIEMBRE";
		if($mesper=='12')$mes="DICIEMBRE";
		$anomes=$ano.$mesper;
		$descr=$mes.' DE '.$ano;
		echo"<option value='$anomes'>$descr</option>";
	}
	echo"</select>
	</td>
	</tr>
	
	<tr><th colspan=2> <input type=radio name=seltotal value=1 onclick='selec()'> Seleccionar todo 
	<input type=radio name=seltotal value=2 onclick='selec()'> Quitar seleccion	 
	</td>
	</tr>
	
	<tr><td><input type=checkbox name=sel1 value=1></td><td> 1 MEDICOS</td></tr>
	<tr><td><input type=checkbox name=sel2 value=1></td><td> 2 ESPECIALIDAD</td></tr>
	<tr><td><input type=checkbox name=sel3 value=1></td><td> 3 MEDICOS MEDICINA ESPECIALIZADA</td></tr>
	<tr><td><input type=checkbox name=sel4 value=1></td><td> 4 MEDICOS MEDICINA GENERAL</td></tr>
	<tr><td><input type=checkbox name=sel5 value=1></td><td> 5 CONTRATOS</td></tr>
	<tr><td><input type=checkbox name=sel6 value=1></td><td> 6 AREAS</td></tr>
	<tr><td><input type=checkbox name=sel7 value=1></td><td> 7 BODEGA</td></tr>
	<tr><td><input type=checkbox name=sel8 value=1></td><td> 8 ALTO COSTO</td></tr>
	<tr><td><input type=checkbox name=sel9 value=1></td><td> 9 ALTO COSTO POR CONTRATO</td></tr>
	<tr><td><input type=checkbox name=sel10 value=1></td><td> 10 ALTO COSTO POR AREA</td></tr>	
	<tr><td><input type=checkbox name=sel11 value=1></td><td>11 PROD ALTO COSTO</td></tr>
	<tr><td><input type=checkbox name=sel12 value=1></td><td>12 MEDICO X AREA</td></tr>	
	<tr><td><input type=checkbox name=sel13 value=1></td><td>13 CONTRATO X AREA</td></tr>
	<tr><td><input type=checkbox name=sel14 value=1></td><td>14 MUNICIPIOS</td></tr>
	<tr><td><input type=checkbox name=sel15 value=1></td><td>15 COSTO X PRODUCTO</td></tr>
	<tr><td><input type=checkbox name=sel16 value=1></td><td>16 FORMULAS POR USUARIO</td></tr>
	<tr><td><input type=checkbox name=sel17 value=1></td><td>17 FORMULAS X USUARIO CE</td></tr>
	<tr><td><input type=checkbox name=sel18 value=1></td><td>18 FORMULAS X MEDICO</td></tr>
	<tr><td><input type=checkbox name=sel19 value=1></td><td>19 FORMULAS X CONTRATO</td></tr>";
	/*
	<tr><td><input type=checkbox name=sel21 value=1></td><td>21 PACIENTES POR CONTRATO</td></tr>
	<tr><td><input type=checkbox name=sel22 value=1></td><td>22 PACIENTES POR AREA</td></tr>
	<tr><td><input type=checkbox name=sel23 value=1></td><td>23 PACIENTES MULTIFORMULADOS</td></tr>
	<tr><td><input type=checkbox name=sel24 value=1></td><td>24 COMPORTAMIENTO 2013</td></tr>
	*/
	echo"
	<tr><td><input type=checkbox name=sel20 value=1></td><td>20 DATOS ESTADISTICOS</td></tr>
	<tr><td><input type=checkbox name=sel21 value=1></td><td>21 INFORME PARA COSTOS</td></tr>
	<tr><td><input type=checkbox name=sel22 value=1></td><td>22 FORMULAS X MEDICO2</td></tr>
	<tr><td><input type=checkbox name=sel23 value=1></td><td>23 DEVOLUCIONES</td></tr>
	<tr><td><input type=checkbox name=sel24 value=1></td><td>24 MULTIFORMULADOS</td></tr>
	<tr><th align=center colspan=3><input type=button value='Aceptar' onclick='salir()'></td></tr>
	</table>
	</form>
	
	";
	
	/*
	<tr><td><input type=checkbox name=sel1 value=1></td><td> 1 MEDICOS</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel2 value=1></td><td> 2 ESPECIALIDAD</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel3 value=1></td><td> 3 MEDICOS MEDICINA ESPECIALIZADA</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel4 value=1></td><td> 4 MEDICOS MEDICINA GENERAL</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel5 value=1></td><td> 5 CONTRATOS</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel6 value=1></td><td> 6 AREAS</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel7 value=1></td><td> 7 BODEGA</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel8 value=1></td><td> 8 ALTO COSTO</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel9 value=1></td><td> 9 ALTO COSTO POR CONTRATO</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel10 value=1></td><td> 10 ALTO COSTO POR AREA</td>											<td>OK</td></tr>	
	<tr><td><input type=checkbox name=sel11 value=1></td><td>11 PROD ALTO COSTO</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel12 value=1></td><td>12 MEDICO X AREA</td>											<td></td></tr>	
	<tr><td><input type=checkbox name=sel13 value=1></td><td>13 CONTRATO X AREA</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel14 value=1></td><td>14 MUNICIPIOS</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel15 value=1></td><td>15 COSTO X PRODUCTO</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel16 value=1></td><td>16 FORMULAS POR USUARIO</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel17 value=1></td><td>17 FORMULAS X USUARIO CE</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel18 value=1></td><td>18 FORMULAS X MEDICO</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel19 value=1></td><td>19 FORMULAS X CONTRATO</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel20 value=1></td><td>20 FORMULAS X AREA</td>											<td>OK</td></tr>
	<tr><td><input type=checkbox name=sel21 value=1></td><td>21 PACIENTES POR CONTRATO</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel22 value=1></td><td>22 PACIENTES POR AREA</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel23 value=1></td><td>23 PACIENTES MULTIFORMULADOS</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel24 value=1></td><td>24 COMPORTAMIENTO 2013</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel25 value=1></td><td>25 DATOS ESTADISTICOS</td>											<td></td></tr>
	<tr><td><input type=checkbox name=sel26 value=1></td><td>26 INFORME PARA COSTOS</td>											<td></td></tr>
	
	
	*/
	

?>
</BODY>
</HTML>




