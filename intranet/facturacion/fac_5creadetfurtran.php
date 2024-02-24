<?
session_start();
if(!empty($iden_rec1)){
    $_SESSION['iden_rec']=$iden_rec1;
}
//echo $_SESSION['iden_rec'];
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION - FURTAN DETALLE</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/estyles.css">

<SCRIPT LANGUAGE=JavaScript>
function validar(){
var error="";
  if(form1.tdoc_vic.value==""){error=error+"Tipo de Documento de Identificacion\n";} 
  if(form1.ndoc_vic.value==""){error=error+"Numero de Identificacion\n";} 
  if(form1.pnom_vic.value==""){error=error+"Primer Nombre\n";} 
  if(form1.pape_vic.value==""){error=error+"Segundo Nombre\n";}
  if(error!=""){
    alert("Para continuar debe completar la siguiente informacin:\n"+error);}
  else{
    form1.submit();
  }
}
function muestratdoc(tipo_,cont_){
cmd_="";
    cmd_="document.form1.tdoc_vic"+cont_+".value='"+tipo_+"'";    
    eval(cmd_);
}
function activar(cont_){
    cmd_="";
    cmd_='form1.chkhabil'+cont_+'.checked';
    if(eval(cmd_)==true){
        cmd_="document.form1.tdoc_vic"+cont_+".disabled=false";
        eval(cmd_);
        cmd_="document.form1.ndoc_vic"+cont_+".disabled=false";
        eval(cmd_);
        cmd_="document.form1.pnom_vic"+cont_+".disabled=false";
        eval(cmd_);
        cmd_="document.form1.snom_vic"+cont_+".disabled=false";
        eval(cmd_);
        cmd_="document.form1.pape_vic"+cont_+".disabled=false";
        eval(cmd_);
        cmd_="document.form1.sape_vic"+cont_+".disabled=false";
        eval(cmd_);
    }
    else{
        cmd_="document.form1.tdoc_vic"+cont_+".disabled=true";
        eval(cmd_);
        cmd_="document.form1.ndoc_vic"+cont_+".disabled=true";
        eval(cmd_);
        cmd_="document.form1.pnom_vic"+cont_+".disabled=true";
        eval(cmd_);
        cmd_="document.form1.snom_vic"+cont_+".disabled=true";
        eval(cmd_);
        cmd_="document.form1.pape_vic"+cont_+".disabled=true";
        eval(cmd_);
        cmd_="document.form1.sape_vic"+cont_+".disabled=true";
        eval(cmd_);
    }
}
function guardar(iden_,cont_){
var campo_='',cmd_='';
    campo_='form1.chkhabil'+cont_+'.checked';
    if(eval(campo_)==true){
        cmd_="document.form1.tdoc_vic"+cont_+".value";
        campo="tdoc_vic="+eval(cmd_);
        cmd_="document.form1.ndoc_vic"+cont_+".value";
        campo=campo+"&ndoc_vic="+eval(cmd_);
        cmd_="document.form1.pnom_vic"+cont_+".value";
        campo=campo+"&pnom_vic="+eval(cmd_);
        cmd_="document.form1.snom_vic"+cont_+".value";
        campo=campo+"&snom_vic="+eval(cmd_);
        cmd_="document.form1.pape_vic"+cont_+".value";
        campo=campo+"&pape_vic="+eval(cmd_);
        cmd_="document.form1.sape_vic"+cont_+".value";
        campo=campo+"&sape_vic="+eval(cmd_);
        campo="iden_vic="+iden_+"&"+campo;        
        window.open("fac_5guardaeditdetfurip.php?"+campo,"fr02");
    }        
}
function borrar(iden_vic,desc_){
    if(confirm("Desea eliminar este registro?\n "+desc_)){
        window.open("fac_5borradetfurtran.php?iden_vic="+iden_vic,"fr02");
    }
    return false;
}
</script>


