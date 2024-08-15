<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script>
<script language=javascript>
function cambio()
{
	if(uno.fecini.value=='')
	{
		alert("Digite la fecha de inicio del reporte");
		uno.fecini.focus();
		return;
	}
	if(uno.fecfin.value=='')
	{
		alert("Digite la fecha final del reporte");
		uno.fecfin.focus();
		return;
	}	
	uno.target='';
	uno.action='ordenes_nutricion.php';
	uno.submit();
}
function cancelar(n)
{
	var respuesta = confirm("Cancelar el pendiente de orden?");
    if (respuesta==false)return;
	uno.itemcance.value=n;
	uno.opcion.value="1";
	uno.target='';
	uno.action='ordenes_nutricion.php';
	uno.submit();
	
}
</script>
</head>
<body onload='entra()'>
<style>
.sel{
font-size:12;
}
.tbl 
{
	border: 1px solid #bbbbff;
	border-collapse: collapse;
	empty-cells: show;
	background: #FFFFFF;
}
.tbl td 
{	
	border: 1px solid #bbbbff;
	font=-family: tahoma;
	color: #0240A3;
	font-size: 10pt;
	text-decoration: none;
	font-weight: 500;
	text-transform: uppercase;	
	padding:.3em .4em;	
}
.tbl th
{
	border: 1px solid #bbbbff;
	padding:.6em .8em;
	font=-family: tahoma;
	color: #0240A3;
	font-size: 10pt;
	text-decoration: none;
	font-weight: 700;
	text-transform: uppercase;
	background-Color:#E3E3ED;	
}

