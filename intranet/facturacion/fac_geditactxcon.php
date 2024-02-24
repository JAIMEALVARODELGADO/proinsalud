<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
include('php/funciones.php');
include('php/conexion.php');

switch($control){
  case '1';
    //Aqui guarda las modificaciones
    for($cont=0;$cont<$numact;$cont++){
      $var='codi_'.$cont;
      //echo "<BR>".$var.' '.$$var;
      if(!empty($$var)){
        $iden_tco=$$var;
        //echo $$var;
        $guarda="UPDATE tarco SET tser_tco="; 
        $var="tser_".$cont;
        $guarda=$guarda."'".$$var."',";
        $guarda=$guarda."valo_tco=";
        $var='valor_'.$cont;
        $guarda=$guarda."'".$$var."',";
        $guarda=$guarda.  "grqx_tco=";
        $var='grqx_'.$cont;
        $guarda=$guarda."'".$$var."'";
        $guarda=$guarda." WHERE iden_tco='".$iden_tco."'";
        //echo "<br>".$guarda;
        mysql_query($guarda);
      }
    }
    break;
  case '2';
    //Aqui borra las actividades seleccionadas
    for($cont=0;$cont<$numact;$cont++){
      $var='codi_'.$cont;
      //echo "<BR>".$$var;
      if(!empty($$var)){
        $iden_tco=$$var;
        $sql_="SELECT iden_tco FROM detalle_factura WHERE iden_tco='$iden_tco'";        
        //echo $sql_;
        $sql_=mysql_query($sql_);
        if(mysql_num_rows($sql_)==0){
          //echo $$var;        
          $elimina="DELETE FROM tarco WHERE iden_tco='".$iden_tco."'";
          //echo "<br>".$elimina;
          mysql_query($elimina);
        }
        else{
          ?>
          <script language='javascript'>
               alert("La actividad ya est facturada");
          </script>
          <?php
        }
      }
    }
    break;
  case '3';
    if($estado=='AC'){
      $sql_="UPDATE tarco SET esta_tco='IN' WHERE iden_tco='$iden_tco'";
    }
    else{
      $cons_="SELECT tarco.iden_tco, tarco.valo_tco, mapii.desc_map, cups.codigo, cups.codi_cup, cups.esta_cup FROM (tarco INNER JOIN mapii ON tarco.iden_map = mapii.iden_map) INNER JOIN cups ON mapii.codi_map = cups.codigo WHERE iden_tco='$iden_tco'";
      $cons_=mysql_query($cons_);
      if(mysql_num_rows($cons_)<>0){
        $row=mysql_fetch_array($cons_);
        if($row[esta_cup]=='AC'){
          $sql_="UPDATE tarco SET esta_tco='AC' WHERE iden_tco='$iden_tco'";
        }
        else{
          ?>
          <script language='JavaScript'>
            alert("La actividad está INACTIVA en CUPS");
          </script>>
          <?php
        }
      }
    }    
    $sql_=mysql_query($sql_);
    break;    
}
echo "<body onload='location.href=\"fac_editactxcon.php?iden_ctr=$iden_ctr\"'>";

/*if($control=='1'){
  //Aqui guarda las modificaciones
  for($cont=0;$cont<$numact;$cont++){
    $var='codi_'.$cont;
    //echo "<BR>".$var.' '.$$var;
    if(!empty($$var)){
      $iden_tco=$$var;
      //echo $$var;
	  $guarda="UPDATE tarco SET tser_tco="; 
      $var="tser_".$cont;
	  $guarda=$guarda."'".$$var."',";
	  $guarda=$guarda."valo_tco=";
	  $var='valor_'.$cont;
	  $guarda=$guarda."'".$$var."',";
	  $guarda=$guarda.	"grqx_tco=";
	  $var='grqx_'.$cont;
	  $guarda=$guarda."'".$$var."'";
	  $guarda=$guarda." WHERE iden_tco='".$iden_tco."'";
	  //echo "<br>".$guarda;
	  mysql_query($guarda);
    }
  }
  echo "<body onload='location.href=\"fac_editactxcon.php?iden_ctr=$iden_ctr\"'>";
}
else{
  //Aqui borra las actividades seleccionadas
  for($cont=0;$cont<$numact;$cont++){
    $var='codi_'.$cont;
    //echo "<BR>".$$var;
    if(!empty($$var)){
        $iden_tco=$$var;
        $sql_="SELECT iden_tco FROM detalle_factura WHERE iden_tco='$iden_tco'";        
        //echo $sql_;
        $sql_=mysql_query($sql_);
        if(mysql_num_rows($sql_)==0){
            //echo $$var;        
            $elimina="DELETE FROM tarco WHERE iden_tco='".$iden_tco."'";
            //echo "<br>".$elimina;
            mysql_query($elimina);
        }
        else{
            ?>
            <script language='javascript'>
                alert("La actividad ya est facturada");
            </script>
            <?
        }
    }
  }
  echo "<body onload='location.href=\"fac_editactxcon.php?iden_ctr=$iden_ctr\"'>";
}*/
mysql_close();

?>

</body>
</html>