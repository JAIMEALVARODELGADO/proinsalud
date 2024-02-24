<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>

<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="javaScript">
function activa(){
    if(document.form1.chkmod.checked==true){
        document.form1.nite_emp.disabled=false;
        document.form1.razo_emp.disabled=false;
        document.form1.codp_emp.disabled=false;
        document.form1.dire_emp.disabled=false;
        document.form1.tele_emp.disabled=false;
        document.form1.pref_emp.disabled=false;
        document.form1.enca_emp.disabled=false;
        document.form1.pie_emp.disabled=false;
        //document.form1.nume_fac.disabled=false;
        document.form1.rela_emp.disabled=false;
        document.form1.ctades_emp.disabled=false;
        document.form1.ctacaj_emp.disabled=false;
    }
    else{
        document.form1.nite_emp.disabled=true;
        document.form1.razo_emp.disabled=true;
        document.form1.codp_emp.disabled=true;
        document.form1.dire_emp.disabled=true;
        document.form1.tele_emp.disabled=true;
        document.form1.pref_emp.disabled=true;
        document.form1.enca_emp.disabled=true;
        document.form1.pie_emp.disabled=true;
        //document.form1.nume_fac.disabled=true;
        document.form1.rela_emp.disabled=true;
        document.form1.ctades_emp.disabled=true;
        document.form1.ctacaj_emp.disabled=true;
    }
}
function validar(){
var error="";
    if(document.form1.nite_emp.value==""){error="Nit\n";}
    if(document.form1.razo_emp.value==""){error=error+"Razón social\n";}
    if(document.form1.codp_emp.value==""){error=error+"Código\n";}
    if(document.form1.dire_emp.value==""){error=error+"Dirección\n";}
    if(document.form1.tele_emp.value==""){error=error+"Teléfono\n";}
    if(document.form1.pref_emp.value==""){error=error+"Prefijo de facturación\n";}
    if(document.form1.enca_emp.value==""){error=error+"Encabezado de gactura\n";}
    if(document.form1.pie_emp.value==""){error=error+"Pié de página de factura\n";}
    //if(document.form1.nume_fac.value==""){error=error+"Número de factura\n";}
    if(document.form1.rela_emp.value==""){error=error+"Numero de relación\n";}
    if(document.form1.ctades_emp.value==""){error=error+"Cuenta para los descuentos\n";}
    if(document.form1.ctacaj_emp.value==""){error=error+"Cuenta para la caja\n";}
    if(error!=""){
        alert("Para continuar debe completar la siguiente información:\n"+error);}
    else{
        if(document.form1.chkmod.checked==true){document.form1.submit();}        
    }
}
</script>

<body>
<?
include('php/funciones.php');
include('php/conexion.php');
?>
<form method="post" name="form1" action="fac_guardaempresa.php">
<?
$consulta=mysql_query("SELECT * FROM empresa");
$row=mysql_fetch_array($consulta);
?>
<center>
<table class="Tbl0"><tr><td class="Td0" align='center'>MODIFICACION DE INFORMACION DE LA EMPRESA</td></tr></table>
</center>
<br><br><br>
<table class="Tbl0" border='0'>
<tr>
  <td class="Td2" align='right' width='25%'>NIT</td>
  <td class="Td2" align='left' width='25%'><input type='text' name='nite_emp' size='15' maxlength='15' value='<?echo $row[nite_emp];?>' disabled></td>
  <td class="Td2" align='right' width='20%'>Razón Social</td>
  <td class="Td2" align='left' width='30%'><input type='text' name='razo_emp' size='50' maxlength='50' value='<?echo $row[razo_emp];?>' disabled></td>
</tr>
<tr>
  <td class="Td2" align='right'>Código</td>
  <td class="Td2" align='left'><input type='text' name='codp_emp' size='12' maxlength='12' value='<?echo $row[codp_emp];?>' disabled></td>
  <td class="Td2" align='right'>Dirección</td>
  <td class="Td2" align='left'><input type='text' name='dire_emp' size='100' maxlength='100' value='<?echo $row[dire_emp];?>' disabled></td>
</tr>
<tr>
  <td class="Td2" align='right'>Teléfono</td>
  <td class="Td2" align='left'><input type='text' name='tele_emp' size='25' maxlength='25' value='<?echo $row[tele_emp];?>' disabled></td>
   <td class="Td2" align='right'>Prefijo de Facturación</td>
  <td class="Td2" align='left'><input type='text' name='pref_emp' size='1' maxlength='1' value='<?echo $row[pref_emp];?>' disabled></td>
</tr>
<tr>
  <td class="Td2" align='right'>Encabezado</td>
  <td class="Td2" align='left' colspan="3"><textarea name='enca_emp' rows="2" cols="120" disabled><?echo $row[enca_emp];?></textarea></td>
</tr>
<tr>
  <td class="Td2" align='right'>Pié de Página</td>
  <td class="Td2" align='left' colspan="3"><textarea name='pie_emp' rows="2" cols="120" disabled><?echo $row[pie_emp];?></textarea></td>
</tr>
<tr>
  <td class="Td2" align='right'>Número de Factura</td>
  <td class="Td2" align='left'><input type='text' name='nume_fac' size='10' maxlength='10' value='<?echo $row[nume_fac];?>' disabled></td>
  <td class="Td2" align='right'>Número de Relación</td>
  <td class="Td2" align='left'><input type='text' name='rela_emp' size='8' maxlength='8' value='<?echo $row[rela_emp];?>' disabled></td>
</tr>
<tr>
  <td class="Td2" align='right'>Cuenta para descuentos</td>
  <td class="Td2" align='left'><input type='text' name='ctades_emp' size='20' maxlength='20' value='<?echo $row[ctades_emp];?>' disabled></td>
  <td class="Td2" align='right'>Cuenta para Caja</td>
  <td class="Td2" align='left'><input type='text' name='ctacaj_emp' size='20' maxlength='20' value='<?echo $row[ctacaj_emp];?>' disabled></td>
</tr>
<tr>
  <td class="Td2" align='right'><input type='checkbox' name='chkmod' onclick='activa()'></td>
  <td class="Td2" align='left'>Modificar</td>
</tr>
</table>
<br>

<table class="Tbl2">
  <tr>
	<td class="Td1"><a href="#" onclick="javascript:validar()"><img hspace=0 width=20 height=20 src='icons\feed_disk.png' alt='Guardar' border=0 align="top"> Guardar</a></td>
	<td class="Td1"><a href="#" onclick="javascript:history.go(-1)">Regresar<img hspace=0 width=20 height=20 src='icons\feed.png' alt='Cancelar' border=0 align="top"></a></td>
  </tr>
</table>
<?
echo "<input type='hidden' name='codi_emp' value=$row[codi_emp]>";
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>
