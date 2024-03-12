<?php
session_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>

function activar(reg_){
    var comando='';
    comando="form1.chk"+reg_+".checked";
    if(eval(comando)==true){
        comando="form1.tipodocumentoidentificacion"+reg_+".disabled=false";
	    eval(comando);
        comando="form1.numerodocumentoidentificacion"+reg_+".disabled=false";
        eval(comando);
        comando="form1.fechanacimiento"+reg_+".disabled=false";
        eval(comando);
        comando="form1.edadgestacional"+reg_+".disabled=false";
        eval(comando);
        comando="form1.numeroconsultascprenatal"+reg_+".disabled=false";
        eval(comando);
        comando="form1.codsexobiologico"+reg_+".disabled=false";
        eval(comando);
        comando="form1.peso"+reg_+".disabled=false";
        eval(comando);
        comando="form1.coddiagnosticoprincipal"+reg_+".disabled=false";
        eval(comando);
        comando="form1.condiciondestinoegreso"+reg_+".disabled=false";
        eval(comando);
        comando="form1.coddiagnosticocausamuerte"+reg_+".disabled=false";
        eval(comando);
        comando="form1.fechaegreso"+reg_+".disabled=false";
        eval(comando);
    }
    else{
        comando="form1.tipodocumentoidentificacion"+reg_+".disabled=true";
        eval(comando);
        comando="form1.numerodocumentoidentificacion"+reg_+".disabled=true";
        eval(comando);
        comando="form1.fechanacimiento"+reg_+".disabled=true";
        eval(comando);
        comando="form1.edadgestacional"+reg_+".disabled=true";
        eval(comando);
        comando="form1.numeroconsultascprenatal"+reg_+".disabled=true";
        eval(comando);
        comando="form1.codsexobiologico"+reg_+".disabled=true";
        eval(comando);
        comando="form1.peso"+reg_+".disabled=true";
        eval(comando);
        comando="form1.coddiagnosticoprincipal"+reg_+".disabled=true";
        eval(comando);
        comando="form1.condiciondestinoegreso"+reg_+".disabled=true";
        eval(comando);
        comando="form1.coddiagnosticocausamuerte"+reg_+".disabled=true";
        eval(comando);
        comando="form1.fechaegreso"+reg_+".disabled=true";
        eval(comando);
  }
}

function activar2(){    
    var comando='';
    comando="form1.chknuevo.checked";    
    if(eval(comando)==true){        
        comando="form1.tipodocumentoidentificacion.disabled=false";        
        eval(comando);        
        comando="form1.numerodocumentoidentificacion.disabled=false";
        eval(comando);        
        comando="form1.fechanacimiento.disabled=false";
        eval(comando);
        comando="form1.edadgestacional.disabled=false";
        eval(comando);
        comando="form1.numeroconsultascprenatal.disabled=false";
        eval(comando);
        comando="form1.codsexobiologico.disabled=false";
        eval(comando);
        comando="form1.peso.disabled=false";
        eval(comando);
        comando="form1.coddiagnosticoprincipal.disabled=false";
        eval(comando);
        comando="form1.condiciondestinoegreso.disabled=false";
        eval(comando);
        comando="form1.coddiagnosticocausamuerte.disabled=false";
        eval(comando);
        comando="form1.fechaegreso.disabled=false";
        eval(comando);    
    }
    else{
        comando="form1.tipodocumentoidentificacion.disabled=true";
        eval(comando);
        comando="form1.numerodocumentoidentificacion.disabled=true";
        eval(comando);
        comando="form1.fechanacimiento.disabled=true";
        eval(comando);
        comando="form1.edadgestacional.disabled=true";
        eval(comando);
        comando="form1.numeroconsultascprenatal.disabled=true";
        eval(comando);
        comando="form1.codsexobiologico.disabled=true";
        eval(comando);
        comando="form1.peso.disabled=true";
        eval(comando);
        comando="form1.coddiagnosticoprincipal.disabled=true";
        eval(comando);
        comando="form1.condiciondestinoegreso.disabled=true";
        eval(comando);
        comando="form1.coddiagnosticocausamuerte.disabled=true";
        eval(comando);
        comando="form1.fechaegreso.disabled=true";
        eval(comando);
    }
}

