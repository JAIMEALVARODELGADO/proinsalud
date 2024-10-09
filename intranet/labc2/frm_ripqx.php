<?
//session_register('Gcod_medico');
SET_TIME_LIMIT(0);
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>Generaci�n de Rips</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librer�a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<link rel="stylesheet" href="css/style.css" type="text/css" />
<style>

#divMenu {font-family:arial,helvetica; font-size:12pt; font-weight:bold}
#divMenu a{text-decoration:none;}
#divMenu a:hover{color:red;}
</style>

<script language="javascript">
function valida()
{
  
  var error='';
  if(form1.finicial.value==''){
    error=error+"Fecha inicial\n";}
  if(form1.ffinal.value==''){
    error=error+"Fecha Final\n";}
  if(error!=''){
    alert("Para continuar debe digitar la siguiente informaci�n\n"+error);}
  else{
	form1.control.value=1;
    form1.action='frm_ripqx.php'
	//form1.target='area';
	form1.submit();}
}
function imprimir()
{
	//form1.control.value=1;
	form1.action='frm_ripqx.php'
	form1.target='area';
	form1.submit();


}
</script>

</head>

<body background="img/fondo_a.jpg">
<FORM name="form1" METHOD="POST" ACTION="frm_especiales.php">

<br><br>
<table width="70%">
   <tr><td class="Th0" align='center'><STRONG>GENERACION DE RIPS</strong></td></tr>
 </table>
<br><br>
<table align='center' width="40%" border='1'>
  <tr>
    <td  width="12%" align='right'><b>Fecha Inicial:</b></td>
	<td  width="12%" align='left'>
	<!-- formulario con el campo de texto y el bot�n para lanzar el calendario--> 
    <? echo "<input type=text name=finicial value='".$finicial."' id=finicial size='10' maxlength='10' />*";?>
    <input type="button" id="lanzador1" value="..." />
    <!-- script que define y configura el calendario--> 
    <script type="text/javascript"> 
     Calendar.setup({ 
       inputField     :    "finicial",     // id del campo de texto 
       ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
       button     :    "lanzador1"     // el id del bot�n que lanzar� el calendario 
     }); 
    </script> 
	</td>
	<td width="10%" align='right'><b>Fecha Final:</b></td>
	<td  width="10%" align='left'>
	<!-- formulario con el campo de texto y el bot�n para lanzar el calendario--> 
    <? echo "<input type=text name=ffinal value='".$ffinal."' id=ffinal size='10' maxlength='10' />*";?>
    <input type="button" id="lanzador2" value="..." />
    <!-- script que define y configura el calendario--> 
    <script type="text/javascript"> 
     Calendar.setup({ 
       inputField     :    "ffinal",     // id del campo de texto 
       ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
       button     :    "lanzador2"     // el id del bot�n que lanzar� el calendario 
     }); 
    </script>
	</td>
	<?
	/*	echo"<td class='Td2' width='5%' align='left'><strong>RIPS</td><td  width=140 align=center>";
		echo"<select name='esta_ncf' onchange='busca()'>";
		echo "<option value='2'>Rips Digitados Consulta</option>";
		echo "<option value='3'>Rips Digitados Procedimientos</option>";
		echo  "</select></td>";*/
				
	?><!--<script language=javascript>form1.esta_ncf.value="<?//echo $esta_ncf?>";</script>-->
	
	<td  width="4%" align='left'><a href='#' onclick='valida()'><img src='icons/feed_magnify.png'  width="15"  height="15"></a></td>
  </tr>
