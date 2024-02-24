<?php
session_start();
require('php/conexion.php');
$q = strtoupper($_GET["q"]);
if (!$q) RETURN;
switch($tipo_){
	case 'P':
		$sql = "SELECT DISTINCT iden_tco AS iden_,descripcion AS desc_,valo_tco AS valo_ FROM vista_tarco_cups		
		WHERE clas_tco='P' AND iden_ctr='$cont_' AND esta_map='AC' AND esta_tco='AC' AND descripcion LIKE '%$q%' ORDER BY desc_";
		break;
	case 'M':
		$sql = "SELECT DISTINCT tar.iden_tco AS iden_,CONCAT(mdi.nomb_mdi,' ',mdi.noco_mdi,' ',ff.desc_ffa) AS desc_,tar.valo_tco AS valo_ FROM tarco AS tar 
		INNER JOIN medicamentos2 AS mdi ON mdi.codi_mdi=tar.iden_map
        INNER JOIN forma_farmaceutica AS ff ON ff.codi_ffa=mdi.coff_mdi
		WHERE tar.clas_tco='M' AND tar.iden_ctr='$cont_' AND (mdi.nomb_mdi LIKE '%$q%' OR mdi.noco_mdi LIKE '%$q%') ORDER BY desc_";
		break;
	case 'I':
		/*$sql = "SELECT DISTINCT tar.iden_tco AS iden_,ins.desc_ins AS desc_,tar.valo_tco AS valo_ FROM tarco AS tar 
		INNER JOIN insu_med AS ins ON ins.codnue=tar.iden_map
		WHERE tar.clas_tco='I' AND tar.iden_ctr='$cont_' AND ins.desc_ins LIKE '%$q%' ORDER BY desc_";*/
		$sql = "SELECT DISTINCT tar.iden_tco AS iden_,ins.desc_ins AS desc_,tar.valo_tco AS valo_ FROM tarco AS tar 
		INNER JOIN insu_med AS ins ON ins.codi_ins=tar.iden_map
		WHERE tar.clas_tco='I' AND tar.iden_ctr='$cont_' AND ins.desc_ins LIKE '%$q%' ORDER BY desc_";
		break;
}
//echo "<br>".$sql."<br>";
$rsd = mysql_query($sql);
if($rsd){
	while($rs = mysql_fetch_array($rsd)) {
		$cid = $rs[$datos[1]];
		$cid1= $rs[$datos[2]];
		$cname = $rs[$datos[0]];
		echo "$cname|$cid|$cid1\n";
	}
}
?>
<p><font color="#000000">no encontrado</font></p>