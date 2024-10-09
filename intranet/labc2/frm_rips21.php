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
    form1.action='frm_rips21.php'
	//form1.target='area';
	form1.submit();}
}
function imprimir()
{
	//form1.control.value=1;
	form1.action='frm_rips21.php'
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
	
	<td  width="4%" align='left'><a href='#' onclick='valida()' title='Buscar'><img src='icons/feed_magnify.png'  width="15"  height="15"></a></td>
  </tr>
</table>
<?
	if($control==1)
	{
		include('php/conexion.php');
		include('php/funciones.php');
		echo"<br>";
		echo"<table width=70%>";
		echo"<tr><th class=Th0 align='center'><STRONG>LABORATORIOS ESPECIALES</strong></td></tr>";
		echo"</table>";
		
		/*$conspro="SELECT detalle_labs.nord_dlab, usuario.TDOC_USU, usuario.NROD_USU,encabezado_labs.fchr_labs, detalle_labs.codigo,
		encabezado_labs.ambi_labs, encabezado_labs.fina_labs, encabezado_labs.dxo_labs, encabezado_labs.ctr_labs,usuario.MATE_USU,usuario.MRES_USU, 
		detalle_labs.cod_medi AS medrea, encabezado_labs.cod_medi AS medsol, usuario.TPAF_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.ZONA_USU,
		detalle_labs.estd_dlab, encabezado_labs.hrar_labs, encabezado_labs.prog_labs, encabezado_labs.fche_labs, detalle_labs.fech_dlab, encabezado_labs.resp_labs,cups.codi_cup
		FROM detalle_labs INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs
		INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU
		INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO
		INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
                INNER JOIN cups ON detalle_labs.codigo = cups.codigo
		WHERE (encabezado_labs.fche_labs >= '2017-03-01' AND encabezado_labs.fche_labs<= '2017-03-31') AND (detalle_labs.estd_dlab = 'CU' OR detalle_labs.estd_dlab = 'RE')";*/
		$conspro="SELECT nord_dlab,TDOC_USU,NROD_USU,fchr_labs,codigo,ambi_labs, fina_labs, dxo_labs, ctr_labs,MATE_USU,MRES_USU,MED_REALIZA,MED_SOLICITA,espe_med, TPAF_USU,REGI_USU, FNAC_USU,TRUNCATE((DATEDIFF(fchr_labs,FNAC_USU))/365.25,0) AS edad, SEXO_USU, ZONA_USU,estd_dlab,hrar_labs, prog_labs, fche_labs, fech_dlab, resp_labs,codi_cup
		FROM vista_detalle_labs
		WHERE (fchr_labs between '$finicial' AND '$ffinal') AND (estd_dlab = 'CU' OR estd_dlab = 'RE')";
		//echo $conspro;
		$consulpro=mysql_query($conspro);
        //echo "<br>".mysql_num_rows($consulpro);
		if(mysql_num_rows($consulpro)){
			$datos="";
			while($rowcon=mysql_fetch_array($consulpro)){
				//echo "<br>".$rowcon[nord_dlab];
				$datos=$datos.$rowcon[nord_dlab].","; 
			  	$datos=$datos."520010066901,";
			  	$datos=$datos.$rowcon[TDOC_USU].",";
			  	$datos=$datos.$rowcon[NROD_USU].",";
			  	$datos=$datos.cambiafechadmy($rowcon[fchr_labs]).",,";
			  	$datos=$datos.$rowcon[codi_cup].",";
			  	$datos=$datos.$rowcon[ambi_labs].",";
			  	$datos=$datos.$rowcon[fina_labs].",";
			  	$datos=$datos.",";
			  	$datos=$datos.strtoupper($rowcon[dxo_labs]).",";
			  	$datos=$datos.",";
			  	$datos=$datos.",";
			  	$datos=$datos.",";
			  	$datos=$datos."0,";
			  	$datos=$datos."1,";
			 	$datos=$datos.",,,,,,,";
			  	$datos=$datos."0,";
				if($rowcon[ctr_labs]=='002'){$datos=$datos."003,";}
				else{$datos=$datos.intval($rowcon[ctr_labs]).",";}
				$datos=$datos.substr($rowcon[MATE_USU],0,2).",";
				$datos=$datos.substr($rowcon[MATE_USU],2,3).",";
				$datos=$datos.substr($rowcon[MATE_USU],2,3).",";

			  	/*$consmres=mysql_query("SELECT codi_mun FROM municipio WHERE nomb_mun='$rowcon[MRES_USU]'");//Consulto el cdigo del municipio de residencia
			  	$rowmres=mysql_fetch_array($consmres);
			  	$datos=$datos.substr($rowmres[codi_mun],2,3).",";
			  	Mysql_free_result($consmres);*/
			  	$datos=$datos.$rowcon[MED_REALIZA].",,";
			  	$datos=$datos.$rowcon[MED_SOLICITA].",";
			  	$datos=$datos.$rowcon[espe_med].",";
			  	if($rowcon[TPAF_USU]=='C'){$datos=$datos."A,";}
			  	else{$datos=$datos.$rowcon[TPAF_USU].",";}
			  	$datos=$datos.$rowcon[edad].",A,";
			  	$datos=$datos.$rowcon[SEXO_USU].",";
			  	if($rowcon[REGI_USU]=='6'){$datos=$datos."1,";}
			  	else{$datos=$datos.$rowcon[REGI_USU].",";}
			  	$datos=$datos.$rowcon[ZONA_USU].",,";
			  	$datos=$datos.substr($rowcon[hrar_labs],11,5).",";
			  	$datos=$datos.$rowcon[prog_labs].",";
			  	$datos=$datos."0,";
			  	$datos=$datos."0,";
			  	$datos=$datos."L,";
			  	$datos=$datos.cambiafechadmy($rowcon[fchr_labs]).",";
			  	$datos=$datos.cambiafechadmy($rowcon[fchr_labs]).",";
			  	$datos=$datos.$rowcon[resp_labs];
				$datos=$datos."\n";
				//echo "<br>".$datos;
			}
			  $archivo="AP.csv"; //ruta del archivo a generar 
			  //echo $archivo;
			  unlink($archivo);
			  $fp=fopen($archivo,"w");
			  //
			  fwrite($fp,$datos); 
			   
			  fclose($fp);
			  echo "<tr><td class='Td2' colspan=2 align='center'><br><br><b><font color=#3300FF>Los Archivos debe bajarse en Formato .txt</font></td></tr><tr><td class='Td2' width='10%' align='right'><a href='".$archivo."'><img hspace='8' width='20' height='20' src='img\feed_disk.png' alt='Generar Archivo' border=0></a></td>
						<td class='Td2' width='90%' align='left'><a href='".$archivo."'><font color=#3300FF>ARCHIVO DE PROCEDIMIENTOS</font></a></td><tr>";
		}
		echo "</table>";
	}
	echo"<input type=hidden name='control' value=$control>";
	?>

</form>

</body>
</html>