<?
session_start();
session_register('iden_fac');
//session_register('Gidusufac');
if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicaci�n");
  window.top.close();
  </script>
  <?
}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');

//Aqui cargo el archivo que contiene el encabezado de la prefactura
$archivo="tmp/af".$id_ing.$enti_fac.".txt";
if(file_exists($archivo)){
  $fp = fopen ($archivo, "r" );
  $reg=0;
  while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ) { // Mientras hay l�neas que leer...
    $reg++;
    $i = 0;
    foreach($data as $dato){
      $campo[$i]=$dato;
      $i++ ;
    }
    $$campo[0]=$campo[1];
  }
}
//$fp=fclose($archivo);

$feci_fac=cambiafecha($feci_fac);
$fecf_fac=cambiafecha($fecf_fac);
$frea_fac=cambiafecha(hoy());
if(!empty($agregafac)){
  //Aqui tomo el numero de la factura para agregar las actividades seleccionadas
  $iden_fac=$agregafac;
}
else{
  //Aqui creo el encabezado de la factura  
  $inser="INSERT INTO encabezado_factura 
  (iden_fac,id_ing,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,rela_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,pdes_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac,frea_fac,nauto_fac)
  VALUES (0,$id_ing,'','','$tipo_fac','$feci_fac','$fecf_fac','$rela_fac','$codi_usu','$codi_con','$iden_ctr','$cod_cie10','$area_fac',0,0,0,0,'1','$enti_fac','N','$Gidusufac','$frea_fac','$nauto_fac')";
  //echo "<br>".$inser;
  mysql_query($inser);
  //echo mysql_affected_rows();
  $iden_fac=mysql_insert_id();
}
//echo $iden_fac;
//Aqui creo los detalles de la factura, con las administraciones seleccionadas
for($i=0;$i<$cont;$i++){
  $var="codi_dfa".$i;
  //echo "<br>".$var." ".$$var;
  if(!empty($$var)){
    $tipo="tipo".$i;
	  $tipo=$$tipo;    
    switch ($tipo){
        case 'P':
            /*$consultatco="SELECT t.iden_tco as iden_tco,t.valo_tco as valo_tco,m.desc_map as desc_ 
            FROM tarco AS t
            INNER JOIN mapii AS m ON m.iden_map=t.iden_map 
            INNER JOIN contratacion AS c ON c.iden_ctr=t.iden_ctr AND c.iden_ctr =$iden_ctr
            WHERE m.codi_map='".$$var."' ";*/
            $consultatco="SELECT t.iden_tco as iden_tco,t.valo_tco as valor_,m.desc_map as desc_ 
            FROM tarco AS t
            INNER JOIN mapii AS m ON m.iden_map=t.iden_map 
            INNER JOIN contratacion AS c ON c.iden_ctr=t.iden_ctr AND c.iden_ctr =$iden_ctr
            WHERE t.iden_tco='".$$var."' ";
            break;
        case 'I':
            //Aqui consulto el valor de insumos
            /*$consultatco="SELECT t.iden_tco as iden_tco,t.valo_tco as valor_,ins.desc_ins as desc_ 
            FROM tarco AS t
            INNER JOIN insu_med AS ins ON ins.codnue=t.iden_map AND t.iden_ctr=$iden_ctr
            WHERE t.iden_map='".$$var."'";*/
            $consultatco="SELECT t.iden_tco as iden_tco,t.valo_tco as valor_,ins.desc_ins as desc_ 
            FROM tarco AS t
            INNER JOIN insu_med AS ins ON ins.codi_ins=t.iden_map AND t.iden_ctr=$iden_ctr
            WHERE t.iden_map='".$$var."'";
            break;
        case 'M':
            //Aqui consulto el valor  medicamentos  
            /*$consultatco="SELECT t.iden_tco as iden_tco,t.valo_tco as valor_,mdi.nomb_mdi as desc_ 
            FROM tarco AS t
            INNER JOIN medicamentos2 AS mdi ON mdi.codi_mdi=t.iden_map AND t.iden_ctr=$iden_ctr
            WHERE t.iden_map='".$$var."'";*/
            $consultatco="SELECT t.iden_tco as iden_tco,t.valo_tco as valor_,mdi.nombre_mdi as desc_ 
            FROM tarco AS t
            INNER JOIN vista_medicamentos2 AS mdi ON mdi.codi_mdi=t.iden_map AND t.iden_ctr=$iden_ctr
            WHERE t.iden_map='".$$var."'";
            break;
    }
  //echo "<br>". $consultatco;
	$restco=mysql_query($consultatco);
	$rowtco=mysql_fetch_array($restco);
	if($tppo_mxc=='D'){
	  //$valo_tco=round($rowtco[valor_]-($rowtco[valor_]*($porc_mxc/100)),-2);
	  $valo_tco=$rowtco[valor_]-($rowtco[valor_]*($porc_mxc/100));
	}
	else{
	  //$valo_tco=round($rowtco[valor_]+($rowtco[valor_]*($porc_mxc/100)),-2);
	  $valo_tco=$rowtco[valor_]+($rowtco[valor_]*($porc_mxc/100));
	}
  $var="cant_dfa".$i;
	$cantidad=$$var;

  $var="servicio".$i;
  $servicio=$$var;
  //$var="fecha_ser".$i;
  //$fecha_ser=$$var;
  //$fecha_ser=cambiafecha($fecha_ser);
  $consultadet="SELECT iden_dfa,cant_dfa FROM detalle_factura WHERE iden_fac='$iden_fac' AND iden_tco='$rowtco[iden_tco]' AND servi_dfa='$servicio'";
  //echo "<br>".$consultadet;
  $consultadet=mysql_query($consultadet);
	if(mysql_num_rows($consultadet)==0){
    /*$sql_det="INSERT INTO detalle_factura (iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,servi_dfa,fecservi_dfa) 
    VALUES(0,'$tipo',$iden_fac,$rowtco[iden_tco],'$rowtco[desc_]',$cantidad,$valo_tco,'1','$nauto_fac','$servicio','$fecha_ser')";*/
    $sql_det="INSERT INTO detalle_factura (iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,servi_dfa) 
    VALUES(0,'$tipo',$iden_fac,$rowtco[iden_tco],'$rowtco[desc_]',$cantidad,$valo_tco,'1','$nauto_fac','$servicio')";
    //echo "<br>".$sql_det;
    mysql_query($sql_det);    
	}
	else{
	  $rowdet=mysql_fetch_array($consultadet);
	  mysql_query("UPDATE detalle_factura SET cant_dfa=$rowdet[cant_dfa]+$cantidad WHERE iden_dfa=$rowdet[iden_dfa]");
	}
	mysql_free_result($consultadet);
	mysql_free_result($restco);
  }
}
$fp=fclose($archivo);
//Aqui borro los archivos temporales
$archivo="tmp/af".$id_ing.$enti_fac.".txt";
unlink($archivo);
$archivo="tmp/ad".$id_ing.$enti_fac.".txt";
unlink($archivo);
echo "<body onload='location.href=\"fac_2detfactu.php?iden_fac=$iden_fac\"'>";
?>
</html><html><head></head><body></body></html>