<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_4hemuestracons.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');
?>
<img src='icons/barra1.png' width='910' height='30' usemap="#actividades" border='0'/>
<?
for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="fcon_fco".$i;
		$actualiza="UPDATE fconsulta SET fcon_fco='".$$nomvar."',";
		$nomvar="naut_fco".$i;
		$actualiza=$actualiza."naut_fco='".$$nomvar."',";
		$nomvar="ccon_fco".$i;
		//Aqui valido que exista el codigo de consulta
		//$consulta="SELECT codi_map FROM mapii WHERE codi_map='".$$nomvar."'";
		$consulta="SELECT codi_cup,codi_map FROM mapii INNER JOIN cups ON cups.codigo=mapii.codi_map WHERE codi_cup='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."ccon_fco='".$$nomvar."',";}
		$nomvar="fina_fco".$i;
		$actualiza=$actualiza."fina_fco='".$$nomvar."',";
		$nomvar="cext_fco".$i;
		$actualiza=$actualiza."cext_fco='".$$nomvar."',";
		//Aqui valido que exista el dx principal
		$nomvar="dxpr_fco".$i;		
		$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."dxpr_fco='".$$nomvar."',";}
		//Aqui valido que exista el dx relacionado 1
		$nomvar="dxr1_fco".$i;
		$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0 or $$nomvar==''){
			$actualiza=$actualiza."dxr1_fco='".$$nomvar."',";}
		//Aqui valido que exista el dx relacionado 2
		$nomvar="dxr2_fco".$i;
		$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0 or $$nomvar==''){
			$actualiza=$actualiza."dxr2_fco='".$$nomvar."',";}
		//Aqui valido que exista el dx relacionado 3
		$nomvar="dxr3_fco".$i;
		$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0 or $$nomvar==''){
			$actualiza=$actualiza."dxr3_fco='".$$nomvar."',";}
		$nomvar="tpdx_fco".$i;
		$actualiza=$actualiza."tpdx_fco='".$$nomvar."' ";
		$nomvar="regi_fco".$i;
		$actualiza=$actualiza."WHERE regi_fco=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>


