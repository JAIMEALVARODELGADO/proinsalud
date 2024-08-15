<html>
<head>
<title></title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<?php
$fecha=time();
$fec=date ("Y-m-d",$fecha);
$dias= 5; // los das a restar 
$fec2=date("Y-m-d", strtotime("$fec -$dias day"));



include('php/funciones.php');
include('php/conexion.php');


echo "<form name=form1 method=post  target=''>";
echo "<table border=1 class='Tbl0'>";
echo "<tr><td colspan=6 class='Td1'>Resultados de Examenes<td></tr>";

echo"<tr class='Td1'><td>Orden</td>";
echo"<td>Fecha</td>";
echo"<td>Descripcion</td>";
echo"<td>Resultados</td>";
echo"<td>Bacteriologo</td>
</tr>";

$conexat=mysql_query("SELECT el.fche_labs,dl.codigo,dl.cod_medi  ,el.hrar_labs, dl.iden_labs, cp.descrip,dl.obsv_dlab,dl.refe_dlab, dl.unid_dlab,dl.nord_dlab,dl.codigo  
FROM encabezado_labs AS el
INNER JOIN detalle_labs AS dl ON el.iden_labs = dl.iden_labs
INNER JOIN cups AS cp ON dl.codigo = cp.codigo
WHERE dl.codigo ='$cod_ante' AND dl.estd_dlab = 'CU' AND el.fche_labs>='$fec2' AND el.fche_labs<='$fec' AND el.codi_usu='$codi_usu'  order by el.fche_labs DESC");
//echo $conexat;
if(mysql_num_rows($conexat)<>0)
{
	while($rowex=mysql_fetch_array($conexat))
	{
		$iden=$rowex[iden_labs];
		$cod=$rowex[codigo];
		$ord=$rowex[nord_dlab];
                $cod_medi=$rowex[cod_medi];
		//echo"<input type=hidden name=iden_labs value='$rowex[iden_labs]'>";
		$desc=substr($rowex[descrip],0,30);
		echo"<tr><td>$rowex[nord_dlab]</td>";
		echo"<td>$rowex[fche_labs]- $rowex[hrar_labs]</td>";
		echo"<td><font face=arial size=1>$desc</font></td>";
		echo"<input type=hidden name=obsv_dlab value=$rowex[obsv_dlab]>";
		echo"<td>$rowex[obsv_dlab]</td>";
		$bact=mysql_query("SELECT nom_medi FROM medicos WHERE ced_medi='$cod_medi'");
                $row_bt=mysql_fetch_array($bact);
                echo"<td>$row_bt[nom_medi]</td></tr>";
		
	}
}
else
    echo"<td colspan=6>El Paciente no posee Historico De ese Examen </td></tr>";
echo "</table>";
echo "<input type=hidden name='estado' value=$estado>";
echo "<input type=hidden name='iden' value=$iden>";
echo "<input type=hidden name='cod' value=$cod>";
echo "<input type=hidden name='ord_lab' value='$ord'>";
echo "</form>";


?>
</body>
</html>
