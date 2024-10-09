<?


include("../uci/php/conexion.php");



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
 <TITLE>Selección de insumos</TITLE>
 <link rel="stylesheet" href="css/style.css" type="text/css" />
   <script languaje="javascript">
		function cambio()
		{
			
			uno.target='';
			uno.action='terapia_impre.php';
			uno.submit();		
		}
		function cambio1(k)
		{
			uno.ubica.value=k;			
			uno.target='';
			uno.action='terapia_impre.php';
			uno.submit();		
		}
		function cambio3()
		{
			if (event.keyCode == 13)
			{
				uno.target='';
				uno.action='terapia_impre.php';
				uno.submit();		
			}
		}
		
		
		function foco()
		{			
			j=uno.ubica.value;
			
			if(j!=uno.fin.value)
			{
				j=uno.ubica.value;	
			}
			else
			{
				j=uno.ubica.value;
			}
			
			if(j!='')
			{				
				ref="uno.selec"+j+".focus()"
				eval(ref);
			}
		}
    </script>
</HEAD>
<BODY onload='foco()'>
<style>
.enlace {
border: 0;
padding: 0;
background-image: url('img/feed_go.png');
width:50%;
height:18;
background-repeat:no-repeat;
color: blue;
border-bottom: 1px solid blue;
TEXT-DECORATION: none;
}
</style>
<?	
	$link=Mysql_connect("localhost","root","");
    if(!$link)echo"no hay conexion";
    Mysql_select_db('proinsalud',$link);

	echo"
	<form name='uno' method='post' action='terapia_impre.php' target='INIPri'>	
	<br><br>
	<table width=90%>	  
	<tr>         
	<td align=center>IDENTIFICACION <input type=text name=cedula inblur='cambio()' onKeydown='cambio3()' value='$cedula' >";


	$nusu=mysql_query("SELECT usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
	FROM usuario
	WHERE (((usuario.NROD_USU)='$cedula'))
	GROUP BY usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU");
	while($rusu=mysql_fetch_array($nusu))
	{
		$nombre['PNOM_USU'].' '.$nombre['SNOM_USU'].' '.$nombre['PAPE_USU'].' '.$nombre['SAPE_USU'];
	}
	
	
	$medi=mysql_query("SELECT medicos.nom_medi, Max(medicos.cod_medi) AS MáxDecod_medi1
	FROM ((medicos INNER JOIN terapia_evolucion ON medicos.cod_medi = terapia_evolucion.medi_ter) INNER JOIN ingreso_hospitalario ON terapia_evolucion.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU
	WHERE (((usuario.NROD_USU)='$cedula'))
	GROUP BY medicos.nom_medi
	ORDER BY medicos.nom_medi");	
	
	echo"<td align=center>MEDICO <select name=medico onchange='cambio()'>
	<option value=0>Todos</option>";
	while($rowmed=mysql_fetch_array($medi))
	{
		$codmed=$rowmed[MáxDecod_medi1];
		$nommed=$rowmed[nom_medi];
		if($medico==$codmed) echo"<option value=$codmed selected>$nommed</option>";
		else echo"<option value=$codmed>$nommed</option>";
	}
	echo"</select>		 
	</th>		 	  
	</tr>
	</table>";
	
	
	$nusu=mysql_query("SELECT usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
	FROM usuario
	WHERE (((usuario.NROD_USU)='$cedula'))
	GROUP BY usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU");
	while($rusu=mysql_fetch_array($nusu))
	{
		$nombre=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
	}
	echo"<BR><BR>
	<table width=90%>
	<tr><td align=center>NOMBRE DEL PACIENTE: <B>$nombre</td></tr>
	</table>";
	

	echo"
	<br><br>
	<table width=90% align=center >	  
	<tr>         
	<td width=10% align=center><B></B></td>
	<td width=10% align=center><B></B></td>   
	<td width=20% align=center><B></B></td>
	<td width=20% align=center></td>
	<td width=40% align=center></td>
	</tr>
	";
	if($medico==0)
	{
		$cad="SELECT Max(terapia_evolucion.fech_ter) AS MáxDefech_ter, terapia_evolucion.id_ing, terapia_evolucion.fech_ter
		FROM usuario INNER JOIN (terapia_evolucion INNER JOIN ingreso_hospitalario ON terapia_evolucion.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
		WHERE (((usuario.NROD_USU)='$cedula'))
		GROUP BY terapia_evolucion.id_ing, terapia_evolucion.fech_ter
		ORDER BY terapia_evolucion.id_ing DESC , terapia_evolucion.fech_ter DESC";
	}
	else
	{
		$cad="SELECT Max(terapia_evolucion.fech_ter) AS MáxDefech_ter, terapia_evolucion.id_ing, terapia_evolucion.fech_ter
		FROM usuario INNER JOIN (terapia_evolucion INNER JOIN ingreso_hospitalario ON terapia_evolucion.id_ing = ingreso_hospitalario.id_ing) ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
		WHERE (((usuario.NROD_USU)='$cedula') AND ((terapia_evolucion.medi_ter)='$medico'))
		GROUP BY terapia_evolucion.id_ing, terapia_evolucion.fech_ter
		ORDER BY terapia_evolucion.id_ing DESC , terapia_evolucion.fech_ter DESC";		
	}	
	$resul=Mysql_query($cad,$link);
	if(!$resul)echo 'no hay consulta';
	$num=Mysql_num_rows($resul);		
	$n=0;
	$ingre=0;
	while($row = mysql_fetch_array($resul))
	{		
		$ingreso=$row['id_ing'];
		$fech_evo=trim($row['MáxDefech_ter']);
		
		if($ingre!=$ingreso)
		{
			ECHO"<tr><td colspan=5><hr align='center' noshade color='#D0D0D0'></td></tr>
			<tr><td colspan=5><a href='terapia_impre1.php?fechaimp=$fech_evo&cedula=$cedula&ingreso=$ingreso'' target='top'><b>Imprimir evoluciones de ingreso $ingreso</b></a></td></tr>
			<tr><td colspan=5><hr align='center' noshade color='#D0D0D0'></td></tr>";
			$ingre=$ingreso;
		}
		echo"
		
		
		
		<tr><td align=center height=25>";
		$nomvar='selec'.$n;
		$selec=$$nomvar;
		if($n==$ubica and $selec==1)
		{
			echo"<input type=checkbox name='$nomvar' value=1 checked onclick='cambio1($n)'>";
		}
		else		
		{
			echo"<input type=checkbox name='$nomvar' value=1 onclick='cambio1($n)'>";
		}	
		$fecev=substr($fech_evo,0,4).'/'.substr($fech_evo,5,2).'/'.substr($fech_evo,8,2);		
		echo"</td>		
		<td><b>$fech_evo</td>";	
		echo"<td colspan=2><a href='terapia_impre1.php?fechaimp=$fech_evo&cedula=$cedula' target='top'><b>Imprimir</b></a></td>";
		echo"</tr>";		
		if($n==$ubica and $selec==1)
		{
			if($medico==0)
			{
				$resu=mysql_query("SELECT terapia_evolucion.iden_ter, terapia_evolucion.tipo_ter, terapia_evolucion.diag_ter, cie_10.nom_cie10, terapia_evolucion.cama_ter, terapia_evolucion.nota_ter, terapia_evolucion.hora_ter, terapia_evolucion.id_ing, medicos.nom_medi
				FROM (((terapia_evolucion INNER JOIN medicos ON terapia_evolucion.medi_ter = medicos.cod_medi) INNER JOIN cie_10 ON terapia_evolucion.diag_ter = cie_10.cod_cie10) INNER JOIN ingreso_hospitalario ON terapia_evolucion.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU
				WHERE (((usuario.NROD_USU)='$cedula') AND ((terapia_evolucion.fech_ter)='$fech_evo'))");					
			}
			else
			{
				$resu=mysql_query("SELECT terapia_evolucion.diag_ter, cie_10.nom_cie10, terapia_evolucion.tipo_ter, terapia_evolucion.iden_ter, terapia_evolucion.cama_ter, terapia_evolucion.nota_ter, terapia_evolucion.hora_ter, medicos.nom_medi
				FROM (((terapia_evolucion INNER JOIN medicos ON terapia_evolucion.medi_ter = medicos.cod_medi) INNER JOIN cie_10 ON terapia_evolucion.diag_ter = cie_10.cod_cie10) INNER JOIN ingreso_hospitalario ON terapia_evolucion.id_ing = ingreso_hospitalario.id_ing) INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU
				WHERE (((terapia_evolucion.fech_ter)='$fech_evo') AND ((terapia_evolucion.medi_ter)='$medico') AND ((usuario.NROD_USU)='$cedula'))");
			}	
			$num=mysql_num_rows($resu);
			
			while($rowresu=mysql_fetch_array($resu))
			{				
				$hora=$rowresu[hora_ter];
				$medi=$rowresu[nom_medi];				
				$nota=$rowresu[nota_ter];
				$cama=$rowresu['cama_ter'];
				$diagno=$rowresu['diag_ter'];
				$tipo_ter=$rowresu['tipo_ter'];
				$nomcie=$rowresu['nom_cie10'];
				$iden_evo=$rowresu[iden_ter];
				if($tipo_ter=='TR')$dester='TERAPIA RESPIRATORIA';
				if($tipo_ter=='TF')$dester='TERAPIA FISICA';
				if($tipo_ter=='TO')$dester='TERAPIA OCUPACIONAL';
				if($tipo_ter=='FO')$dester='FONOAUDIOLOGIA';				
				$bare=mysql_query("SELECT destipos.codi_des, destipos_1.nomb_des
				FROM destipos INNER JOIN destipos AS destipos_1 ON destipos.val2_des = destipos_1.codi_des
				WHERE (((destipos.codi_des)='$cama'))");
				$areaus='';
				while($rare=mysql_fetch_array($bare))
				{
					$areaus=$rare['nomb_des'];				
				}
				echo"	
				<tr><td height=20></td></tr>
				
				<tr><td></td><td  colspan=4><hr align='tr' noshade></td></tr>				
				<tr><td></td><td><b>$hora</b></td><td><b>$dester</b></td><td colspan=1><b>Dr. $medi</b></td><td colspan=2><b>$areaus</b></td></tr>				
				<tr><td></td><td colspan=4><hr align='tr' noshade></td></tr>
				
				<tr><td height=20></td></tr>
				<tr><td></td><td valign='TOP'>DIAGNOSTICO</td><td colspan=3><b>$diagno $nomcie</b></td></tr>
				<tr><td height=10></td></tr>
				<tr><td></td><td valign='TOP'>EVOLUCION</td><td colspan=3><b>$nota</b></td></tr>				
				<tr><td height=10></td></tr>";
				
			
				$medsol=mysql_query("select * from terapia_insumos where iden_ter='$iden_evo' order by tipo_int desc");
				if(mysql_num_rows($medsol))
				{					
					echo"
					<tr><td height=10></td></tr>
					<tr><td></td><td valign='TOP'>MEDICAMENTOS</td></tr>				
					<tr><td height=10></td></tr>
					
					<tr><td colspan=2></td>					
					
					<td colspan=3><table width=100%>
					<tr>
					<td><b>Descripción</td>
					<td><b>Posología</td>
					<td align=center><b>cantidad</td>				
					</tr>";
					
					while($rme=mysql_fetch_array($medsol))
					{						
						$codi_pro=$rme[codi_pro];
						$codi_pro=trim($codi_pro);
						$tipo_int=$rme[tipo_int];  
						$dosi_med=$rme[dosi_med]; 
						$unid_med=$rme[unid_med];
						$via_med=$rme[via_med]; 
						$frec_med=$rme[frec_med];
						$ufre_med=$rme[ufre_med];
						$caso_med=$rme[caso_med];
						$tipo_int=$rme[tipo_int];
						if($dosi_med==0)$dosi_med='';
						if($frec_med==0)$frec_med='';
						if($dosi_med==0)$dosi_med='';
						
						
						$nommedicam='';
						$nomunid='';
						$nomufre='';
						$nomvia='';
						
						if($tipo_int=='M')
						{			
							
							$maximo2=Mysql_query("SELECT medicamentos2.noco_mdi, medicamentos2.nomb_mdi, forma_farmaceutica.desc_ffa
							FROM forma_farmaceutica INNER JOIN medicamentos2 ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi
							WHERE (((medicamentos2.codi_mdi)='$codi_pro'))");
							
							
							$num=mysql_num_rows($maximo2);
							//echo $num;
							while($row2 = mysql_fetch_array($maximo2))
							{
								$nommedicam=$row2['nomb_mdi'].' '.$row2['noco_mdi'].' '.$row2['desc_ffa'];    //Nombre medicamento
								
							}
							
							$cadunida="select * from destipos where codi_des='$unid_med'";
							$resunida=Mysql_query($cadunida,$link);				
							while($row7 = mysql_fetch_array($resunida))
							{			
								$nomunid=$row7['nomb_des']; 		     
							}				
							$ufre=trim($ufre);
							$cadufre="select * from destipos where codi_des='$ufre_med'";
							$resufre=Mysql_query($cadufre,$link);				
							while($rowufre= mysql_fetch_array($resufre))
							{			
								$nomufre=$rowufre['nomb_des']; 		     
							}				
							$via=trim($via);
							$cadviada="select * from destipos where codi_des='$via_med'";
							$resunida=Mysql_query($cadviada,$link);
							while($row8 = mysql_fetch_array($resunida))
							{			
								$nomvia=$row8['nomb_des']; 		     
							} 								
						}
						else
						{
							$maximo2="SELECT desc_ins from insu_med where codi_ins='$codi_pro'";			
							$resul22=Mysql_query($maximo2,$link);
							while($row2 = mysql_fetch_array($resul22))
							{
								$nommedicam=$row2['desc_ins'];    //Nombre dispositivo				
							}
						}							
						 
						echo"		
						<tr>
						<td>$nommedicam</td>
						<td>$dosi_med $nomunid $frec_med $nomufre</td>
						<td  align=center>$caso_med</td>				
						</tr>";
					}					
					echo"</table></td></tr>";					
					echo"<tr><td height=20></td></tr>";				
				}
				
				//echo"<tr><td colspan=2><td COLSPAN=3><a href='terapia_impre1.php?iden=$iden_evo' target='top'><b>Imprimir</b></a></td></tr>";	
			}			
		}
		$n=$n+1;
	}
	echo"</table>
	<input type=hidden name=ubica value=$ubica>
	<input type=hidden name=fin value=$fin>
	<input type=hidden name=fecdia value=$fecdia>
	<input type=hidden name=usuar value=$cedula>
	<input type=hidden name=iden_evo>
	</form>				
	<table align=center>
	<tr><td height=15></td></tr>";
	
	//ECHO"<tr><td><td  colspan=4 align=center><a href='terapia_listapac.php' target='_self'><img src='img/feed.png' width=18'><br><b>Salir<a></td></tr>";
	ECHO"</table>";		
	function convertir($str)
	{
		$legalChars = "%[^0-9\-\. ]%";
		$str=preg_replace($legalChars,"",$str);
		return $str;
	}	
?>
</BODY>
</HTML>
