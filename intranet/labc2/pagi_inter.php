<?set_time_limit (180);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML>
<HEAD>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--<meta http-equiv="Refresh" content="20"> Actualizar la pagina-->
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

 <TITLE>PACIENTES PENDIENTES DE TOMA DE MUESTRA</TITLE>
 <link rel="stylesheet" href="css/style.css" type="text/css" />
   <script language='Javascript'>
  
   function enviar()
	{
		
		uno.action='ing_externos.php';
		uno.submit();
	}
   
    </script>
</HEAD>
<BODY >

<?    	
	
		
	echo "<form name=uno method=post target=''>";

	echo"<table class='Tbl1'><tr><th class='Th0'>PACIENTES PENDIENTES / TOMA DE MUESTRA</th></tr></table>";
	
	echo"<table align=center border=0>
	<tr>";	
	echo 'usuario'.$codiusua.'citas'.$idcita;
	include('php/conexion.php');
	
		
			
                    $cons_ref=mysql_query("SELECT detareferencia.codi_dre, cups.descrip, cups.codigo,referencia.codi_cita,
					detareferencia.tipo_dre,detareferencia.alse_dre,referencia.msol_ref
					FROM referencia INNER JOIN (detareferencia INNER JOIN cups ON detareferencia.codi_dre = cups.codigo)
					ON referencia.idre_ref = detareferencia.idre_dre
					WHERE (((detareferencia.cita_dre)='$idcita'))
					GROUP BY detareferencia.codi_dre, cups.descrip, cups.codigo");
					
				//echo $cons_ref;
				$vl_ayd=0;
				while($rowdes=mysql_fetch_array($cons_ref))
				{
					$desc=$rowdes['descrip'];
					$cod=$rowdes['codigo'];
					$codi_cita=$rowdes['iden_cita'];
					$are_sol=$rowdes['alse_dre']; 
					$msol_ref=$rowdes['msol_ref'];
                                        //echo $are_sol;
					
					$area=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des=$are_sol");
					$sql_are=mysql_fetch_array($area);
					$nom=$sql_are[nomb_des];
				   
					$nomvar='selec'.$vl_ayd;									
                    echo "<input type=text name=$nomvar value=1>";

					$nomvar='cod'.$vl_ayd;
					echo"<input type=text name=$nomvar value=$cod>";
					
					$nomvar='area'.$vl_ayd;
					echo"<input type=text name=$nomvar value=$are_sol>";

					

					 $vl_ayd++;
				}
				echo "<input type=text name=fin value='$vl_ayd'>";
				
        echo"</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
		echo"<input type=text name='contrato' value='$ctr'>";
		echo "<input type=hidden name=idfin>";
		echo "<input type=hidden name=msol_ref value=$msol_ref>";
		echo "<input type=hidden name=codig_usu >";
		echo "<input type=text name=idcita value=$idcita>";
		echo "<input type=hidden name=ide_cita value='$ide_cita'>";
		echo "<input type=hidden name=m>";	
		echo "<input type=hidden name=n>";
        echo "<input type=hidden name=ite>";
		echo "<input type=hidden name=ar_ci>";
        echo "<input type=text name=cod_usu value='$codiusua'>";
		// echo "<input type=hidden name=esta_ncf>";
		echo"<body onload='enviar()'>";
?>
</BODY>
</HTML>