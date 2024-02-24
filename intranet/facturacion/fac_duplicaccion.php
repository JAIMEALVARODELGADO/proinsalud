<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function activar(cont_){
    //alert(cont_);
    switch(cont_){
        case 1:
            if(document.form1.procedim.checked==true){
                document.form1.poract.disabled=false;
                document.form1.tpporact.disabled=false;
                document.form1.poract.focus();
            }
            else{
                document.form1.poract.disabled=true;
                document.form1.tpporact.disabled=true;
            }
            break
        case 2:
            if(document.form1.grupo.checked==true){
                document.form1.porgru.disabled=false;
                document.form1.tpporgru.disabled=false;
                document.form1.porgru.focus();
            }
            else{
                document.form1.porgru.disabled=true;
                document.form1.tpporgru.disabled=true;
            }
            break
            
        case 3:
            if(document.form1.medicam.checked==true){
                document.form1.pormed.disabled=false;
                document.form1.tppormed.disabled=false;
                document.form1.pormed.focus();
            }
            else{
                document.form1.pormed.disabled=true;
                document.form1.tppormed.disabled=true;
            }
            break
        case 4:
            if(document.form1.insumo.checked==true){
                document.form1.porins.disabled=false;
                document.form1.tpporins.disabled=false;
                document.form1.porins.focus();
            }
            else{
                document.form1.porins.disabled=true;
                document.form1.tpporins.disabled=true;
            }
            break
    }
}

function validaguarda(){
var error="";
if(document.form1.contrato.value==''){error+="Debe seleccionar el contrado fuente de información\n";}
if(document.form1.procedim.checked==false && document.form1.medicam.checked==false && document.form1.insumo.checked==false && document.form1.grupo.checked==false){
    error+="Debe seleccionar una o varios de los items a parametrizar\n";
}
if(document.form1.procedim.checked==true){
    if(document.form1.poract.value==''){error+="Debe digitar el porcentaje a aplicar a las actividades\n";}
    if(document.form1.tpporact.value==''){error+="Debe seleccionar el tipo de porcentaje a aplicar a las actividades\n";}
}
if(document.form1.grupo.checked==true){
    if(document.form1.porgru.value==''){error+="Debe digitar el porcentaje a aplicar a las grupos Qx\n";}
    if(document.form1.tpporgru.value==''){error+="Debe seleccionar el tipo de porcentaje a aplicar a los grupos Qx\n";}
}
if(document.form1.medicam.checked==true){
    if(document.form1.pormed.value==''){error+="Debe digitar el porcentaje a aplicar a los medicamentos\n";}
    if(document.form1.tppormed.value==''){error+="Debe seleccionar el tipo de porcentaje a aplicar a los medicamentos\n";}
}
if(document.form1.insumo.checked==true){
    if(document.form1.porins.value==''){error+="Debe digitar el porcentaje a aplicar a los insumos\n";}
    if(document.form1.tpporins.value==''){error+="Debe seleccionar el tipo de porcentaje a aplicar a los insumos\n";}
}
if(error!=""){
    alert(error);
    return(false);
}
else{
    if(confirm("Realmente desea realizar este proceso?")==true){
        form1.submit();
    }    
}  
}
</script>
</head>
<body>
<form name='form1' method='post' action='fac_guardadup.php'>
<table class="Tbl0">
    <tr><td class="Td0" align='center'>DUPLICA CONTRATO</td></tr>
    <tr><td class="Td2" align='center'>Esta utilidad del sistema, le permite tomar la parametrización de un contrato y duplicarla para otro contrato, incrementando o descontando un porcentaje.</td></tr>
</table>
<?
include('php/funciones.php');
include('php/conexion.php');
$consulta="SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE iden_ctr=$iden_ctr";
//echo $consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];
$tpor_crt=$row[tpor_crt];
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='5%'>NRO</th>
	  <th class='Th0' width='30%'>ENTIDAD</th>
	  <th class='Th0' width='20%'>VIGENCIA</th>
	  <th class='Th0' width='5%'>MONTO</font></th>
	  <th class='Th0' width='40%'>CLAUSULAS</font></th>";
echo "<tr>";
echo "<td class='Td2'>$row[nume_ctr]</td>";
echo "<td class='Td2'>$row[neps_con]</td>";
echo "<td class='Td2'>".cambiafechadmy($row[fini_ctr])." - ".cambiafechadmy($row[ffin_ctr])."</td>";
echo "<td class='Td2'>$row[mont_ctr]</td>";
if(empty($tari_ctr)){$tari_ctr=$row[tari_ctr];}
if($pctg_ctr==""){$pctg_ctr=$row[pctg_ctr];}
$tabla='';
$campo='';
$obser='';
if($tari_ctr=='1'){
  $obser='Soat con ';
}
if($tari_ctr=='2'){
  $obser='ISS 2001 con ';
}
if($tari_ctr=='3'){
  $obser='ISS 2004 con ';
}
if($tpor_crt=='+'){$tipo='de Incremento';}
if($tpor_crt=='-'){$tipo='de Descuento';}

