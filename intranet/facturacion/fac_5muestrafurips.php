<html>
<head>
<title>PROGRAMA DE FACTURACIÓN - FURIPS</title>
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
<table class="Tbl0"><tr><td class="Td0" align='center'>LISTADO DE FURIPS</td></tr></table><br>
<?
include('php/conexion.php');
//echo "Copiar php/funciones.php";
?>
<table class="Tbl1" border="0">
    <th class="Th0" colspan="4">Opc</th>
    <th class="Th0">Numero</th>
    <th class="Th0">Fecha Evento</th>
    <th class="Th0">Factura</th>
    <th class="Th0">Identificacion</th>
    <th class="Th0">Nombre</th>
    <th class="Th0">Aseguradora</th>
    <th class="Th0">Vr. Recobro</th>
    <?php    
    $condicion="";
    if(!empty($nrod_usu)){
        $condicion=$condicion."usu.nrod_usu='$nrod_usu' AND ";
    }
    if(!empty($num_fac)){
        $condicion=$condicion."ef.nume_fac='$num_fac' AND ";
    }
    if(!empty($codi_con)){
        $condicion=$condicion."ef.codi_con='$codi_con' AND ";
    }           
    if(!empty($condicion)){
        $condicion=substr($condicion,0,strlen($condicion)-5);
        $condicion=" WHERE ".$condicion;
    }
    //echo "<br>".$condicion;    
    $consulta="SELECT rec.iden_rec,rec.fechoc_rec,rec.iden_fac,aten.totrec_ate,ef.nume_fac,
        usu.nrod_usu,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu) AS nombre,
        con.neps_con
        FROM fr_reclamacion AS rec
        INNER JOIN fr_atencion AS aten ON aten.iden_rec=rec.iden_rec
        INNER JOIN encabezado_factura AS ef ON ef.iden_fac=rec.iden_fac
        INNER JOIN contrato AS con ON con.codi_con=ef.codi_con
        INNER JOIN usuario AS usu ON usu.codi_usu=rec.codi_usu".$condicion;
    //echo "<br>".$consulta;
    $consulta=mysql_query($consulta);
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";
        echo "<td class='Td2' align='center'><a href='fac_5editfurips.php?iden_rec1=$row[iden_rec]'><img src='icons/feed_edit.png' border='0' alt='Editar' width=15 height=15></a></td>";
        echo "<td class='Td2' align='center'><a href='fac_5creadetfurips.php?iden_rec1=$row[iden_rec]'><img src='icons/feed_add.png' border='0' alt='Ir a los detalles' width=15 height=15></a></td>";
        echo "<td class='Td2' align='center'><a href='fac_5generafurips.php?iden_rec1=$row[iden_rec]'><img src='icons/feed_disk.png' border='0' alt='Genera Archivo Plano' width=15 height=15></a></td>";
        echo "<td class='Td2' align='center'><a href='fac_5prnfurips.php?iden_rec1=$row[iden_rec]' target='new'><img src='icons/feed_magnify.png' border='0' alt='Imprimir Formato' width=15 height=15></a></td>";
        echo "<td class='Td2' align='center'>$row[iden_rec]</td>";
        echo "<td class='Td2' align='center'>$row[fechoc_rec]</td>";
        echo "<td class='Td2' align='center'>$row[nume_fac]</td>";
        echo "<td class='Td2' align='left'>$row[nrod_usu]</td>";
        echo "<td class='Td2' align='left'>$row[nombre]</td>";
        echo "<td class='Td2' align='left'>$row[neps_con]</td>";
        echo "<td class='Td2' align='right'>$row[totrec_ate]</td>";
        echo "</tr>";
    }
    ?>
</table>
</form>
</body>
</html>
