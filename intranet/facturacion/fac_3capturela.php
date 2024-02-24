<html>
<head>
<title>ASIGNAR RELACION A LA FACTURA</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<script languaje="Javascript">
function validar(){
    error="";
    if(document.form1.relacion.value==''){
        error="Debe seleccionar el numero de relacion";   
    }
    if(error!=""){
        alert(error);
        return(false);
    }
    else{
        document.form1.submit();
        window.close();
    }    
}
</script>

</head>
<form name="form1" method="POST" action="fac_3relaciona.php" target='fr02'>
<body>
<?
include('php/funciones.php');
include('php/conexion.php');
//echo "<br>".$iden_fac;
$consultafac="SELECT nume_fac,CONCAT(PNOM_USU,' ',SNOM_USU,' ',PAPE_USU,' ',SAPE_USU) AS nombre,pref_fac,fcie_fac,rela_fac,enti_fac,NEPS_CON FROM vista_factura_encabezado WHERE iden_fac='$iden_fac'";
//echo "<br>".$consultafac;
$consultafac=mysql_query($consultafac);
$row=mysql_fetch_array($consultafac);

$consultarel="SELECT rela_cco,nit_cco FROM cuenta_cobro WHERE esta_cco='A' AND nit_cco='$row[enti_fac]'";
//echo "<br>".$consultarel

?>
<table class="Tbl0"><tr><td class="Td0" align='center'>DATOS DE LA FACTURA</td></tr></table><br>
<table class="Tbl0">
    <tr>
        <td class="Td2" align='right'>Factura:</td>
        <td class="Td2" align='left'><?php echo $row[pref_fac].' '.$row[nume_fac];?></td>
    </tr>
    <tr>
        <td class="Td2" align='right'>Fecha de Cierre:</td>
        <td class="Td2" align='left'><?php echo $row[fcie_fac];?></td>
    </tr>
    <tr>
        <td class="Td2" align='right'>Nombre:</td>
        <td class="Td2" align='left'><?php echo $row[nombre];?></td>
    </tr>
    <tr>
        <td class="Td2" align='right'>Contrato:</td>
        <td class="Td2" align='left'><?php echo $row[NEPS_CON];?></td>
    </tr>
    <tr>
        <td class="Td2" align='right'>Relación:</td>
        <td class="Td2" align='left'><select name='relacion'>
            <option value=""></option>
            <?php
                $consultarel=mysql_query($consultarel);
                while($rowrel=mysql_fetch_array($consultarel)){
                    echo "<option value='$rowrel[rela_cco]'>$rowrel[rela_cco]</option>";
                }
          ?>
            </select>
        </td>
    </tr>
</table>
<input type="hidden" name="iden_fac" value="<?echo $iden_fac;?>">
<br><br>

<table class="Tbl0">
    <tr>
        <!--<td class="Td2" align='center'><input type='button' name='cerrar' value='Cerrar Factura' onclick="validar('<?echo $fecf_fac;?>')"></td>-->
        <td class="Td2" align='center'><input type='button' name='asignar' value='Asignar Relacion a la Factura' onclick="validar()"></td>
        <td class="Td2" align='center'><input type='button' name='cancela' value='Cancelar' onclick='javascript:window.close();'></td>
    </tr>
</table>
</form>
</body>
</html>