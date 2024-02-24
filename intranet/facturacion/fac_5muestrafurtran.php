<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - FURTRAN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<SCRIPT LANGUAGE=JavaScript>
function envio(apli){
    form1.action=apli;
    form1.target='fr02';
    form1.submit();
}

function nuevo(){
    form1.action='fac_5creafurips.php';
    form1.target='fr02';
    form1.submit();
}
</script>
</head>

<form name="form1" method="POST" action="" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>LISTADO DE FURTRAN</td></tr></table><br>
<?
include('php/funciones.php');
include('php/conexion.php');
$condicion="";
if(!empty($numero_rec)){
    $condicion=$condicion."iden_rec='$numero_rec' AND ";
}
if(!empty($fecha_rec)){
    $fecha_rec=cambiafecha($fecha_rec);
    $condicion=$condicion."fectra_rec='$fecha_rec' AND ";
}
if(!empty($condicion)){
    $condicion=SUBSTR($condicion,0,STRLEN($condicion)-5);
    $condicion=' WHERE '.$condicion;
}
$consulta="SELECT * FROM ft_reclamacion".$condicion;
//echo $consulta;
$consulta=mysql_query($consulta);
?>
<table class="Tbl1" border="0">
    <th class="Th0" colspan="3">Opc</th>
    <th class="Th0">Numero</th>
    <th class="Th0">Fecha de Traslado</th>
    <th class="Th0"></th>
    <th class="Th0"></th>
    <th class="Th0"></th>
    <th class="Th0"></th>
    <th class="Th0"></th>
    <?php
        while($row=mysql_fetch_array($consulta)){
            $fectra_rec=cambiafechadmy($row[fectra_rec]);
            echo "<tr>";
            echo "<td class='Td2' align='center'><a href='fac_5editfurtran.php?iden_rec1=$row[iden_rec]'><img src='icons/feed_edit.png' border='0' alt='Editar' width=15 height=15></a></td>";            
            echo "<td class='Td2' align='center'><a href='fac_5generafurtran.php?iden_rec1=$row[iden_rec]'><img src='icons/feed_disk.png' border='0' alt='Genera Archivo Plano' width=15 height=15></a></td>";
            echo "<td class='Td2' align='center'><a href='fac_5prnfurtran.php?iden_rec1=$row[iden_rec]' target='new'><img src='icons/feed_magnify.png' border='0' alt='Mirar' width=15 height=15></a></td>";
            echo "<td class='Td2' align='center'>$row[iden_rec]</td>";
            echo "<td class='Td2' align='center'>$fectra_rec</td>";
            echo "<td class='Td2' align='left'></td>";
            echo "<td class='Td2' align='left'></td>";
            echo "<td class='Td2' align='left'></td>";
            echo "<td class='Td2' align='left'></td>";
            echo "<td class='Td2' align='left'></td>";
            echo "</tr>";
        }
    ?>
</table>
</form>
</body>
</html>
