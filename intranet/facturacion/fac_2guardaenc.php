<?php
session_start();
session_register('iden_fac');
session_register('$Gidusufac');
if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicaci�n");
  window.top.close();
  </script>
  <?
}
else{
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//include('php/funciones.php');
include('php/conexion.php');

//Aqui creo un archivo para guardar los datos del encabezado de la factura
$archivo="tmp/af".$id_ing.$enti_fac.".txt";
$fp = fopen($archivo, 'w+');
$cadena="iden_ctr|$iden_ctr\n";
fwrite($fp, $cadena);
$cadena="tipo_fac|$tipo_fac\n";
fwrite($fp, $cadena);
$cadena="feci_fac|$feci_fac\n";
fwrite($fp, $cadena);
$cadena="fecf_fac|$fecf_fac\n";
fwrite($fp, $cadena);
$cadena="rela_fac|$rela_fac\n";
fwrite($fp, $cadena);
$cadena="codi_usu|$codi_usu\n";
fwrite($fp, $cadena);
$cadena="iden_ctr|$iden_ctr\n";
fwrite($fp, $cadena);
$cadena="cod_cie10|$cod_cie10\n";
fwrite($fp, $cadena);
$cadena="area_fac|$servicio\n";
fwrite($fp, $cadena);
$cadena="enti_fac|$enti_fac\n";
fwrite($fp, $cadena);
$cadena="nauto_fac|$nauto_fac\n";
fwrite($fp, $cadena);
fclose($fp);

//Tipos permitidos para el campo
// I = Insumos
// M = Medicamentos
// P = Otros diferentes a los anteriores (consultas, interconsultas, laboratorios, imagenes Dx, etc

//Aqui creo un archivo para guardar los datos del detalle de la factura
$archivo="tmp/ad".$id_ing.$enti_fac.".txt";
$fp = fopen($archivo, 'w+');
//Datos de la estancia
for($ce=0;$ce<=$conte;$ce++){
  $var="chkestan".$ce;
  if($$var=='on'){
    $var="estancia".$ce;
    $cadena="tipo|P\n";
    fwrite($fp, $cadena);
    $cadena="codigo|".$$var."\n";
    fwrite($fp, $cadena);
    $var="servicio".$ce;    
    $cadena="servicio|".$$var."\n";

    fwrite($fp, $cadena);
    /*$var="fecha_ser".$ce;
    $cadena="fecha_ser|".$$var."\n";
    fwrite($fp, $cadena);*/

    $var="diasest".$ce;
    $cadena="cant_dfa|".$$var."\n";
    fwrite($fp, $cadena);
  }
}

//Datos de la valoraciones
if(!empty($valoracion)){
  $cadena="tipo|P\n";
  fwrite($fp, $cadena);
  $cadena="codigo|$valoracion\n";
  fwrite($fp, $cadena);

  $cadena="servicio|$serviciovalo\n";
  fwrite($fp, $cadena);
  /*$cadena="fecha_ser|$fecha_valo\n";
  fwrite($fp, $cadena);*/

  $cadena="cant_dfa|$cantvalo\n";
  fwrite($fp, $cadena);
}
if(!empty($valoracionini)){
  $cadena="tipo|P\n";
  fwrite($fp, $cadena);
  $cadena="codigo|$valoracionini\n";
  fwrite($fp, $cadena);

  $cadena="servicio|$servicioini\n";
  fwrite($fp, $cadena);
  /*$cadena="fecha_ser|$fecha_ini\n";
  fwrite($fp, $cadena);  */

  $cadena="cant_dfa|$cantvalini\n";
  fwrite($fp, $cadena);
}
//Datos de las evoluciones
for($i=0;$i<$contc;$i++){
  $var="codigo".$i;
  if(!empty($$var)){
    $cadena="tipo|P\n";
    fwrite($fp, $cadena);
    $cadena="codigo|".$$var."\n";
    fwrite($fp, $cadena);

    $var="servicio_evo".$i;
    $cadena="servicio|".$$var."\n";
    fwrite($fp, $cadena);
    $var="fecha_evo".$i;
    /*$cadena="fecha_ser|".$$var."\n";
    fwrite($fp, $cadena);*/

    $cadena="cant_dfa|1\n";
    fwrite($fp, $cadena);
	  $var="iden_evo".$i;
	  $actualiza="UPDATE hist_evo SET fact_evo='S' WHERE iden_evo='".$$var."'";
	  mysql_query($actualiza);
  }
  $var="chknfevo".$i;
  if($$var=='on'){
  	$var="iden_evo".$i;
  	$actualiza="UPDATE hist_evo SET fact_evo='N' WHERE iden_evo='".$$var."'";
  	mysql_query($actualiza);
  }
}

//Datos de las administraciones
for($i=0;$i<$conta;$i++){
  $var="chkadmin".$i;
  if(!empty($$var)){
    $var="tpid_adi".$i;
    $cadena="tipo|".$$var."\n";
	  //$cadena="tipo|M\n";
    fwrite($fp, $cadena);
	  $var="chkadmin".$i;
    $cadena="codigo|".$$var."\n";
    fwrite($fp, $cadena);

    $var="servicio_adi".$i;
    $cadena="servicio|".$$var."\n";
    fwrite($fp, $cadena);
    /*$var="fecha_adi".$i;    
    $cadena="fecha_ser|".$$var."\n";
    fwrite($fp, $cadena);*/

  	$var="cant_adi".$i;
  	$cantidad=$$var;
  	$cadena="cant_dfa|$cantidad\n";
    fwrite($fp, $cadena);
  	$var="iden_adi".$i;
  	//$actualiza="UPDATE movi_med SET fact_mme='S' WHERE iden_mme='".$$var."'";
  	$actualiza="UPDATE administra_insumo SET fact_adi='S' WHERE iden_adi='".$$var."'";
  	mysql_query($actualiza);
  }
  $var="chknfadmin".$i;
  if($$var=='on'){
  	$var="iden_adi".$i;
  	$actualiza="UPDATE administra_insumo SET fact_adi='N' WHERE iden_adi='".$$var."'";
  	mysql_query($actualiza);
  }
}

//Datos de las terapias
for($i=0;$i<$contt;$i++){
  $var="chkter".$i;
  if(!empty($$var)){
    $cadena="tipo|P\n";
    fwrite($fp, $cadena);
    $cadena="codigo|".$$var."\n";
    fwrite($fp, $cadena);
	   
    $var="servicio_ter".$i;
    $cadena="servicio|".$$var."\n";
    fwrite($fp, $cadena);
    /*$var="fecha_ter".$i;    
    $cadena="fecha_ser|".$$var."\n";
    fwrite($fp, $cadena);*/

    $cadena="cant_dfa|1\n";
    fwrite($fp, $cadena);
    $var="iden_ter".$i;
    $actualiza="UPDATE terapia_evolucion SET fact_ter='S' WHERE iden_ter='".$$var."'";    
    mysql_query($actualiza);
  }
  $var="chknfter".$i;
  if($$var=='on'){
	$var="iden_ter".$i;
	//$actualiza="UPDATE terapia_evolucion SET fact_ter='N' WHERE iden_ter='".$$var."'";
	//mysql_query($actualiza);
  }
}

//Datos de las insumos de terapias
for($i=0;$i<$contti;$i++){
  $var="chkterins".$i;
  if(!empty($$var)){
    $cadena="tipo|I\n";
    fwrite($fp, $cadena);
    $cadena="codigo|".$$var."\n";
    fwrite($fp, $cadena);
	   
    $var="servicio_terins".$i;
    $cadena="servicio|".$$var."\n";
    fwrite($fp, $cadena);
    /*$var="fecha_terins".$i;
    $cadena="fecha_ser|".$$var."\n";
    fwrite($fp, $cadena);*/

    $var="cant_terins".$i;        
    $cadena="cant_dfa|".$$var."\n";
    fwrite($fp, $cadena);
    $var="iden_sal".$i;
    $actualiza="UPDATE terapia_salinsu SET fact_sal='S' WHERE iden_sal='".$$var."'";
    mysql_query($actualiza);
  }
  $var="chknfter".$i;
  if($$var=='on'){
	$var="iden_ter".$i;
  }
}

//Datos de los medicamentos de terapias
for($i=0;$i<$conttm;$i++){
  $var="chktermed".$i;
  if(!empty($$var)){
    $cadena="tipo|M\n";
    fwrite($fp, $cadena);
    $cadena="codigo|".$$var."\n";
    fwrite($fp, $cadena);
	   
    $var="servicio_termed".$i;
    $cadena="servicio|".$$var."\n";
    fwrite($fp, $cadena);
    /*$var="fecha_termed".$i;
    $cadena="fecha_ser|".$$var."\n";
    fwrite($fp, $cadena);*/

    $var="cant_termed".$i;        
    $cadena="cant_dfa|".$$var."\n";
    fwrite($fp, $cadena);
    $var="iden_salmed".$i;
    $actualiza="UPDATE terapia_salinsu SET fact_sal='S' WHERE iden_sal='".$$var."'";
    mysql_query($actualiza);
  }
  $var="chknfter".$i;
  if($$var=='on'){
	$var="iden_ter".$i;
 }
}

//Datos de las ordenes/Ayudas Dx
for($i=0;$i<$contv;$i++){  
  $var="chkvar".$i;
  $codi_map=$$var;
  if(!empty($$var)){
    $cadena="tipo|P\n";
    fwrite($fp, $cadena);
    $cadena="codigo|".$$var."\n";
    fwrite($fp, $cadena);

    $var="servicio_var".$i;    
    $cadena="servicio|".$$var."\n";
    fwrite($fp, $cadena);
    /*$var="fecha_var".$i;
    $cadena="fecha_ser|".$$var."\n";
    fwrite($fp, $cadena);*/

  	$cantidad=1;
  	$cadena="cant_dfa|$cantidad\n";
    fwrite($fp, $cadena);
  	$var="iden_var".$i;
    $actualiza="UPDATE hist_var SET fact_var='S' WHERE iden_var='".$$var."'";        
  	mysql_query($actualiza);
  }
  $var="chknfvar".$i;
  if($$var=='on'){
  	$var="iden_var".$i;
    $actualiza="UPDATE hist_var SET fact_var='N' WHERE iden_var='".$$var."'";    
  	mysql_query($actualiza);
  }
}

//Datos de otros servicios
for($i=0;$i<$conts;$i++){
  $var="codi_ser".$i;
  if(!empty($$var)){
    $cadena="tipo|P\n";
    fwrite($fp, $cadena);
    $cadena="codigo|".$$var."\n";
    fwrite($fp, $cadena);

    $var="servicio_ser".$i;    
    $cadena="servicio|".$$var."\n";
    fwrite($fp, $cadena);
    /*$var="fecha_ser".$i;
    $cadena="fecha_ser|".$$var."\n";
    fwrite($fp, $cadena);*/

  	$cantidad=1;
  	$cadena="cant_dfa|$cantidad\n";
    fwrite($fp, $cadena);
  	$var="iden_ser".$i;
  	$actualiza="UPDATE ordenvarias SET fact_ord='S' WHERE iden_ord='".$$var."'";
  	mysql_query($actualiza);
  }
  $var="chknfser".$i;
  if($$var=='on'){
	  $var="iden_ser".$i;
	  $actualiza="UPDATE ordenvarias SET fact_ord='N' WHERE iden_ord='".$$var."'";
	  mysql_query($actualiza);
  }  
}
fclose($fp);
mysql_close();
echo "<body onload='location.href=\"fac_2encab.php?id_ing=$id_ing\"'>";
?>

</body>
</html>
<?php
}
?>