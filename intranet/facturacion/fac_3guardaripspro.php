<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_3muestraripsproc.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');

for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="fechainicioatencion".$i;
		$actualiza="UPDATE nrprocedimiento SET fechainicioatencion='".$$nomvar."',";
		$nomvar="idmipres".$i;
		$actualiza=$actualiza."idmipres='".$$nomvar."',";
        $nomvar="numautorizacion".$i;
		$actualiza=$actualiza."numautorizacion='".$$nomvar."',";
		$nomvar="codprocedimiento".$i;
		//Aqui valido que exista el codigo de consulta
		/*$consulta="SELECT codi_cup,codi_map FROM mapii INNER JOIN cups ON cups.codigo=mapii.codi_map WHERE codi_cup='".$$nomvar."'";
		//echo $consulta;
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."cpro_fpr='".$$nomvar."',";}*/
        $actualiza=$actualiza."codprocedimiento='".$$nomvar."',";
		$nomvar="viaingresoservicio".$i;
		$actualiza=$actualiza."viaingresoservicio='".$$nomvar."',";
		$nomvar="modalidadgruposervicio".$i;
		$actualiza=$actualiza."modalidadgruposervicio='".$$nomvar."',";
		$nomvar="gruposervicios".$i;
		$actualiza=$actualiza."gruposervicios='".$$nomvar."',";
        $nomvar="codservicio".$i;
		$actualiza=$actualiza."codservicio='".$$nomvar."',";
        $nomvar="finalidadtecnologia".$i;
		$actualiza=$actualiza."finalidadtecnologia='".$$nomvar."',";
        

		//Aqui valido que exista el dx principal
		$nomvar="coddiagnosticoprincipal".$i;		
		/*$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."dxpr_fpr='".$$nomvar."',";}*/
        $actualiza=$actualiza."coddiagnosticoprincipal='".$$nomvar."',";
		//Aqui valido que exista el dx relacionado
		$nomvar="coddiagnosticorelacionado".$i;
		/*$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."dxre_fpr='".$$nomvar."',";}*/
        $actualiza=$actualiza."coddiagnosticorelacionado='".$$nomvar."',";
		//Aqui valido que exista la complicacion
		$nomvar="codcomplicacion".$i;
		/*$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."cpli_fpr='".$$nomvar."',";}*/
        $actualiza=$actualiza."codcomplicacion='".$$nomvar."',";
		$nomvar="conceptorecaudo".$i;
		$actualiza=$actualiza."conceptorecaudo='".$$nomvar."',";
        $nomvar="valorpagomoderador".$i;
		$actualiza=$actualiza."valorpagomoderador='".$$nomvar."',";
        $nomvar="numfevpagomoderador".$i;
		$actualiza=$actualiza."numfevpagomoderador='".$$nomvar."' ";
		$nomvar="id_procedimiento".$i;
		$actualiza=$actualiza."WHERE id_procedimiento=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>


