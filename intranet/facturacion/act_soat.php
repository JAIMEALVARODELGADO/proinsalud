<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
</head>
<?
//Caracteristicas del archivo de texto:
//Nombre:SOAT2013.CSV
//Estructura:CODIGOSOAT,DESCRIPCION,GRUPO,VALOR
//Conexion con la base
mysql_connect("localhost","root","");
//selección de la base de datos con la que vamos a trabajar 
mysql_select_db("proinsalud");
//Aqui cargo el archivo de usuarios
$nombre_arc="tmp/SOAT2016.CSV";

if (isset($nombre_arc)){
    $fp = fopen ( $nombre_arc , "r" );
    //echo "<table border='1'>";
    $reg=0;
    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
        $i = 0;
        //echo "<tr>";
        foreach($data as $row) {
            //echo "<td>";
            //echo "$row"; //Muestra el campo
            //echo "</td>";
            $campo[$i]=$row;
            $i++ ;     
        }
        //echo "<br>".$campo[0]." ".$campo[1]." ".$campo[2]." ".$campo[3];
        if($campo[3]<>0){
            $consulta="SELECT * FROM soat WHERE codi_tar='$campo[0]'";            
            //echo "<br>".$consulta;
            //echo "<br>".$campo[3];
            $consulta=mysql_query($consulta);
            if(mysql_num_rows($consulta)<>0){
                $row=mysql_fetch_array($consulta);                               
                //echo "anterior:  ".$row[valr_tar];
                $sql_="UPDATE soat SET valr_tar=$campo[3] WHERE codi_tar='$campo[0]'";
                //echo "<br>".$sql_;
                mysql_query($sql_);
                //ECHO "<BR>".mysql_affected_rows();
            }
            $consulta="SELECT * FROM mapii WHERE soat_map='$campo[0]'";
            //echo "<br>".$consulta;
            $consulta=mysql_query($consulta);
            if(mysql_num_rows($consulta)<>0){
                $sql_="UPDATE mapii SET valsoa_map=$campo[3] WHERE soat_map='$campo[0]'";
                //echo "<br>".$sql_;
                mysql_query($sql_);                
            }
        }
        $reg++;
        //echo "<tr>";
    }
    fclose ( $fp );
    //echo "</table>";
    echo "<br>Se Cargaron $reg Registros";
    //Aqui llamo la funcion para actualizar tarco, cuando el contrato ya esta creado
    //acttarco();

}
else{
    echo "<br>Directorio no valido";
}
?>

</body>
</html>
<?php
function acttarco(){   
    $iden_ctr='315';
    $constco="SELECT mapii.iden_map,mapii.valsoa_map,tarco.iden_tco,tarco.iden_map,tarco.valo_tco FROM mapii 
    INNER JOIN tarco ON tarco.iden_map=mapii.iden_map
    WHERE iden_ctr='$iden_ctr'";
    echo "<br>".$constco;
    $constco=mysql_query($constco);
    while($row=mysql_fetch_array($constco)){
        if($row[valsoa_map]<>0){
            echo "<br>".$row[valsoa_map]." ".$row[valo_tco];
            $sql="UPDATE tarco SET valo_tco=$row[valsoa_map] WHERE iden_tco=$row[iden_tco]";
            //echo "<br>".$sql;            
            mysql_query($sql);
            echo "<br>".mysql_affected_rows();
        }
    }
    
}
?>