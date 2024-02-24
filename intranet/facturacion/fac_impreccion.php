<html>
<head>
<title>PROGRAMA DE FACTURACIN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<form name='form1' method='post' action='fac_geditactxcon.php'>
<table class="Tbl0"><tr><td class="Td0" align='center'>CONTRATO</td></tr></table>
<?
include('php/funciones.php');
include('php/conexion.php');
$consulta=mysql_query("SELECT con.neps_con,con.codi_con,
ccion.iden_ctr,ccion.nume_ctr,ccion.fini_ctr,ccion.ffin_ctr,ccion.mont_ctr,ccion.pctg_ctr,ccion.tari_ctr,ccion.tpor_crt
FROM contrato AS con
INNER JOIN contratacion AS ccion ON ccion.codi_con=con.codi_con
WHERE ccion.iden_ctr='$iden_ctr'");
$row=mysql_fetch_array($consulta);
$codi_con=$row[codi_con];
$tpor_crt=$row[tpor_crt];
$pctg_ctr=$row[pctg_ctr]/100;
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='10%'>NRO</th>
	  <th class='Th0' width='30%'>ENTIDAD</th>
	  <th class='Th0' width='15%'>VIGENCIA</th>
	  <th class='Th0' width='5%'>MONTO</font></th>
	  <th class='Th0' width='40%'>CLAUSULAS</font></th>";
echo "<tr>";
echo "<td class='Td2'>$row[nume_ctr]</td>";
echo "<td class='Td2'>$row[neps_con]</td>";
echo "<td class='Td2'>".cambiafechadmy($row[fini_ctr])." - ".cambiafechadmy($row[ffin_ctr])."</td>";
echo "<td class='Td2'>$row[mont_ctr]</td>";
$tabla='';
$campo='';
$obser='';
if($row[tari_ctr]=='1'){    
  $obser='Soat con ';
  $tabla='soat';
  $campo='soat_map';
}
if($row[tari_ctr]=='2'){
  $obser='ISS 2001 con ';
  $tabla='iss1';
  $campo='iss1_map';
}
if($row[tari_ctr]=='3'){
  $obser='ISS 2004 con ';
  $tabla='iss4';
  $campo='iss4_map';
}

if($row[tpor_crt]=='+'){$tipo='de Incremento';}
if($row[tpor_crt]=='-'){$tipo='de Descuento';}

$obser=$obser.'  '.$row[pctg_ctr].' % '.$tipo;

echo "<td class='Td2'>$obser</td>";
echo "</tr>";
echo "</table>";
echo "<table class='Tbl0'><tr><td class='Td0' align='center'>ACTIVIDADES CONTRATADAS</td></tr></table>";
$condicion="map.esta_map='AC' and tar.clas_tco='P' and tar.iden_ctr=".$iden_ctr;
echo "<table class='Tbl0'>";
echo "<th class='Th0' width='10%'>COD.CUPS</th>
        <th class='Th0' width='10%'>COD.SOAT</th>
        <th class='Th0' width='45%'>NOMBRE</th>
	<th class='Th0' width='20%'>CLASE</th>
	<th class='Th0' width='10%'>VALOR</th>
	<th class='Th0' width='5%'>GRUPO</th>";    

//Aqui hago la consulta de las actividades (mapii)
$consulta="SELECT cup.codi_cup,tar.iden_tco,tar.iden_map,tar.iden_ctr,tar.tser_tco,tar.valo_tco,tar.grqx_tco,
map.codi_map,map.soat_map,map.desc_map
FROM tarco AS tar
INNER JOIN mapii AS map ON map.iden_map=tar.iden_map 
INNER JOIN cups AS cup ON cup.codigo=map.codi_map
WHERE $condicion ORDER BY map.desc_map";
//echo $consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";    
        echo "<td class='Td2'>$row[codi_cup]</td>";
        echo "<td class='Td2'>$row[soat_map]</td>";
        echo "<td class='Td2'>$row[desc_map]</td>";
        echo "<td class='Td2'>";        
	     $consultatp=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$row[tser_tco]'");        
        if(mysql_num_rows($consultatp)<>0){            
            $rowtp=mysql_fetch_array($consultatp);
            echo $rowtp[nomb_des];
        }
        echo "</td>";
        echo "<td class='Td2' align='right'>".number_format($row[valo_tco])."</td>";	
	echo "<td class='Td2'>$row[grqx_tco]</td>";
        echo"</tr>";	
  }
  mysql_free_result($consultatp);
}

