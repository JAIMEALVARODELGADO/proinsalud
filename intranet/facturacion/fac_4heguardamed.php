<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_4hemuestramedi.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');
?>
<img src='icons/barra3.png' width='910' height='30' usemap="#actividades" border='0'/>
<?
for($i=0;$i<$cont;$i++){
	$nomvar="chk".$i;
	if($$nomvar=='on'){	
		$nomvar="naut_fme".$i;
		$actualiza="UPDATE fmedicamento SET naut_fme='".$$nomvar."',";
		$nomvar="codi_fme".$i;
		//Aqui valido que exista el codigo del medicamento
		//$consulta="SELECT codi_map FROM mapii WHERE codi_map='".$$nomvar."'";
		//$consulta=mysql_query($consulta);
		//if(mysql_num_rows($consulta)<>0){
		$actualiza=$actualiza."codi_fme='".$$nomvar."',";
		$nomvar="tipo_fme".$i;
		$actualiza=$actualiza."tipo_fme='".$$nomvar."',";
		$nomvar="nomb_fme".$i;
		$actualiza=$actualiza."nomb_fme='".$$nomvar."',";
		$nomvar="form_fme".$i;
		$actualiza=$actualiza."form_fme='".$$nomvar."',";
		$nomvar="conc_fme".$i;		
		$actualiza=$actualiza."conc_fme='".$$nomvar."',";
		$nomvar="unid_fme".$i;
		$actualiza=$actualiza."unid_fme='".$$nomvar."'";
		$nomvar="regi_fme".$i;
		$actualiza=$actualiza." WHERE regi_fme=".$$nomvar;
		//echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>