function validar(cont_){
    var i=0,comando='',error='';    
    if(form1.chknuevo.checked==true){        
        if(form1.tipodocumentoidentificacion.value==''){error=error+"Tipo documento de identificación\n";}
        if(form1.numerodocumentoidentificacion.value==''){error=error+"Número de documento\n";}
        if(form1.fechanacimiento.value==''){error=error+"Fecha de nacimiento\n";}
        if(form1.edadgestacional.value==''){error=error+"Edad gestacional\n";}
        if(form1.numeroconsultascprenatal.value==''){error=error+"Número de consultas prenatales \n";}
        if(form1.codsexobiologico.value==''){error=error+"Sexo biológico\n";}
        if(form1.peso.value==''){error=error+"Peso\n";}        
        if(form1.coddiagnosticoprincipal.value==''){error=error+"Diagnóstico principal\n";}
        if(form1.condiciondestinoegreso.value==''){error=error+"Condición y destino\n";}
        if(form1.condiciondestinoegreso.value=='02' && form1.coddiagnosticocausamuerte.value==''){error=error+"Diagnóstico de muerte\n";}

        if(form1.condiciondestinoegreso.value!='02' && form1.coddiagnosticocausamuerte.value!=''){
            form1.coddiagnosticocausamuerte.value='';
        }
        
        if(form1.fechaegreso.value==''){error=error+"Fecha de egreso\n";}
    }
    else{
        for(i=0;i<cont_;i++){
            comando="form1.tipodocumentoidentificacion"+i+".value"
            if(eval(comando)==''){error=error+"Tipo de documento de identificación "+i+"\n";}
            comando="form1.numerodocumentoidentificacion"+i+".value"
            if(eval(comando)==''){error=error+"Número de documento "+i+"\n";}
            comando="form1.fechanacimiento"+i+".value"
            if(eval(comando)==''){error=error+"Fecha de nacimiento "+i+"\n";}
            comando="form1.edadgestacional"+i+".value"
            if(eval(comando)==''){error=error+"Edad gestacional "+i+"\n";}
            comando="form1.numeroconsultascprenatal"+i+".value"
            if(eval(comando)==''){error=error+"Número de consultas prenatales "+i+"\n";}
            comando="form1.codsexobiologico"+i+".value"
            if(eval(comando)==''){error=error+"Sexo "+i+"\n";}
            comando="form1.peso"+i+".value"
            if(eval(comando)==''){error=error+"Peso "+i+"\n";}
            comando="form1.coddiagnosticoprincipal"+i+".value"
            if(eval(comando)==''){error=error+"Diagnóstico principal "+i+"\n";}
            comando="form1.condiciondestinoegreso"+i+".value"
            if(eval(comando)==''){error=error+"Destino y condicion "+i+"\n";}                        

            comando="form1.condiciondestinoegreso"+i+".value";
            comando2="form1.coddiagnosticocausamuerte"+i+".value";
            if(eval(comando)=='02' && eval(comando2)==''){error=error+"Diagnóstico de muerte "+i+"\n";}
            if(eval(comando)!='02' && eval(comando2)!=''){
                comando="form1.coddiagnosticocausamuerte"+i+".value=''";
                eval(comando);
            }

            comando="form1.fechaegreso"+i+".value";            
            if(eval(comando)==''){error=error+"Fecha de egreso "+i+"\n";}
        }
    }
    if(error!=''){
        alert("Para guardar debe complementar la siguiente información:\n\n"+error);
    }
    else{
        form1.submit();
    }
}

function ayuda(tipo_,codi_){
var url="fac_ayuda.php?tipo_="+tipo_+"&codi_="+codi_;
  window.open(url,"ventana1","width=400,height=700,scrollbars=1,top=100,left=800") 
}

function activasel(var_,val_){
  var comando="form1."+var_+".value='"+val_+"'";
  eval(comando);
}

function borrareg(tipo_,regi_){
    var url_='';
    if(confirm("Desea borrar el registro del recien nacido?")){            
        url_="fac_3borrarips.php?reg="+regi_+"&tipo="+tipo_;
        window.open(url_,"fr02");
    }
}
</script>

