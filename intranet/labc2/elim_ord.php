<html>
<head>
	<title>laboratorio</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" />
<SCRIPT LANGUAGE='JavaScript'>
	function validag()
	{		
		
		if(form1.esta_ord.value=="")
		{
			alert("Identificar el Estado del Laboratorio");
			form1.esta_ord.focus();
			return;
		}
		
		
		if(form1.datos.value=="")
		{
			alert("Identificar el motivo de la cancelación");
			form1.datos.focus();
			return;			
		}
				
		else
		{
			form1.submit();
		}
	}
	
</script>
	
	
	
	
	</head>
<form name="form1" method="POST" action="camb_esta.php" >
<body >
	<br>
	<br>
 <table class='Tbl0'><td class="Td1" align='center'>CANCELACION O ANULACION DE LABORATORIO CLINICO</th></table>
 <?
		include('php/conexion.php');
		//echo "Usu".$iden_evo;
		//echo "ing".$id_ing;
		$fecha=time();
		$fech_qxf=date("Y/m/d",$fecha);
		$hora=$hor=date ("H:i:s",$fecha);
		echo "<br>";
		echo "<br>";
		echo "<br>";
		
		
		echo "<input type=hidden name=it value=$it>";
		echo "<input type=hidden name=jt value=$jt>";
		echo "<input type=hidden name=mcu value=$mcu>";
		
		for($i=0;$i<$mcu;$i++)
		{
			$nomvar='iden_var'.$it.$jt.$i;
			$iden_var=$$nomvar;	
								
			echo"<input type=hidden name=$nomvar value=$iden_var>";
					
		
		}
		
		
		
		/*$con_desop="SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.DIRE_USU, usuario.TRES_USU ,usuario.MRES_USU,usuario.TPAF_USU 
		FROM usuario
		INNER JOIN ucontrato AS ucontrato ON ucontrato.CUSU_UCO=usuario.CODI_USU
		INNER JOIN contrato AS contrato ON contrato.CODI_CON=ucontrato.CONT_UCO
		WHERE usuario.CODI_USU='$codusu'";*/
		$con_desop="SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.DIRE_USU, usuario.TRES_USU ,usuario.MRES_USU,usuario.TPAF_USU 
		FROM usuario
		WHERE usuario.CODI_USU='$codusu'";		
		
		//echo $con_desop;
		$con_desop=mysql_query($con_desop);
		
		echo "<table class='Tbl0' border=0>";
		echo "
		  <th class='Td1' width='8%'>FECHA</font></th>
		  <th class='Td1' width='8%'>HORA</font></th>
          <th class='Td1' width='15%'>IDENTIFICACION</font></th>
	      <th class='Td1' width='69%'>NOMBRE</font></th>";
		//$c=0;
		while($row=mysql_fetch_array($con_desop))
		{
		  echo "<tr>";
		  echo "<td class='Td2' align='center'><input type=hidden name=fech_qxf value=$fech_qxf>$fech_qxf</td>";
		  echo "<td class='Td2' align='center'><input type=hidden name=hora value=$hora>$hora</td>";
		  echo "<input type=hidden name=iden_evo value=$iden_evo>";
		  echo "<input type=hidden name=id_ing value=$id_ing>";
		  echo "<td class='Td2' align='center'><input type=hidden name=codusu value=$codusu>$row[NROD_USU]</td>";
		  echo "<td class='Td2' align='center'>$row[PNOM_USU] $row[PAPE_USU]</td>";
		  echo "<td class='Td2'>";
		  echo "</td>";
		  echo "</tr>";
		  echo "<tr><td>  </td></tr>";
		  echo "<tr><td>  </td></tr>";
		  echo "<tr><td class='Td1' ><b>Estado</td>";
		  echo "<td class='Td1' colspan=3><b>Observación</td></tr>";
		  //$nomvar="esta_ord".$c;
		  //echo "<br>".$nomvar;
		  echo "<tr><td><select name='esta_ord'>";
		  echo "<option value=''> </option>";
		  echo "<option value='CU'>CUMPLIDA</option>";
		  echo "<option value='RE'>RECHAZADA</option>";
		  echo "</select></td>";
		  echo "<td colspan=3  align='center'><textarea name=datos cols=100 rows=10></textarea></td>";			        
		  echo "</tr>";
		  //$c++;
		
		}
		echo "</table>";		
		mysql_close();
?>
<table class='Tbl2'>
    <tr>
      <td class='Td1' width='25%'><a href='#' onclick='validag()'><img hspace=0 width=15 height=15 src='icons\feed_delete.png' alt='Guarda Orden' border=0 align='center'>GUARDAR</a></td>
    </tr>
</table>
<?
 echo"<input type=hidden name='iden_ord' value=$iden_ord>";
 //echo"<input type=text name='contador' value=$c>";
 

?>
</form>
</body>
</html>