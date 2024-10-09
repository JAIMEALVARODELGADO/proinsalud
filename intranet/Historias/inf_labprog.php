<?
//session_register('Gcod_medico');
SET_TIME_LIMIT(0);
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>Generacin de Rips</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<link rel="stylesheet" href="css/style.css" type="text/css" />
<style>

#divMenu {font-family:arial,helvetica; font-size:12pt; font-weight:bold}
#divMenu a{text-decoration:none;}
#divMenu a:hover{color:red;}
</style>


<body background="img/fondo_a.jpg">
<FORM name="form1" METHOD="POST" ACTION="frm_especiales.php">

<br><br>

<?
		
		$prog_lab=$_POST['prog_lab'];
		$finicial=$_POST['finicial'];
		$ffinal=$_POST['ffinal'];
		
		$fecha=time();
		$fec_ing=date ("Y-m-d",$fecha);
		$hora=date ( "h:i:s" , $fecha ); 
		include('php/conexion2.php');
		include('php/funciones.php');
		echo"<br>";
		echo"<table width=70%>";
		echo"<tr><th class=Th0 align='center'><STRONG>LABORATORIOS FINALIDAD IV / PROGRAMA</strong></td></tr>";
		echo"</table>";
		
		if(!empty($prog_lab)){
		$condicion=$condicion."encabezado_labs.prog_labs ='$prog_lab' AND ";}
		else{
		$condicion=$condicion."(encabezado_labs.prog_labs = '4' OR encabezado_labs.prog_labs = '5' OR encabezado_labs.prog_labs = '6') AND ";}
		
		if(!empty($condicion)){
		$condicion=substr($condicion,0,(strlen($condicion)-5));}
		
		$conspro="SELECT detalle_labs.nord_dlab, usuario.TDOC_USU, usuario.NROD_USU, encabezado_labs.fchr_labs, detalle_labs.codigo, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, 
		encabezado_labs.fina_labs, encabezado_labs.ctr_labs,usuario.MATE_USU,usuario.MRES_USU,detalle_labs.obsv_dlab,detalle_labs.refe_dlab,detalle_labs.unid_dlab, 
		detalle_labs.cod_medi AS medrea, encabezado_labs.cod_medi AS medsol, usuario.TPAF_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.ZONA_USU,
		detalle_labs.estd_dlab, encabezado_labs.hrar_labs, encabezado_labs.prog_labs, encabezado_labs.fche_labs, detalle_labs.fech_dlab, encabezado_labs.resp_labs
		FROM detalle_labs INNER JOIN encabezado_labs ON detalle_labs.iden_labs = encabezado_labs.iden_labs
		INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU
		INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO
		INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
		WHERE (encabezado_labs.fchr_labs >= '$finicial' AND encabezado_labs.fchr_labs <= '$ffinal') AND (detalle_labs.estd_dlab = 'CU' OR detalle_labs.estd_dlab = 'RE')
		AND encabezado_labs.fina_labs='4' AND $condicion ";
		
		
		//echo $conspro;
		$consulpro=mysql_query($conspro);
		if(mysql_num_rows($consulpro)<>0)
		{
			  $datos="";
			  while($rowcon=mysql_fetch_array($consulpro))
			  {
				  $nombre=$nom1usu=$rowcon['PNOM_USU'].' '.$rowcon['SNOM_USU'].' '.$rowcon['PAPE_USU'].' '.$rowcon['SAPE_USU']; 
				  $ejec=$fec_ing.' '.$hora;
				  $datos=$datos."$ejec,";
				  $datos=$datos."$rowcon[NROD_USU],";
				  $datos=$datos."$nombre,";
				  $unidad='';
				  $edad=calculaedad2($rowcon[FNAC_USU],$unidad);
				  $unidad=substr(ltrim($unidad),0,1);
				  $datos=$datos."$edad,";
				  $datos=$datos."$rowcon[SEXO_USU],";
				  $datos=$datos."$rowcon[prog_labs],";
				  if($rowcon[ctr_labs]=='002'){$datos=$datos."003,";} //Cambio el contrato, cuando es 002 lo paso a 003  
				  else{$datos=$datos.substr($rowcon[ctr_labs],1,2).",";}
				  $datos=$datos."$rowcon[codigo],";
				  $consmres=mysql_query("SELECT descrip  FROM cups WHERE codigo='$rowcon[codigo]'");//Consulto el cdigo del municipio de residencia
				  $rowmres=mysql_fetch_array($consmres);
				  $datos=$datos.substr($rowmres[descrip],0,15).",";
				  $valot=$valot+mysql_num_rows($consmres);
				  Mysql_free_result($consmres);
				  $datos=$datos."$rowcon[obsv_dlab],";
				  $datos=$datos."$rowcon[unid_dlab],";
				  $datos=$datos."$rowcon[refe_dlab],";
				  $datos=$datos."$rowcon[fchr_labs],";
				  $datos=$datos."\n";
				 // echo $datos;

			  }
			  $valt=$valt+$valot;
			  $archivo="AP.csv"; //ruta del archivo a generar 
			  //echo $archivo;
			  unlink($archivo);
			  $fp=fopen($archivo,"w");
			  //
			  fwrite($fp,$datos); 
			   
			  fclose($fp);
			  if ($prog_lab==4){ $dpro='(4) - Adulto Mayor';}
			  if ($prog_lab==5){ $dpro='(5) - HTA-DIAB-HIPER';}
			  if ($prog_lab==6){ $dpro='(6) - Obesidad';}
			  if ($prog_lab==''){ $dpro='(4)Adulto Mayor - (5)HTA-DIAB-HIPER - (6)Obesidad';}
			  echo "<br><br><table width=50% border=0 align='center'>
			  <tr><td class='Td2'>Fecha Ejecucion</td><td>$fec_ing / $hora</td>
			  <tr><td class='Td2'>Fecha Elaboracion</td><td>$finicial - $ffinal</td></tr>
			  <tr><td class='Td2'>Cantidad De Registros</td> <td>$valt</td></tr>
			  <tr><td class='Td2'>Programa</td><td>$dpro</td></tr>
			  <tr><td class='Td2' colspan=2 align='center'>
			  <a href='".$archivo."'><img hspace='8' width='20' height='20' src='img\feed_disk.png' alt='Generar Archivo' border=0></a>
			  <a href='".$archivo."'><font color=#3300FF align='center'>ARCHIVO PLANO</font></a></td><tr>";  
			  echo "</table>";
		}
			
		else
		{
			echo "<br><br><table width=50% border=0 align='center'>
			  <tr><td class='Td2' colspan=2><font color=#3300FF align='center'><b>No Existen Registros para esta Busqueda</td></tr></table>";
		}
	
	echo"<input type=hidden name='control' value=$control>";
	?>

</form>

</body>
</html>