<?
include("../uci/php/conexion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<HEAD>
 <TITLE>Selección de insumos</TITLE>
 <link rel="stylesheet" href="css/style.css" type="text/css" />
   <script languaje="javascript">
		function salir(ing)
		{
			uno.ingresoes.value=ing;
			uno.target='TOP';
			uno.action='../uci/escalas.php';
			uno.submit();		
		}
		function cambio()
		{
			
			uno.target='';
			uno.action='escalas_riesgo.php';
			uno.submit();		
		}
		function cambio1(k)
		{
			uno.ubica.value=k;			
			uno.target='';
			uno.action='escalas_riesgo.php';
			uno.submit();		
		}
		function cambio3()
		{
			if (event.keyCode == 13)
			{
				uno.target='';
				uno.action='escalas_riesgo.php';
				uno.submit();		
			}
		}
		
		
		
    </script>
</HEAD>
<BODY>
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
	<form name='uno' method='post'>	
	<input type=hidden name=ingresoes>
	<br><br>
	<table width=90%>	  
	<tr>         
	<td align=center>IDENTIFICACION <input type=text name=cedula inblur='cambio()' onKeydown='cambio3()' value='$cedula' ></td>
	</tr>
	</table>
	<br><br>";
	if(!empty($cedula))
	{

		$nusu=mysql_query("SELECT usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
		FROM usuario
		WHERE (((usuario.NROD_USU)='$cedula'))");
		if(mysql_num_rows($nusu))
		{
			while($rusu=mysql_fetch_array($nusu))
			{
				$nombre=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
				$usuario=$rusu['CODI_USU'];
			}
			ECHO"<table width=90%>	  
			<tr>         
			<td align=center><b>$nombre</b><td>
			</tr>
			</table>
			<br><br>";
			
			$bing=mysql_query("SELECT ingreso_hospitalario.codius_ing, ingreso_hospitalario.id_ing, ingreso_hospitalario.fecin_ing, 
			ingreso_hospitalario.fecsa_ing
			FROM ingreso_hospitalario
			WHERE (((ingreso_hospitalario.codius_ing)='$usuario')) ORDER BY ingreso_hospitalario.fecin_ing DESC");
			if(mysql_num_rows($bing)>0)
			{
				ECHO"<table width=90%>
				<tr>
				<th>NUMERO DE INGRESO</th>
				<th>FECHA DE INGRESO</th>
				<th>FECHA DE SALIDA</th>
				<th>VER REGISTROS</th>
				</tr>";
				while($ring=mysql_fetch_array($bing))
				{
					$ingreso=$ring['id_ing'];
					$fechaing=$ring['fecin_ing'];
					$fechasal=$ring['fecsa_ing'];
					echo"
					<tr>         
					<td align=center> $ingreso</td>
					<td align=center> $fechaing</td>
					<td align=center> $fechasal</td>
					<td align=center> <a href='' onclick='salir($ingreso)'><img src='Img/feed_go.png'></a></td>
					</tr>";
					
				}
				echo"</table>";
			}
			else
			{
				echo "<center><h5>NO HAY REGISTROS DE HOSPITALIZACION</H5></center>";
			}
		}
		else 
		{
			echo "<center><h5>DOCUMENTO NO ENCONTRADO EN BASE DE DATOS</H5></center>";
		}
	}
?>
<form>
</BODY>
</HTML>
