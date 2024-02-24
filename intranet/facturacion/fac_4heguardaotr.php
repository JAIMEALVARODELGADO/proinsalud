<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_4hemuestraotro.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');
?>
<img src='icons/barra4.png' width='910' height='30' usemap="#actividades" border='0'/>
<?
for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="naut_fos".$i;
		$actualiza="UPDATE fotros_servicios SET naut_fos='".$$nomvar."',";
		$nomvar="tpser_fos".$i;
		$actualiza=$actualiza."tpser_fos='".$$nomvar."',";
		$nomvar="cods_fos".$i;
		$actualiza=$actualiza."cods_fos='".$$nomvar."',";
		$nomvar="noms_fos".$i;
		$actualiza=$actualiza."noms_fos='".$$nomvar."'";
		$nomvar="regi_fos".$i;
		$actualiza=$actualiza." WHERE regi_fos=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>


