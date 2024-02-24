<!-- Programa que actualiza codigos contables de mapii-->
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

$nombre_arc="cuentas.csv";
if (isset($nombre_arc)){
    $fp = fopen ( $nombre_arc , "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay lneas que leer...
      $i = 0;
      foreach($data as $row) {
        $campo[$i]=$row;
        $i++;		
      }
      //echo "<br>".$campo[0]." - ".$campo[1];
      $sql="UPDATE mapii SET cconcir_map='$campo[1]' WHERE iden_map='$campo[0]'";
      // echo $sql;
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