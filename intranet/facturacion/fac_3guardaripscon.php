<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_3muestraripscons.php","fr02") 
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
		$actualiza="UPDATE nrconsulta SET fechainicioatencion='".$$nomvar."',";

		$nomvar="numautorizacion".$i;
		$actualiza=$actualiza."numautorizacion='".$$nomvar."',";
		$nomvar="codconsulta".$i;
		//Aqui valido que exista el codigo de consulta		
		/*$consulta="SELECT codi_cup,codi_map FROM mapii INNER JOIN cups ON cups.codigo=mapii.codi_map WHERE codi_cup='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."codconsulta='".$$nomvar."',";}*/
        $actualiza=$actualiza."codconsulta='".$$nomvar."',";        
        $nomvar="modalidadgruposervicio".$i;
		$actualiza=$actualiza."modalidadgruposervicio='".$$nomvar."',";
        $nomvar="gruposervicios".$i;
		$actualiza=$actualiza."gruposervicios='".$$nomvar."',";
        $nomvar="codservicio".$i;
		$actualiza=$actualiza."codservicio='".$$nomvar."',";
		$nomvar="finalidadtecnologia".$i;
		$actualiza=$actualiza."finalidadtecnologia='".$$nomvar."',";
		$nomvar="causamotivoatencion".$i;
		$actualiza=$actualiza."causamotivoatencion='".$$nomvar."',";
		//Aqui valido que exista el dx principal
		$nomvar="coddiagnosticoprincipal".$i;		
		/*$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0){
			$actualiza=$actualiza."dxpr_fco='".$$nomvar."',";}*/
        $actualiza=$actualiza."coddiagnosticoprincipal='".$$nomvar."',";
		//Aqui valido que exista el dx relacionado 1
		$nomvar="coddiagnosticorelacinado1".$i;
		/*$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0 or $$nomvar==''){
			$actualiza=$actualiza."dxr1_fco='".$$nomvar."',";}*/
        $actualiza=$actualiza."coddiagnosticorelacinado1='".$$nomvar."',";
		//Aqui valido que exista el dx relacionado 2
		$nomvar="coddiagnosticorelacinado2".$i;
		/*$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0 or $$nomvar==''){
			$actualiza=$actualiza."dxr2_fco='".$$nomvar."',";}*/
        $actualiza=$actualiza."coddiagnosticorelacinado2='".$$nomvar."',";
		//Aqui valido que exista el dx relacionado 3
		$nomvar="coddiagnosticorelacinado3".$i;
		/*$consulta="SELECT cod_cie10 FROM cie_10 WHERE cod_cie10='".$$nomvar."'";
		$consulta=mysql_query($consulta);
		if(mysql_num_rows($consulta)<>0 or $$nomvar==''){
			$actualiza=$actualiza."dxr3_fco='".$$nomvar."',";}*/
        $actualiza=$actualiza."coddiagnosticorelacinado3='".$$nomvar."',";
		$nomvar="tipodiagnosticoprincipal".$i;
		$actualiza=$actualiza."tipodiagnosticoprincipal='".$$nomvar."',";
        $nomvar="conceptorecaudo".$i;
		$actualiza=$actualiza."conceptorecaudo='".$$nomvar."',";
        $nomvar="valorpagomoderador".$i;
		$actualiza=$actualiza."valorpagomoderador='".$$nomvar."',";
        $nomvar="numfevpagomoderador".$i;
		$actualiza=$actualiza."numfevpagomoderador='".$$nomvar."' ";
		$nomvar="id_consulta".$i;
		$actualiza=$actualiza."WHERE id_consulta=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>


