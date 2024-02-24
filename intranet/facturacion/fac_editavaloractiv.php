<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function validar(){
  var msg_="";
  if(modo!='S'){  
    msg_=msg_+"Debe seleccionar el modo de aplicacion\n";
  }  
  if(document.form1.porcentaje.value==''){
    msg_=msg_+"Debe digitar el valor del porcentaje que se va a aplicar\n";
  }
  if(document.form1.tpor_crt.value==''){
    msg_=msg_+"Debe seleccionar el tipo de aplicación\n";
  }
  if(document.form1.rad_modo.value=='1' && document.form1.tari_ctr.value==''){
    msg_=msg_+"Debe seleccionar el tarifario\n";
  }
  if(msg_!=""){
    alert(msg_);  
  }
  else{
    if(confirm("Desea modificar los valores de este contrato?ok"))
    document.form1.submit();
  }
}

function valida_modo(){  
  document.form1.porcentaje.disabled=false;
  document.form1.tpor_crt.disabled=false;
  document.form1.redondeo.disabled=false;
  if(document.form1.rad_modo.value=='1'){
    document.form1.tari_ctr.disabled=false;
  }
  else{
    document.form1.tari_ctr.disabled=true;
  }
  modo='S';
  document.form1.porcentaje.focus();
}
var modo='N';

</script>
</head>
<body>
<form name='form1' method='post' action='fac_editavalores.php'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CONTRATO</td></tr></table>
<?php
include('php/funciones.php');
include('php/conexion.php');
$consulta=mysql_query("SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE ccion.iden_ctr='$iden_ctr'");
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];
$tpor_crt=$row[tpor_crt];
$pctg_ctr=$row[pctg_ctr]/100;
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='15%'>NRO</th>
	  <th class='Th0' width='30%'>ENTIDAD</th>
	  <th class='Th0' width='20%'>VIGENCIA</th>
	  <th class='Th0' width='5%'>MONTO</font></th>
	  <th class='Th0' width='30%'>CLAUSULAS</font></th>";
echo "<tr>";
echo "<td class='Td2'>$row[nume_ctr]</td>";
echo "<td class='Td2'>$row[neps_con]</td>";
echo "<td class='Td2'>".cambiafechadmy($row[fini_ctr])." - ".cambiafechadmy($row[ffin_ctr])."</td>";
echo "<td class='Td2'>$row[mont_ctr]</td>";
$tabla='';
$campo='';
$obser='';
if($row[tari_ctr]=='1'){
  $obser='Soat con ';
  $tabla='soat';
  $campo='soat_map';
}
if($row[tari_ctr]=='2'){
  $obser='ISS 2001 con ';
  $tabla='iss1';
  $campo='iss1_map';
}
if($row[tari_ctr]=='3'){
  $obser='ISS 2004 con ';
  $tabla='iss4';
  $campo='iss4_map';
}

if($row[tpor_crt]=='+'){$tipo='de Incremento';}
if($row[tpor_crt]=='-'){$tipo='de Descuento';}

$obser=$obser.'  '.$row[pctg_ctr].' % '.$tipo;

echo "<td class='Td2'>$obser</td>";
echo "</tr>";
echo "</table>";
mysql_close();
?>
<table class='Tbl0'><tr><td class='Td0' align='center'>CAMBIAR EL VALOR A LAS ACTIVIDADES DEL CONTRATO</td></tr></table>

<table class='Tbl0' align='center' width='40'>
  <tr>
    <td class='Td1' align='center'>Selección</td>
    <td class='Td1' align='center'>Valor</td>
    <td class='Td1' align='center'>Tipo</td>
    <td class='Td1' align='center'>Tarifario</td>
    <td class='Td1' align='center'>Redondear</td>
  </tr>
  <tr>
    <td class='Td2' align='left'><input type='radio' name='rad_modo' value='1' onclick='valida_modo()'> Por Tarifario
      <br><input type='radio' name='rad_modo' value='2' onclick='valida_modo()'> Al Valor Actual
    </td>
    <td class='Td2' align='center'><input type='text' name='porcentaje' size='5' maxlength='5' onKeypress='if (event.keyCode > 47 && event.keyCode <58 ||event.keyCode == 46) event.returnValue = true;else event.returnValue = false' value='' disabled='false'>%</td>
    <td class='Td2' align='center'><select name='tpor_crt' disabled='true'><option value=''></option>
        <option value='+'>Incremento</option>
        <option value='-'>Descuento</option>
      </select>
    </td>
    <td class='Td2' align='center'>
      <select name='tari_ctr' disabled='true'>
        <option value=''></option>
        <option value='1'>Soat</option>
        <option value='2'>Iss 2001</option>
        <option value='3'>Iss 2004</option>
      </select>
    </td>
      <td class='Td2' align='center'>
      <select name='redondeo' disabled='true'>
        <option value='0'>Sin Redondeo</option>
        <option value='-1'>A la Decena</option>
        <option value='-2'>A la Centena</option>
      </select>
      </td>
  </tr>
</table>

<table class="Tbl2">
  <tr>
  <td class="Td1"><a href="#" onclick="javascript:validar()" title='Cambiar Valores'><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Cambiar Valores' border=0 align="top"> Cambiar Valores </a></td>
  <td class="Td1"><a href="fondo.php" onclick="javascript:history.go(-1)">Cancelar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
</table>

<input type='hidden' name='iden_ctr' value='<?echo $iden_ctr;?>'>
<input type='hidden' name='codi_con' value='<?echo $codi_con;?>'>
</form>
</body>
</html>