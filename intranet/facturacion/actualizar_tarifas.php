<?php
set_time_limit(0);

include('php/conexion.php');

//echo "Aqui estoy...!";
//$conexion = mysqli_connect("192.168.4.12","root","","proinsalud_1");
//mysql_select_db("proinsalud_1",$conexion);
//$conexion = mysql_connect("192.168.4.20","root","");
//mysql_select_db("proinsalud",$conexion);
  
//$nombre_del_archivo = 'TARIFAEVENTO_SUBIR.txt';
//$nombre_del_archivo = 'TARIFACAPITA_SUBIR.txt';
//$nombre_del_archivo = 'DISPOSITIVOSEVENTO.txt';
//$nombre_del_archivo = 'MEDICAMENTOSEVENTO.txt';

// Abre el archivo en modo de lectura
/*if (($gestor = fopen($nombre_del_archivo, "r")) !== FALSE) {
    // Recorre cada línea del archivo
    $fila=0;
    while (($datos = fgetcsv($gestor, 10000, ",")) !== FALSE) {
        $numero = count($datos);

        
        $tarco = new Tarco();
        $tarco->codigo_cups = $datos[0];
        $tarco->tser_tco = $datos[1];
        $tarco->grqx_tco = $datos[2];
        $tarco->clas_tco = $datos[3];
        $tarco->valo_tco= $datos[4];

        //Se deben definir estos campos
        //817 capita
        //818 evento

        $tarco->iden_ctr = 781;        

        //$tarco->actualizar();
        //$tarco->actualizarDispositivos();
        $tarco->actualizarMedicamentos();
        $fila++;
        echo "<br>".$fila;
        //exit;
    }
    // Cierra el archivo
    fclose($gestor);
}*/

//actualizartarco();
//inactivarmaipii();


class Tarco {
    // Propiedad
    public $codigo_cups;
    public $iden_ctr;
    public $tser_tco;
    public $clas_tco;
    public $valo_tco;
    public $grqx_tco;

    // Método
    public function actualizar() {
        //echo "<br><br>COD ".$this->codigo_cups;
        /*echo "<br>TS ".$this->tser_tco;
        echo "<br>GR ".$this->grqx_tco;
        echo "<br>CLAS ".$this->clas_tco;
        echo "<br>VAL ".$this->valo_tco;*/

        $conexion = mysqli_connect("192.168.4.12","root","","proinsalud");
        $consultacups="SELECT iden_map,codi_map FROM mapii WHERE codi_map='$this->codigo_cups'";
        $respuestacups=mysqli_query($conexion,$consultacups);
        if(mysqli_num_rows($respuestacups) <> 0){
            $rowcups = mysqli_fetch_array($respuestacups);
            $iden_map=$rowcups['iden_map'];
            
            $query="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
            VALUES(0,$iden_map,$this->iden_ctr,'$this->tser_tco','$this->clas_tco',$this->valo_tco,'$this->grqx_tco','AC')";
            //echo "<br>".$query;
            $res=mysqli_query($conexion,$query);
            //echo "<br>".mysqli_affected_rows($conexion);
        }        
        mysqli_close($conexion);
    }

    public function actualizarDispositivos() {
        /*echo "<br><br>COD ".$this->codigo_cups;
        echo "<br>TS ".$this->tser_tco;
        echo "<br>GR ".$this->grqx_tco;
        echo "<br>CLAS ".$this->clas_tco;
        echo "<br>VAL ".$this->valo_tco;*/

        $conexion = mysqli_connect("192.168.4.12","root","","proinsalud");
        $consultacups="SELECT codnue FROM insu_med WHERE codnue = '$this->codigo_cups'";
        //echo "<br>".$consultacups;
        $respuestacups=mysqli_query($conexion,$consultacups);
        if(mysqli_num_rows($respuestacups) <> 0){
            //$rowcups = mysqli_fetch_array($respuestacups);
            $iden_map=$this->codigo_cups;
            
            $query="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
            VALUES(0,$iden_map,$this->iden_ctr,'$this->tser_tco','$this->clas_tco',$this->valo_tco,'$this->grqx_tco','AC')";
            //echo "<br>".$query;
            $res=mysqli_query($conexion,$query);
            //echo "<br>".mysqli_affected_rows($conexion);
        }        
        mysqli_close($conexion);
    }

    public function actualizarMedicamentos() {
        /*echo "<br><br>COD ".$this->codigo_cups;
        echo "<br>TS ".$this->tser_tco;
        echo "<br>GR ".$this->grqx_tco;
        echo "<br>CLAS ".$this->clas_tco;
        echo "<br>VAL ".$this->valo_tco;*/

        $conexion = mysqli_connect("192.168.4.12","root","","proinsalud");
        $consultacups="SELECT codi_mdi,ncsi_medi FROM medicamentos2 WHERE ncsi_medi = '$this->codigo_cups'";
        //echo "<br>".$consultacups;
        $respuestacups=mysqli_query($conexion,$consultacups);
        if(mysqli_num_rows($respuestacups) <> 0){
            $rowcups = mysqli_fetch_array($respuestacups);
            $iden_map=$rowcups['codi_mdi'];
            
            $query="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
            VALUES(0,$iden_map,$this->iden_ctr,'$this->tser_tco','$this->clas_tco',$this->valo_tco,'$this->grqx_tco','AC')";
            //echo "<br>".$query;
            $res=mysqli_query($conexion,$query);
            //echo "<br>".mysqli_affected_rows($conexion);
        }        
        mysqli_close($conexion);
    }
}