</table>
<?
	if($control==1)
	{
		include('php/conexion.php');
		include('php/funciones.php');
		echo"<br>";
		echo"<table width=70%>";
		echo"<tr><th class=Th0 align='center'><STRONG>Rips de Quirófano</strong></td></tr>";
		echo"</table>";
		
		/*$conspro="SELECT encabezado_qx.iden_qxf, usuario.TDOC_USU, usuario.NROD_USU, encabezado_qx.fech_qxf,  detalle_cirujia.ccup_cir, 
		encabezado_qx.ambi_qxf, encabezado_qx.fina_qxf, encabezado_qx.dxpe_cir, encabezado_qx.ctro_usu ,usuario.MATE_USU,usuario.MRES_USU, 
		encabezado_qx.ccir_qxf AS medrea, usuario.TPAF_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.ZONA_USU,
		encabezado_qx.hini_qxf, encabezado_qx.fech_qxf, encabezado_qx.fech_qxf,encabezado_qx.fina_qxf,cups.codi_cup
		FROM ((contrato INNER JOIN (usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) 
		ON contrato.CODI_CON = ucontrato.CONT_UCO) INNER JOIN encabezado_qx ON usuario.CODI_USU = encabezado_qx.iden_uco) 
		INNER JOIN (detalle_cirujia INNER JOIN cups ON detalle_cirujia.ccup_cir = cups.codigo) ON encabezado_qx.iden_qxf = detalle_cirujia.iden_qxf 
		WHERE (encabezado_qx.fech_qxf>= '$finicial' AND encabezado_qx.fech_qxf<= '$ffinal')";*/
		$conspro="SELECT iden_qxf, TDOC_USU, NROD_USU, fech_qxf, ccup_cir,COD_AMBITO,REGI_USU, COD_FINALI, dxpe_cir, ctro_usu , MATE_USU, MRES_USU, 
		ccir_qxf, TPAF_USU, FNAC_USU,TRUNCATE((DATEDIFF(fech_qxf,FNAC_USU))/365.25,0) AS edad, SEXO_USU, ZONA_USU,hini_qxf, fech_qxf, fech_qxf, codi_cup
		FROM vista_quirofano_detalle 
		WHERE (fech_qxf between '$finicial' AND '$ffinal')";
		//echo "<br>".$conspro;
		$consulpro=mysql_query($conspro);
		if(mysql_num_rows($consulpro)){
			$datos="";
			while($rowcon=mysql_fetch_array($consulpro)){
				$datos=$datos.$rowcon[iden_qxf].","; 
				$datos=$datos."520010066901,";
				$datos=$datos.$rowcon[TDOC_USU].",";
				$datos=$datos.$rowcon[NROD_USU].",";
				$datos=$datos.cambiafechadmy($rowcon[fech_qxf]).",";
				$datos=$datos.",";
				$datos=$datos.$rowcon[codi_cup].",";
				$datos=$datos.$rowcon[COD_AMBITO].",";
               	$datos=$datos.$rowcon[COD_FINALI].",";
				$datos=$datos.",";
				$datos=$datos.$rowcon[dxpe_cir].",";
				$datos=$datos.",,,0,,,,,,,,,0,";
				if($rowcon[ctro_usu]=='002'){$datos=$datos."003,";} //Cambio el contrato, cuando es 002 lo paso a 003  
				else{$datos=$datos.intval($rowcon[ctro_usu]).",";}
				$datos=$datos.substr($rowcon[MATE_USU],0,2).",";
				$datos=$datos.substr($rowcon[MATE_USU],2,3).",";
				$consmres=mysql_query("SELECT codi_mun FROM municipio WHERE nomb_mun='$rowcon[MRES_USU]'");//Consulto el cdigo del municipio de residencia
				$rowmres=mysql_fetch_array($consmres);
				$datos=$datos.substr($rowmres[codi_mun],2,3).",";
				//$datos=$datos.$rowcon[ccir_qxf].",";
				$cmdcir=mysql_query("SELECT iden_qx,tipp_qx,codp_qx,esta_per FROM personal_qx WHERE iden_qx='$rowcon[iden_qxf]' AND tipp_qx='6101' AND esta_per='A'");
				//echo $cmdcir;
				$rowmed=mysql_fetch_array($cmdcir);
				//$ccir_qxf= $rowmed[codp_qx];
				$datos=$datos.$rowmed[codp_qx].",,,,";
				if($rowcon[TPAF_USU]=='C'){$datos=$datos."A,";}
				else{$datos=$datos."$rowcon[TPAF_USU],";}
				$datos=$datos.$rowcon[edad].",A,";
				$datos=$datos."$rowcon[SEXO_USU],";
				if($rowcon[REGI_USU]=='6'){$datos=$datos."1,";}
			  	else{$datos=$datos.$rowcon[REGI_USU].",";}
			  	$datos=$datos.$rowcon[ZONA_USU].",,";
			  	$datos=$datos.substr($rowcon[hini_qxf],0,5).",";
			  	$datos=$datos.",0,0,";
			  	$datos=$datos."Q,";
			  	$datos=$datos.cambiafechadmy($rowcon[fech_qxf]).",";
			  	$datos=$datos.cambiafechadmy($rowcon[fech_qxf]).",";
			  	$datos=$datos."SIMA";
                //echo "<br>".$datos;
			}
			  
			  $archivo="APQX.csv"; //ruta del archivo a generar 
			  //echo $archivo;
			  unlink($archivo);
			  $fp=fopen($archivo,"w");
			  //
			  fwrite($fp,$datos); 
			   
			  fclose($fp);
			  echo "<table><tr>
			  <td class='Td2' colspan=2 align='center'><br><br><b><font color=#3300FF>Los Archivos debe bajarse en Formato .txt</font></td>
			  </tr>
			  <tr>
			  <td class='Td2' width='10%' align='right'><a href='".$archivo."'><img hspace='8' width='20' height='20' src='img\feed_disk.png' alt='Generar Archivo' border=0></a></td>
			  <td class='Td2' width='90%' align='left'><a href='".$archivo."'><font color=#3300FF>ARCHIVO DE PROCEDIMIENTOS</font></a></td>
			  <tr>";  
		}
		echo "</table>";
	}
	echo"<input type=hidden name='control' value=$control>";
	?>

</form>

</body>
</html>