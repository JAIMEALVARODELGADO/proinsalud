<?
session_start();
?>
<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function regresar(){
  window.open("fac_4hemuestrarnac.php","fr02") 
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
		$actualiza="INSERT INTO fnacidos(regi_fna,iden_fac,numf_fna,fnac_fna,hnac_fna,edge_fna,contr_fna,sexo_fna,peso_fna,diag_fna,cmue_fna,fmue_fna,hmue_fna)
		VALUES(0,'$giden_fac','$gfactura','$fnac_fna','$hnac_fna',$edge_fna,'$contr_fna','$sexo_fna',$peso_fna,'$diag_fna','$cmue_fna','$fmue_fna','$hmue_fna')";
		mysql_query($actualiza);
	}
	else{
		for($i=0;$i<$cont;$i++){
			$nomvar="chk".$i;
			echo "<br>".$nomvar." ".$$nomvar;
			if($$nomvar=='on'){	
				$nomvar="fnac_fna".$i;
				$actualiza="UPDATE fnacidos SET fnac_fna='".$$nomvar."',";	
				$nomvar="hnac_fna".$i;
				$actualiza=$actualiza."hnac_fna='".$$nomvar."',";
				$nomvar="edge_fna".$i;
				$actualiza=$actualiza."edge_fna='".$$nomvar."',";
				$nomvar="contr_fna".$i;
				$actualiza=$actualiza."contr_fna='".$$nomvar."',";
				$nomvar="sexo_fna".$i;
				$actualiza=$actualiza."sexo_fna='".$$nomvar."',";
				$nomvar="peso_fna".$i;
				$actualiza=$actualiza."peso_fna='".$$nomvar."',";
				$nomvar="diag_fna".$i;
				$actualiza=$actualiza."diag_fna='".$$nomvar."',";
				$nomvar="cmue_fna".$i;
				$actualiza=$actualiza."cmue_fna='".$$nomvar."',";
				$nomvar="fmue_fna".$i;
				$actualiza=$actualiza."fmue_fna='".$$nomvar."',";
				$nomvar="hmue_fna".$i;
				$actualiza=$actualiza."hmue_fna='".$$nomvar."'";
				$nomvar="regi_fna".$i;
				$actualiza=$actualiza." WHERE regi_fna=".$$nomvar;
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
