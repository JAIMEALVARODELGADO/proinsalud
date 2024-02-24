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

$nombre_arc="G:\Homologacion de codigos\HOMOLOGACION ENERO 27 2011\MEDICAMENTOS.csv";
if (isset($nombre_arc)){
    $fp = fopen ( $nombre_arc , "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
      $i = 0;
      foreach($data as $row) {
        $campo[$i]=$row;
        $i++;		
      }
	  echo "<br>".$campo[2]." - ".$campo[29]." - ".$campo[44];
      $consulta=mysql_query("SELECT codi_mdi,valo1_mdi FROM medicamentos2 WHERE codi_mdi='$campo[2]'");
      if(mysql_num_rows($consulta)<>0){
	    $row=mysql_fetch_array($consulta);
		if($row[valo1_mdi]<>$campo[29]){
		  echo "<br>Diferente";
		}
		else{
		    echo "<br>Igual";
		}
	    mysql_query("UPDATE medicamentos2 SET ccon_mdi='$campo[44]'
		WHERE codi_mdi='$campo[2]'");
	    echo "<br>Encontrado";
	  }
	  else{
	    //mysql_query("INSERT INTO insu_med (codnue,codnue,refe_ins,desc_ins,codsis,descante,fech_ins,esta_ins,fmod_ins,uso_ins,cuen_ins,valor_ins)
		//VALUES('$campo[0]','$campo[3]','$campo[1]','$campo[5]','$campo[0]','$campo[2]','0000-00-00','A','0000-00-00','$campo[6]','$campo[4]',$campo[7])");
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