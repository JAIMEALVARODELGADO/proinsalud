<html>
<head><title>Solicitudes por áreas</title>
</head>
<body >
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px;  }
.tm {font-family: Arial, Helvetica, sans-serif; font-size: 10px;  color:#E30909;}
-->
</style>
<script LANGUAGE =javascript>
function abrir() {
//form1.fec_var.value=fec_var
form1.submit();
}
function abrir2(fec_var,hor_var) {
//alert(formfec_var);
form1.ghor_.value=hor_var;
form1.gfec_.value=fec_var;
//alert(form1.gfec_.value);
form1.submit();
}
function cargar(ii,jj,fec_var,hora_var)
{
      form1.gfec_.value=fec_var;
	  form1.ghor_.value=hora_var;
	  form1.item1.value=ii;
	  form1.item2.value=jj;
	  form1.action="pac_hosp.php";
	  form1.target='fr2';
	  form1.submit();
}
</script>
<form name="form1" method="POST" action="busq_area.php" target="Fr04">
<?	include('php/conexion.php');?>
<Table width='90%' border='1' align='center' cellpadding='0' Cellspacing='1' borderColor='#ffffff'>
  <tr>
	<?
			//echo "AQUI".$gfec_var;
			$conser=mysql_query("SELECT codi_des,nomb_des FROM destipos WHERE codi_des='$ser'");
			$rowser=mysql_fetch_array($conser);
			$dser=$rowser[nomb_des];
			echo"<tr bgcolor='#E6E8FA'><td colspan='7' class='Estilo6'>$dser</td></tr>";
     
			$cons=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, Max(usuario.CODI_USU) AS MáxDeCODI_USU
			FROM ((hist_evo INNER JOIN (((ingreso_hospitalario INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) INNER JOIN (ucontrato INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) ON hist_evo.codi_usu = usuario.CODI_USU) INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) INNER JOIN cups ON hist_var.iden_ser = cups.codigo
			WHERE (((hist_traza.ubica_tra)='$ser') AND ((ucontrato.ESTA_UCO)='AC') AND ((hist_traza.id_ing) Is Not Null) AND ((hist_traza.horas_tra)=-1) AND ((hist_var.esta_var)='SO') AND ((cups.tipo)='1803'))
			GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing");
		
			//echo $cons;
			
			echo "<tr bgcolor='#E6E8FA' align='center'>
			<th class='Estilo6' width='5%'>Op</th>
	        <th class='Estilo6' width='10%'>Identificación</font></th>
		    <th class='Estilo6' width='45%'>Nombre</font></th>
			<th class='Estilo6' width='5%'>Estado</font></th></tr>";
		 
			$i=0;
           while ($rowx=mysql_fetch_array($cons))
		   {
				  $cod_usu=$rowx[NROD_USU];
				  echo "<tr bgcolor=#ffffff>";
				  $nomvar='codchk'.$i;
				  $valor=$$nomvar;
		 
				  if($valor==1)
				  {
					$nomvar='codchk'.$i;
					echo "<td class='Td2'><input type=checkbox name='$nomvar' value=1 checked onclick='abrir()'</td>";
				  }
				  else
				  {
					$nomvar='codchk'.$i;
					echo "<td class='Td2'><input type=checkbox  name='$nomvar' value=1 onclick='abrir()'</td>";
				  }
				  $i++;
				  		      
				  echo"<td class=Estilo7><br>$rowx[NROD_USU]";
				  echo "<td class=Estilo7><br>$rowx[PNOM_USU] $rowx[SNOM_USU] $rowx[PAPE_USU] $rowx[SAPE_USU]
				  </td></tr>";
				 $j=0;
				if($valor==1)
				{ 
					//echo "<tr>";
					$consciru=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, Max(usuario.CODI_USU) AS MáxDeCODI_USU, hist_var.fech_var,hist_evo.cod_medi,hist_var.hora_var
					FROM ((hist_evo INNER JOIN (((ingreso_hospitalario INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) INNER JOIN (ucontrato INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) ON hist_evo.codi_usu = usuario.CODI_USU) INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) INNER JOIN cups ON hist_var.iden_ser = cups.codigo
					WHERE (((hist_traza.ubica_tra)=$ser) AND ((ucontrato.ESTA_UCO)='AC') AND ((hist_traza.id_ing) Is Not Null) AND ((hist_traza.horas_tra)=-1) AND ((hist_var.esta_var)='SO') AND ((cups.tipo)='1803') AND ((usuario.NROD_USU)='$cod_usu'))
					GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, hist_var.fech_var
					ORDER BY hist_var.fech_var desc");
					
					//echo $consciru;
					while($rowciru=mysql_fetch_array($consciru))
					{
						 
						  $fecha_vari=$rowciru[fech_var];
						  $hora_vari=$rowciru[hora_var];
						  echo"<tr bgcolor='#E6E8FA' align='center'>";
						  $nomvar2='codchk2'.$i.$j;
						  $valor2=$$nomvar2;
						 // echo "vl2".$valor2;
				 
						  if($valor2==1)
						  {
							$nomvar2='codchk2'.$i.$j;
							echo "<td class='Td2'><input type=checkbox name='$nomvar2' value=1 checked onclick='abrir2(\"$fecha_vari\",\"$hora_vari\")'></td>";
						  }
						  else
						  {
							$nomvar2='codchk2'.$i.$j;
							echo "<td class='Td2'><input type=checkbox  name='$nomvar2' value=1 onclick='abrir2(\"$fecha_vari\",\"$hora_vari\")'></td>";
						  }
						
						  echo "<td align='left' colspan=2><span class='tm'><a href='#' onclick='cargar($i,$j,\"$fecha_vari\",\"$hora_vari\")'>$fecha_vari -  $hora_vari</a>";
						  //<button type=button name='btn1' onclick='cargar()'><img src='icons/feed_edit.png' border='0' alt='Editar'>$rowciru[fech_var]</td>";
						  echo "<td colspan=3 align='left'><span class='tm'></td>";
						  echo "</tr>";
					    
					
						echo "<input type=hidden name=cod_usu value=$cod_usu>";
						
						$nom_var2='cod_medi'.$i.$j;
						echo "<input type=hidden name=$nom_var2 value=$rowciru[cod_medi]>";
						
						$j++;
				
						//echo "vl2".$valor2;
						if($valor2==1)
						{ 
							//echo "<tr>";
							$consdes=mysql_query("SELECT usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, hist_var.fech_var, cups.descrip,  hist_evo.cod_medi,  hist_var.hora_var
							FROM (contrato INNER JOIN ucontrato ON contrato.CODI_CON = ucontrato.CONT_UCO) INNER JOIN (cups INNER JOIN (((hist_evo INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo)
							INNER JOIN (ingreso_hospitalario INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) ON hist_evo.codi_usu = usuario.CODI_USU) 
							INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) ON cups.codigo = hist_var.iden_ser) ON ucontrato.CUSU_UCO = usuario.CODI_USU
							WHERE (((hist_var.fech_var)='$gfec_') AND ((usuario.NROD_USU)='$cod_usu') AND ((cups.tipo)='1803') AND ((hist_traza.horas_tra)=-1) AND ((hist_traza.ubica_tra)=$ser) 
							AND ((hist_traza.horas_tra)=-1) AND ((hist_var.esta_var)='SO') AND ((ucontrato.ESTA_UCO)='AC'))
							ORDER BY hist_var.fech_var desc");
							
							
							//echo $consdes;
							$m=1;
							while($rowdes=mysql_fetch_array($consdes))
							{
							  $desc=$rowdes['descrip'];
							  echo "<td align=left></td>";
							  echo "<td ></td>";
							  echo "<td class='tm'>$m. $desc<br></td>";
							  echo "<td ></td>";
							  echo "<td ></td>";
							  echo "</tr>";
							  $m++;
							}
					
					
						}
								        
							
					}
				  
				  
				  
				  
		}		  
				  
}
		 echo "<input type=hidden name=item1>";
		 echo "<input type=hidden name=item2>";
		 echo "<input type=hidden name=ser value=$ser>";
		 echo "<input type=hidden name=gfec_ value='$gfec_'>";	
		 echo "<input type=hidden name=ghor_ value='$ghor'>";
  ?>

</tr>
</table>
</form>
</body>
</html>
















