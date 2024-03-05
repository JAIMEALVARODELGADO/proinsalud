<?
session_start();
session_register('ord_fac');
//session_register('serv_fac');
//session_register('esta_fac');
//session_register('fecha_ini');
//session_register('fecha_fin');
//if(!empty($serv)){$serv_fac=$serv;}
//if(!empty($esta)){$esta_fac=$esta;}
//if(!empty($fechaini)){$fecha_ini=$fechaini;}
//if(!empty($fechafin)){$fecha_fin=$fechafin;}

if(empty($ord_fac)){$ord_fac='qx.fech_qxf';}
elseif(!empty($orden)){$ord_fac= $orden;}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACI�N</title>


<SCRIPT LANGUAGE=JavaScript>
function ordenar(campo){
  form1.orden.value=campo;
  form1.action="fac_3quirof.php";
  form1.target='fr02';
  form1.submit();
}
</script>

<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body lang=ES  style='tab-interval:35.4pt'>
<form name="form1" method="POST" action="fac_3quirof.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>INTERVECIONES REALIZADAS</td></tr></table><br>
<?
include('php/conexion.php');
include('php/funciones.php');
?>
<center><table class="Tbl0" border=1>
	<tr>
	  <?
          
          //qx.fech_qxf>='2010/12/09' AND qx.fech_qxf<='2011/12/09' AND con.codi_con='002' 
		$condicion="";
		if(!empty($fechaini)){$condicion=$condicion."qx.fech_qxf>='".cambiafecha($fechaini)."' AND ";}
		if(!empty($fechafin)){$condicion=$condicion."qx.fech_qxf<='".cambiafecha($fechafin)."' AND ";}
		if(!empty($identif)){$condicion=$condicion."us.nrod_usu='".$identif."' AND ";}
		if(!empty($contra)){$condicion=$condicion."con.codi_con='".$contra."' AND ";}
                $condicion=substr($condicion,0,strlen($condicion)-5);
                //if(!empty($condicion)){$condicion=$condicion}
		//echo "<br>".$condicion;
                
		if ($esta_fac==0){$esta_fac='>=0';}
		else{$esta_fac='=-1';}
                /*echo "<br>SELECT qx.iden_qxf,qx.fech_qxf,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,con.neps_con 
FROM encabezado_qx AS qx
INNER JOIN ucontrato AS uco ON uco.iden_uco=qx.iden_uco
INNER JOIN usuario AS us ON us.codi_usu=uco.cusu_uco
INNER JOIN contrato AS con ON con.codi_con=uco.cont_uco
WHERE $condicion
ORDER BY $ord_fac<br>";*/
		$_pagi_sql="SELECT qx.iden_qxf,qx.fech_qxf,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,con.neps_con 
                FROM encabezado_qx AS qx
                INNER JOIN ucontrato AS uco ON uco.iden_uco=qx.iden_uco
                INNER JOIN usuario AS us ON us.codi_usu=uco.cusu_uco
                INNER JOIN contrato AS con ON con.codi_con=uco.cont_uco
                WHERE $condicion
                ORDER BY $ord_fac";

                
		echo "<br>".$_pagi_sql;
		$_pagi_cuantos = 15; 
		include("php/paginator.inc.php"); 
		if(mysql_num_rows($_pagi_result)!=0) 
		{
			echo "<table class='Tbl0'>";
			echo "<th class='Th0' width='3%'>OPC</th>
	        <th class='Th0' width='7%'><a href='#' onclick=\"ordenar('nrod_usu')\">Identificacion</a></font></th>
		    <th class='Th0' width='15%'><a href='#' onclick=\"ordenar('pnom_usu')\">Nombre</font></a></th>
			<th class='Th0' width='10%'><a href='#' onclick=\"ordenar('neps_con')\">Contrato</font></a></th>
			<th class='Th0' width='10%'><a href='#' onclick=\"ordenar('fech_qxf')\">Fecha de Interv</font></a></th>";
			while($row = mysql_fetch_array($_pagi_result))
			{
				echo "<tr>";
				echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_3encab.php?iden_qxf=$row[iden_qxf]'\"></label></td>";
				echo "<td class='Td2'>".$row['nrod_usu']."</td>";
				echo "<td class='Td2'>".$row['pnom_usu'].' '.$row['snom_usu'].' '.$row['pape_usu'].' '.$row['sape_usu']."</td>";
				echo "<td class='Td2'>".$row['neps_con']."</td>";
				echo "<td class='Td2'>".cambiafechadmy($row['fech_qxf'])."</td>";
				echo "</tr>";
			}
			echo"</table></center>";
			echo "<table class='Tbl2'>";
			echo "<tr>";
			echo "<td class='Td1'>".$_pagi_navegacion."</td>";
		 }
		 echo"<input name='orden' type='hidden'>";
	  ?>
	</tr>
</form>
</body>
</html>