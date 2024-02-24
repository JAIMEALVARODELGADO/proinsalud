<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function activar(cont_){
var comando="";
    comando="document.form1.chk"+cont_+".checked";
    if(eval(comando)==true){
        comando="document.form1.cuenta_med"+cont_+".disabled=false";
        eval(comando);
        comando="document.form1.cuenta_ins"+cont_+".disabled=false";
        eval(comando);
        comando="document.form1.cuenta_med"+cont_+".focus()";
        eval(comando);
    }
    else{
        comando="document.form1.cuenta_med"+cont_+".disabled=true";
        eval(comando);
        comando="document.form1.cuenta_ins"+cont_+".disabled=true";
        eval(comando);
    }
    
}
function guardar(cont_){
var comando="",error="",codi_="",cuenta_med="",cuenta_ins="";
    comando="document.form1.chk"+cont_+".checked";
    if(eval(comando)==true){
        comando="document.form1.cuenta_med"+cont_+".value";
        if(eval(comando)==''){error=error+'Cuenta para el medicamento\n';}
        comando="document.form1.cuenta_ins"+cont_+".value";
        if(eval(comando)==''){error=error+'Cuenta para el insumo\n';}
        if(error!=''){alert('Debe completar la siguiente informacion:\n'+error)}
        else{
            comando="document.form1.chk"+cont_+".value";
            codi_=(eval(comando));
            comando="document.form1.cuenta_med"+cont_+".value";
            cuenta_med=(eval(comando));
            comando="document.form1.cuenta_ins"+cont_+".value";
            cuenta_ins=(eval(comando));
            comando="fac_guardacta.php?codi_cxs="+codi_+"&ctamed="+cuenta_med+"&ctains="+cuenta_ins;            
            window.open(comando,'fr02');
        }
    }
    else{
        alert("El servicio debe estar seleccionado");
    }
}
//fac_editaccos.php?codi_cdc=$row[codi_cdc]
</script>

</head>
<body>
<form name="form1" method="POST" action="busq_mapii.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CENTROS DE COSTOS</td></tr></table>
<?
//echo "$cod";
include('php/conexion.php');
$condicion="codt_des='06'";
if(!empty($codi)){
    $condicion=$condicion." AND codi_des='$codi'";}
if(!empty($serv)){
    $condicion=$condicion." AND codi_des='$serv'";}
$consulta="SELECT codi_des,nomb_des FROM destipos WHERE $condicion ORDER BY nomb_des";
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0) {
    echo "<table class='Tbl0'>";
    echo "<th class='Th0' width='10%'>Seleccionar</th>
        <th class='Th0' width='10%'>CODIGO</font></th>
	<th class='Th0' width='30%'>NOMBRE</font></th>
        <th class='Th0' width='10%'>CUENTA PARA MEDICAMENTOS</font></th>
        <th class='Th0' width='10%'>CUENTA PARA INSUMOS</font></th>
        <th class='Th0' width='5%'>Opc</font></th>
        <th class='Th0' width='25%'></font></th>
        ";    
    $cont=0;
    while($row=mysql_fetch_array($consulta)){        
        echo "<tr>";
        $var="chk".$cont;
        echo "<td class='Td4'><input type='checkbox' name='$var' onclick='activar($cont)' value='$row[codi_des]'></td>";        
        echo "<td class='Td2'>$row[codi_des]</td>";
        echo "<td class='Td2'>$row[nomb_des]</td>";        
        $conscta="SELECT ctamed_cxs,ctains_cxs FROM cuentaxservicio WHERE codi_cxs='$row[codi_des]'";
        //echo "<br>".$conscta;
        $ctamed_cxs="";
        $ctains_cxs="";
        $conscta=mysql_query($conscta);
        if(mysql_num_rows($conscta)<>0){
            $rowcta=mysql_fetch_array($conscta);
            $ctamed_cxs=$rowcta[ctamed_cxs];
            $ctains_cxs=$rowcta[ctains_cxs];
        }
        $var="cuenta_med".$cont;
        echo "<td class='Td2'><input type='text' name='$var' size='10' maxlength='10' value='$ctamed_cxs' disabled></td>";
        $var="cuenta_ins".$cont;
        echo "<td class='Td2'><input type='text' name='$var' size='10' maxlength='10' value='$ctains_cxs' disabled></td>";        
        echo "<td class='Td2'><a href='#' onclick='guardar(\"$cont\")'><img src='icons/feed_disk.png' border='0' alt='Guardar'></a></td>";
        echo"</tr>";
        $cont++;
    }
    echo "</table>";
    echo "<table class='Tbl2'>";
    echo "<tr>";
    echo "<td class='Td1'></td>";
    echo "</tr>";
    echo "</table>";
}
else{
    echo "<center>";
    echo "<p class=Msg>No existen registros para esta busqueda</p>";
    echo "</center>";
}
mysql_close();
?>
</body>
</html>