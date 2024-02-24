<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<script languaje="JavaScript">
function muestraerror(error_){
    alert(error_);
}
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');
if($control=='1'){
  //Aqui guardo las modificaciones
  for($i=0;$i<$cont;$i++){
    $nomvar='chkser'.$i;
    if($$nomvar=='on'){
      $iden_='iden_tco'.$i;
	  $tser_='tser'.$i;
	  $val_='valor'.$i;
	  $actualiza="UPDATE tarco SET ";
	  $actualiza=$actualiza."tser_tco='".$$tser_."',";
	  $actualiza=$actualiza."valo_tco=".$$val_;
	  $actualiza=$actualiza." WHERE iden_tco=".$$iden_;
	  mysql_query($actualiza);
    }
  }
}  
else{
  //Aqui borra las actividades seleccionadas
  $error="";
  for($i=0;$i<$cont;$i++){
    $nomvar='chkser'.$i;
    if($$nomvar=='on'){
        $iden_='iden_tco'.$i;
        $consfac="SELECT iden_tco FROM detalle_factura WHERE iden_tco='".$$iden_."'";
		    //echo "<br>".$consfac;
        $consfac=mysql_query($consfac);
		if(mysql_num_rows($consfac)==0){
            $elimina="DELETE FROM tarco WHERE iden_tco=".$$iden_;
            mysql_query($elimina);
        }
        else{
            $error="No se elminaron los medicamentos que ya estan facturados";
        }
    }
  }
}
mysql_close();
if(!empty($error)){
    ?>
        <script languaje='JavaScript'>muestraerror("<? echo $error;?>")</script>
    <?php
}
echo "<body onload='location.href=\"fac_editmedinsxcon.php?iden_ctr=$iden_ctr\"'>";
?>
</body>
</html>