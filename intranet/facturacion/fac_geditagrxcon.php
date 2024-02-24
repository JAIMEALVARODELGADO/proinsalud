<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');
if($control=='1'){
  //Aqui guarda las modificaciones
  for($cont=0;$cont<$numact;$cont++){
    $var='codi_'.$cont;
    //echo "<BR>".$$var;
    if(!empty($$var)){
      $iden_gxc=$$var;
      //echo $$var;
	  $guarda="UPDATE grupoxcont SET valo_gxc="; 
	  $var='valo_gxc'.$cont;
	  $guarda=$guarda."'".$$var."'";
	  $guarda=$guarda." WHERE iden_gxc='".$iden_gxc."'";
	  //echo "<br>".$guarda;
	  mysql_query($guarda);
    }
  }
  //echo $iden_ctr;
  echo "<body onload='location.href=\"fac_editgrpxcon.php?iden_ctr=$iden_ctr\"'>";
}
else{
  //Aqui borra las actividades seleccionadas
  for($cont=0;$cont<$numact;$cont++){
    $var='codi_'.$cont;
    //echo "<BR>".$$var;
    if(!empty($$var)){
      $iden_gxc=$$var;
      //echo $$var;
	  $elimina="DELETE FROM grupoxcont WHERE iden_gxc='".$iden_gxc."'";
	  //echo "<br>".$elimina;
	  mysql_query($elimina);
    }
  }
  echo "<body onload='location.href=\"fac_editgrpxcon.php?iden_ctr=$iden_ctr\"'>";
}
mysql_close();
?>

</body>
</html>