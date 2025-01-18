<?php
//session_start();
//session_register('ord_fac');
//session_register('serv_fac');
//session_register('esta_fac');
//session_register('fecha_ini');
//session_register('fecha_fin');
//if(!empty($serv)){$serv_fac=$serv;}
//if(!empty($esta)){$esta_fac=$esta;}
//if(!empty($fechaini)){$fecha_ini=$fechaini;}
//if(!empty($fechafin)){$fecha_fin=$fechafin;}

//if(empty($ord_fac)){$ord_fac='qx.fech_qxf';}
//elseif(!empty($orden)){$ord_fac= $orden;}
?>
<html>
<head>
<title>TERAPIA</title>


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
<?php
include('php/conexion.php');
include('php/funciones.php');
?>
<center><table class="Tbl0" border=1>
	<tr>
	  <?php
		$condicion="";
        $condicion2="";
		//if(!empty($fechaini)){$condicion=$condicion."th.fecha_this BETWEEN '2023-04-14 00:00:00' and '2023-04-14 23:59:59'".cambiafecha($fechaini)."' AND ";}
        if(!empty($fechaini)){
            $condicion=$condicion."th.fecha_this BETWEEN '".cambiafecha($fechaini)." 00:00:00' and '".cambiafecha($fechafin)." 23:59:00' AND ";
            $condicion2=$condicion2."tc.fecha_tcon BETWEEN '".cambiafecha($fechaini)." 00:00:00' and '".cambiafecha($fechafin)." 23:59:00' AND ";
        }
		/*if(!empty($fechafin)){$condicion=$condicion."qx.fech_qxf<='".cambiafecha($fechafin)."' AND ";}
		if(!empty($identif)){$condicion=$condicion."us.nrod_usu='".$identif."' AND ";}
		if(!empty($contra)){$condicion=$condicion."con.codi_con='".$contra."' AND ";}*/
        $condicion=substr($condicion,0,strlen($condicion)-5);
        $condicion2=substr($condicion2,0,strlen($condicion2)-5);
		echo "<br>".$condicion;
                
		if ($esta_fac==0){$esta_fac='>=0';}
		else{$esta_fac='=-1';}
        /*
        

        */
        //Aqui se crea una vista uniendo las consultas de primera vez y las consultas de control
        $sql_vista="CREATE OR REPLACE VIEW vista_terapia_fisica_informe AS
        SELECT '' AS iden_tcon,th.iden_this ,DATE(th.fecha_this) AS fecha,th.numero_orden_this, 
            u.NROD_USU ,CONCAT(u.PNOM_USU,' ',u.SNOM_USU ,' ',u.PAPE_USU,' ' ,u.SAPE_USU) AS nombre,
            c.NEPS_CON,
            d.nomb_des AS servicio_remitente,
            c2.nom_cie10,
            m.nom_medi,'PRIMERA VEZ' AS tipo_atencion 
            FROM ter_historia th 
            INNER JOIN contrato c ON c.CODI_CON=th.cont_this
            INNER JOIN usuario u ON u.CODI_USU = th.codi_usu 
            INNER JOIN destipos d ON d.codi_des = th.servrem_this 
            INNER JOIN medicos m ON m.cod_medi = th.codmedi_this
            INNER JOIN cie_10 c2 ON c2.cod_cie10 = th.dxprinc_this 
            WHERE ".$condicion."
            UNION
            SELECT tc.iden_tcon,tc.iden_this ,DATE(tc.fecha_tcon) AS fecha,th.numero_orden_this,
            u.NROD_USU ,CONCAT(u.PNOM_USU,' ',u.SNOM_USU ,' ',u.PAPE_USU,' ' ,u.SAPE_USU) AS nombre,
            c.NEPS_CON,
            d.nomb_des AS servicio_remitente,
            c2.nom_cie10,
            m.nom_medi,'CONTROL' AS tipo_atencion 
            FROM ter_control tc 
            INNER JOIN ter_historia th ON th.iden_this = tc.iden_this 
            INNER JOIN contrato c ON c.CODI_CON=th.cont_this
            INNER JOIN usuario u ON u.CODI_USU = th.codi_usu 
            INNER JOIN destipos d ON d.codi_des = th.servrem_this 
            INNER JOIN medicos m ON m.cod_medi = tc.codmedi_tcon
            INNER JOIN cie_10 c2 ON c2.cod_cie10 = th.dxprinc_this 
            WHERE ".$condicion2;
        echo "<br>".$sql_vista;
        $sql_vista=mysql_query($sql_vista);
        mysql_query($sql_vista);


		/*$_pagi_sql="SELECT qx.iden_qxf,qx.fech_qxf,us.nrod_usu,us.pnom_usu,us.snom_usu,us.pape_usu,us.sape_usu,con.neps_con 
                FROM encabezado_qx AS qx
                INNER JOIN ucontrato AS uco ON uco.iden_uco=qx.iden_uco
                INNER JOIN usuario AS us ON us.codi_usu=uco.cusu_uco
                INNER JOIN contrato AS con ON con.codi_con=uco.cont_uco
                WHERE $condicion
                ORDER BY $ord_fac";

                
		//echo "<br>".$_pagi_sql;
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
		 echo"<input name='orden' type='hidden'>";*/
	  ?>
	</tr>
</form>
</body>
</html>