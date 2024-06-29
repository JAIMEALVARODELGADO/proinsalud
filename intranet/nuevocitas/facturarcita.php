<?php
session_start();
$usucitas=$_SESSION['usucitas'];

/*echo "<br>cita ".$_POST['id_cita'];
echo "<br>tco ".$_POST['iden_tco'];
echo "<br>ctr ".$_POST['iden_ctr'];*/

include ('php/conexion1.php');

$msj="";


//Aqui se consulta la cita del paciente
$consulta_cita="SELECT h.Fecha_horario,c.Idusu_citas,c.Cotra_citas,c.iden_dfa, h.Cserv_horario,h.Cmed_horario,c2.NIT_CON
FROM citas c 
INNER JOIN horarios h ON h.ID_horario = c.ID_horario 
INNER JOIN contrato c2 ON c2.CODI_CON = c.Cotra_citas
WHERE c.id_cita ='".$_POST['id_cita']."'";
//echo "<br>".$consulta_cita;

$consulta_cita = mysql_query($consulta_cita);
$rowcita = mysql_fetch_array($consulta_cita);
if($rowcita['iden_dfa'] == 0){
    //Aqui se consulta el área
    $consulta_area="SELECT codi_des FROM areas WHERE cod_areas='$rowcita[Cserv_horario]'";
    //echo "<br>".$consulta_area;
    $consulta_area = mysql_query($consulta_area);
    $rowarea = mysql_fetch_array($consulta_area);

    //Aqui se consulta la tarifa
    $consulta_tarifa="SELECT t.iden_tco, t.valo_tco, m.desc_map 
    FROM tarco t 
    INNER JOIN mapii m ON m.iden_map = t.iden_map
    WHERE t.iden_tco = $_POST[iden_tco]";
    //echo "<br>".$consulta_tarifa;
    $consulta_tarifa = mysql_query($consulta_tarifa);
    $rowtarifa = mysql_fetch_array($consulta_tarifa);


    //Aqui se crea el registro de la factura
    $sql="INSERT INTO encabezado_factura (nume_fac,tipo_fac,feci_fac,fecf_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac)
    VALUES('','2','$rowcita[Fecha_horario]','$rowcita[Fecha_horario]','$rowcita[Idusu_citas]','$rowcita[Cotra_citas]','$_POST[iden_ctr]','','$rowarea[codi_des]','$rowtarifa[valo_tco]','0','0','0','0','$rowtarifa[valo_tco]','1','$rowcita[NIT_CON]','N','$usucitas')";
    //echo "<br>".$sql;

    mysql_query($sql);
    $iden_fac=mysql_insert_id();

    $sqldetalle="INSERT INTO detalle_factura(tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa,fecservi_dfa)
    VALUES('P','$iden_fac','$_POST[iden_tco]','$rowtarifa[desc_map]','1','$rowtarifa[valo_tco]','1','','$rowcita[Cmed_horario]','$rowarea[codi_des]','$rowcita[Fecha_horario]')";

    //echo "<br>".$sqldetalle;
    mysql_query($sqldetalle);
    $iden_dfa=mysql_insert_id();
    if($iden_dfa <> 0){
            $sqlacturalizar="UPDATE citas SET iden_dfa='$iden_dfa' WHERE id_cita=$_POST[id_cita]";
            //echo "<br>".$sqlacturalizar;
            mysql_query($sqlacturalizar);
            $msj="Factura creada con éxito.";
    }
    else{
            $msj="Factura NO creada";
    }
}
else{
    $msj="La cita ya está facturada";
}


echo $msj;
?>
