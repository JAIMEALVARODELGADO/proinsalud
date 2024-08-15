<? //echo $codi_cir;
 $gcodi_=$codi_cir;
 $gnom_=$nom_cir;
?>
<html>
<head>
<title>LABORATORIO CLINICO</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<SCRIPT LANGUAGE=JavaScript>
function vaciar(){
form1.codi_cir.value='';
form1.nom_cir.value='';
}
function buscar(){
  form1.control.value='2';
  form1.submit();
}
</script>

</head>

<form name="form1" method="POST" action="bus_labs.php">
<body>
<style type="text/css">
<!--
.Estilo11 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px; color: #333366;
}
.Estilo3 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; color: #333366;}
-->
</style>
<center><table class='Estilo11' border='1'>
		<BR><BR><BR><tr>
			    <td class='Estilo11' align='right'><b>Código:</td>
			    <td class='Estilo11'><input type="text" name="codi_cir" size="12" maxlength="12" onFocus="vaciar()" value=<?echo $gcodi_;?>></td>
				<td class='Estilo11' align='right'><b>Nombre: </td>
				<td class='Estilo11' ><input type="text" name="nom_cir" size="15" onFocus="vaciar()" value=<?echo $gnom_;?>></td>
		    	<td class='Estilo11' align='left' width='10%'><a href='#' onclick='buscar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>
		</tr></table>
<?
	echo "<input type=hidden name=nord_dlab value='$nord_dlab'>";
	echo "<input type=hidden name=iden_labs value=$iden_labs>";
	echo "<input type=hidden name=codusu value=$codusu>";
	mysql_connect("localhost","root",""); 
	mysql_select_db("PROINSALUD");
	$condicion="prmt_cup='13' AND esta_cup='AC' AND ";
	if(!empty($gcodi_)){
	  $condicion=$condicion."codigo  LIKE '%$gcodi_%' AND ";}
	if(!empty($gnom_)){
	  $gnom_=trim($gnom_);
	  $condicion=$condicion."descrip LIKE '$gnom_%' AND ";}
	if(!empty($condicion)){
	  $condicion=substr($condicion,0,(strlen($condicion)-5));}
	if(!empty($condicion)){
	  $_pagi_sql="SELECT iden_tar, codigo, descrip,tipo FROM cups WHERE $condicion ORDER BY descrip";}
	else{
	  $_pagi_sql="SELECT iden_tar, codigo, descrip,tipo FROM cups ORDER BY descrip";}
	  
    $_pagi_cuantos = 18 ; 
	include("php/paginator.inc.php"); 

	
	
	
	if(mysql_num_rows($_pagi_result)!=0) 
	{ 
	  echo "<table class='Estilo11' border='1' width='70%'>";
	  echo "<br><br><td class='Estilo3' width='5%'>OPC</th>
	        <td class='Estilo3' width='10%'>CODIGO</font></th>
		    <td class='Estilo3' width='55%'>DESCRIPCION</font></th>";
	  while($row=mysql_fetch_array($_pagi_result))
	  {
	  echo "<BR><BR><tr>";
		  echo "<td class='Estilo11'><input name=codchk type=checkbox onclick=\"location.href='edi_orden.php?codi_cir=$row[codigo]&codusu=$codusu&iden_labs=$iden_labs&nord_dlab=$nord_dlab'\"></td>";
	 	  echo "<td class='Estilo11'>$row[codigo]</td>";
		  echo "<td class='Estilo11'>$row[descrip]</td>";
		  echo"</tr>";
	  }
	  echo "</table>";
  
	  echo "<table class='Estilo11'>";
	  echo "<tr>";
      echo "<td class='Estilo11'>".$_pagi_navegacion."</td>";
  
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
<input type='hidden' name='vopc' value='<?echo $gvopc;?>'>
</form>
</body>
</html>
