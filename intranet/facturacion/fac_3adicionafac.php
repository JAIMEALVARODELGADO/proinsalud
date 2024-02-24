<html>
<head>
<title>PROGRAMA DE FACTURACIN</title>
<script language='javascript'>
function buscar(){
    if(document.form1.factura.value=='' && document.form1.fecha.value==''){
        alert("Debe seleccionar al menos uno de los parmetros de bsqueda");        
    }
    else{
        document.form1.submit();
    }
}

function adicionafac(){
    if (confirm("Desea adicionar las facturas seleccionadas?")){
        //document.form1.iden_fac.value=iden_;
        document.form1.submit();
    }
}

function finaliza(rela_){
    location.href="fac_3infmuescuenta.php?relacion="+rela_;
}
function selec_todo(cont_){
var cchk=0,comando=''
    if(document.form1.chktodo.checked==true){
        for(cchk=0;cchk<cont_;cchk=cchk+1){
            comando="document.form1.chkiden"+cchk+".checked=true";
            eval(comando);            
        }
    }
    else{
         for(cchk=0;cchk<cont_;cchk=cchk+1){
            comando="document.form1.chkiden"+cchk+".checked=false";
            eval(comando);
            //alert(comando);
        }
    }
}
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<body>
<form name='form1' method="POST" action='fac_3adicionafac.php' target='fr02'>
<?
include('php/conexion.php');
include('php/funciones.php');
//Aqui asigno el numero de la relacion, a las facturas seleccionadas
if($cont>0){
    for($i=0;$i<$cont;$i++){
        $var="chkiden".$i;
        if($$var=='on'){
            $var="iden_fac".$i;
            $consulta="UPDATE encabezado_factura SET rela_fac='$relacion' WHERE iden_fac=".$$var;
            mysql_query($consulta);
            //echo "<br>".$consulta;
        }
    }
}

echo "<table class='Tbl0'><tr><td class='Td0' align='center'>ADICIONAR FACTURAS A LA CUENTA Nro $relacion</td></tr></table><br>";
$consultanit="SELECT cco.nit_cco,con.neps_con
    FROM cuenta_cobro AS cco
    INNER JOIN contrato AS con ON con.nit_con=cco.nit_cco
    WHERE cco.rela_cco='$relacion'";
//echo $consultanit;
$consultanit=mysql_query($consultanit);
$rownit=mysql_fetch_array($consultanit);


echo "<table class='Tbl0' border='0'>";
echo "<th class='Th0' colspan='7'>PARAMETROS DE BUSQUEDA</th>";
echo "<tr>";
echo "<td class='Td2' align='right' width='10%'>Contrato:</td>";
echo "<td class='Td2' align='left' width='20%'>$rownit[neps_con]</td>";
echo "<td class='Td2' align='right' width='10%'>Factura:</td>";
echo "<td class='Td2' align='left' width='10%'><input type='text' name='factura' size='10' maxlength='10' value='$factura'></td>";
echo "<td class='Td2' align='right' width='10%'>Fecha: (dd/mm/aaaa)</td>";
echo "<td class='Td2' align='left' width='10%'><input type='text' name='fecha' size='10' maxlength='10' value='$fecha'></td>";
echo "<td class='Td2' align='left' width='30%'><a href='#' onclick='buscar()'><img src='icons/feed_magnify.png' border='0' alt='Buscar' width=20 height=20></a></td>";
echo "</tr>";
echo "</table>";
echo "<hr>";
$condicion="";
if(!empty($contrato)){$condicion=$condicion."con.codi_con='$contrato' AND ";}
if(!empty($factura)){$condicion=$condicion."fac.nume_fac='$factura' AND ";}
if(!empty($fecha)){$condicion=$condicion."fac.fcie_fac='".cambiafecha($fecha)."' AND ";}
if(!empty($condicion)){
    $condicion=substr($condicion,0,(strlen($condicion)-5));}
if(!empty($condicion)){    
    $condicion="fac.rela_fac='' AND fac.esta_fac='2' AND fac.anul_fac='N' AND ".$condicion;    
    $consulta="SELECT fac.iden_fac,fac.nume_fac,fac.fcie_fac,fac.vtot_fac,fac.vcop_fac,fac.pdes_fac,fac.vnet_fac,
    usu.nrod_usu,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu,' ') AS nombre    
    FROM encabezado_factura AS fac
    INNER JOIN usuario AS usu ON usu.codi_usu=fac.codi_usu    
    WHERE $condicion ORDER BY fac.nume_fac";
    //echo $consulta;
    $consulta=mysql_query($consulta);
    echo "<table class='Tbl0'>";
    echo "<tr><th class='Th0' width='10%'>OPCIONES</th>
    <th class='Th0' width='10%'>FACTURA</th>
    <th class='Th0' width='10%'>IDENTIFICACION</th>
    <th class='Th0' width='30%'>NOMBRE</th>    
    <th class='Th0' width='10%'>FECHA</th>
    <th class='Th0' width='10%'>VALOR</th>
    <th class='Th0' width='10%'>ESTADO</th>";
    $cont=0;
    while($row=mysql_fetch_array($consulta)){
        if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
        $fecf_fac=cambiafechadmy($row[fecf_fac]);
        echo "<tr>";
        echo "<td class='Td2' align='right' bgcolor='$color'>";        
        
        $var="chkiden".$cont;
	echo "<input type='checkbox' name='$var'>";
	$var="iden_fac".$cont;
	echo "<input type='hidden' name='$var' value='$row[iden_fac]'>";
        
        echo "</td>";
        echo "<td class='Td2' bgcolor='$color'>$row[pref_fac] $row[nume_fac]</td>";
        echo "<td class='Td2' bgcolor='$color'>$row[nrod_usu]</td>";
        echo "<td class='Td2' bgcolor='$color'>$row[nombre]</td>";
        echo "<td class='Td2' bgcolor='$color'>".cambiafechadmy($row[fcie_fac])."</td>";
        echo "<td class='Td2' align='right' bgcolor='$color'>$row[vnet_fac]</td>";
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
        echo "<td class='Td2' bgcolor='$color'><font color='$colorest'>$estado</font></td>";
        echo"</tr>";
        $total+=$row[vnet_fac];
        $cont++;
    }
    echo "<tr>";    
    echo "<td class='Td2' align='right'>";
    echo "<input type='checkbox' name='chktodo' onclick='selec_todo($cont)'>";
    echo "</td>";
    echo "<td class='Td2' bgcolor='$color'><b>Seleccionar Todo</td>";
    echo "</tr>";
    mysql_free_result($consulta);
}
echo "<input type='hidden' name='relacion' value='$relacion'>";
echo "<input type='hidden' name='cont' value='$cont'>";
mysql_free_result($consultanit);
mysql_close();
echo "<table class='Tbl0'><tr>
    <td class='Td1' align='center'><a href='#' onclick=adicionafac()><img src='icons/feed_disk.png' border='0' alt='Finalizar'>Guardar</a></td>
    <td class='Td1' align='center'><a href='#' onclick=finaliza('$relacion')><img src='icons/feed.png' border='0' alt='Finalizar'>Finalizar</a></td>
</tr></table><br>";
?>

</table>
</form>
</body>
</html>