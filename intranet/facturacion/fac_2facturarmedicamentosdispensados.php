<?php
session_start();
/*echo "<br>nume_for ".$_POST['nume_for'];
echo "<br>codi_con ".$_POST['codi_con'];
echo "<br>items ".$_POST['listaItems'];*/
$listaItems=$_POST['listaItems'];

include('php/conexion.php');


//Aqui cargo los medicamentos
$facturas = array();

$msj="";

//Aqui se consulta el encabezado de la formula
$consulta_for="SELECT fm.fdis_for ,fm.coduni_usu, fm.dxprin_for, fm.servicio_for, fm.codi_medi,
m.cod_medi 
FROM formedica.formulamae fm 
LEFT JOIN medicos m ON m.csii_med = fm.codi_medi 
WHERE fm.nume_for ='$_POST[nume_for]'";
//echo "<br>".$consulta_for;
$consulta_for=mysql_query($consulta_for);
$rowfor=mysql_fetch_array($consulta_for);

foreach($listaItems as $item) {
    /*echo "<br>".$item['regi_for'];
    echo "<br>".$item['iden_tco'];
    echo "<br>".$item['iden_ctr'];
    echo "<br>obj nume_for".$item['nume_for'];
    echo "<br>pos nume_for: ".$_POST['nume_for'];*/

    if($item['nume_for'] == $_POST['nume_for'] && $item['iden_tco'] <> 0){
        $nit=buscarNit($item['iden_ctr']);
    
        $factura = new Factura();    
        $factura->iden_fac=0;
        $factura->nume_fac='';
        $factura->tipo_fac='2';
        $factura->feci_fac=$rowfor['fdis_for'];
        $factura->fecf_fac=$rowfor['fdis_for'];
        $factura->codi_usu=$rowfor['coduni_usu'];
        $factura->codi_con=$_POST['codi_con'];
        $factura->iden_ctr=$item['iden_ctr'];
        $factura->cod_cie10=$rowfor['dxprin_for'];
        $factura->area_fac=$rowfor['servicio_for'];
        $factura->vtot_fac='0';
        $factura->pcop_fac='0';
        $factura->vcop_fac='0';
        $factura->pdes_fac='0';
        $factura->cmod_fac='0';
        $factura->vnet_fac='0';
        $factura->esta_fac='1';
        $factura->enti_fac=$nit;
        $factura->anul_fac='N';
        $factura->usua_fac=$Gidusufac;

        $iden_fac = crearFactura($facturas,$factura);
        
        //Aqui se consulta los medicamentos de la orden
        $consulta_dis="SELECT f.regi_for,f.codi_pro,f.cdis_for, t.valo_tco, t.iden_tco,
        m.nomb_mdi 
        FROM formedica.formuladet f 
        INNER JOIN tarco t ON t.iden_map = f.codi_pro 
        INNER JOIN medicamentos2 m ON m.codi_mdi = t.iden_map    
        WHERE t.iden_ctr ='$item[iden_ctr]' AND f.regi_for='$item[regi_for]'
        UNION
        SELECT f.regi_for,f.codi_pro,f.cdis_for, t.valo_tco, t.iden_tco, im.desc_ins AS nomb_mdi 
        FROM formedica.formuladet f 
        INNER JOIN tarco t ON t.iden_map = f.codi_pro 
        INNER JOIN insu_med im ON im.codi_ins = t.iden_map
        WHERE t.iden_ctr ='$item[iden_ctr]' AND f.regi_for='$item[regi_for]'";
        //echo "<br>".$consulta_dis;
        $consulta_dis = mysql_query($consulta_dis);
        $rowdis = mysql_fetch_array($consulta_dis);
        
        $tipo_dfa='';
        if(strlen($rowdis['codi_pro'])==6){
            $tipo_dfa='M';
        }
        else{
            $tipo_dfa='I';
        }
        

        $sqldetalle="INSERT INTO detalle_factura(tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa,fecservi_dfa)
        VALUES('$tipo_dfa','$iden_fac','$item[iden_tco]','$rowdis[nomb_mdi]','$rowdis[cdis_for]','$rowdis[valo_tco]','1','','$rowfor[cod_medi]','$rowfor[servicio_for]','$rowfor[fdis_for]')";
        //echo "<br>".$sqldetalle;
        mysql_query($sqldetalle);
        $iden_dfa=mysql_insert_id();
        if($iden_dfa <> 0){
            //Aqui se marcar el registro dispensado con el registro del detalle de la factura
            $sqlacturalizar="UPDATE formedica.formuladet SET factu_for='S', iden_dfa='$iden_dfa' 
            WHERE regi_for='$rowdis[regi_for]'";
            //echo "<br>".$sqlacturalizar;
            mysql_query($sqlacturalizar);
        }
    }    
}
$msj=actualizarTotales($facturas);

