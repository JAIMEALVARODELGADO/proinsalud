<?php
session_start();
/*echo "<br>cpl ".$_POST['iden_cpl'];
echo "<br>tco ".$_POST['iden_tco'];
echo "<br>ctr ".$_POST['iden_ctr'];*/


include('php/conexion.php');

$msj="";
//Aqui se consulta la atención del paciente
$consulta_con="SELECT e.cous_ehi,c.iden_cpl,e.cont_ehi,c.feca_cpl,c.area_cpl,c.cod1_cpl,c.come_cpl,
        u.NROD_USU, CONCAT(U.PNOM_USU,' ',U.SNOM_USU,' ',U.PAPE_USU,' ',U.SAPE_USU) nombre, 
        ct.NEPS_CON,ct.NIT_CON
        FROM encabesadohistoria e
        INNER JOIN consultaprincipal c ON c.numc_cpl = e.numc_ehi
        INNER JOIN usuario u ON u.CODI_USU = e.cous_ehi
        INNER JOIN contrato ct on ct.CODI_CON = e.cont_ehi 
        WHERE iden_cpl=".$_POST['iden_cpl'];
//echo "<br>".$consulta_con;

$consulta_con = mysql_query($consulta_con);
$rowcon = mysql_fetch_array($consulta_con);

//Aqui se consulta el área
$consulta_area="SELECT codi_des FROM areas WHERE cod_areas='$rowcon[area_cpl]'";
//echo "<br>".$consulta_area;
$consulta_area = mysql_query($consulta_area);
$rowarea = mysql_fetch_array($consulta_area);

//Aqui se consulta la tarifa
$consulta_tarifa="SELECT t.iden_tco, t.valo_tco, m.desc_map 
FROM tarco t 
INNER JOIN mapii m ON m.iden_map = t.iden_map
WHERE t.iden_tco = $_POST[iden_tco]";
//echo "<br>".$consultatarifa;
$consulta_tarifa = mysql_query($consulta_tarifa);
$rowtarifa = mysql_fetch_array($consulta_tarifa);

//Aqui se crea el registro de la factura
$sql="INSERT INTO encabezado_factura (nume_fac,tipo_fac,feci_fac,fecf_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac)
VALUES('','2','$rowcon[feca_cpl]','$rowcon[feca_cpl]','$rowcon[cous_ehi]','$rowcon[cont_ehi]','$_POST[iden_ctr]','$rowcon[cod1_cpl]','$rowarea[codi_des]','$rowtarifa[valo_tco]','0','0','0','0','$rowtarifa[valo_tco]','1','$rowcon[NIT_CON]','N','$Gidusufac')";
//echo "<br>".$sql;

mysql_query($sql);
$iden_fac=mysql_insert_id();

$sqldetalle="INSERT INTO detalle_factura(tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa,fecservi_dfa)
VALUES('P','$iden_fac','$_POST[iden_tco]','$rowtarifa[desc_map]','1','$rowtarifa[valo_tco]','1','','$rowcon[come_cpl]','$rowarea[codi_des]','$rowcon[feca_cpl]')";

//echo "<br>".$sqldetalle;
mysql_query($sqldetalle);
$iden_dfa=mysql_insert_id();
if($iden_dfa <> 0){
        $sqlacturalizar="UPDATE consultaprincipal SET iden_dfa='$iden_dfa' WHERE iden_cpl=$_POST[iden_cpl]";
        //echo "<br>".$sqlacturalizar;
        mysql_query($sqlacturalizar);
        $msj="Factura creada con éxito.";
}
else{
        $msj="Factura NO creada";
}

echo $msj;
?>