$obser=$obser.'  '.$row[pctg_ctr].'%'.' '.$tipo;

echo "<td class='Td2'>$obser</td>";
echo "</tr>";
echo "</table>";

echo "<table class='Tbl0'><tr><td class='Td0' align='center'>ADICIONA ACTIVIDADES AL CONTRATO</td></tr></table>";
echo "<table class='Tbl0' border='0'>";
/*echo "<tr>";
echo "<td class='Td0' width='25%' align='center'>Clase</td>";
echo "<td class='Td0' width='25%' align='center'>Especialidad</td>";
echo "<td class='Td0' width='25%' align='center'>Tarifario</td>";
echo "<td class='Td0' width='25%' align='center'>Porc.</td>";
echo "<td class='Td0' width='25%' align='center'>Buscar</td>";
echo "</tr>";*/
echo "<tr>";
echo "<td class='Td2' align='right'><b>Contrato del cual se va a tomar la parametrización:</td>";
$consultacon="SELECT ctr.iden_ctr,ctr.nume_ctr,con.neps_con
    FROM contratacion AS ctr 
    INNER JOIN contrato AS con ON con.codi_con=ctr.codi_con ORDER BY con.neps_con";
//echo $consultacon;
$consultacon=mysql_query($consultacon);
echo "<td class='Td2' colspan='2'><select name='contrato'><option value=''>";
while($rowcon=mysql_fetch_array($consultacon)){
  echo "<option value='$rowcon[iden_ctr]'>$rowcon[neps_con] - $rowcon[nume_ctr]";
}
echo "</select>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td class='Td2' align='right'><input type='checkbox' name='procedim' onclick='activar(1)'></td>";
echo "<td class='Td2' align='left'><b>Actividades</td>";
echo "<td class='Td2' align='left'><b>Aplicar: 
        <input type='text' name='poract' size='5' maxlength='5' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false' disabled>
        % de 
        <select name='tpporact' disabled>
            <option value=''>
            <option value='+'>Incremento
            <option value='-'>Descuento
        </select>
        </td>";
echo "</tr>";

echo "<tr>";
echo "<td class='Td2' align='right'><input type='checkbox' name='grupo' onclick='activar(2)'></td>";
echo "<td class='Td2' align='left'><b>Grupos Qx</td>";
echo "<td class='Td2' align='left'><b>Aplicar: 
        <input type='text' name='porgru' size='5' maxlength='5' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false' disabled>
        % de 
        <select name='tpporgru' disabled>
            <option value=''>
            <option value='+'>Incremento
            <option value='-'>Descuento
        </select>
        </td>";
echo "</tr>";

echo "<tr>";
echo "<td class='Td2' align='right'><input type='checkbox' name='medicam' onclick='activar(3)'></td>";
echo "<td class='Td2' align='left'><b>Medicamentos</td>";
echo "<td class='Td2' align='left'><b>Aplicar: 
        <input type='text' name='pormed' size='5' maxlength='5' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false' disabled>
        % de 
        <select name='tppormed' disabled>
            <option value=''>
            <option value='+'>Incremento
            <option value='-'>Descuento
        </select>
        </td>";
echo "</tr>";

echo "<tr>";
echo "<td class='Td2' align='right'><input type='checkbox' name='insumo' onclick='activar(4)'></td>";
echo "<td class='Td2' align='left'><b>Insumos</td>";
echo "<td class='Td2' align='left'><b>Aplicar: 
        <input type='text' name='porins' size='5' maxlength='5' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false' disabled>
        % de 
        <select name='tpporins' disabled>
            <option value=''>
            <option value='+'>Incremento
            <option value='-'>Descuento
        </select>
        </td>";
echo "</tr>";
echo "<tr>";
echo "<td class='Td2' align='right'><b>Redondeo de valores:</td>";
echo "<td class='Td2' align='left' >
    <input type='radio' name='redondeo' value='0'> Sin redondeo
    <br><input type='radio' name='redondeo' value='-1' checked> A la decena
    <br><input type='radio' name='redondeo' value='-2'> A la centena
    </td>";
echo "<td class='Td2' align='left'></td>";
echo "</tr>";
echo "</table>";

echo "</table>";
echo "<table class='Tbl2'>";
echo "<tr>";
echo "<td class='Td1' width='45%'><a href='#' onclick='validaguarda()'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align='center'>Guardar</a></td>";
echo "<td class='Td1' width='45%'><a href='fac_muesccion.php?codi_con=<?echo $codi_con;?>'>Regresar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align='center'></a></td>";
echo "</tr>";
echo "</table>";

mysql_free_result($consulta);
mysql_free_result($consultacon);
mysql_close();
?>
<input type='hidden' name='iden_ctr' value='<?echo $iden_ctr;?>'>
<input type='hidden' name='codi_con' value='<?echo $codi_con;?>'>
</form>
</body>
</html>

