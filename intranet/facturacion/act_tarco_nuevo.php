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

$nombre_arc="HOMOLO_MAPII.csv";
if (isset($nombre_arc)){  
    $fp = fopen ( $nombre_arc , "r" );    
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay lneas que leer...      
      $i = 0;
      foreach($data as $row) {
        $campo[$i]=$row;
        $i++;        
      }
      $codigo_ant[$reg]=$campo[0];
      $codigo_nue[$reg]=$campo[1];
      $reg++;
    }
    fclose ( $fp );
    echo "<br>Se Cargaron $reg Registros";
    $reg=$reg-1;
    echo "<br>".$codigo_ant[$reg]." ".$codigo_nue[$reg];
    
    $consulta="SELECT contratacion.iden_ctr, contratacion.nume_ctr, contratacion.codi_con, contratacion.esta_ctr, mapii.iden_map, mapii.codi_map, tarco.iden_tco, tarco.iden_ctr, tarco.tser_tco, tarco.clas_tco, tarco.valo_tco, tarco.grqx_tco
        FROM (mapii INNER JOIN tarco ON mapii.iden_map = tarco.iden_map) INNER JOIN contratacion ON tarco.iden_ctr = contratacion.iden_ctr
        WHERE contratacion.esta_ctr='A' AND tarco.clas_tco='P' AND (tarco.valo_tco<>0 OR tarco.grqx_tco<>'')";
      echo "<br>".$consulta;
      $consulta=mysql_query($consulta);      
      echo "<br>".mysql_num_rows($consulta);
      $total=0;
      while($row=mysql_fetch_array($consulta)){
        for($i=0;$i<=$reg;$i++){
          //echo "<br>".$codigo_ant[$i];
          if($row[codi_map]==$codigo_ant[$i]){
            //echo "<br>Encontrado...: ".$row[codi_map];
            $consmap="SELECT mapii.iden_map,mapii.codi_map FROM mapii WHERE codi_map='$codigo_nue[$i]'";
            //echo "<br>".$consmap;
            $consmap=mysql_query($consmap);
            if(mysql_num_rows($consmap)<>0){
              $rowmap=mysql_fetch_array($consmap);
              $sql="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco) VALUES(0,'$rowmap[iden_map]','$row[iden_ctr]','$row[tser_tco]','$row[clas_tco]','$row[valo_tco]','$row[grqx_tco]','AC')";
              //echo "<br>".$sql;        
              mysql_query($sql);
              $total++;
            }
          }
        }
      }
      echo "<br>Total...: ".$total;



}
else{
    echo "Directorio no valido";
}
mysql_close();
?>


</body>
</html>
