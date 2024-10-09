<html>
<head>
<title></title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<SCRIPT LANGUAGE='JavaScript'>
//var x=screen.availWidth-350
//Windows.moveTo(x,60)

 function buscar(id,orden,cod)
 {
	//alert(orden);
	form1.estado.value=1;
	//form1.iden.value=id
	form1.ord_lab.value=orden;
	form1.cod.value=cod;
	//alert("Orden: "+form1.ord_lab.value);
	form1.action='hist_pac2.php';
	form1.target='';
	form1.submit();
 }

</script>
</head>
<?php

$link=Mysql_connect("localhost","root","");
if(!$link)echo"no hay conexion";
Mysql_select_db('proinsalud',$link);


echo "<form name=form1 method=post action=hist_pac.php target=''>";
echo "<table border=1 class='Tbl1'>";
echo "<tr><td colspan=6 class='Td1'>Resultados de Examenes<td></tr>";

echo"<tr class='Td1'><td>Orden</td>";
echo"<td>Fecha</td>";
echo"<td>Descripción</td>";
echo"<td>Resultados</td>";
echo"<td>Unidades</td>";
echo"<td>Referencia</td></tr>";

$conexat=Mysql_query("SELECT el.fche_labs, el.hrar_labs, dl.iden_labs, cp.descrip,dl.obsv_dlab,dl.refe_dlab, dl.unid_dlab,dl.nord_dlab,dl.codigo  
FROM encabezado_labs AS el
INNER JOIN detalle_labs AS dl ON el.iden_labs = dl.iden_labs
INNER JOIN cups AS cp ON dl.codigo = cp.codigo
WHERE el.codi_usu ='$codusu' AND dl.estd_dlab = 'CU' order by el.fche_labs DESC");

echo"<input type=hidden name=codusu value='$codusu'>";
if(mysql_num_rows($conexat)<>0)
{
	while($rowex=mysql_fetch_array($conexat))
	{
		$iden=$rowex[iden_labs];
		$cod=$rowex[codigo];
		$ord=$rowex[nord_dlab];
		//echo"<input type=hidden name=iden_labs value='$rowex[iden_labs]'>";
		$desc=substr($rowex[descrip],0,30);
		echo"<tr><td>$rowex[nord_dlab]</td>";
		echo"<td>$rowex[fche_labs]- $rowex[hrar_labs]</td>";
		echo"<td><font face=arial size=1>$desc</font></td>";
		echo"<input type=hidden name=obsv_dlab value=$rowex[obsv_dlab]>";
		if(($rowex[obsv_dlab]=='F') OR ($rowex[obsv_dlab]=='f') )
		{
			
			echo"<td><a href='#' onclick='buscar($iden,\"$ord\",$cod)'>$rowex[obsv_dlab]</a></td>";
		
		}
		else
		{
		
			echo"<td>$rowex[obsv_dlab]</td>";
		
		}
		echo"<td><input type=hidden name=unid_dlab value='$rowex[unid_dlab]'>$rowex[unid_dlab]</td>";
		echo"<td><input type=hidden name=refe_dlab value=$rowex[refe_dlab]>$rowex[refe_dlab]</td></tr>";
		
	}
}
else
		echo"<td colspan=6>El Paciente no posee Historico</td></tr>";

echo "</table>";
echo "<input type=hidden name='estado' value=$estado>";
echo "<input type=hidden name='iden' value=$iden>";
echo "<input type=hidden name='cod' value=$cod>";
echo "<input type=hidden name='ord_lab' value='$ord'>";


?>
</form>
</body>
</html>
