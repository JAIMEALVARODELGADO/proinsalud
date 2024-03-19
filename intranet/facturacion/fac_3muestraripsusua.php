<?php
session_start();
session_register('gfactura');
session_register('giden_fac');
if(!empty($factura)){
  $gfactura=$factura;
  $giden_fac=$iden_fac;
}
set_time_limit(100);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function activar(){
    var comando='';
    if(form1.tipodocumento.disabled == true){
        form1.tipodocumento.disabled=false;}
    else{
        form1.tipodocumento.disabled=true;}
    if(form1.numdocumento.disabled == true){
        form1.numdocumento.disabled=false;}
    else{
        form1.numdocumento.disabled=true;}
    if(form1.tipousuario.disabled == true){
        form1.tipousuario.disabled=false;}
    else{
        form1.tipousuario.disabled=true;}
    if(form1.fechanacimiento.disabled == true){
        form1.fechanacimiento.disabled=false;}
    else{
        form1.fechanacimiento.disabled=true;}
    if(form1.codsexo.disabled == true){
        form1.codsexo.disabled=false;}
    else{
        form1.codsexo.disabled=true;}    
    if(form1.codpaisresidencia.disabled == true){
        form1.codpaisresidencia.disabled=false;}
    else{
        form1.codpaisresidencia.disabled=true;}
    if(form1.codmunicipioresidencia.disabled == true){
        form1.codmunicipioresidencia.disabled=false;}
    else{
        form1.codmunicipioresidencia.disabled=true;}
    if(form1.codzonaresidencia.disabled == true){
        form1.codzonaresidencia.disabled=false;}
    else{
        form1.codzonaresidencia.disabled=true;}
    if(form1.incapacidad.disabled == true){
        form1.incapacidad.disabled=false;}
    else{
        form1.incapacidad.disabled=true;}
    if(form1.codpaisorigen.disabled == true){
        form1.codpaisorigen.disabled=false;}
    else{
        form1.codpaisorigen.disabled=true;}
}

function validar(cont_){      
    var comando='',error='';        
    if(form1.tipodocumento.disabled == false){
        if(form1.tipodocumento.value==''){
            error=error+"Tipo de documento \n";
        }    
        if(form1.numdocumento.value==''){        
            error=error+"Número de documento \n";
        }
        if(form1.tipousuario.value==''){        
            error=error+"Tipo de usuario \n";
        }
        if(form1.fechanacimiento.value==''){        
            error=error+"Fecha de nacimiento \n";
        }
        if(form1.codsexo.value==''){        
            error=error+"Sexo \n";
        }
        if(form1.codpaisresidencia.value==''){
            error=error+"País de residencia \n";
        }
        if(form1.codpaisresidencia.value=='170' && form1.codmunicipioresidencia.value==''){
            error=error+"Municipio de residencia \n";        
        }
        if(form1.codpaisresidencia.value!='170' && form1.codmunicipioresidencia.value!=''){
            form1.codmunicipioresidencia.value='';
        }
        if(form1.codzonaresidencia.value==''){
            error=error+"Zona de residencia \n";
        }
        if(form1.incapacidad.value==''){
            error=error+"Incapacidad \n";
        }
        if(form1.codpaisorigen.value==''){
            error=error+"País de origen \n";
        }
    }
    else{
        error=error+"No hay cambios para guardar... \n";
    }


    if(error!=''){
        alert("Para guardar debe complementar la siguiente información:\n\n"+error);
    }
    else{
        form1.submit();
    }
}

function activasel(var_,val_){
  var comando="form1."+var_+".value='"+val_+"'";
  eval(comando);
}


</script>
</head>
<div>
  <ul class="menu">
    <li><a href="fac_3muestraripsusua.php" class="activo">Usuario</a></li>
    <li><a href="fac_3muestraripscons.php">Consultas</a></li>
    <li><a href="fac_3muestraripsproc.php">Procedimientos</a></li>
    <li><a href="fac_3muestraripsmedi.php">Medicamentos</a></li>
    <li><a href="fac_3muestraripsotro.php">Otros Servicios</a></li>
    <li><a href="fac_3muestraripsurge.php">Urgencias</a></li>    
    <li><a href="fac_3muestraripshosp.php">Hospitalización</a></li>
    <li><a href="fac_3muestraripsrnac.php">R. Nacidos</a></li>
    <li><a href="fac_3generaripsjson.php">Generar Json</a></li>
  </ul>
