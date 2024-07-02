<html>
<head><title>Modifica Persona</title>

<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(form){
    var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
    var a = ""
    if (form.tido_medi.value == "") { a += "Tipo de Identificacion\n"; }
    if (form.ced_medi.value == "") { a += "Cédula\n"; }
    if (form.pnom_medi.value == "") { a += "Primer Nombre\n"; }
    if (form.pape_medi.value == "") { a += "Primer Apellido\n"; }
    if (form.reg_medi.value == "") { a += "Registro\n"; }
    if (form.espe_med.value == "") { a += "Especialidad\n"; }
    if (a != ""){alert(error + a);return true;}
    document.form1.cod_medi.disabled=false;    
    form.submit()
}
function atras(){
    history.go(-1)
}
</script>
</head>
<body >

<form method="POST" name="form1" action="per_guardamodper.php"><br>
<?
//Conexion con la base
include ('php/conexion.php');
include ('php/funciones.php');

$consultamed="SELECT cod_medi,nom_medi,dir__medi,telf_medi,are_medi,esta_medi,ced_medi,reg_medi,csii_med,espe_med,tido_medi,pnom_medi,snom_medi,pape_medi,sape_medi
FROM medicos WHERE cod_medi='$cod_medi'";
//echo $consultamed;
$consultamed=mysql_query($consultamed);
$rowmed=mysql_fetch_array($consultamed);

//$nom_est=estado($rowmed[esta_medi])
?>
<center><h2>Modifica Datos Personales</h2></center>
<?php
echo $rowmed[nom_medi];
require('per_captura.php');
?>

<script language='JavaScript'>
    document.form1.cod_medi.disabled='true';
    document.form1.esta_medi.disabled='true';
    document.form1.areas_ar.disabled='true';
    document.form1.tido_medi.value='<?echo $rowmed[tido_medi];?>';
    document.form1.ced_medi.value='<?echo $rowmed[ced_medi];?>';
    document.form1.pnom_medi.value='<?echo $rowmed[pnom_medi];?>';
    document.form1.snom_medi.value='<?echo $rowmed[snom_medi];?>';
    document.form1.pape_medi.value='<?echo $rowmed[pape_medi];?>';
    document.form1.sape_medi.value='<?echo $rowmed[sape_medi];?>';
    document.form1.dir_medi.value='<?echo $rowmed[dir__medi];?>';
    document.form1.telf_medi.value='<?echo $rowmed[telf_medi];?>';
    document.form1.are_medi.value='<?echo $rowmed[are_medi];?>';
    document.form1.reg_medi.value='<?echo $rowmed[reg_medi];?>';    
    document.form1.espe_med.value='<?echo $rowmed[espe_med];?>';
    document.form1.csii_med.value='<?echo $rowmed[csii_med];?>';    
</script>
<center><b><?echo $mensaje?></center>
<br>
<center>
<table border='0' width='40%'>
  <tr>
    <td width='50%' align='center'><input type="button" name="btnnuevo" value="Guardar" onclick="validar(this.form)"></td>
    <td width='50%' align='center'><input type="button" name="regresar" value="Regresar" onclick="atras()"></td>
  </tr>
</table>
</center>
<!--<input type='hidden' name="cod_medi2" size=20 maxlength=20 value='<?echo $cod_medi?>'>-->
<?php
mysql_free_result($consultamed);
mysql_close();
?>
</form>
</body>
</html>