function actualizartarco(){    
    $conexion = mysqli_connect("192.168.4.20","root","","proinsalud");
    $consultatarco="SELECT * FROM tarco t WHERE clas_tco ='P' AND iden_ctr in (817,818)";
    echo $consultatarco;
    $respuestatarco = mysqli_query($conexion,$consultatarco);
    while($rowtco = mysqli_fetch_array($respuestatarco)){
        //echo "<br>".$rowtco['iden_tco'];
        $consultamapii ="SELECT * FROM MAPII WHERE iden_map='$rowtco[iden_map]'";
        echo "<br>".$consultamapii;
        $respuestamapii = mysqli_query($conexion,$consultamapii);
        $rowmapii = mysqli_fetch_array($respuestamapii);
        //echo "<br>".$rowmapii['iden_map'];

        $consultacups ="SELECT * FROM cups WHERE codi_cup='$rowmapii[codi_map]' AND esta_cup='AC'";
        echo "<br>".$consultacups;
        $respuestacups = mysqli_query($conexion,$consultacups);
        if(mysqli_num_rows($respuestacups) <> 0){            
            //echo "<br>Encontrado ".mysqli_num_rows($respuestacups);
            //echo"<br>".$rowmapii['codi_map'].'-'.$rowmapii['esta_map'].'-'.$rowmapii['desc_map'];
            $rowcups=mysqli_fetch_array($respuestacups);
            //echo"<br>".$rowcups['codigo'].'-'.$rowmapii['codi_map'];
            if($rowcups['codigo'] <> $rowmapii['codi_map']){
                //echo"<br>Son diferentes ".$rowcups['codigo'].'-'.$rowmapii['codi_map'];
                $consultanuevomap="SELECT * FROM mapii WHERE codi_map='$rowcups[codigo]'";
                echo "<br>Nuevo mapii ".$consultanuevomap;
                $resultadonuevomap=mysqli_query($conexion,$consultanuevomap);                
                if(mysqli_num_rows($resultadonuevomap)<>0){
                    $rownuevomap=mysqli_fetch_array($resultadonuevomap);
                    echo "<br>Nuevo ".$rownuevomap['iden_map']." Anterior ".$rowmapii['iden_map'];
                    $sql="UPDATE tarco SET iden_map='$rownuevomap[iden_map]' WHERE iden_tco='$rowtco[iden_tco]'";
                    echo "<br>".$sql;
                    mysqli_query($conexion,$sql);
                    echo "<br>".mysqli_affected_rows($conexion);
                }
                else{
                    //echo "<br>No encontrado ";
                }
            }            
        }
        else{
            //echo "<br>No Encontrado ".$rowmapii['iden_map']." - ".$rowmapii['codi_map'];           
            //echo"<br>".$rowmapii['codi_map'].'-'.$rowmapii['esta_map'].'-'.$rowmapii['desc_map'];
        }

        //$rowmapii = mysqli_fetch_array($respuestamapii);
        //echo "<br>".$rowmapii['iden_map'];
        echo "<br>";

    }
    echo "<br>Hecho";
    

    
    mysqli_close($conexion);
}

function inactivarmaipii(){
    //$conexion = mysqli_connect("192.168.4.20","root","","proinsalud");
	$conexion = mysqli_connect("localhost","root","","proinsalud");
    $consultacups = "SELECT * FROM cups";
    //echo "<br>".$consultacups;
    $resultadocups = mysqli_query($conexion,$consultacups);
    $contador=0;
    while($rowcups = mysqli_fetch_array($resultadocups) ){
        echo "<br>".$rowcups['codi_cup'].' - '.$rowcups['codigo'].' - '.$rowcups['esta_cup'];

        $consultamapii ="SELECT * FROM mapii WHERE codi_map='".$rowcups['codigo']."'";
        echo "<br>".$consultamapii;
        $resultadomaipii = mysqli_query($conexion,$consultamapii);
        if(mysqli_num_rows($resultadomaipii) <> 0){
            $rowmapii = mysqli_fetch_array($resultadomaipii);
            //echo "<br>".$rowmapii['esta_map'];
            if($rowcups['esta_cup']<>$rowmapii['esta_map']){
                $sql="UPDATE mapii SET esta_map='$rowcups[esta_cup]' WHERE iden_map='$rowmapii[iden_map]'";                
                //echo "<br>".$sql;
                mysqli_query($conexion,$sql);
                $contador++;
            }

        }
        echo "<br>";        
    }
    echo "<br>Hecho...".$contador;
}
?>
