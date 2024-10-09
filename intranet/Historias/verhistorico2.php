<?
session_register('Garehci');

?>
<html>
<style type="text/css"> 
</style>
<head>
<SCRIPT LANGUAGE=JavaScript>
function Muestra()
{        
	uno.action='verhistorico2.php';
	uno.target='Frmh1a';
	uno.submit();		
	uno.action='historico2.php';
	uno.target='Frmh2a';
	uno.submit();
        if(document.uno.areac.value==03){            
            //uno.action='../hcmpv2/consultas_mat.php?iden_mat=$rowcit[iden_mat]';
            uno.action='historico3.php';
            uno.target='Frmh2a';
            uno.submit();
        }        
}
function salir()
{        
	if (event.keyCode == 13)
	{
		uno.action='verhistorico2.php';
		uno.target='Frmh1a';
		uno.submit();		
		uno.action='historico2.php';
		uno.target='Frmh2a';
		uno.submit();
	}
        if(document.uno.areac.value==03){            
            //uno.action='../hcmpv2/consultas_mat.php?iden_mat=$rowcit[iden_mat]';
            uno.action='historico3.php';
            uno.target='Frmh2a';
            uno.submit();
        }   
}
</SCRIPT>
<!--Hoja de estilos del calendario --> 
  <link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 
  <!-- librer?a principal del calendario --> 
 <script type="text/javascript" src="java/calendar/calendar.js"></script>
 <!-- librer?a para cargar el lenguaje deseado --> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
  <!-- librer?a que declara la funci?n Calendar.setup, que ayuda a generar un calendario en unas pocas l?neas de c?digo --> 
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
  <title><h6>PROGRAMA PARA EL MANEJO DE CITAS MEDICAS</h6></title>

</head>
<body  scroll = "no">
<form name="uno" method="post">
	<?
	set_time_limit(300);
	echo"<table border='0' cellpadding='0' cellspacing='0' style='border-collapse: collapse' width=100% align='center'>";
	//include('\appserv\www\intranet\Radica_old\Php\funciones.php');
	//include('\appserv\www\intranet\Radica_old\Php\conexion.php');
	include('php/funciones5.php');	
	include('php/conexion5.php');
	base_proinsalud();	
	echo"<td>NUMERO DE CEDULA <input type=text name=cedula onKeydown='salir()' value=$cedula>";	
	if(!empty($cedula))
	{
		$nusu=mysql_query("select * from usuario where NROD_USU ='$cedula'");	
		while($row=mysql_fetch_array($nusu))	
		{			
			$nombre=$row['PNOM_USU'].' '.$row['SNOM_USU'].' '.$row['PAPE_USU'].' '.$row['SAPE_USU'];
		}
	}
        
	echo "<td><select name='areac' onChange='Muestra();' >";
	echo "<option >--------"; 
	/*if($areac=='01' || $areac=='')
	{
		echo "<option value=01 selected>HISTORIA CLINICA</option>"; 
		echo "<option value=02>EVOLUCIONES</option>";                
	}
	if($areac=='02' )
	{
		echo "<option value=01>HISTORIA CLINICA</option>"; 
		echo "<option value=02 selected>EVOLUCIONES</option>";                
	}*/
        //echo "<option value=01>HISTORIA CLINICA</option>"; 
        echo "<option value=02 selected>EVOLUCIONES</option>";                
        echo "<option value=03>MATERNA</option>";
	echo"</select></td>"; 
	echo"<td>$cedula</td>";
	echo"<td>$nombre</td>";
	?>
        <script language="JavaScript">document.uno.areac.value='<?php echo $areac;?>';</script>
	</tr>
	</table>
</form> 
</body>
</html>
