<?php 
set_time_limit(0);

include('php/conexion.php');


$conexionI = conectarBd();

$msj="";
$listaItems = $_POST['contenido'];
$iden_ctr = $_POST['iden_ctr'];

$linea = 1;
foreach ($listaItems as $item) {        

    $tarco = new Tarco();
    $tarco->codigo_cups = $item['Codigo'];
    $tarco->tser_tco = $item['Tipo'];
    $tarco->grqx_tco = $item['Grupo'];
    $tarco->clas_tco = strtoupper($item['Clase']);
    $tarco->valo_tco= $item['Valor'];
    $tarco->iden_ctr = $iden_ctr;

    $resp = "";
    switch($tarco->clas_tco){
        case 'P':
            $resp = $tarco->actualizar($conexionI);
            if(!empty($resp)){
                $msj = $msj."<br>Linea: ".$linea." ".$resp;
            }
            break;
        case 'M':
            $resp = $tarco->actualizarMedicamentos($conexionI);
            if(!empty($resp)){
                $msj = $msj."<br>Linea: ".$linea." ".$resp;
            }
            break;
        case 'I':
            $resp = $tarco->actualizarDispositivos($conexionI);
            if(!empty($resp)){
                $msj = $msj."<br>Linea: ".$linea." ".$resp;
            }
            break;
        default:
            $msj = $msj."<br>Linea: ".$linea." Clase ".$item['Clase']." no válido";
    }
    $linea++;
}

mysqli_close($conexionI);

echo $msj;
    
class Tarco {
    // Propiedad
    public $codigo_cups;
    public $iden_ctr;
    public $tser_tco;
    public $clas_tco;
    public $valo_tco;
    public $grqx_tco;

    // Método
    public function actualizar($conexion_) {
        $error = false;
        $respuesta_="";

        $consultatipo="SELECT d.codi_des 
        FROM destipos d  
        WHERE d.codt_des='01' AND codi_des ='$this->tser_tco'";
        //echo "<br>".$consultatipo;
        $consultatipo=mysqli_query($conexion_,$consultatipo);        
        if(mysqli_num_rows($consultatipo)==0){
            $error = true;
            $respuesta_=$respuesta_."Tipo de servicio ".$this->tser_tco." no encontrado";
        }

        $consultacups="SELECT c.codi_cup,c.codigo,c.esta_cup,m.iden_map, m.codi_map 
        FROM mapii m 
        INNER JOIN cups c on c.codigo = m.codi_map
        WHERE esta_cup ='AC' AND c.codi_cup = '$this->codigo_cups'";
        //echo "<br>".$consultacups;

        $respuestacups=mysqli_query($conexion_,$consultacups);            
        if(mysqli_num_rows($respuestacups) == 0){
            $respuesta_=$respuesta_." Código CUPS ".$this->codigo_cups." no encontrado o no está en MAPII";
            $error = true;
        }

        if(!$error){                
            $rowcups = mysqli_fetch_array($respuestacups);
            $iden_map=$rowcups['iden_map'];

            $consultatar="SELECT t.iden_tco,t.iden_map FROM tarco t
            WHERE t.iden_map = '$iden_map' and t.iden_ctr = '$this->iden_ctr'";
            //echo "<br>".$consultatar;
            $consultatar = mysqli_query($conexion_,$consultatar);
            if(mysqli_num_rows($consultatar) == 0 ){
                $query="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
                VALUES(0,'$iden_map','$this->iden_ctr','$this->tser_tco','$this->clas_tco',$this->valo_tco,'$this->grqx_tco','AC')";
                //echo "<br>".$query;
                $res=mysqli_query($conexion_,$query);
                //echo "<br>".mysqli_affected_rows($conexion_);
            }
        }
        return $respuesta_;
    }

    public function actualizarDispositivos($conexion_) {
        $error = false;
        $respuesta_="";

        $consultatipo="SELECT d.codi_des 
        FROM destipos d  
        WHERE d.codt_des='01' AND codi_des ='$this->tser_tco'";
        //echo "<br>".$consultatipo;
        $consultatipo = mysqli_query($conexion_,$consultatipo);        
        if(mysqli_num_rows($consultatipo)==0){
            $error = true;
            $respuesta_=$respuesta_."Tipo de servicio ".$this->tser_tco." no encontrado";
        }
        
        $consultains="SELECT codnue FROM insu_med WHERE codnue = '$this->codigo_cups'";
        //echo "<br>".$consultains;
        $respuestains = mysqli_query($conexion_,$consultains);
        if(mysqli_num_rows($respuestains) == 0){        
            $respuesta_=$respuesta_." Código del dispositivo  ".$this->codigo_cups." no encontrado";
            $error = true;
        }

        if(!$error){   
            //$rowcups = mysqli_fetch_array($respuestacups);
            $iden_map=$this->codigo_cups;
            
            //Aqui se verifica si el medicamento ya está parametrizado
            $consultatar="SELECT t.iden_tco,t.iden_map FROM tarco t
            WHERE t.iden_map = '$iden_map' and t.iden_ctr = '$this->iden_ctr'";
            //echo "<br>".$consultatar;
            $consultatar = mysqli_query($conexion_,$consultatar);
            if(mysqli_num_rows($consultatar) == 0 ){
                $query="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
                VALUES(0,$iden_map,$this->iden_ctr,'$this->tser_tco','$this->clas_tco',$this->valo_tco,'$this->grqx_tco','AC')";
                //echo "<br>".$query;
                $res=mysqli_query($conexion_,$query);                
            }            
        }
        return $respuesta_;
    }

    public function actualizarMedicamentos($conexion_) {
        $error = false;
        $respuesta_="";

        $consultatipo="SELECT d.codi_des 
        FROM destipos d  
        WHERE d.codt_des='01' AND codi_des ='$this->tser_tco'";
        //echo "<br>".$consultatipo;
        $consultatipo=mysqli_query($conexion_,$consultatipo);        
        if(mysqli_num_rows($consultatipo)==0){
            $error = true;
            $respuesta_=$respuesta_."Tipo de servicio ".$this->tser_tco." no encontrado";
        }

        $consultamedicam="SELECT codi_mdi,ncsi_medi FROM medicamentos2 WHERE ncsi_medi = '$this->codigo_cups'";
        //echo "<br>".$consultamedicam;
        
        $respuestamedicam=mysqli_query($conexion_,$consultamedicam);
        if(mysqli_num_rows($respuestamedicam) == 0){            
            $respuesta_=$respuesta_." Código del medicamento  ".$this->codigo_cups." no encontrado";
            $error = true;
        }

        if(!$error){   
           $rowmed = mysqli_fetch_array($respuestamedicam);
            $iden_map=$rowmed['codi_mdi'];
            //echo "<br>".$iden_map;
            
            //Aqui se verifica si el medicamento ya está parametrizado
            $consultatar="SELECT t.iden_tco,t.iden_map FROM tarco t
            WHERE t.iden_map = '$iden_map' and t.iden_ctr = '$this->iden_ctr'";
            //echo "<br>".$consultatar;
            $consultatar = mysqli_query($conexion_,$consultatar);
            if(mysqli_num_rows($consultatar) == 0 ){
                $query="INSERT INTO tarco(iden_tco,iden_map,iden_ctr,tser_tco,clas_tco,valo_tco,grqx_tco,esta_tco)
                VALUES(0,'$iden_map','$this->iden_ctr','$this->tser_tco','$this->clas_tco',$this->valo_tco,'$this->grqx_tco','AC')";
                //echo "<br>".$query;
                $res=mysqli_query($conexion_,$query);
            }
        }
        return $respuesta_;
    }
}


?>