echo $msj;

function crearFactura(&$facturas_,$factura_){
    //Aqui se crea el registro de la factura
    $iden_fac = 0;

    $encontrado = 0;
    foreach ($facturas_ as $objetoFactura){
		if($objetoFactura->iden_ctr == $factura_->iden_ctr){
			$encontrado = 1;
            $iden_fac=$objetoFactura->iden_fac;
		}
	}

    if($encontrado == 0){

        $sql="INSERT INTO encabezado_factura (nume_fac,tipo_fac,feci_fac,fecf_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac)
        VALUES('$factura_->nume_fac','$factura_->tipo_fac','$factura_->feci_fac','$factura_->fecf_fac','$factura_->codi_usu','$factura_->codi_con','$factura_->iden_ctr','$factura_->cod_cie10','$factura_->area_fac','0','0','0','0','0','0','1','$factura_->enti_fac','N','$factura_->usua_fac')";
        //echo "<br>".$sql;
        mysql_query($sql);
        $iden_fac=mysql_insert_id();
        $factura_->iden_fac=$iden_fac;
        $facturas_[] = $factura_;
    }

    return $iden_fac;

}

function buscarNit($idenctr_){
    //Aqui se consulta el codigo del contrato
    $consulta_con="SELECT c.codi_con, ct.NIT_CON
    FROM contratacion c 
    INNER JOIN contrato ct ON ct.codi_con = c.codi_con
    WHERE iden_ctr='$idenctr_'";
    //echo "<br>".$consulta_con;
    $consulta_con = mysql_query($consulta_con);
    $rowcon=mysql_fetch_array($consulta_con);
    return($rowcon['NIT_CON']);
}

function actualizarTotales($facturas_){
    //Aqui se actualizan los totales de la factura
    foreach ($facturas_ as $objetoFactura){
        $consultaFac="SELECT SUM(df.cant_dfa*df.valu_dfa) AS total
        FROM detalle_factura df 
        WHERE df.iden_fac = '$objetoFactura->iden_fac'";
        //echo "<br>".$consultaFac;
        $consultaFac=mysql_query($consultaFac);
        $rowFac=mysql_fetch_array($consultaFac);
        $sql="UPDATE encabezado_factura SET vtot_fac='$rowFac[total]', vnet_fac='$rowFac[total]' WHERE iden_fac = '$objetoFactura->iden_fac'";
        //echo "<br>".$sql;
        mysql_query($sql);
	}    
    return ("Factura creada con éxito...");
}


class Factura{
    public $iden_fac;
    public $nume_fac;
    public $tipo_fac;
    public $feci_fac;
    public $fecf_fac;
    public $codi_usu;
    public $codi_con;
    public $iden_ctr;
    public $cod_cie10;
    public $area_fac;
    public $vtot_fac;
    public $pcop_fac;
    public $vcop_fac;
    public $pdes_fac;
    public $cmod_fac;
    public $vnet_fac;
    public $esta_fac;
    public $enti_fac;
    public $anul_fac;
    public $usua_fac;
}
?>
