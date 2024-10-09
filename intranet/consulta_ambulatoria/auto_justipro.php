<?php
session_start();
$codiusua=$_SESSION['codiusua'];
$codidocum=$_SESSION['codidocum'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
 foreach($_GET as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
include ('php/conexion1.php');
$q = strtoupper($_GET["q"]);
IF (!$q) RETURN;
if (strlen($q)>2)
{
    $ntab=mysql_query("CREATE TEMPORARY TABLE usutmp SELECT codi_ins as codigo, codnue as nco, desc_ins as nombre FROM `insu_med`");	
    $ntab1=mysql_query("insert into usutmp SELECT medicamentos2.codi_mdi as codigo, medicamentos2.ncsi_medi as nco, CONCAT(medicamentos2.nomb_mdi,' ',medicamentos2.noco_mdi,' ',forma_farmaceutica.desc_ffa) as nombre 
	FROM forma_farmaceutica INNER JOIN medicamentos2 ON forma_farmaceutica.codi_ffa = medicamentos2.coff_mdi WHERE pos_mdi='12'");
    $sql = "select * from usutmp where nombre LIKE '%$q%' ORDER BY nombre";
    $rsd = mysql_query($sql);
    IF ($rsd)
    {        
        WHILE($rs = mysql_fetch_array($rsd)) 
        {			
            $cid = $rs[codigo];
            $cname = $rs[nombre];
            $ncod = $rs[nco];
            $cname1=$cname;	
            if($cname1!='')
            ECHO "$cname1|$cid|$ncod\n";
        }
    }
    echo "-";    	
}
?>