</head>
<body>
<div>
  <ul class="menu">
    <li><a href="fac_3muestraripsusua.php">Usuario</a></li>
    <li><a href="fac_3muestraripscons.php">Consultas</a></li>
    <li><a href="fac_3muestraripsproc.php">Procedimientos</a></li>
    <li><a href="fac_3muestraripsmedi.php">Medicamentos</a></li>
    <li><a href="fac_3muestraripsotro.php">Otros Servicios</a></li>
    <li><a href="fac_3muestraripsurge.php">Urgencias</a></li>    
    <li><a href="fac_3muestraripshosp.php">Hospitalización</a></li>
    <li><a href="fac_3muestraripsrnac.php" class="activo">R. Nacidos</a></li>
    <li><a href="fac_3generaripsjson.php">Generar Json</a></li>
  </ul>
</div>


<form name='form1' method="POST" action='fac_3guardaripsnac.php' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'><h2>R I P S(2275) de Recién nacidos</h2></td></tr></table>
<?php
include('php/conexion.php');
include('php/funciones.php');
//include('menurips2275.html');
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
<table class="Tbl0" border='1'>
  <th class="Th0" colspan='2'><b>Sel</td>
  <th class="Th0"><b>Tipo documento</td>
  <th class="Th0"><b>Número de documento</td>
  <th class="Th0"><b>Fecha nacimiento</td>
  <th class="Th0"><b>Edad gestacional</td>
  <th class="Th0"><b>Nro consulta prenatales</td>
  <th class="Th0"><b>Sexo biológico</td>
  <th class="Th0"><b>Peso</td>
  <th class="Th0"><b>Diagnósticos</td>
  <th class="Th0"><b>Condicion y destino</td>
  <th class="Th0"><b>Fecha de egreso</td>