</div>  
<body>
<form name='form1' method="POST" action='fac_3guardaripsusu.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'><h2>R I P S(2275) de Usuario</h2></td></tr></table>
<?
include('php/conexion.php');
include('php/funciones.php');
?>

<table class="Tbl0" border='0'>
  <th class="Th1" width='10%'><b>Factura Nro:</td>
  <th class="Th1" width='15%'><b>Tp. Identificación:</td>
  <th class="Th1" width='15%'><b>Número</td>
  <th class="Th1" width='50%'><b>Nombre</td>
  <th class="Th1" width='10%'><b>Vr.Factura</td>
<?
  $consulta=mysql_query("SELECT us.tdoc_usu,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,
  ef.vnet_fac
  FROM encabezado_factura AS ef
  INNER JOIN usuario AS us ON us.codi_usu=ef.codi_usu
  WHERE iden_fac=$giden_fac");
  $row=mysql_fetch_array($consulta);
  $nombre=$row[pnom_usu]." ".$row[snom_usu]." ".$row[pape_usu]." ".$row[sape_usu];
  echo "<tr>";
  echo "<td class='Td2' align='left'><b>$gfactura</td>";
  echo "<td class='Td2' align='center'><b>$row[tdoc_usu]</td>";
  echo "<td class='Td2' align='center'><b>$row[nrod_usu]</td>";
  echo "<td class='Td2' align='center'><b>$nombre</td>";
  echo "<td class='Td2' align='center'><b>$row[vnet_fac]</td>";
  echo "</tr>";
?>    
</table>

<?    
    $consultacon="SELECT usu.id_usuario,usu.tipodocumento,usu.numdocumento,usu.tipousuario,usu.fechanacimiento,usu.codsexo,usu.codpaisresidencia,usu.codmunicipioresidencia,usu.codzonaresidencia,usu.incapacidad,usu.codpaisorigen,usu.iden_fac
    FROM nrusuario AS usu
    WHERE iden_fac='$giden_fac'";
    //secho $consultacon;
    $consultacon=mysql_query($consultacon);
    $rowcon=mysql_fetch_array($consultacon);
    
	echo "<input type='hidden' name='id_usuario' value='$rowcon[id_usuario]'>";
    ?>
    <br><br>
    <center>
    <table class="Tbl1" border="0">
        <tr>
            <td class="Td1" align='right' width='50%'>
                
            </td>
            <td class="Td" align='left' width='50%'>
                
            </td>
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Tipo de documento de identificación:</td>
            <td class="Td2" align='left' width='50%'>
                <?php
                    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='E3'");
                    echo "<select name='tipodocumento' disabled>";
                    while($rowdes=mysql_fetch_array($consultades)){
                        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
                    }
                    echo "</select>";	
                ?>
                <script language='javascript'>activasel('tipodocumento','<?php echo $rowcon[tipodocumento];?>');</script>
            </td>        
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Número:</td>
            <td class="Td2" align='left' width='50%'>
                <input type='text' name='numdocumento' size='20' maxlength='20' value='<?php echo $rowcon[numdocumento];?>' disabled>
            </td>
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Tipo de usuario:</td>
            <td class="Td2" align='left' width='50%'>
                <?php
                    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='G3'");
                    echo "<select name='tipousuario' disabled>";
                    while($rowdes=mysql_fetch_array($consultades)){
                        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
                    }
                    echo "</select>";	
                ?>
                <script language='javascript'>activasel('tipousuario','<?php echo $rowcon[tipousuario];?>');</script>
            </td>        
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Fecha de nacimiento:</td>
            <td class="Td2" align='left' width='50%'>
                <input type='text' name='fechanacimiento' size='10' maxlength='10' value='<?php echo $rowcon[fechanacimiento];?>' disabled>
            </td>
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Sexo:</td>
            <td class="Td2" align='left' width='50%'>
                <?php
                    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H9'");
                    echo "<select name='codsexo' disabled>";
                    while($rowdes=mysql_fetch_array($consultades)){
                        echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
                    }
                    echo "</select>";	
                ?>
                <script language='javascript'>activasel('codsexo','<?php echo $rowcon[codsexo];?>');</script>
            </td>        
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Pais de residencia:</td>
            <td class="Td2" align='left' width='50%'>
                <?php
                    $consultades=mysql_query("SELECT codigo,nombre FROM pais ORDER BY nombre");
                    echo "<select name='codpaisresidencia' disabled>";
                    while($rowdes=mysql_fetch_array($consultades)){
                        echo "<option value='$rowdes[codigo]'>$rowdes[nombre]";
                    }
                    echo "</select>";
                ?>
                <script language='javascript'>activasel('codpaisresidencia','<?php echo $rowcon[codpaisresidencia];?>');</script>
            </td>        
        </tr>        
        <tr>
            <td class="Td2" align='right' width='50%'><b>Municipio de residencia:</td>
            <td class="Td2" align='left' width='50%'>
                <?php
                    $consultades=mysql_query("SELECT CODI_MUN,NOMB_MUN FROM municipio ORDER BY NOMB_MUN");
                    echo "<select name='codmunicipioresidencia' disabled>";
                    echo "<option value=''>";
                    while($rowdes=mysql_fetch_array($consultades)){
                        echo "<option value='$rowdes[CODI_MUN]'>$rowdes[NOMB_MUN] ";
                    }
                    echo "</select>";
                ?>
                <script language='javascript'>activasel('codmunicipioresidencia','<?php echo $rowcon[codmunicipioresidencia];?>');</script>
            </td>        
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Zona de residencia:</td>
            <td class="Td2" align='left' width='50%'>
                <?php
                    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H0'");
                    echo "<select name='codzonaresidencia' disabled>";
                    while($rowdes=mysql_fetch_array($consultades)){
                        echo "<option value='$rowdes[valo_des]'>$rowdes[nomb_des] ";
                    }
                    echo "</select>";
                ?>
                <script language='javascript'>activasel('codzonaresidencia','<?php echo $rowcon[codzonaresidencia];?>');</script>
            </td>        
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Incapacidad:</td>
            <td class="Td2" align='left' width='50%'>
                <select name='incapacidad' disabled>
                    <option value='NO'>NO
                    <option value='SI'>SI
                </select>
                <script language='javascript'>activasel('incapacidad','<?php echo $rowcon[incapacidad];?>');</script>
            </td>        
        </tr>
        <tr>
            <td class="Td2" align='right' width='50%'><b>Pais de origen:</td>
            <td class="Td2" align='left' width='50%'>
                <?php
                    $consultades=mysql_query("SELECT codigo,nombre FROM pais ORDER BY nombre");
                    echo "<select name='codpaisorigen' disabled>";
                    while($rowdes=mysql_fetch_array($consultades)){
                        echo "<option value='$rowdes[codigo]'>$rowdes[nombre] ";
                    }
                    echo "</select>";	
                ?>
                <script language='javascript'>activasel('codpaisorigen','<?php echo $rowcon[codpaisresidencia];?>');</script>
            </td>        
        </tr>
        <tr>
            <td class="Td6" align='right' width='50%'>
                <center><a href='#' onclick='activar()' title="Editar"><img src='icons/feed_edit.png' width='20' height='20'>Editar</a></center>
            </td>
            <td class="Td6" align='left' width='50%'>
                <center><a href='#' onclick='validar()' title="Guardar"><img src='icons/feed_disk.png' width='20' height='20'>Guardar</a></center>
            </td>
        </tr>
    </table>
    </center>

    <?php
    mysql_free_result($consulta);
    mysql_free_result($consultacon);
    mysql_close();
    ?>    

    <br><br>
    

</form>
</body>
</html>
