<?
session_start();
session_register('iden_fac');
//session_register('Gidusufac');
if(empty($Gidusufac)){
  ?>
  <script language='javascript'>
  alert("La sesion ha finalizado, porfavor ingrese nuevamente a la aplicación");
  window.top.close();
  </script>
  <?
}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?

include('php/funciones.php');
include('php/conexion.php');

//Aqui cargo el archivo que contiene el encabezado de la prefactura
$archivo="tmp/af".$iden_qxf.$enti_fac.".txt";
if(file_exists($archivo)){
  $fp = fopen ($archivo, "r" );
  $reg=0;
  while (( $data = fgetcsv ( $fp , 1000 , "|" )) !== FALSE ){ // Mientras hay líneas que leer...
    $reg++;
    $i = 0;
    foreach($data as $dato){
      $campo[$i]=$dato;
      $i++ ;
    }
    $$campo[0]=$campo[1];
  }
  fclose($fp);
}

$feci_fac=cambiafecha($feci_fac);
$fecf_fac=cambiafecha($fecf_fac);

//Aqui creo el encabezado de la factura
mysql_query("INSERT INTO encabezado_factura 
(iden_fac,id_ing,nume_fac,pref_fac,tipo_fac,feci_fac,fecf_fac,rela_fac,codi_usu,iden_ctr,cod_cie10,vtot_fac,pcop_fac,pdes_fac,vnet_fac,esta_fac,enti_fac,usua_fac)
VALUES (0,0,'','','$tipo_fac','$feci_fac','$fecf_fac','$rela_fac','$codi_usu','$iden_ctr','$cod_cie10',0,0,0,0,'1','$enti_fac','$Gidusufac')");
$iden_fac=mysql_insert_id();
//Aqui creo los detalles de la factura, con las administraciones seleccionadas
for($i=0;$i<$cont;$i++){
  $var="codi_dfa".$i;
  if($$var=='on'){
    $var="codigo".$i;
	$var="iden_tco".$i;
	$consultatco="SELECT t.iden_tco,t.valo_tco,m.desc_map 
	FROM tarco AS t
	INNER JOIN mapii AS m ON m.iden_map=t.iden_map 
	WHERE t.iden_tco='".$$var."' ";
	$restco=mysql_query($consultatco);
	$rowtco=mysql_fetch_array($restco);
	//echo $rowtco[valo_tco];
	$cons="INSERT INTO detalle_factura (iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa) 
	VALUES(0,'O',$iden_fac,'$rowtco[iden_tco]','$rowtco[desc_map]',1,$rowtco[valo_tco],'1')";
	echo "<br>".$cons;

	mysql_query("INSERT INTO detalle_factura (iden_dfa,tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa) 
	VALUES(0,'O',$iden_fac,'$rowtco[iden_tco]','$rowtco[desc_map]',1,$rowtco[valo_tco],'1')");
		   
    $iden_dfa=mysql_insert_id();
	$valtot=0;
	for($contser=0;$contser<5;$contser++){
	  $var="codi_via".$i."_".$contser;
	  if($$var=='on'){
	    $iden_gxc='iden_gxc'.$i."_".$contser;
		$valor="valor".$i."_".$contser;
	    $insert="INSERT INTO grupoxdeta(iden_gxd,iden_dfa,iden_gxc,valo_gxd) VALUES(0,'$iden_dfa','".$$iden_gxc."',".$$valor.")";
	    mysql_query($insert);
		$valtot+=$$valor;
	  }
	}
	mysql_query("UPDATE detalle_factura SET valu_dfa=$valtot WHERE iden_dfa=$iden_dfa");
	mysql_free_result($restco);
  }
}
mysql_free_result($consulta);
//Aqui borro los archivos temporales
$archivo="tmp/af".$iden_qxf.$enti_fac.".txt";
unlink($archivo);
$archivo="tmp/qx".$iden_qxf.$enti_fac.".txt";
unlink($archivo);
echo "<body onload='location.href=\"fac_2detfactu.php?iden_fac=$iden_fac\"'>";
?>
</html>