<?php
session_start();
//echo "<br>nume_for ".$_POST['nume_for'];
//echo "<br>iden_ctr ".$_POST['iden_ctr'];

include('php/conexion.php');

$msj="";

//Aqui se consulta el codigo del contrato
$consulta_con="SELECT c.codi_con, ct.NIT_CON
FROM contratacion c 
INNER JOIN contrato ct ON ct.codi_con = c.codi_con
WHERE iden_ctr='$_POST[iden_ctr]'";
//echo "<br>".$consulta_con;
$consulta_con = mysql_query($consulta_con);
$rowcon=mysql_fetch_array($consulta_con);


//Aqui se consulta el encabezado de la formula
$consulta_for="SELECT fm.fdis_for ,fm.coduni_usu, fm.dxprin_for, fm.servicio_for, fm.codi_medi,
m.cod_medi 
FROM formedica.formulamae fm 
LEFT JOIN medicos m ON m.csii_med = fm.codi_medi 
WHERE fm.nume_for ='$_POST[nume_for]'";
//echo "<br>".$consulta_for;
$consulta_for=mysql_query($consulta_for);
$rowfor=mysql_fetch_array($consulta_for);


//Aqui se consulta los medicamentos de la orden
$consulta_dis="SELECT f.regi_for,f.codi_pro,f.cdis_for, t.valo_tco, t.iden_tco,
m.nomb_mdi 
FROM formedica.formuladet f 
INNER JOIN tarco t ON t.iden_map = f.codi_pro 
INNER JOIN medicamentos2 m ON m.codi_mdi = t.iden_map
WHERE LENGTH(f.codi_pro)=6 AND (ISNULL(f.factu_for) OR f.factu_for<>'S') AND t.iden_ctr ='$_POST[iden_ctr]' AND f.nume_for ='$_POST[nume_for]'";
//echo "<br>".$consulta_dis;

$total=0;
$consulta_dis = mysql_query($consulta_dis);

if(mysql_num_rows($consulta_dis)<>0){
    //Aqui se crea el registro de la factura
    $sql="INSERT INTO encabezado_factura (nume_fac,tipo_fac,feci_fac,fecf_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac)
    VALUES('','2','$rowfor[fdis_for]','$rowfor[fdis_for]','$rowfor[coduni_usu]','$rowcon[codi_con]','$_POST[iden_ctr]','$rowfor[dxprin_for]','$rowfor[servicio_for]','0','0','0','0','0','0','1','$rowcon[NIT_CON]','N','$Gidusufac')";
    //echo "<br>".$sql;
    mysql_query($sql);
    $iden_fac=mysql_insert_id();
    //echo "<br>".$iden_fac;
    
    //Aqui se leen los registros de medicamentos para crear los detalles de la factura
    while($rowdis = mysql_fetch_array($consulta_dis)){
        //echo"<br>".$rowdis['codi_pro'];
        $sqldetalle="INSERT INTO detalle_factura(tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa,fecservi_dfa)
        VALUES('M','$iden_fac','$rowdis[iden_tco]','$rowdis[nomb_mdi]','$rowdis[cdis_for]','$rowdis[valo_tco]','1','','$rowfor[cod_medi]','$rowfor[servicio_for]','$rowfor[fdis_for]')";
        //Falta validar el codigo del medico
    
        //echo "<br>".$sqldetalle;
        mysql_query($sqldetalle);
        $iden_dfa=mysql_insert_id();
        $total=$total+($rowdis[cdis_for]*$rowdis[valo_tco]);
        if($iden_dfa <> 0){
            //Aqui se marcar el registro dispensado con el registro del detalle de la factura
            $sqlacturalizar="UPDATE formedica.formuladet SET factu_for='S', iden_dfa='$iden_dfa' 
            WHERE regi_for='$rowdis[regi_for]'";
            //echo "<br>".$sqlacturalizar;
            mysql_query($sqlacturalizar);
        }
    }
    
    //Aqui se actualizan los totales de la factura
    $sql="UPDATE encabezado_factura SET vtot_fac='$total', vnet_fac='$total' WHERE iden_fac = '$iden_fac'";
    mysql_query($sql);
    $msj="Factura creada con éxito...";
}
else{
    $msj="La dispensacion ".$_POST['nume_for']." NO tiene medicamentos pendientes por facturar";
}

echo $msj;
?>
