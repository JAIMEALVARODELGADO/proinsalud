<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<script language='javascript'>
function quitafac(nume_,iden_,rela_){
    //fac_3editenca.php?iden=$row[NROD_USU]&enti=$row[CODI_CON]&idefac=$row[iden_fac]&cotr=$row[iden_ctr]
    //alert(iden_);
    if (confirm("Desea retirar la factura " +nume_)){
        location.href='fac_3quitafac.php?iden_fac='+iden_+'&relacion='+rela_;
    }
}
function finaliza(rela_){
    location.href="fac_3infmuescuenta.php?relacion="+rela_;
}
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<body>
<form name='form1' method="POST" action='fondo.php' target='fr02'>
<?
echo "<table class='Tbl0'><tr><td class='Td0' align='center'>LISTADO DE FACTURAS DE LA CUENTA Nro $relacion</td></tr></table><br>";
include('php/conexion.php');
include('php/funciones.php');
if(!empty($iden_fac)){
    //Aqui se quita el numero de relación de la factura
    $consulta="UPDATE encabezado_factura SET rela_fac='' WHERE iden_fac=$iden_fac";    
    $consulta=mysql_query($consulta);
    //$consulta="UPDATE cuenta_cobro );
    //$consulta=mysql_query($consulta);
}
$consulta="SELECT fac.iden_fac,fac.nume_fac,fac.fcie_fac,fac.vtot_fac,fac.vcop_fac,fac.pdes_fac,fac.vnet_fac,
usu.nrod_usu,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu,' ') AS nombre,
con.neps_con,ccion.nume_ctr
FROM encabezado_factura AS fac
INNER JOIN usuario AS usu ON usu.codi_usu=fac.codi_usu
INNER JOIN contratacion AS ccion ON ccion.iden_ctr=fac.iden_ctr
INNER JOIN contrato AS con ON con.codi_con=ccion.codi_con
WHERE fac.rela_fac='$relacion' ORDER BY fac.nume_fac";
//echo $consulta;
$consulta=mysql_query($consulta);
echo "<table class='Tbl0'>";
echo "<tr><th class='Th0' width='10%'>OPCIONES</th>
    <th class='Th0' width='10%'>FACTURA</th>
    <th class='Th0' width='10%'>IDENTIFICACION</th>
    <th class='Th0' width='30%'>NOMBRE</th>
    <th class='Th0' width='10%'>CONTRATO</th>
    <th class='Th0' width='10%'>FECHA</th>
    <th class='Th0' width='10%'>VALOR</th>
    <th class='Th0' width='10%'>ESTADO</th>";
$total=0;
while($row=mysql_fetch_array($consulta)){
    $fecf_fac=cambiafechadmy($row[fecf_fac]);
    echo "<tr>";
    echo "<td class='Td2' align='center'><a href='#' onclick=quitafac('$row[nume_fac]',$row[iden_fac],'$relacion')><img src='icons/feed_delete.png' border='0' alt='Quitar la Factura de la Cuenta'></a></td>";
    echo "<td class='Td2'>$row[pref_fac] $row[nume_fac]</td>";
    echo "<td class='Td2'>$row[nrod_usu]</td>";
    echo "<td class='Td2'>$row[nombre]</td>";
    echo "<td class='Td2'>$row[neps_con] $row[nume_ctr]</td>";
    echo "<td class='Td2'>".cambiafechadmy($row[fcie_fac])."</td>";
    echo "<td class='Td2' align='right'>$row[vnet_fac]</td>";
    $estado='';
    //echo $row[anul_fac];
    if($row[esta_fac]=='1'){
        $estado='Abierta';
        $colorest='#00CC00';
    }
    else{
        $estado='Cerrada';
        $colorest='#006666';
    }
    if($row[anul_fac]=='S'){
        $estado='Anulada';
        $colorest='#ff0033';
    }
    echo "<td class='Td2'><font color='$colorest'>$estado</font></td>";
    echo"</tr>";
    $total+=$row[vnet_fac];
}

mysql_free_result($consulta);
mysql_close();
?>
<tr>
    <td class='Td2' align='right' colspan="6"><b>Total</td>
    <td class='Td2' align='right'><b><?echo $total;?></td>
</tr>
</table>
<?
  echo "<table class='Tbl0'><tr><td class='Td1' align='center'><a href='#' onclick=finaliza('$relacion')><img src='icons/feed.png' border='0' alt='Finalizar'>Finalizar</a></td></tr></table><br>";
?>
</form>
</body>
</html>