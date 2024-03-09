<?
session_start();
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_3muestraripsrnac.php","fr02") 
}
</script>
</head>
<?
include('php/conexion.php');
//include('php/funciones.php');
?>
<img src='icons/barra7.png' width='910' height='30' usemap="#actividades" border='0'/>
<?
if($borra=='S'){
	mysql_query("DELETE FROM fnacidos WHERE regi_fna=$regi_fna");
}
else{
	if($chknuevo=='on'){
        //Aqui se consulta el consecutivo
        $consultaconsecutivo="SELECT COUNT(*) AS cantidad FROM nrnacidos WHERE iden_fac='$giden_fac'";
        //echo "<br>".$consultaconsecutivo;
        $consultaconsecutivo=mysql_query($consultaconsecutivo);
        $rowconsecutivo=mysql_fetch_array($consultaconsecutivo);
        $consecutivo=$rowconsecutivo[cantidad]+1;

		$actualiza="INSERT INTO nrnacidos(tipodocumentoidentificacion,numerodocumentoidentificacion,fechanacimiento,edadgestacional,numeroconsultascprenatal,codsexobiologico,peso,coddiagnosticoprincipal,condiciondestinoegreso,coddiagnosticocausamuerte,fechaegreso,consecutivo,iden_fac)
		VALUES(
            '$tipodocumentoidentificacion',
            '$numerodocumentoidentificacion',
            '$fechanacimiento',
            '$edadgestacional',
            '$numeroconsultascprenatal',
            '$codsexobiologico',
            '$peso',
            '$coddiagnosticoprincipal',
            '$condiciondestinoegreso',
            '$coddiagnosticocausamuerte',
            '$fechaegreso',
            '$consecutivo',
            '$giden_fac')";
        //echo "<br>".$actualiza;
		mysql_query($actualiza);
	}
	else{
		for($i=0;$i<$cont;$i++){
			$nomvar="chk".$i;
			echo "<br>".$nomvar." ".$$nomvar;
			if($$nomvar=='on'){	
				$nomvar="tipodocumentoidentificacion".$i;
				$actualiza="UPDATE nrnacidos SET tipodocumentoidentificacion='".$$nomvar."',";	
				$nomvar="numerodocumentoidentificacion".$i;
				$actualiza=$actualiza."numerodocumentoidentificacion='".$$nomvar."',";
				$nomvar="fechanacimiento".$i;
				$actualiza=$actualiza."fechanacimiento='".$$nomvar."',";
				$nomvar="edadgestacional".$i;
				$actualiza=$actualiza."edadgestacional='".$$nomvar."',";
				$nomvar="numeroconsultascprenatal".$i;
				$actualiza=$actualiza."numeroconsultascprenatal='".$$nomvar."',";
				$nomvar="codsexobiologico".$i;
				$actualiza=$actualiza."codsexobiologico='".$$nomvar."',";
				$nomvar="peso".$i;
				$actualiza=$actualiza."peso='".$$nomvar."',";
				$nomvar="coddiagnosticoprincipal".$i;
				$actualiza=$actualiza."coddiagnosticoprincipal='".$$nomvar."',";
				$nomvar="condiciondestinoegreso".$i;
				$actualiza=$actualiza."condiciondestinoegreso='".$$nomvar."',";
				$nomvar="coddiagnosticocausamuerte".$i;
				$actualiza=$actualiza."coddiagnosticocausamuerte='".$$nomvar."',";
                $nomvar="fechaegreso".$i;
				$actualiza=$actualiza."fechaegreso='".$$nomvar."'";
				$nomvar="id_nacidos".$i;
				$actualiza=$actualiza." WHERE id_nacidos=".$$nomvar;
				//echo "<br>".$actualiza;
				mysql_query($actualiza);
			}
		}
	}
}
mysql_close();
?>
<body onload='regresar()'>
</body>
</html>
