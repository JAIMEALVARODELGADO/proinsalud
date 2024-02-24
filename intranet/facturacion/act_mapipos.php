<!-- Programa que actualiza informacion de insumos-->
<html>
<head>
<?
//Aqui cargo las funciones de validación de fechas
include("php/funciones.php");
?>
<title>Actualiza Insumos</title>
</head>
<body bgcolor="#E6E8FA">
<?

mysql_connect("localhost","root","VJvj321");
//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");

$nombre_arc="G:\Homologacion de codigos\MAPIPOS.csv";
if (isset($nombre_arc)){
    $fp = fopen ( $nombre_arc , "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
      $i = 0;
      foreach($data as $row) {
        $campo[$i]=$row;
        $i++;		
      }
      //echo "<br>".$campo[0]." ".$campo[1]." ".$campo[2]." ".$campo[3]." ".$campo[4];
      $consulta=mysql_query("SELECT codi_map FROM mapipos WHERE codi_map='$campo[0]'");
      if(mysql_num_rows($consulta)<>0){
	    echo "<br>Encontrado";
	  }
	  else{
	    $cons=mysql_query("INSERT INTO mapipos(codi_map,nomb_map,refe_map,nive_map,tipo_map,gqxo_map,sexo_map,prepa,listado)
        VALUES ('$campo[0]','$campo[1]','','$campo[4]','','$campo[2]','','','')");
		//echo $cons;
		echo "<br>".mysql_affected_rows();
	    echo "<br>No encontrado";
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