<?
  $cont=0;
  $consultacon="SELECT rna.id_nacidos,rna.tipodocumentoidentificacion,rna.numerodocumentoidentificacion,rna.fechanacimiento,rna.edadgestacional,rna.numeroconsultascprenatal,rna.codsexobiologico,rna.peso,rna.coddiagnosticoprincipal,rna.condiciondestinoegreso,rna.coddiagnosticocausamuerte,rna.fechaegreso,rna.consecutivo,rna.iden_fac
  FROM nrnacidos AS rna
  WHERE rna.iden_fac='$giden_fac'";
  //echo $consultacon;
  $consultacon=mysql_query($consultacon);
  while($rowcon=mysql_fetch_array($consultacon)){
    $nomvar="id_nacidos".$cont;
	echo "<input type='hidden' name='$nomvar' value='$rowcon[id_nacidos]'>";
    echo "<tr>";
	$nomvar="chk".$cont;
    echo "<td class='Td2' align='left'><input type='checkbox' name='$nomvar' onclick='activar($cont)'></td>
	<td class='Td2' align='center'><a href='#' onclick=borrareg('N',$rowcon[id_nacidos])><img src='icons/feed_delete.png' width='15' height='15'></a>
	</td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='E3'");
	$nomvar="tipodocumentoidentificacion".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
	  while($rowdes=mysql_fetch_array($consultades)){
	    echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
	  }
	echo "</select>";
	echo "</td>";
	?>
  	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[tipodocumentoidentificacion];?>');</script>
	<?php

    $nomvar="numerodocumentoidentificacion".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='20' maxlength='20' value='$rowcon[numerodocumentoidentificacion]' disabled></td>";

    $nomvar="fechanacimiento".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='16' maxlength='16' value='$rowcon[fechanacimiento]' disabled></td>";	
	
    $nomvar="edadgestacional".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='2' maxlength='2' value='$rowcon[edadgestacional]' disabled>Semanas</td>";

    $nomvar="numeroconsultascprenatal".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='2' maxlength='2' value='$rowcon[numeroconsultascprenatal]' disabled></td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H9'");
	$nomvar="codsexobiologico".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
	  while($rowdes=mysql_fetch_array($consultades)){
	    echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
	  }
	echo "</select>";
	echo "</td>";
	?>
	<script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[codsexobiologico];?>');</script>
	<?php

    $nomvar="peso".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[peso]' disabled>Gr</td>";

	$nomvar="coddiagnosticoprincipal".$cont;
	echo "<td class='Td2' align='center'>Principal<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticoprincipal]' disabled><a href='#' onclick='ayuda(\"D\",\"$rowcon[coddiagnosticoprincipal]\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>";

    $nomvar="coddiagnosticocausamuerte".$cont;
	echo "<br>Muerte<input type='text' name='$nomvar' size='4' maxlength='4' value='$rowcon[coddiagnosticocausamuerte]' disabled>";
	echo "</td>";

    $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H3'");
    $nomvar="condiciondestinoegreso".$cont;
    echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
    while($rowdes=mysql_fetch_array($consultades)){
      echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
    }
    echo "</select>";
    echo "</td>";
    ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[condiciondestinoegreso];?>');</script>
    <?php    

    $nomvar="fechaegreso".$cont;
    echo "<td class='Td2' align='center'><input type='text' name='$nomvar' size='10' maxlength='10' value='$rowcon[fechaegreso]' disabled></td>";

    echo "</tr>";
	$cont++;
  }
  echo "<tr>";
  echo "<td class='Td2' align='left'><input type='checkbox' name='chknuevo' onclick='activar2()'>
  </td><td class='Td2' align='center'>Nuevo</td>";

  $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='E3'");
  $nomvar="tipodocumentoidentificacion";
  echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
  while($rowdes=mysql_fetch_array($consultades)){
    echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
  }
  echo "</select>";
  echo "</td>";
  ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[tipodocumentoidentificacion];?>');</script>
  <?php
  echo "<td class='Td2' align='center'><input type='text' name='numerodocumentoidentificacion' size='20' maxlength='20' disabled></td>";
  echo "<td class='Td2' align='center'><input type='text' name='fechanacimiento' size='16' maxlength='16' disabled></td>";
  echo "<td class='Td2' align='center'><input type='text' name='edadgestacional' size='2' maxlength='2' disabled>Semanas</td>";
  echo "<td class='Td2' align='center'><input type='text' name='numeroconsultascprenatal' size='2' maxlength='2' disabled></td>";
  
  $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H9'");
  $nomvar="codsexobiologico";
  echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
  while($rowdes=mysql_fetch_array($consultades)){
    echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,20);
  }
  echo "</select>";
  echo "</td>";
  ?>
    <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[codsexobiologico];?>');</script>
  <?php  
  
  echo "<td class='Td2' align='center'><input type='text' name='peso' size='4' maxlength='4' disabled>Gr</td>";
  echo "<td class='Td2' align='center'>Principal<input type='text' name='coddiagnosticoprincipal' size='4' maxlength='4' disabled><a href='#' onclick='ayuda(\"D\",\"$coddiagnosticoprincipal\")'><img src='icons/feed_magnify.png' width='15' height='15'></a>";
  echo "<br>Muerte<input type='text' name='coddiagnosticocausamuerte' size='4' maxlength='4' value='$rowcon[coddiagnosticocausamuerte]' disabled>";
  echo "</td>";

  $consultades=mysql_query("SELECT valo_des,nomb_des FROM destipos WHERE codt_des='H3'");
  $nomvar="condiciondestinoegreso";
  echo "<td class='Td2' align='center'><select name='$nomvar' disabled>";
  while($rowdes=mysql_fetch_array($consultades)){
    echo "<option value='$rowdes[valo_des]'>$rowdes[valo_des] ".substr($rowdes[nomb_des],0,40);
  }
  echo "</select>";
  echo "</td>";
  ?>
  <script language='javascript'>activasel('<?echo $nomvar;?>','<?echo $rowcon[condiciondestinoegreso];?>');</script>
  <?php
  
  echo "<td class='Td2' align='center'><input type='text' name='fechaegreso' size='16' maxlength='16' disabled></td>";
  echo "</tr>";  
  
mysql_free_result($consulta);
mysql_free_result($consultacon);
mysql_close();
?>    
</table>
<br><br>
<center><a href='#' onclick='validar(<?echo $cont;?>)'><img src='icons/feed_disk.png' width='20' height='20'>Guardar</a></center>
<input type='hidden' name='cont' value='<?echo $cont;?>'>
</form>
</body>
</html>