//Aqui hago la consulta de los medicamentos contratados (medicamentos2)
$condicion="tar.clas_tco='M' and tar.iden_ctr=".$iden_ctr;
//echo "<br>".$condicion;
$consulta="SELECT tar.iden_tco,tar.iden_map,tar.iden_ctr,tar.tser_tco,tar.valo_tco,tar.grqx_tco,
med.ncsi_medi,med.codi_mdi, med.cum_med,med.nomb_mdi
FROM tarco AS tar
INNER JOIN medicamentos2 AS med ON med.codi_mdi=tar.iden_map 
WHERE $condicion ORDER BY med.nomb_mdi";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";    
        //echo "<td class='Td2'>$row[ncsi_medi]</td>";
        echo "<td class='Td2'>$row[cum_med]</td>";        
        echo "<td class='Td2'>$row[codi_mdi]</td>";
        echo "<td class='Td2'>$row[nomb_mdi]</td>";
        echo "<td class='Td2'>";        
        $consultatp=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$row[tser_tco]'");        
        if(mysql_num_rows($consultatp)<>0){            
            $rowtp=mysql_fetch_array($consultatp);
            echo $rowtp[nomb_des];
        }
        echo "</td>";
        echo "<td class='Td2' align='right'>".number_format($row[valo_tco])."</td>";
	echo "<td class='Td2'>$row[grqx_tco]</td>";
        echo"</tr>";
  }
  mysql_free_result($consultatp);
}

//Aqui hago la consulta de los insumos contratados (insumed)
$condicion="tar.clas_tco='I' and tar.iden_ctr=".$iden_ctr;
//echo "<br>".$condicion;
$consulta="SELECT tar.iden_tco,tar.iden_map,tar.iden_ctr,tar.tser_tco,tar.valo_tco,tar.grqx_tco,
ins.codnue,ins.desc_ins
FROM tarco AS tar
INNER JOIN insu_med AS ins ON ins.codnue=tar.iden_map 
WHERE $condicion ORDER BY ins.desc_ins";
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);
if(mysql_num_rows($consulta)!=0){
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";    
        echo "<td class='Td2'>$row[codnue]</td>";
        echo "<td class='Td2'>$row[desc_ins]</td>";
        echo "<td class='Td2'>";        
	$consultatp=mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$row[tser_tco]'");        
        if(mysql_num_rows($consultatp)<>0){            
            $rowtp=mysql_fetch_array($consultatp);
            echo $rowtp[nomb_des];
        }
        echo "</td>";
        echo "<td class='Td2' align='right'>".number_format($row[valo_tco])."</td>";
	echo "<td class='Td2'>$row[grqx_tco]</td>";
        echo"</tr>";
  }
  mysql_free_result($consultatp);
}

/*else{
  echo "<center>";
  echo "<p class=Msg>No existen registros para esta busqueda</p>";
  echo "</center>";
}*/
mysql_free_result($consulta);
mysql_close();

echo "</table>";
echo "<table class='Tbl2'>";
echo "<tr>";  
echo "<td class='Td1'><a href='#' onclick='window.print()'><img hspace=0 width=20 height=20 src='icons\listado.gif' alt='Imprimir' border=0 align='top'>Imprimir</a></td>";
echo "</tr>";
echo "</table>";
?>
</form>
</body>
</html>