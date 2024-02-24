<?
session_register('gtipo_fac');
session_register('grela_fac');
session_register('gfeci_fac');
session_register('gfecf_fac');
session_register('gcod_cie');
session_register('gnom_cie');

if($control=='1'){
  $gtipo_fac=$tipo_fac;
  $grela_fac=$rela_fac;
  $gfeci_fac=$feci_fac;
  $gfecf_fac=$fecf_fac;
  $gcod_cie=$cod_cie10;
  $gnom_cie='';
}
if($control=='2'){
  $gcod_cie=$cod_cie;
  $gnom_cie=$nom_cie;
}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - PROFACTU</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<SCRIPT LANGUAGE=JavaScript>
function vaciar(){
form1.cod_cie.value='';
form1.nom_cie.value='';
}
function buscar(){
  form1.control.value='2';
  form1.submit();
}
</script>

</head>

<form name="form1" method="POST" action="fac_2busqc10.php" target='fr02'>
<body>
<table class="Tbl0"><tr><td class="Td0" align='center'>BUSQUEDA DE CIE 10</td></tr></table><br>
<?
include('php/conexion.php');
?>
<center><table class="Tbl0">
		<tr>
			    <td class='Td2' align='right'><b>Código:</td>
			    <td class='Td2'><input type="text" name="cod_cie" size="4" maxlength="4" onFocus="vaciar()" value=<?echo $gcod_cie;?>></td>
				<td class='Td2' align='right'><b>Nombre: </td>
				<td class='Td2' ><input type="text" name="nom_cie" size="15" onFocus="vaciar()" value=<?echo $gnom_cie;?>></td>
		    	<td class="Td2" align='left' width='10%'><a href='#' onclick='buscar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
		</tr></table>
		<?
include('php/conexion.php');
$condicion="";
	if(!empty($gcod_cie)){
	  $condicion=$condicion."cod_cie10  LIKE '%$gcod_cie%' AND ";}
	if(!empty($gnom_cie)){
	  $gnom_cie=trim($gnom_cie);
	  $condicion=$condicion."nom_cie10  LIKE '%$gnom_cie%' AND ";}
	if(!empty($condicion)){
	  $condicion=substr($condicion,0,(strlen($condicion)-5));}
	if(!empty($condicion)){
	  $_pagi_sql="SELECT  cod_cie10, nom_cie10, sex_cie10, inf_cie10, sup_cie10, grupo_vie10 FROM cie_10 WHERE $condicion ORDER BY  nom_cie10";}
	else{
	  $_pagi_sql="SELECT cod_cie10, nom_cie10, sex_cie10, inf_cie10, sup_cie10, grupo_vie10 FROM cie_10 ORDER BY  nom_cie10";}
	  
    $_pagi_cuantos = 15; 
	include("php/paginator.inc.php"); 

	if(mysql_num_rows($_pagi_result)!=0) 
	{ 
	  echo "<table class='Tbl0'>";
	  echo "<th class='Th0' width='10%'>OPCIONES</th>
	        <th class='Th0' width='15%'>CODIGO</font></th>
		    <th class='Th0' width='70%'>DESCRIPCION</font></th>";
	  while($row=mysql_fetch_array($_pagi_result))
	  {
		  echo "<tr>";
		  echo "<td><input name=codchk type=checkbox onclick=\"location.href='fac_2encapre.php?cod_cie10=$row[cod_cie10]&nom_cie10=$row[nom_cie10]'\"></td>";
		  echo "<td class='Td2'>$row[cod_cie10]</td>";
		  echo "<td class='Td2'>$row[nom_cie10]</td>";
		  echo"</tr>";
	  }
	  echo "</table>";
  
	  echo "<table class='Tbl2'>";
	  echo "<tr>";
      echo "<td class='Td1'>".$_pagi_navegacion."</td>";
  
	  echo "</tr>";
      echo "</table>";
    }
	else
	{
	  echo "<center>";
	  echo "<p class=Msg>No existen registros para esta busqueda</p>";
	  echo "</center>";
	}
	mysql_close();
?>
<input type='hidden' name='control'>
</form>
</body>
</html>
