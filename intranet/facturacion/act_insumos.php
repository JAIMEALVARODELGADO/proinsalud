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

//$nombre_arc="G:\Homologacion de codigos\INSUMOS_FACTURACION.csv";
$nombre_arc="INSUMOS.csv";
if (isset($nombre_arc)){
    $fp = fopen ( $nombre_arc , "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
      $i = 0;
      foreach($data as $row) {
        $campo[$i]=$row;
        $i++;		
      }
	  //echo "<br>".$campo[0]." ".$campo[1]." ".$campo[2]." ".$campo[3]." ".$campo[4]." ".$campo[5]." ".$campo[6]." ".$campo[7];
	  //echo "<br>".$campo[0]." ".$campo[1]." ".$campo[2]." ".$campo[3];
      $consulta=mysql_query("SELECT codnue,valo1_ins FROM insu_med WHERE codnue='$campo[0]'");
      if(mysql_num_rows($consulta)<>0){
	    $cons="UPDATE insu_med SET valo1_ins='$campo[3]'
		WHERE codnue='$campo[0]'";
		//echo "<br>".$cons;
		mysql_query($cons);
	    echo "<br>Encontrado";
	  }
	  else{
	    //mysql_query("INSERT INTO insu_med (codnue,codnue,refe_ins,desc_ins,codsis,descante,fech_ins,esta_ins,fmod_ins,uso_ins,cuen_ins,valor_ins)
		//VALUES('$campo[0]','$campo[3]','$campo[1]','$campo[5]','$campo[0]','$campo[2]','0000-00-00','A','0000-00-00','$campo[6]','$campo[4]',$campo[7])");
		//echo "<br>".mysql_affected_rows();
		//echo "<br>".$cons;
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