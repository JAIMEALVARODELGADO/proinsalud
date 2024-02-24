<!-- Programa que actualiza codigos contables de mapii-->
<html>
<head>
<?
//Aqui cargo las funciones de validacin de fechas
include("php/funciones.php");
?>
<title>Actualiza MAPII</title>
</head>
<body bgcolor="#E6E8FA">
<?
set_time_limit(0);
mysql_connect("localhost","root","");
//seleccin de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");

$nombre_arc="MAPII_NUEVOS.csv";

if (isset($nombre_arc)){  
    $fp = fopen ( $nombre_arc , "r" );    
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay lneas que leer...      
      $i = 0;
      foreach($data as $row) {
        $campo[$i]=$row;
        $i++;
        
      }
      //echo "<br>".$campo[0]." - ".$campo[1]." - ".$campo[2]." - ".$campo[3];
      $sql="INSERT INTO mapii(iden_map,codi_map,desc1_map,desc_map,nivl_map,clas_map,soat_map,grusoa_map,valsoa_map,iss1_map,uvriss_map,valiss_map,iss4_map,uvri4_map,vris4_map,form_map,mapi_map,grumap_map,espe_map,nivmap_map,pos_map,cconcir_map,conane_map,conayu_map,conder_map,conmat_map,homo_map,cla2_map,esta_map) VALUES('0','$campo[0]','$campo[1]','$campo[1]','$campo[2]','$campo[3]','$campo[4]','$campo[5]','$campo[6]','$campo[7]','$campo[8]','$campo[9]','$campo[10]','$campo[11]','$campo[12]','$campo[13]','$campo[14]','$campo[15]','$campo[16]','$campo[17]','$campo[18]','$campo[19]','$campo[20]','$campo[21]','$campo[22]','$campo[23]','$campo[24]','$campo[25]','AC')";
      //echo "<br>".$sql;
      mysql_query($sql);
      echo "<br>".mysql_affected_rows();
      $reg++;
    }
    fclose ( $fp );
    echo "<br>Se Cargaron $reg Registros";
}
else{
    echo "Directorio no valido";
}
mysql_close();
?>


</body>
</html>
