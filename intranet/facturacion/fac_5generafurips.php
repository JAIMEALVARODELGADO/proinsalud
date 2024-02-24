<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='JavaScript'>

</script>
</head>
<body>
<form name='form1' method="POST" action='' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>Validación de F U R I P S</td></tr></table>
<?
set_time_limit(0);
include('php/conexion.php');
include('php/funciones.php');
$error=0;
echo "<table class='Tbl0' border='0'>";
echo "<th class='Th0' width='5%'>Sel</th>
      <th class='Th0' width='10%'>Concepto</th>
      <th class='Th0' width='60%'>Error</th>";
$consulta="SELECT usu.codi_usu,usu.nrod_usu,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu) AS nombre,usu.fnac_usu,usu.sexo_usu,usu.dire_usu,usu.mate_usu,
    ef.nume_fac,mun.nomb_mun,
    rec.resp_rec,rec.radant_rec,rec.iden_fac,rec.nume_rec,rec.codi_usu,rec.cond_rec,rec.natu_rec,rec.desot_rec,rec.direoc_rec,rec.fechoc_rec,rec.horaoc_rec,rec.munioc_rec,rec.zonaoc_rec
    FROM fr_reclamacion AS rec
    INNER JOIN encabezado_factura AS ef ON ef.iden_fac=rec.iden_fac
    INNER JOIN usuario AS usu ON usu.codi_usu=rec.codi_usu
    INNER JOIN municipio AS mun ON mun.codi_mun=rec.munioc_rec
    WHERE rec.iden_rec='$iden_rec1'";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
if(!empty($row[resp_rec]) and empty($row[radant_rec])){
    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
    muetraerror($color,'Es necesario el numero de radicado anterior');
    $error++;
}
if(empty($row[nume_fac])){
    if($color<>'#dddddd'){$color='#dddddd';}else{$color='';}
    muetraerror($color,'La factura debe estar cerrada');
    $error++;
}

//Datos del vehiculo
$consveh="SELECT veh.iden_veh,veh.iden_rec,veh.estase_veh,veh.marca_veh,veh.placa_veh,veh.tipo_veh,veh.codi_con,veh.poliza_veh,veh.finipol_veh,veh.ffinpol_veh,veh.inter_veh,veh.exced_veh,veh.placaseg_veh,veh.tdocseg_veh,veh.ndocseg_veh,veh.placater_veh,veh.tdocter_veh,veh.ndocter_veh,
con.codase_con
FROM fr_vehiculo AS veh 
INNER JOIN contrato AS con ON con.codi_con=veh.codi_con
WHERE iden_rec='$iden_rec1'";
//echo $consveh;
$consveh=mysql_query($consveh);
if(mysql_num_rows($consveh)<>0){
    $rowveh=mysql_fetch_array($consveh);
    if($rowveh[codase_con]==''){
        muetraerror($color,'El contrato no tiene el codigo de la entidad aseguradora');
    }
}

$consate="SELECT aten.fecing_ate,aten.horing_ate,aten.fecsal_ate,aten.horsa_ate,aten.diapri_ate,aten.diaas1_ate,aten.diaas2_ate,aten.dxprieg_ate,aten.dxaseg1_ate,aten.dxaseg2_ate,aten.cod_medi,aten.totfac_ate,aten.totrec_ate,aten.totftra_ate,aten.totrtra_ate,aten.foli_ate,
med.pnom_medi,med.snom_medi,med.pape_medi,med.sape_medi,med.tido_medi,med.ced_medi,med.reg_medi
FROM fr_atencion AS aten
INNER JOIN medicos AS med ON med.cod_medi=aten.cod_medi
WHERE iden_rec='$iden_rec1'";
//echo $consate;
$consate=mysql_query($consate);
$rowate=mysql_fetch_array($consate);
if($rowate[pnom_medi]==''){
    muetraerror($color,'El primer nombre del medico esta vacio');
}
if($rowate[pape_medi]==''){
    muetraerror($color,'El primer apellido del medico esta vacio');
}
if($rowate[tido_medi]==''){
    muetraerror($color,'El tipo de documento de identificacion del medico esta vacio');
}
if($rowate[ced_medi]==''){
    muetraerror($color,'El numero de identificacion del medico esta vacio');
}
if($rowate[reg_medi]==''){
    muetraerror($color,'El registro del medico esta vacio');
}

$consultadet="SELECT * FROM fr_detalle_rec WHERE iden_rec='$iden_rec1' ORDER BY tipser_det,desc_det";
//echo $consultadet;
$consultadet=mysql_query($consultadet);
while($rowdet=mysql_fetch_array($consultadet)){
    if($rowdet[codi_det]==''){
        muetraerror($color,'El Codigo del detalle esta vacio '.$rowdet[desc_det]);
    }    
}

echo "</table>";

echo "<br><center><a href='fac_5creaplanofurips.php?iden_rec1=$iden_rec1'><img src='icons/1273718947326355398.png' height='40' width='40' alt='Generar archivos planos'>Generar Archivos Planos</a></center>";

mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</html>

<?
function muetraerror($color_,$desc_){
	echo "<tr>";
	echo "<td class='Td2' align='center' bgcolor='$color_'><a href='fac_4heenviarips__.php?iden_fac=$idfac_&factura=$fac_&cpt=$cpt_'><img width=15 height=15 src='icons\feed_edit.png' alt='Ir a los rips de la factura' border=0></a></td>";
	echo "<td class='Td2' align='center' bgcolor='$color_'></td>";
	echo "<td class='Td2' align='left' bgcolor='$color_'>".$desc_."</td>";	
	echo "</tr>";
}
?>
