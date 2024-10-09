<html> 

<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 


<head> 

<SCRIPT languague="JavaScript">
<!--
	var cuenta=0
	var texto=" - PROINSALUD - LABORATORIO CLINICO  "
	function scrolltexto ()
	{
		window.status=texto.substring (cuenta,texto.length)+ 
		texto.substring(0,cuenta)
		if (cuenta <texto.length)
		{ 
			cuenta ++
		}
		else
		{
			cuenta=0
		}
		setTimeout("scrolltexto()",150)
	}
	scrolltexto ()
//-->
</SCRIPT>

<?
	//Aqui cargo las funciones para php
	include("php/funciones.php");
?>


<title>INFORMACION USUARIOS *PROINSALUD* </title> </head> 
<body ><!--<hr aling="center"width="100%">-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px;  }
-->
</style>

<form name="form1" method="POST"  action="pac_hosp.php" target="fr2">  

<script language="javascript">

function validar(form)
{
  
	if (form.frec.value == "") 
    { alert("Por favor Ingrese Fecha de Recepcion De Muestras"); return true; }
	if (form.fent.value == "") 
    { alert("Por favor Ingrese Fecha de Entrega De Resultados"); return true; }
	if (form.minr.value == "") 
    { alert("Por favor Ingrese Hora Recepcion"); return true; }
	if (form.mine.value == "") 
    { alert("Por favor Ingrese Hora de Entrega"); return true; }
	if (form.nom_medi.value == "") 
    { alert("Por favor Ingrese Nombre Médico"); return true; }
	if (form.amb_usu.value == "") 
    { alert("Por favor Ingrese Ambito "); return true; }

form.submit()
}

function validacod(){
  form1.submit();
}

function enviar(){
  form1.action='bus_labs.php';
  form1.submit();
}

function adiciona()
{
	
	 form1.action='lab_2add.php';
	 form1.submit();
	
}

function verifica()
{
	form1.submit();
}

</script>

