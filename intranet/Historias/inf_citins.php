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
		
		$med_cext=$_POST['med_cext'];
		$finicial=$_POST['finicial'];
		$ffinal=$_POST['ffinal'];
		
		$fecha=time();
		$fec_ing=date ("Y-m-d",$fecha);
		$hora=date ( "h:i:s" , $fecha ); 
		include('php/conexion2.php');
		include('php/funciones.php');
		echo"<br>";
		echo"<table width=100%>";
		echo"<tr><th class=Th0 align='center'><STRONG>LABORATORIOS FINALIDAD IV / PROGRAMA</strong></td></tr>";
		echo"</table>";
		
		if(!empty($med_cext)){
		$condicion=$condicion."medicos.cod_medi ='$med_cext' AND ";}
		else{
		$condicion=$condicion."(medicos.cod_medi = '11021685' OR medicos.cod_medi = '11021749' OR medicos.cod_medi = '1102171') AND ";}
		
		if(!empty($condicion)){
		$condicion=substr($condicion,0,(strlen($condicion)-5));}
		
		$conspro="SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.DIRE_USU, usuario.TRES_USU, medicos.nom_medi, 
		esta_cita.descrip_estaci, medicos.cod_medi, esta_cita.cod_estaci, citas.Hora_cita,usuario.FNAC_USU, usuario.SEXO_USU,areas.nom_areas,areas.cod_areas
		FROM medicos INNER JOIN (((horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN usuario ON citas.Idusu_citas = usuario.CODI_USU)
		INNER JOIN esta_cita ON citas.Esta_cita = esta_cita.cod_estaci) ON medicos.cod_medi = horarios.Cmed_horario
		INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
		WHERE ((esta_cita.cod_estaci='4') AND (citas.Fsolusu_citas >= '$finicial' AND citas.Fsolusu_citas <= '$ffinal') AND $condicion) ORDER BY citas.Hora_cita";
		
		
		//echo $conspro;
		$consulpro=mysql_query($conspro);
		if(mysql_num_rows($consulpro)<>0)
		{
			
			   echo "<table width=100% border=0 align='center'>
			  <tr><th class=Th0>Identificacion</td>
			  <th class=Th0>Nombre</td>
			  <th class=Th0>Edad</td>
			  <th class=Th0>Sexo</td>
			  <th class=Th0>Fecha</td>
			  <th class=Th0>Estado</td>
			  <th class=Th0>Servicio</td>
			  <th class=Th0>Medico</td>
			  </tr>";
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
				  $datos=$datos."$rowcon[Hora_cita],";
				  $datos=$datos."$rowcon[descrip_estaci],";
				  $datos=$datos."$rowcon[nom_medi],";
				  $datos=$datos."$rowcon[nom_areas],";
				  $datos=$datos."\n";
				 // echo $datos;

			  echo "<tr>
			  <td class='Td2'>$rowcon[NROD_USU]</td>
			  <td class='Td2'>$nombre</td>
			  <td class='Td2'>$edad</td>
			  <td class='Td2'>$rowcon[SEXO_USU]</td>
			  <td class='Td2'>$rowcon[Hora_cita]</td>
			  <td class='Td2'>$rowcon[descrip_estaci]</td>
			  <td class='Td2'>$rowcon[nom_medi]</td>
			  <td class='Td2'>$rowcon[nom_areas]</td>
			  </tr>";			  
			  
			 }
			  echo "</table>"; 
			  $archivo="AP.csv"; //ruta del archivo a generar 
			  //echo $archivo;
			  unlink($archivo);
			  $fp=fopen($archivo,"w");
			  //
			  fwrite($fp,$datos); 
			   
			  fclose($fp);
			  echo "<table width=50% border=0 align='center'>
			  <tr><td class='Td2' colspan=2 align='center'>
			  <a href='".$archivo."'><img hspace='8' width='20' height='20' src='img\feed_disk.png' alt='Generar Archivo' border=0></a>
			  <a href='".$archivo."'><font color=#3300FF align='center'>ARCHIVO PLANO</font></a></td><tr>";  
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