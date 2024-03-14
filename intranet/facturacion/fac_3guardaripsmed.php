<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_3muestraripsmedi.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');

for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="numautorizacion".$i;
		$actualiza="UPDATE nrmedicamento SET numautorizacion='".$$nomvar."',";		
		$nomvar="idmipres".$i;
		$actualiza=$actualiza."idmipres='".$$nomvar."',";
		$nomvar="fechadispensadmon".$i;
		$actualiza=$actualiza."fechadispensadmon='".$$nomvar."',";
		$nomvar="coddiagnosticoprincipal".$i;
		$actualiza=$actualiza."coddiagnosticoprincipal='".$$nomvar."',";
		$nomvar="coddiagnosticorelacionado".$i;
		$actualiza=$actualiza."coddiagnosticorelacionado='".$$nomvar."',";
		$nomvar="tipomedicamento".$i;
		$actualiza=$actualiza."tipomedicamento='".$$nomvar."',";
		$nomvar="codtecnologia".$i;
		$actualiza=$actualiza."codtecnologia='".$$nomvar."',";		
		$nomvar="nomtecnologia".$i;
		$actualiza=$actualiza."nomtecnologia='".$$nomvar."',";
		$nomvar="concentracion".$i;
		$actualiza=$actualiza."concentracion='".$$nomvar."',";
		$nomvar="unidadmedida".$i;		
		$actualiza=$actualiza."unidadmedida='".$$nomvar."',";
		$nomvar="formafarmaceutica".$i;
		$actualiza=$actualiza."formafarmaceutica='".$$nomvar."',";
		$nomvar="unidadmindispensa".$i;
		$actualiza=$actualiza."unidadmindispensa='".$$nomvar."',";
		$nomvar="diastratamiento".$i;
		$actualiza=$actualiza."diastratamiento='".$$nomvar."',";
		$nomvar="conceptorecaudo".$i;
		$actualiza=$actualiza."conceptorecaudo='".$$nomvar."',";
		$nomvar="valorpagomoderador".$i;
		$actualiza=$actualiza."valorpagomoderador='".$$nomvar."',";
		$nomvar="numfevpagomoderador".$i;
		$actualiza=$actualiza."numfevpagomoderador='".$$nomvar."'";
		$nomvar="id_medicamento".$i;
		$actualiza=$actualiza." WHERE id_medicamento=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>