<?php

	$link=Mysql_connect("localhost","root","");
	if(!$link){echo"no hay conexion";}
	Mysql_select_db('proinsalud',$link);
	
	
	echo "<input type=hidden name=item1 value=$item1>";
	echo "<input type=hidden name=item2 value=$item2>";
	echo "<input type=hidden name=ser   value=$ser>";
	echo "<input type=hidden name=cod_usu value='$cod_usu'>";
	echo "<input type=hidden name=num_fac value='$num_fac'>";
	echo "<input type=hidden name=num_ord value='$fac_num'>";
	echo "<input type=hidden name=gfec_   value='$gfec_'>";
	echo "<input type=hidden name=minr    value='$ghor_'>";
	$var_med='cod_medi'.$item1.$item2;
	$cod_medi=$$var_med;
	echo "<input type=hidden name=$var_med value='$cod_medi'>";
	
	
	echo "<table border='1' bgcolor='#FFFFFF' bordercolor='#D0D0F0' width='100%' align='center' cellpadding='0' cellspacing='1'>";
    echo "<tr bgcolor=#D0D0F0><td height=10 colspan=6><div align=center class=Estilo6>Datos de Usuarios </div></td></tr>";		
	echo "<td class='Estilo7'><div align=left><strong>Orden:</div></strong> ";
	echo "<td class='Estilo7' colspan=5><input type=text name='num_fac' size=10 maxlength=10 onblur='verifica()' value='$num_fac'>";
	$cons =mysql_query("select * from factura where num_fac='$num_fac'");
	if (mysql_num_rows($cons)==0)
	{
										
			$result =mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,TPAF_USU,MATE_USU,CONT_UCO,NEPS_CON,IDEN_UCO,MRES_USU FROM usuario, ucontrato,contrato WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON AND NROD_USU = '$cod_usu'"); 

			if (mysql_num_rows($result)<>0)
			{
			
			while ($rowx = mysql_fetch_array($result))
		    {
				
				
					echo "<tr class=Estilo7>
					<td class=Estilo7 width='15%'><div align=left><strong>Id:</strong> $rowx[NROD_USU]<input name=NROD_USU  type=hidden  value=$rowx[NROD_USU] size='12'></div></td>
					
					<input name=pnom type=hidden   value=$rowx[PNOM_USU] size='20' maxlength='20'>
					<input name=snom type=hidden   value=$rowx[SNOM_USU] size='20' maxlength='20'>
					<input name=pape type=hidden   value=$rowx[PAPE_USU] size='20' maxlength='20'>
					<input name=sape type=hidden   value=$rowx[SAPE_USU] size='20' maxlength='20'>";
					
					echo"<td class=Estilo7 width='40%'><div align=left><strong>Nombre:</strong> $rowx[PNOM_USU] $rowx[SNOM_USU] $rowx[PAPE_USU] $rowx[SAPE_USU]</strong></div></td>
					<input name=nom type=hidden  value=$rowx[PNOM_USU] $rowx[SNOM_USU] $rowx[PAPE_USU] $rowx[SAPE_USU]  size='20'>
					<input name=ape type=hidden  value=$rowx[PAPE_USU]$rowx[SAPE_USU] size='20'>"; 
					
					//edad
					
					$edad=calculaedad2($rowx['FNAC_USU'],$unidad);
					echo "<td class=Estilo7 width='10%'><div align=left><strong>Edad: </strong>$edad $unidad</div></td>
					<input name=edad_usu type=hidden value=$edad size='3' maxlength='3'>
		            <input name=uni_med type=hidden value=$unidad>";
		        
					echo"<td class=Estilo7 width='10%'><div align=left><strong>Genero:</strong> $rowx[SEXO_USU]</div></td>
			        <input name=gen_usu type=hidden value=$rowx[SEXO_USU] size='3' maxlength='3'> ";   
					
					echo"<td class=Estilo7 width='15%'><div align=left><strong>Contrato:</strong> $rowx[NEPS_CON]</div></td>
				         <input name=tipusu type=hidden  value=$rowx[NEPS_CON] size='10' >";
						 
					echo"<td class=Estilo7 width='15%'><div align=left><strong>";
						 
					
					if($ser=='0680'||$ser=='0681'|| $ser=='0682')
					{
					 echo "<tr><td class=Estilo7><div align=left><strong>Ambito:</strong> Hospitalario</div></td>
					 <input type=hidden name=amb_usu value=2>";
					}
					
					if($ser=='0634')
					{
					 echo "<tr><td class=Estilo7><div align=left><strong>Ambito:</strong> Urgencias</div></td>
					 <input type=hidden name=amb_usu value=3>";
					}
					if(empty($ser))
					{
					 echo "<tr><td class=Estilo7><div align=left><strong>Ambito:</strong> Ambulatorio</div></td>
					 <input type=hidden name=amb_usu value=1>";
					}
					
					$var_med='cod_medi'.$item1.$item2;
					$cod_medi=$$var_med;
					
					echo"<input type=hidden name='codi_medi' value='$cod_medi'>";
					
					echo"<td class=Estilo7 width='15%'><div align=left><strong>Solicita:</strong> ";
					$consmed=mysql_query("SELECT medicos.cod_medi, medicos.nom_medi FROM medicos where medicos.cod_medi='$cod_medi' ORDER BY medicos.nom_medi");
				
					while ($row=mysql_fetch_array($consmed))
					{
						
						echo "$row[nom_medi]</div></td>";
					}
					
					echo"<td class=Estilo7 colspan=2><div align=left><strong>Fsolicitación:</strong>$gfec_ $ghor_</div></td>";
					
					
					?>
					        <td colspan='2' class="Estilo7"><strong>Fentrega:</strong>
							<?php echo "<span class='Estilo7'><input type=text name=fent id=fent size='10' value=$fec>*";?>
							<input type="button" id="lanzador2" value="..." />
							<!-- script que define y configura el calendario--> 
							<script type="text/javascript"> 
						     Calendar.setup({ 
							inputField     :    "fent",     // id del campo de texto 
							ifFormat     :     "%Y/%m/%d",     // formato de la fecha que se escriba en el campo de texto 
							button     :    "lanzador2"     // el id del botón que lanzará el calendario 
							}); 
							</script> 
						<?	
					echo"<span class=Estilo7><strong>Hora:</strong> <input type=text name=mine size=6 value=$hor></td></tr>";
					
					echo"</tr><tr><td class=Estilo7 ><div align=left><strong>Condicion de Usuario:</strong></div></td>
				        <td class=Estilo7>";
						$sex=$rowx["SEXO_USU"];
						 if ($sex=='M'){
							echo "Ninguna";
							}
							
						else{
							echo"<select name=con_usu class=Estilo7>";
							echo "<option> Ninguna</option>";
							echo "<option> Primer Trimestre Embarazo</option>";
							echo "<option> Segundo Trimestre Embarazo</option>";
							echo "<option> Tercer Trimestre Embarazo</option>";
							echo "<option> No Embarazada</option>
							</select></td>";
							
							}
		  			
						echo"
					    <td><span class=Estilo7><div align=left><strong>Programa:<strong></div></td>
				        <td><select name=pro_usu span class=Estilo7>
						<option>  </option>
						<option> Materna Post Parto</option>
						<option> Recien Nacidos</option>
						<option> Adulto Joven</option>
						<option> Materna Control</option>
						<option> Adultos Mayores</option>
						</select></div></td>
					    
					    <td colspan=2><span class=Estilo7 ><strong>Finalidad:</strong>
						<select name=fin_usu span class=Estilo7>
						<option> </option>
						<option> 04</option>
						</select></div></td></tr><table> ";
					
					}
					//segunda Tabla de Examenes 
					
					echo "<br><table border='1' bgcolor='#FFFFFF' bordercolor='#D0D0F0' width='100%' align='center' cellpadding='0' cellspacing='1'>";
					echo "<tr bgcolor=#D0D0F0>
					<td height=10 width='5%'><div align=center class=Estilo6>OP</div></td>
					<td height=10 width='5%'><div align=center class=Estilo6>Cups</div></td>
					<td height=10 width='60%'><div align=center class=Estilo6>Descripción</div></td>
					<td height=10 width='10%'><div align=center class=Estilo6>Resultado</div></td>
					<td height=10 width='10%'><div align=center class=Estilo6>Referencia</div></td>
					<td height=10 width='10%'><div align=center class=Estilo6>Unidades</div></td></tr>";	
					
					$consdes=mysql_query("SELECT usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, hist_var.fech_var, cups.descrip, cups.codigo, cups.refe_cup, cups.unlab_med ,hist_evo.cod_medi,  hist_var.hora_var
									FROM (contrato INNER JOIN ucontrato ON contrato.CODI_CON = ucontrato.CONT_UCO) INNER JOIN (cups INNER JOIN (((hist_evo INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo)
									INNER JOIN (ingreso_hospitalario INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) ON hist_evo.codi_usu = usuario.CODI_USU) 
									INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) ON cups.codigo = hist_var.iden_ser) ON ucontrato.CUSU_UCO = usuario.CODI_USU
									WHERE (((hist_var.fech_var)='$gfec_') AND ((usuario.NROD_USU)='$cod_usu') AND ((cups.tipo)='1803') AND ((hist_traza.horas_tra)=-1) AND ((hist_traza.ubica_tra)=$ser) 
									AND ((hist_traza.horas_tra)=-1) AND ((hist_var.esta_var)='SO') AND ((ucontrato.ESTA_UCO)='AC'))
									ORDER BY hist_var.fech_var desc");
									
									
									//echo $consdes;
									$m=0;
									while($rowdes=mysql_fetch_array($consdes))
									{
									  $cod=$rowdes['codigo'];
									  $desc=substr($rowdes['descrip'],0,70);			  
									 
									  $nom_var0='obs_'.$m;
									  //$val_obs=;
									  
									  $nom_var1='ref_'.$m;
									  $val_ref=$rowdes[refe_cup];
									  
									  $nom_var2='unid_'.$m;
									  $val_uni=$rowdes[unlab_med];
									  
									  echo "<tr>";
									  echo "<td></td>";
									  echo "<td class=Estilo7>$cod <br></td>";
									  echo "<td class=Estilo7>$desc<br></td>";
									  echo "<td class=Estilo7><input type=text name=$nom_var0 size=7></td>";
									  echo "<td class=Estilo7><input type=text name=$nom_var1  value='$val_ref' size=7></td>";
									  echo "<td class=Estilo7><input type=text name=$nom_var2 value='$val_uni' size=7></td>";
									  echo "</tr>";
									  $m++;
									}
									echo "<input type=hidden name=itm  value='$m'>";
								

									if(empty($vadif)) $vadif=0;
									$contu=0;
									while($contu==$vadif)
									{
										echo "vadif".$vadif+1;
										echo "contu".$contu.'<br>';
										if($vadif<=$contu)
										{
										echo "<td><a href='#' onclick='elimina()'><img hspace=0  src='icons\feed_delete.png' alt='Eliminar'  border=0 align='center'></a>";
										echo " <a href='#' onclick='adiciona()'><img hspace=0  src='icons\feed_edit.png' alt='Adicionar'  border=0 align='center'> </a></td>";
										$nom_var3='codi_cir'.$contu;
										$codi_cir=$$nom_var3;
										echo "<td class='Estilo7'>$codi_cir<input type=text name=$nom_var3 size=6 maxlength=6  value=$codi_cir>";
										echo "<a href='#' onclick='enviar()'><img hspace=0 width=15 height=15 src='icons\bus.gif' alt='Buscar' border=0 align='center'></a></td>";
										}
										else
										{
										$nom_var3='codi_cir'.$contu;
										$codi_cir=$$nom_var3;
										echo "<td></td><td>$codi_cir</td>";
										}
										
										
										echo "<td class='Estilo7'>";
										$consmap=mysql_query("SELECT iden_tar, codigo, descrip,tipo,refe_cup,unlab_med FROM cups WHERE codigo='$codi_cir'");
										$rowp=mysql_fetch_array($consmap);
										
										echo "$rowp[descrip]</td>";
										
										$nom_var4='obs_exa'.$contu;
										$obs_exa=$$nom_var4;
										echo "<td class='Estilo7' aling=center><input type=text name=$nom_var4 size=7   value='$obs_exa'></td>";
										
										$nom_var5='refe_cup'.$contu;
										$refe_cup=$$rowp[refe_cup];
										echo "<td class='Estilo7'><input type=text name=$nom_var5 size=7 value ='$refe_cup'>";
										
										$nom_var6='unlab_med'.$contu;
										$unlab_med=$$rowp[unlab_med];
										
										echo "<td class='Estilo7'><input type=text name=$nom_var6  size=7 value='$unlab_med'></td></tr>";
										$contu=$contu+1;
									}
									$vadif=$contu;
									echo "<input type=hidden name=vadif  value='$vadif'>";
									//echo "<tr><td class='Estilo7'><a href='#' onclick='validag()'><img hspace=0  src='icons\feed_disk.png' alt='Guardar' border=0 align='center'></a></td>";
									
					echo"</tr></td></table>";
				}
	

			  else
					{
					
						echo "<br>La Identificacion : $usu ";
						echo " \n";
			            echo "¡ El Usuario No esta en la base de Datos o pertenece a otro contrato !";
			            
			        }
		}
		else
					{
					
						echo "<br>La factura : $num_fac ";
						echo " \n";
			            echo "¡ La Factura ya existe !";
			            
			        }
		
		

?>

</form>
</body>
</html>