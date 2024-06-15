<?php
session_start();
echo "<br>nume_for ".$_POST['nume_for'];
echo "<br>iden_ctr ".$_POST['iden_ctr'];


include('php/conexion.php');

$msj="Siiiii";

//Aqui se consulta el codigo del contrato
$consulta_con="SELECT c.codi_con, ct.NIT_CON
FROM contratacion c 
INNER JOIN contrato ct ON ct.codi_con = c.codi_con
WHERE iden_ctr='$_POST[iden_ctr]'";
//echo "<br>".$consulta_con;
$consulta_con = mysql_query($consulta_con);
$rowcon=mysql_fetch_array($consulta_con);


//Aqui se consulta el encabezado de la formula
$consulta_for="SELECT fm.fdis_for ,fm.coduni_usu, fm.dxprin_for, fm.servicio_for
FROM formedica.formulamae fm 
WHERE fm.nume_for ='$_POST[nume_for]'";

//echo "<br>".$consulta_for;
$consulta_for=mysql_query($consulta_for);
$rowfor=mysql_fetch_array($consulta_for);


//Aqui se crea el registro de la factura
$sql="INSERT INTO encabezado_factura (nume_fac,tipo_fac,feci_fac,fecf_fac,codi_usu,codi_con,iden_ctr,cod_cie10,area_fac,vtot_fac,pcop_fac,vcop_fac,pdes_fac,cmod_fac,vnet_fac,esta_fac,enti_fac,anul_fac,usua_fac)
VALUES('','2','$rowfor[fdis_for]','$rowfor[fdis_for]','$rowfor[coduni_usu]','$rowcon[codi_con]','$_POST[iden_ctr]','$rowfor[dxprin_for]','$rowfor[servicio_for]','0','0','0','0','0','0','1','$rowcon[NIT_CON]','N','$Gidusufac')";
echo "<br>".$sql;
//mysql_query($sql);
//$iden_fac=mysql_insert_id();
//echo "<br>".$iden_fac;
$iden_fac=2815151;

//Aqui se consulta los medicamentos de la orden
$consulta_dis="SELECT f.codi_pro,f.cdis_for, t.valo_tco, t.iden_tco,
m.nomb_mdi 
FROM formedica.formuladet f 
INNER JOIN tarco t ON t.iden_map = f.codi_pro 
INNER JOIN medicamentos2 m ON m.codi_mdi = t.iden_map
WHERE t.iden_ctr ='$_POST[iden_ctr]' AND LENGTH(f.codi_pro)=6 AND f.nume_for ='$_POST[nume_for]'";
echo "<br>".$consulta_dis;


$consulta_dis = mysql_query($consulta_dis);
while($rowdis = mysql_fetch_array($consulta_dis)){
    //echo"<br>".$rowdis['codi_pro'];
    $sqldetalle="INSERT INTO detalle_factura(tipo_dfa,iden_fac,iden_tco,desc_dfa,cant_dfa,valu_dfa,esta_dfa,nauto_dfa,cod_medi,servi_dfa,fecservi_dfa)
    VALUES('M','$iden_fac','$rowdis[iden_tco]','$rowdis[nomb_mdi]','$rowdis[cdis_for]','$rowdis[valo_tco]','1','','Falta Validar este dato$rowcon[come_cpl]','$rowfor[servicio_for]','$rowfor[fdis_for]')";

    echo "<br>".$sqldetalle;
    /*mysql_query($sqldetalle);
    $iden_dfa=mysql_insert_id();
    if($iden_dfa <> 0){
        $sqlacturalizar="UPDATE consultaprincipal SET iden_dfa='$iden_dfa' WHERE iden_cpl=$_POST[iden_cpl]";
        //echo "<br>".$sqlacturalizar;
        mysql_query($sqlacturalizar);
        $msj="Factura creada con éxito.";
    }
    else{
        $msj="Factura NO creada";
    }*/

    //**************************** */
    //Aqui se debe marcar el registro dispensado con el registro del detalle de la factura
    //**************************** */

}
//**************************** */
//Aqui se debe actualizar los totales de la factura
//**************************** */





//Aqui se consulta el área
/*$consulta_area="SELECT codi_des FROM areas WHERE cod_areas='$rowcon[area_cpl]'";
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
$rowtarifa = mysql_fetch_array($consulta_tarifa);*/



/*

*/

echo $msj;
?>
