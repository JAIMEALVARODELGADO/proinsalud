<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_4hemuestrahosp.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');
?>
<img src='icons/barra6.png' width='910' height='30' usemap="#actividades" border='0'/>
<?
for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="via_fho".$i;
		$actualiza="UPDATE fhospital SET via_fho='".$$nomvar."',";	
		$nomvar="feci_fho".$i;
		$actualiza=$actualiza."feci_fho='".$$nomvar."',";
		$nomvar="hori_fho".$i;
		$actualiza=$actualiza."hori_fho='".$$nomvar."',";
		$nomvar="naut_fho".$i;
		$actualiza=$actualiza."naut_fho='".$$nomvar."',";
		$nomvar="cext_fho".$i;
		$actualiza=$actualiza."cext_fho='".$$nomvar."',";
		$nomvar="dxin_fho".$i;
		$actualiza=$actualiza."dxin_fho='".$$nomvar."',";
		$nomvar="dxeg_fho".$i;
		$actualiza=$actualiza."dxeg_fho='".$$nomvar."',";
		$nomvar="dxre1_fho".$i;
		$actualiza=$actualiza."dxre1_fho='".$$nomvar."',";
		$nomvar="dxre2_fho".$i;
		$actualiza=$actualiza."dxre2_fho='".$$nomvar."',";
		$nomvar="dxre3_fho".$i;
		$actualiza=$actualiza."dxre3_fho='".$$nomvar."',";
		$nomvar="comp_fho".$i;		
		$actualiza=$actualiza."comp_fho='".$$nomvar."',";
		$nomvar="ests_fho".$i;
		$actualiza=$actualiza."ests_fho='".$$nomvar."',";
		$nomvar="cmue_fho".$i;
		$actualiza=$actualiza."cmue_fho='".$$nomvar."',";
		$nomvar="fece_fho".$i;
		$actualiza=$actualiza."fece_fho='".$$nomvar."',";
		$nomvar="hore_fho".$i;
		$actualiza=$actualiza."hore_fho='".$$nomvar."'";
		$nomvar="regi_fho".$i;
		$actualiza=$actualiza." WHERE regi_fho=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>
