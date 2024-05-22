<?php
session_start();

include('php/conexion.php');

$msj="";

//$listaItems = json_decode($_POST['listaItems'], true);
$listaItems = $_POST['listaItems'];

//echo count($listaItems);
$nrod_usu='';
foreach($listaItems as $item) {
    //echo $item['nrod_usu'] . ': ' . $item['iden_adi'] . ': ' . $item['iden_tco'] . '<br>'; 

    //Aqui se consulta las aplicaciones
    $consulta_apli="SELECT ai.iden_adi,ai.tpin_adi,ai.idin_adi , ai.fech_adi,ai.hora_adi, ai.cant_adi, ai.resp_adi,
    c.CODI_CON ,c.NEPS_CON,c.NIT_CON ,u.NROD_USU , CONCAT(u.PNOM_USU,' ',u.SNOM_USU,' ',u.PAPE_USU,' ',u.SAPE_USU) as nombre,ih.ubica_ing	,ih.codius_ing, ih.contra_ing, ih.id_ing
    FROM administra_insumo ai 
    INNER JOIN ingreso_hospitalario ih ON ih.id_ing =ai.id_ing 
    INNER JOIN usuario u ON u.CODI_USU = ih.codius_ing
    INNER JOIN contrato c ON c.CODI_CON = ih.contra_ing    
    WHERE iden_adi='".$item['iden_adi']."'";
    //echo "<br>".$consulta_apli;

    $consulta_apli = mysql_query($consulta_apli);
    $rowapli = mysql_fetch_array($consulta_apli);

    if($item['nrod_usu'] <> $nrod_usu){
        $nrod_usu=$item['nrod_usu'];

        $consultaevo = "SELECT cod_cie10 FROM hist_evo he where id_ing ='".$rowapli[id_ing]."'";
        //echo "<br>".$consultaevo;
        $consultaevo = mysql_query($consultaevo);
        $rowevo = mysql_fetch_array($consultaevo);


        //Aqui se crea el registro de la factura
        $sql="INSERT INTO encabezado_factura (id_ing,nume_fac,tipo_fac,feci_fac,fecf_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac)
        VALUES('$rowapli[id_ing]','','2','$rowapli[fech_adi]','$rowapli[fech_adi]','$rowapli[codius_ing]','$rowapli[contra_ing]','$item[iden_ctr]','$rowevo[cod_cie10]','$rowapli[ubica_ing]','0','0','0','0','0','0','1','$rowapli[NIT_CON]','N','$Gidusufac')";
        //echo "<br>".$sql;

        mysql_query($sql);
        $iden_fac=mysql_insert_id();
    }

    //Aqui se consulta los medicamentos o insumos
    if($rowapli['tpin_adi'] == 'M'){
        $consulta_med="SELECT t.iden_tco,t.clas_tco , t.valo_tco,m.codi_mdi, m.nomb_mdi
        FROM tarco t
        INNER JOIN medicamentos2 m ON m.codi_mdi = t.iden_map
        WHERE t.iden_tco='$item[iden_tco]'";
        //echo "<br>".$consulta_med;
        $consulta_med = mysql_query($consulta_med);
        $rowmed = mysql_fetch_array($consulta_med);
        $descripcion = $rowmed['nomb_mdi'];
        $valor = $rowmed['valo_tco'];
    }
    else{
        $consulta_ins="SELECT t.iden_tco,t.clas_tco , t.valo_tco, im.codi_ins, im.desc_ins
        FROM tarco t
        INNER JOIN insu_med im  ON im.codi_ins = t.iden_map         
        WHERE t.iden_tco='$item[iden_tco]'";
        //echo "<br>".$consulta_ins;
        $consulta_ins = mysql_query($consulta_ins);
        $rowins = mysql_fetch_array($consulta_ins);
        $descripcion = $rowins['desc_ins'];
        $valor = $rowins['valo_tco'];
        
    }

    $sqldetalle="INSERT INTO detalle_factura(tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa,fecservi_dfa)
    VALUES('$rowapli[tpin_adi]' ,'$iden_fac','$item[iden_tco]','$descripcion','$rowapli[cant_adi]','$valor' ,'1','','$rowapli[resp_adi]','$rowapli[ubica_ing]','$rowapli[fech_adi]')";
    //echo "<br>".$sqldetalle;
    mysql_query($sqldetalle);
    $iden_dfa=mysql_insert_id();

    $sqlactfac="
    UPDATE encabezado_factura SET vtot_fac =
        (SELECT SUM(df.cant_dfa*df.valu_dfa) FROM detalle_factura df WHERE iden_fac ='$iden_fac'),
        vnet_fac =
        (SELECT SUM(df.cant_dfa*df.valu_dfa) FROM detalle_factura df WHERE iden_fac ='$iden_fac')
    WHERE iden_fac ='$iden_fac'";
    //echo "<br>".$sqlactfac;
    mysql_query($sqlactfac);

    //Aqui se marca el registro como facturado
    //$iden_dfa=1;
    if($iden_dfa <> 0){
        $sqlacturalizar="UPDATE administra_insumo SET fact_adi='S' WHERE iden_adi='$item[iden_adi]'";
        //echo "<br>".$sqlacturalizar;
        mysql_query($sqlacturalizar);
        $msj="Factura creada con éxito.";
    }
    else{
        $msj="Factura NO creada";
    }

}

echo $msj;

?>