.tb2 
{
	border: 1px solid #bbbbff;
	border-collapse: collapse;
	empty-cells: show;
	background: #FFFFFF;

}
.tb2 td 
{	
	font=-family: tahoma;
	color: #0240A3;
	font-size: 8pt;
	text-decoration: none;
	font-weight: 500;
	text-transform: uppercase;
	border: 1px solid #ya sub;
	padding:.3em .4em;	
	background-Color:#F8F8F8;	
	
}
.tb2 th
{
	border: 1px solid #bbbbff;
	padding:.6em .8em;
	font=-family: tahoma;
	color: #0240A3;
	font-size: 8pt;
	text-decoration: none;
	font-weight: 700;
	text-transform: uppercase;	
}
.caja
{
	font-family: arial,tahoma;
	font-size: 10pt;
	color:#000088;
	font-weight: 500;
	text-transform:uppercase;
	background:#FFF;
}
</style>
<?
	// 192.168.4.20/intraweb/intranet/Historias/ordenes_nutricion.php
	foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}
	 foreach($_GET as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	}	
	set_time_limit (100);
    $fecha=date("Y-m-d");
	
	include ('php/conexion2.php');
	
	if($opcion=="1")
	{		
		mysql_query("UPDATE nutricion_sol_interconsulta SET esta_ordennut='CA' WHERE iden_ordennut='$itemcance'");
		$opcion="0";
	}
	//if(empty($fecini))$fecini=$fecha;
	if(empty($fecfin))$fecfin=$fecha;
	
	$fecini=date("Y-m-d",strtotime($fecfin."- 3 days"));
	
	echo"<form name=uno method=post>
	<input type=hidden name=itemcance>
	<input type=hidden name=opcion>
	
	<br>
	<table class='tbl' align=center>
	<tr>
	<th colspan=2>INTERCONSULTAS NUTRICION</td>	
	</tr>	
	<tr>	
	<th>FECHA INICIO</td>
	<th>FECHA FINAL</td>
	</tr>
	<tr>	
	<td>
	";	
	?>
		<input type="text" name="fecini" class='caja' size="10" maxlength="10" value="<?echo $fecini;?>" id="fini" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador1" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "fini",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador1"     // el id del botn que lanzar el calendario 				
		}); 
		</script> 				
	<?		
	echo"
	</td>	
	<td>";
	?>
		<input type="text" name="fecfin" class='caja' size="10" maxlength="10" value="<?echo $fecfin;?>" id="ffin" <?echo $disp;?>>
		<input type="button" class='caja' id="lanzador2" value="..." <?echo $disp;?>/>
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField     :    "ffin",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
		button     :    "lanzador2"     // el id del botn que lanzar el calendario 				
		}); 
		</script> 				
	<?	
	
	echo"</td>
	</tr>
	<tr><th colspan=4><input type=button value=buscar onclick='cambio()'>
	</td></tr>
	</table>
	<br>";
	
	if($fecini!='' && $fecfin!='')
	{
		
		$nut1=mysql_query("CREATE TEMPORARY TABLE ordennutri SELECT nutricion_sol_interconsulta.iden_ordennut, nutricion_sol_interconsulta.iden_var, 
		usuario.NROD_USU AS cedula, Concat(usuario.PNOM_USU,' ',usuario.SNOM_USU,' ',usuario.PAPE_USU,' ',usuario.SAPE_USU) AS nombre, 
		destipos.nomb_des AS cama, destipos_1.nomb_des AS area, hist_var.fech_var AS fecha, hist_var.hora_var AS hora, nutricion_sol_interconsulta.perdidapeso_ordennut, nutricion_sol_interconsulta.cuantos_ordennut, nutricion_sol_interconsulta.comidomenos_ordennut, nutricion_sol_interconsulta.esta_ordennut
		FROM (((usuario INNER JOIN ((ingreso_hospitalario INNER JOIN (hist_var INNER JOIN hist_evo ON hist_var.iden_evo = hist_evo.iden_evo) ON ingreso_hospitalario.id_ing = hist_evo.id_ing) INNER JOIN nutricion_sol_interconsulta ON hist_var.iden_var = nutricion_sol_interconsulta.iden_var) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON destipos.val2_des = destipos_1.codi_des) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
		WHERE (((hist_var.fech_var)>='$fecini' And (hist_var.fech_var)<='$fecfin') AND ((nutricion_sol_interconsulta.esta_ordennut)='PE') AND ((hist_var.idevo_cumpli) Is Null) AND ((hist_traza.horas_tra)=-1))");
		
		

		$nut2=mysql_query("INSERT INTO ordennutri SELECT nutricion_sol_interconsulta.iden_ordennut, nutricion_sol_interconsulta.iden_var, 
		encabesadohistoria.idus_ehi AS cedula, encabesadohistoria.nomb_ehi AS nombre, destipos.nomb_des AS cama, destipos_1.nomb_des AS area,
		consultaprincipal.feca_cpl AS fecha, consultaprincipal.hora_cpl AS hora, nutricion_sol_interconsulta.perdidapeso_ordennut, 
		nutricion_sol_interconsulta.cuantos_ordennut, nutricion_sol_interconsulta.comidomenos_ordennut, nutricion_sol_interconsulta.esta_ordennut
		FROM (((hist_traza INNER JOIN ingreso_hospitalario ON hist_traza.id_ing = ingreso_hospitalario.id_ing) INNER JOIN ((nutricion_sol_interconsulta INNER JOIN encabesadohistoria ON nutricion_sol_interconsulta.numc_histo = encabesadohistoria.numc_ehi) INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) ON ingreso_hospitalario.consu_ing = nutricion_sol_interconsulta.numc_histo) INNER JOIN destipos ON ingreso_hospitalario.caac_ing = destipos.codi_des) INNER JOIN destipos AS destipos_1 ON destipos.val2_des = destipos_1.codi_des
		WHERE (((nutricion_sol_interconsulta.iden_var)=0) AND ((nutricion_sol_interconsulta.esta_ordennut)='PE') AND ((encabesadohistoria.feco_ehi)>='$fecini' And (encabesadohistoria.feco_ehi)<='$fecfin') AND ((hist_traza.horas_tra)=-1))");
		
		

		$nut=mysql_query("SELECT * FROM ordennutri");		
		
		
		if(mysql_num_rows($nut)>0)
		{
			echo"<table class='tbl' align=center width=90%>
			<tr>
			<th>REGISTRO</th>
			<th>CEDULA</th>
			<th>NOMBRE</th>
			<th>AREA</th>
			<th>CAMA</th>
			<th>FECHA</th>
			<th>HORA</th>
			<th>PERDIDA PESO</th>
			<th>KILOS PERDIDOS</th>
			<th>HA COMIDO MENOS DE LOS NORMAL</th>
			<th>TOTAL</th>
			<th>ESTADO</th>
			<th>CANCELAR</th>
			</tr>";
			while($rnut=mysql_fetch_array($nut))
			{
				
				
				$iden=$rnut['iden_ordennut'];
				$iden_var=$rnut['iden_var'];
				$cedula=$rnut['cedula'];
				$nombre=$rnut['nombre'];
				$area=$rnut['area'];
				$cama=$rnut['cama'];
				$fecha=$rnut['fecha'];
				$hora=substr($rnut['hora'],0,5);		
				$perdidapeso=$rnut['perdidapeso_ordennut'];
				$cuantos=$rnut['cuantos_ordennut'];
				$comidomenos=$rnut['comidomenos_ordennut'];
				$estado=$rnut['esta_ordennut'];
				
				$puntos=0;
				if($perdidapeso=='NO')
				{
					$perdida='NO';
					$puntos=$puntos+0;
				}
				if($perdidapeso=='NS')
				{
					$perdida='NO ESTOY SEGURO';
					$puntos=$puntos+2;
				}
				if($perdidapeso=='SI')
				{
					$perdida='SI';
					$puntos=$puntos+2;
				}
				
				if($cuantos==0)
				{
					$kilos='NO ESTOY SEGURO';
					$puntos=$puntos+0;
				}
				if($cuantos==1)
				{
					$kilos='1 a 5';
					$puntos=$puntos+1;
				}
				if($cuantos==2)
				{
					$kilos='6 a 10';
					$puntos=$puntos+2;
				}
				if($cuantos==3)
				{
					$kilos='10 a 15';
					$puntos=$puntos+3;
				}
				if($cuantos==4)
				{
					$kilos='MAS DE 15';
					$puntos=$puntos+4;
				}
				
				if($comidomenos=='SI')
				{
					$commenos='SI';
					$puntos=$puntos+1;
				}
				if($comidomenos==4)
				{
					$commenos='NO';
					$puntos=$puntos+0;
				}
				echo"
				<tr>
				<td align=center>$iden</td>
				<td>$cedula</td>
				<td>$nombre</td>
				<td>$area</td>
				<td align=center>$cama</td>
				<td>$fecha</td>
				<td align=center>$hora</td>
				<td align=center>$perdida</td>
				<td align=center>$kilos</td>
				<td align=center>$commenos</td>
				<td align=center>$puntos</td>";
				if($iden_var==0)
				{
					if($puntos>=2)
					{
						echo"<td bgcolor='#F1948A'>PENDIENTE ORDEN</td>";
						echo"<td align=center><input type=button class=boton onclick='cancelar($iden)' value=' X ' title='Cancelar'></td>";
					}
					else 
					{
						echo"<td bgcolor='#F1948A'></td>";
						echo"<td></td>";
						
					}
				}
				else
				{
					echo"<td bgcolor='#F9E79F'>PENDIENTE INTERCONSULTA</td>";
					echo"<td></td>";
				}
				
				echo"</tr>";
			}
			echo "</table>";
		}
		else
		{
			echo"<table class='tbl' align=center>
			<tr>
			<th colspan=2>NO SE ENCOTRARON REGISTROS PARA SU BUSQUEDA</td>	
			</tr>
			</table>";			
		}
	}
	echo"<form>
	<br><br><br>";
?>
</body>
</html>