<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');
$porcentaje=$porcentaje/100;
$consulta="SELECT tarco.iden_tco, tarco.iden_map, tarco.iden_ctr, tarco.clas_tco, tarco.valo_tco, mapii.valsoa_map, mapii.valiss_map, mapii.vris4_map
FROM mapii INNER JOIN tarco ON mapii.iden_map = tarco.iden_map
WHERE tarco.esta_tco='AC' AND tarco.grqx_tco='' AND tarco.iden_ctr='$iden_ctr' AND tarco.clas_tco='P'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)<>0){
  while($row=mysql_fetch_array($consulta)){    
    $valo_tco=0;
    if($rad_modo=='1'){
      switch ($tari_ctr) {
        case '1':
          if($tpor_crt=='+'){
            $valo_tco=$row[valsoa_map]+$row[valsoa_map]*$porcentaje;
          }
          else{
            $valo_tco=$row[valsoa_map]-$row[valsoa_map]*$porcentaje; 
          }
          break;
        case '2':
          if($tpor_crt=='+'){
            $valo_tco=$row[valiss_map]+$row[valiss_map]*$porcentaje;
          }
          else{
            $valo_tco=$row[valiss_map]-$row[valiss_map]*$porcentaje; 
          }
          break;
        case '3':
          if($tpor_crt=='+'){
            $valo_tco=$row[vris4_map]+$row[vris4_map]*$porcentaje;
          }
          else{
            $valo_tco=$row[vris4_map]-$row[vris4_map]*$porcentaje; 
          }
          break;
      }
    }
    else{
      if($tpor_crt=='+'){
        $valo_tco=$row[valo_tco]+$row[valo_tco]*$porcentaje;
      }
      else{
        $valo_tco=$row[valo_tco]-$row[valo_tco]*$porcentaje; 
      }
    }
    $valo_tco=round($valo_tco,$redondeo);    
    $sql="UPDATE tarco SET valo_tco='$valo_tco' WHERE iden_tco='$row[iden_tco]'";
    //echo "<br>".$sql;
    mysql_query($sql);
  }
}

echo "<body onload='location.href=\"fac_muesccion.php?codi_con=$codi_con\"'>";

mysql_close();

?>
<script languaje='JavaScript'>
  alert("Se han aplicado los cambios al contrato");
</script>>
</body>
</html>