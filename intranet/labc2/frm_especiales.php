<?
//session_register('Gcod_medico');
SET_TIME_LIMIT(0);
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head><title>Generación de Rips</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librería principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librería para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librería que declara la función Calendar.setup, que ayuda a generar un calendario en unas pocas líneas de código --> 
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
    alert("Para continuar debe digitar la siguiente información\n"+error);}
  else{
    form1.action='frm_especiales.php'
	//form1.target='area';
	form1.submit();}
}
function imprimir()
{

	form1.action='impr_especiales.php'
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
<table align='center' width="100%" border='0'>
  <tr>
    <td  width="12%" align='right'><b>Fecha Inicial:</b></td>
	<td  width="12%" align='left'>
	<!-- formulario con el campo de texto y el botón para lanzar el calendario--> 
    <? echo "<input type=text name=finicial value='".$finicial."' id=finicial size='10' maxlength='10' />*";?>
    <input type="button" id="lanzador1" value="..." />
    <!-- script que define y configura el calendario--> 
    <script type="text/javascript"> 
     Calendar.setup({ 
       inputField     :    "finicial",     // id del campo de texto 
       ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
       button     :    "lanzador1"     // el id del botón que lanzará el calendario 
     }); 
    </script> 
	</td>
	<td width="10%" align='right'><b>Fecha Final:</b></td>
	<td  width="10%" align='left'>
	<!-- formulario con el campo de texto y el botón para lanzar el calendario--> 
    <? echo "<input type=text name=ffinal value='".$ffinal."' id=ffinal size='10' maxlength='10' />*";?>
    <input type="button" id="lanzador2" value="..." />
    <!-- script que define y configura el calendario--> 
    <script type="text/javascript"> 
     Calendar.setup({ 
       inputField     :    "ffinal",     // id del campo de texto 
       ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
       button     :    "lanzador2"     // el id del botón que lanzará el calendario 
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
	
	<td  width="4%" align='left'><a href='#' onclick='valida()'><img src='icons/revisa.png'  width="20%"  height="12%"></a></td>
  </tr>
</table>
<?
				include('php/conexion.php');
			include('php/funciones.php');
		echo"<br>";
		echo"<table width=70%>";
		echo"<tr><th class=Th0 align='center'><STRONG>LABORATORIOS ESPECIALES</strong></td></tr>";
		echo"</table>";
			
		$con_esp=mysql_query("SELECT  us.NROD_USU, us.CODI_USU, us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU,us.FNAC_USU,dl.nord_dlab,el.dxo_labs,el.iden_labs 
				FROM detalle_labs AS dl
				INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
				INNER JOIN usuario AS us ON us.codi_usu = el.codi_usu
				INNER JOIN cups AS cp ON dl.codigo = cp.codigo
				WHERE el.fchr_labs = '$finicial' AND el.fchr_labs ='$ffinal'
				AND cp.grup_quim ='4606'
				GROUP BY dl.nord_dlab
				ORDER BY dl.nord_dlab");
		echo "<br>";
		echo"<table width=100%>";
			echo"<tr>";
			echo"<td class=Th0 align='center'><STRONG>Orden</strong></td>";
			echo"<td class=Th0 align='center'><STRONG>Identificacion</strong></td>";
			echo"<td class=Th0 align='center'><STRONG>Nombre</strong></td>";
			echo"<td class=Th0 align='center'><STRONG>Edad</strong></td>";
			echo"<td class=Th0 align='center'><STRONG>Dx</strong></td>";
			echo"<td class=Th0 align='center'><STRONG>Cups</strong></td>";
			echo"</tr>";
			
		while($row_=mysql_fetch_array($con_esp))
		{
			$nord_dlab=$row_[nord_dlab];
			$nrod_usu=$row_[NROD_USU];
			$nom_usu=$row_[PNOM_USU].' '.$row_[SNOM_USU].' '.$row_[PAPE_USU].' '.$row_[SAPE_USU];
			$edad=calculaedad($row_[FNAC_USU]);
			$examen=$row_[codigo];
			$dx=$row_[dxo_labs];
			$iden_labs=$row_[iden_labs];
			
			echo"<tr><td>$nord_dlab</strong></td>";
			echo"<td>$nrod_usu</strong></td>";
			echo"<td>$nom_usu</strong></td>";
			echo"<td>$edad</strong></td>";
			$consucie=mysql_query("SELECT nom_cie10 FROM cie_10 where cod_cie10='$dx'");
			
			  $rowcie=mysql_fetch_array($consucie);
			  $nom_cie=substr($rowcie[nom_cie10],0,60);
			  echo"<td>$nom_cie</td>";
			
			$conscup=mysql_query("SELECT cups.descrip
			FROM (detalle_labs INNER JOIN cups ON detalle_labs.codigo = cups.codigo) INNER JOIN destipos ON cups.grup_quim = destipos.codi_des
			WHERE detalle_labs.iden_labs='$iden_labs' AND cups.grup_quim ='4606'
			GROUP BY cups.descrip");
			if(mysql_num_rows($conscup)<>0)
			{
			  while($rowcod_=mysql_fetch_array($conscup))
				{
				  $descrip=substr($rowcod_[descrip],0,38);
				  echo"<tr><td></td><td></td><td></td><td></td><td></td>";
				  echo"<td>$descrip</td></tr>";
				}
			}
			echo"</tr>";
			
		}
		echo"</table>";
		echo"<table class='Tbl2' width='70%'>
		<tr>
		<td class='Td1'><a href='#' onclick='imprimir()'><img  width='20' height='20' src='icons\imp_espe.png' alt='Imprimir' border=0 align='center'>Imprimir</a></td>
		 </tr>
		</table>";
	?>

</form>

</body>
</html>