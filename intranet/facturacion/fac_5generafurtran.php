<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='JavaScript'>

</script>
</head>
<body>
<form name='form1' method="POST" action='' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Validación de F U R T R A N</td></tr></table>
<?
set_time_limit(0);
include('php/conexion.php');
include('php/funciones.php');
$error=0;
echo "<table class='Tbl0' border='0'>";
echo "<th class='Th0' width='5%'>Sel</th>
      <th class='Th0' width='10%'>Concepto</th>
      <th class='Th0' width='60%'>Error</th>";
$consulta="SELECT rec.radant_rec,rec.resp_rec,rec.tipeve_rec,rec.dire_rec,rec.muni_rec,rec.zona_rec,rec.fectra_rec,rec.hortra_rec,rec.codips_rec,rec.totfol_rec,
    vic.tdoc_vic,vic.ndoc_vic,vic.pnom_vic,vic.snom_vic,vic.pape_vic,vic.sape_vic
    FROM ft_reclamacion AS rec
    INNER JOIN ft_victima AS vic ON vic.iden_rec=rec.iden_rec
    WHERE rec.iden_rec='$iden_rec1'";
echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
echo "</table>";

echo "<br><center><a href='fac_5creaplanofurtran.php?iden_rec1=$iden_rec1'><img src='icons/1273718947326355398.png' height='40' width='40' alt='Generar archivos planos'>Generar Archivos Planos</a></center>";

mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>

<?
function muetraerror($color_,$desc_){
	echo "<tr>";
	echo "<td class='Td2' align='center' bgcolor='$color_'><a href='fac_4heenviarips__.php?iden_fac=$idfac_&factura=$fac_&cpt=$cpt_'><img width=15 height=15 src='icons\feed_edit.png' alt='Ir a los rips de la factura' border=0></a></td>";
	echo "<td class='Td2' align='center' bgcolor='$color_'></td>";
	echo "<td class='Td2' align='left' bgcolor='$color_'>".$desc_."</td>";	
	echo "</tr>";
}
?>
