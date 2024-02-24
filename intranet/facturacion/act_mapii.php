<!-- Programa que actualiza informacion de insumos-->
<html>
<head>
<?
//Aqui cargo las funciones de validacin de fechas
include("php/funciones.php");
?>
<title>Actualiza Insumos</title>
</head>
<body bgcolor="#E6E8FA">
<?

mysql_connect("localhost","root","");
//seleccin de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");

//$nombre_arc="SOAT2012.csv";
$nombre_arc="ISS2004.csv";
if (isset($nombre_arc)){
    $fp = fopen ( $nombre_arc , "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay lneas que leer...
      $i = 0;
      foreach($data as $row) {
        $campo[$i]=$row;
        $i++;		
      }
	//echo "<br>".$campo[0]." - ".$campo[1]." - ".$campo[2]." - ".$campo[3]." - ".$campo[4];
      $consulta="SELECT codi_map FROM mapii WHERE codi_map='$campo[0]'";
      //$consulta="SELECT soat_map FROM mapii WHERE soat_map='$campo[0]'";
      //echo "<br>".$consulta;
      $consulta=mysql_query($consulta);
      if(mysql_num_rows($consulta)<>0){
          //echo "<br>Siiii ";
          //if(!empty($campo[1])){
              $sql="UPDATE mapii SET uvri4_map='$campo[2]',vris4_map='$campo[3]' WHERE codi_map='$campo[0]'";
              //echo $sql;
              mysql_query($sql);
              echo "<br>".mysql_affected_rows();
          //}
      }
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