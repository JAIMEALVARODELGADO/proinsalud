<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_3muestraripshosp.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');

for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="viaingresoservicio".$i;
		$actualiza="UPDATE nrhospital SET viaingresoservicio='".$$nomvar."',";
		$nomvar="fechainicioatencion".$i;
		$actualiza=$actualiza."fechainicioatencion='".$$nomvar."',";
		$nomvar="numautorizacion".$i;
		$actualiza=$actualiza."numautorizacion='".$$nomvar."',";
		$nomvar="causamotivoatencion".$i;
		$actualiza=$actualiza."causamotivoatencion='".$$nomvar."',";
		$nomvar="coddiagnosticoprincipal".$i;
		$actualiza=$actualiza."coddiagnosticoprincipal='".$$nomvar."',";
		$nomvar="coddiagnosticoprincipale".$i;
		$actualiza=$actualiza."coddiagnosticoprincipale='".$$nomvar."',";
		$nomvar="coddiagnosticorelacionadoe1".$i;
		$actualiza=$actualiza."coddiagnosticorelacionadoe1='".$$nomvar."',";
		$nomvar="coddiagnosticorelacionadoe2".$i;
		$actualiza=$actualiza."coddiagnosticorelacionadoe2='".$$nomvar."',";
		$nomvar="coddiagnosticorelacionadoe3".$i;
		$actualiza=$actualiza."coddiagnosticorelacionadoe3='".$$nomvar."',";
		$nomvar="codcomplicacion".$i;
		$actualiza=$actualiza."codcomplicacion='".$$nomvar."',";
		$nomvar="condiciondestinoegreso".$i;		
		$actualiza=$actualiza."condiciondestinoegreso='".$$nomvar."',";
		$nomvar="coddiagnosticocausamuerte".$i;
		$actualiza=$actualiza."coddiagnosticocausamuerte='".$$nomvar."',";
		$nomvar="fechaegreso".$i;
		$actualiza=$actualiza."fechaegreso='".$$nomvar."'";		
		$nomvar="id_hospital".$i;
		$actualiza=$actualiza." WHERE id_hospital=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>