</head>
<body>
<form name="form1" method="POST" action="fac_5guardadetfurtran.php" target='fr02'>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<table class="Tbl0"><tr><td class="Td0" align='center'>RELACION DE LAS VICTIMAS TRASLADADAS</td></tr></table><br>
<table class='Tbl0' border="0">
    <th class='Th0' colspan='2'>Opc</Th>
    <th class='Th0'>Tipo Doc. Ident</Th>
    <th class='Th0'>Numero</Th>
    <th class='Th0'>Primer Nombre</Th>
    <th class='Th0'>Segundo Nombre</Th>
    <th class='Th0'>Primer Apellido</Th>
    <th class='Th0'>Segundo Apellido</Th>
    <th class='Th0'>Guardar</Th>
    <?php
    $consultavic="SELECT * FROM ft_victima WHERE iden_rec='$_SESSION[iden_rec]' ORDER BY pape_vic";
    $consultavic=mysql_query($consultavic);
    $cont=0;
    while($rowvic=mysql_fetch_array($consultavic)){
        $nomvar='chkhabil'.$cont;
        echo "<tr>";
        echo "<td class='Td2' align='left'><a href='#' onclick='guardar($rowvic[iden_vic],$cont)'><img src='icons/feed_disk.png' alt='Guardar' disabled></a></TD>";
        echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar(\"$cont\")'></TD>";        
        $nomvar='tdoc_vic'.$cont;
        echo "<td class='Td2' align='left'><select name='$nomvar' disabled=true>
                <option value=''></option>
                <option value='CC'>Cedula de Ciudadania</option>
                <option value='CE'>Cedula de Extrangeria</option>
                <option value='PA'>Pasaporte</option>
                <option value='TI'>Tarjeta de Identidad</option>
                <option value='RC'>Registro Civil</option>
                <option value='AS'>Adulto sin Identificacion</option>
                <option value='MS'>Menor sin Identificacion</option>
                </select>
        </td>";        
        $nomvar='ndoc_vic'.$cont;
        echo "<td class='Td2' align='left'><input type='text' name='$nomvar' size='16' maxlength='16' value='$rowvic[ndoc_vic]' disabled=true></td>";
        $nomvar='pnom_vic'.$cont;
        echo "<td class='Td2' align='left'><input type='text' name='$nomvar' size='20' maxlength='20' value='$rowvic[pnom_vic]' disabled=true></td>";
        $nomvar='snom_vic'.$cont;
        echo "<td class='Td2' align='left'><input type='text' name='$nomvar' size='30' maxlength='30' value='$rowvic[snom_vic]' disabled=true></td>";
        $nomvar='pape_vic'.$cont;
        echo "<td class='Td2' align='left'><input type='text' name='$nomvar' size='20' maxlength='20' value='$rowvic[pape_vic]' disabled=true></td>";
        $nomvar='sape_vic'.$cont;
        echo "<td class='Td2' align='left'><input type='text' name='$nomvar' size='30' maxlength='30' value='$rowvic[sape_vic]' disabled=true></td>";
        echo "<td class='Td2' align='center'><a href='#' onclick=borrar($rowvic[iden_vic],$rowvic[ndoc_vic])><img src='icons/feed_delete.png' alt='Eliminar'></a></td>";
        echo "</tr>";
        ?>
        <script language="JavaScript">            
            muestratdoc('<?echo $rowvic[tdoc_vic];?>','<?echo $cont;?>');
        </Script>
        <?php
        $cont++;
    }
    ?>
    <tr>
        <td class='Td2' align='center'><a href="#" onclick='validar()'><img src="icons/feed_disk.png" alt="Guardar"></a></td>
        <td class='Td2' align='center'><a href="#" onclick='validar()'></a></td>
        <td class='Td2' align='center'><select name="tdoc_vic">
                <option value=''></option>
                <option value='CC'>Cedula de Ciudadania</option>
                <option value='CE'>Cedula de Extrangeria</option>
                <option value='PA'>Pasaporte</option>
                <option value='TI'>Tarjeta de Identidad</option>
                <option value='RC'>Registro Civil</option>
                <option value='AS'>Adulto sin Identificacion</option>
                <option value='MS'>Menor sin Identificacion</option>
                </select>
        </td>        
        <td class='Td2' align='center'><input type='text' name="ndoc_vic" size="16" maxlength="16"></td>
        <td class='Td2' align='center'><input type='text' name="pnom_vic" size="20" maxlength="20"></td>
        <td class='Td2' align='center'><input type='text' name="snom_vic" size="30" maxlength="30"></td>
        <td class='Td2' align='center'><input type='text' name="pape_vic" size="20" maxlength="20"></td>
        <td class='Td2' align='center'><input type='text' name="sape_vic" size="30" maxlength="30"></td>
        <td class='Td2' align='center'></td>
    </tr>    
</table>

<table class="Tbl0"><tr><td class="Td1" align='center'><a href="fondo.php"><img src="icons/feed.png">Finalizar</a></td></tr></table>
</form>
</body>
</html>