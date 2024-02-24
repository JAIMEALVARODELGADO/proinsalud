<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_4hemuestraproc.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');
?>
<img src='icons/barra2.png' width='910' height='30' usemap="#actividades" border='0'/>
<?
for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="fpro_fpr".$i;
		$actualiza="UPDATE fprocedim SET fpro_fpr='".$$nomvar."',";
		$nomvar="naut_fpr".$i;
		$actualiza=$actualiza."naut_fpr='".$$nomvar."',";
		$nomvar="cpro_fpr".$i;
		//Aqui valido que exista el codigo de consulta
		$consulta="SELECT codi_cup,codi_map FROM mapii INNER JOIN cups ON cups.codigo=mapii.codi_map WHERE codi_cup='".$$nomvar."'";
		//echo $consulta;
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."cpro_fpr='".$$nomvar."',";}
		$nomvar="ambi_fpr".$i;
		$actualiza=$actualiza."ambi_fpr='".$$nomvar."',";
		$nomvar="fina_fpr".$i;
		$actualiza=$actualiza."fina_fpr='".$$nomvar."',";
		$nomvar="pers_fpr".$i;
		$actualiza=$actualiza."pers_fpr='".$$nomvar."',";
		//Aqui valido que exista el dx principal
		$nomvar="dxpr_fpr".$i;		
		$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."dxpr_fpr='".$$nomvar."',";}
		//Aqui valido que exista el dx relacionado
		$nomvar="dxre_fpr".$i;
		$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."dxre_fpr='".$$nomvar."',";}
		//Aqui valido que exista la complicacion
		$nomvar="cpli_fpr".$i;
		$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."cpli_fpr='".$$nomvar."',";}
		$nomvar="form_fpr".$i;
		$actualiza=$actualiza."form_fpr='".$$nomvar."' ";
		$nomvar="regi_fpr".$i;
		$actualiza=$actualiza."WHERE regi_fpr=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>


