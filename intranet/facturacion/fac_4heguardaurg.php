<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_4hemuestraurge.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');
?>
<img src='icons/barra5.png' width='910' height='30' usemap="#actividades" border='0'/>
<?
for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="feci_fur".$i;
		$actualiza="UPDATE furgencia SET feci_fur='".$$nomvar."',";	
		$nomvar="hori_fur".$i;
		$actualiza=$actualiza."hori_fur='".$$nomvar."',";
		$nomvar="naut_fur".$i;
		$actualiza=$actualiza."naut_fur='".$$nomvar."',";
		$nomvar="cext_fur".$i;
		$actualiza=$actualiza."cext_fur='".$$nomvar."',";
		$nomvar="dxeg_fur".$i;
		$actualiza=$actualiza."dxeg_fur='".$$nomvar."',";
		$nomvar="dxre1_fur".$i;
		$actualiza=$actualiza."dxre1_fur='".$$nomvar."',";
		$nomvar="dxre2_fur".$i;
		$actualiza=$actualiza."dxre2_fur='".$$nomvar."',";
		$nomvar="dxre3_fur".$i;
		$actualiza=$actualiza."dxre3_fur='".$$nomvar."',";
		$nomvar="dest_fur".$i;
		$actualiza=$actualiza."dest_fur='".$$nomvar."',";
		$nomvar="ests_fur".$i;
		$actualiza=$actualiza."ests_fur='".$$nomvar."',";
		$nomvar="cmue_fur".$i;
		$actualiza=$actualiza."cmue_fur='".$$nomvar."',";
		$nomvar="fece_fur".$i;
		$actualiza=$actualiza."fece_fur='".$$nomvar."',";
		$nomvar="hore_fur".$i;
		$actualiza=$actualiza."hore_fur='".$$nomvar."'";
		$nomvar="regi_fur".$i;
		$actualiza=$actualiza." WHERE regi_fur=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>
