<?PHP
session_register('munilabor'); 
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
if (strlen($q)>0)
{
    echo $q;
    $sql = "select * from establecimientos_educativos where nombre_establecimiento LIKE '%$q%' AND cod_muni='$munilabor' ORDER BY nombre_establecimiento";
	
    $rsd = mysql_query($sql);
    IF ($rsd)
    {        
        WHILE($rs = mysql_fetch_array($rsd)) 
        {			
            $cid = $rs[iden];
            $cname = $rs[nombre_establecimiento];  
			$dep = $rs[nom_depar];
			$mun = $rs[nom_muni];
			$cdep = $rs[cod_depar];
			$cmun = $rs[cod_muni];	
			$cnamec=$cname.' ('.$mun.' / '.$dep.')';
			$cnamec = utf8_decode($cnamec);
			$mundep=$mun.' / '.$dep;
            ECHO "$cnamec|$cid\n";
        }
		$cnamec="NO APLICA";
		$cid='0000';
		ECHO "$cnamec|$cid\n";
    }    
}

?>