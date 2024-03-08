<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_3muestraripsotro.php","fr02") 
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
		$nomvar="numautorizacion".$i;
		$actualiza="UPDATE nrotroservicios SET numautorizacion='".$$nomvar."',";
		$nomvar="idmipres".$i;
		$actualiza=$actualiza."idmipres='".$$nomvar."',";
		$nomvar="fechasuministrotecnologia".$i;
		$actualiza=$actualiza."fechasuministrotecnologia='".$$nomvar."',";
		$nomvar="tipoos".$i;
		$actualiza=$actualiza."tipoos='".$$nomvar."',";
        $nomvar="codtecnologia".$i;
		$actualiza=$actualiza."codtecnologia='".$$nomvar."',";
        $nomvar="nomtecnologia".$i;
		$actualiza=$actualiza."nomtecnologia='".$$nomvar."',";
        $nomvar="conceptorecaudo".$i;
		$actualiza=$actualiza."conceptorecaudo='".$$nomvar."',";
        $nomvar="valorpagomoderador".$i;
		$actualiza=$actualiza."valorpagomoderador='".$$nomvar."',";
        $nomvar="numfevpagomoderador".$i;
		$actualiza=$actualiza."numfevpagomoderador='".$$nomvar."'";        
		$nomvar="id_otros".$i;
		$actualiza=$actualiza." WHERE id_otros=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>


