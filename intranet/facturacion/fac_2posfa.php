<?php
session_start();
session_register('serv_fac');
session_register('esta_fac');
session_register('ord_fac');
if(!empty($serv)){$serv_fac=$serv;}
if(!empty($esta) OR $esta=='0'){$esta_fac=$esta;}
if(empty($ord_fac)){$ord_fac='fecin_ing';}
elseif(!empty($orden)){$ord_fac= $orden;}
?>
<html>
<head>
<title>PROGRAMA DE FACTURACI�N - PROFACTU</title>

<SCRIPT LANGUAGE=JavaScript>
function ordenar(campo){

  form1.orden.value=campo;
  form1.action="fac_2posfa.php";
  form1.target='fr02';
  form1.submit();
}
</script>

<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>

<form name="form1" method="POST" action="fac_2inicio.php" target='fr02'>
<body lang=ES  style='tab-interval:35.4pt'  >
<table class="Tbl0"><tr><td class="Td0" align='center'>INFORMACION DE PACIENTES </td></tr></table><br>
<?include('php/conexion.php');?>
<center><table class="Tbl0" border=1>
	<tr>
	  <?
	  	$condicion='';
	    //$condicion='ih.contra_ing=c.codi_con';
		//echo $serv_fac;
		if(!empty($serv_fac)){$condicion=$condicion."hist_traza.ubica_tra='$serv_fac' AND ";}
		if(!empty($nrod_usu)){$condicion=$condicion."usuario.NROD_USU='$nrod_usu' AND ";}
        if($esta_fac=='0'){$condicion=$condicion."hist_traza.horas_tra<>0 AND ";}		
		else{$condicion=$condicion."hist_traza.horas_tra=-1 AND ";}
		$condicion=SUBSTR($condicion,0,-5);
		/*$_pagi_sql="SELECT ih.id_ing,u.nrod_usu,concat(u.pnom_usu,' ',u.snom_usu,' ',u.pape_usu,' ',u.sape_usu) AS nombre,
		c.neps_con,ih.fecin_ing,ih.hora_ing,ih.fecsa_ing,
		tr.ubica_tra,tr.horas_tra
		FROM ingreso_hospitalario AS ih 
		INNER JOIN hist_traza AS tr ON ih.id_ing=tr.id_ing
		INNER JOIN usuario AS u ON ih.codius_ing=u.codi_usu
		INNER JOIN ucontrato AS uc ON u.codi_usu=uc.cusu_uco
		INNER JOIN contrato AS c ON uc.cont_uco=c.codi_con
		WHERE $condicion ORDER BY $ord_fac";*/
		$_pagi_sql="SELECT ingreso_hospitalario.id_ing, ingreso_hospitalario.fecin_ing, ingreso_hospitalario.hora_ing, ingreso_hospitalario.fecsa_ing, usuario.NROD_USU, CONCAT(usuario.PNOM_USU,' ', usuario.SNOM_USU,' ', usuario.PAPE_USU,' ', usuario.SAPE_USU) AS nombre, contrato.NEPS_CON, hist_traza.ubica_tra, hist_traza.horas_tra
			FROM (contrato INNER JOIN (usuario INNER JOIN ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing) ON contrato.CODI_CON = ingreso_hospitalario.contra_ing) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
			WHERE ".$condicion." ORDER BY $ord_fac";
        //echo $_pagi_sql;
		//$_pagi_cuantos = 15; 
		//include("php/paginator.inc.php"); 
		//if(mysql_num_rows($_pagi_result)!=0) 
		$_pagi_result=mysql_query($_pagi_sql);
		if(mysql_num_rows($_pagi_result)!=0){
			echo "<table class='Tbl0'>";
			echo "<th class='Th0' width='3%'>OPC</th>
                        <th class='Th0' width='7%'><a href='#' onclick=\"ordenar('nrod_usu')\">Identificación</a></font></th>
                        <th class='Th0' width='15%'><a href='#' onclick=\"ordenar('pnom_usu')\">Nombre</font></a></th>
			<th class='Th0' width='10%'><a href='#' onclick=\"ordenar('neps_con')\">Contrato</font></a></th>
			<th class='Th0' width='10%'><a href='#' onclick=\"ordenar('fecin_ing')\">Fecha de Ingreso</font></a></th>";
			while($row = mysql_fetch_array($_pagi_result)){
			    //echo $row[id_ing];
				echo "<tr>";
				echo "<td><label><input name=codichk type=checkbox onclick=\"location.href='fac_2encab.php?id_ing=$row[id_ing]'\"></label></td>";				
				echo "<td class='Td2'>".$row['NROD_USU']."</td>";
				echo "<td class='Td2'>".$row['nombre']."</td>";
				echo "<td class='Td2'>".$row['NEPS_CON']."</td>";
				echo "<td class='Td2'>".SUBSTR($row['fecin_ing'],0,10)." ".$row['hora_ing']."</td></tr>";
				//echo "<td class='Td2'>".$row['DCodHis']."</td>";
			}
			echo"</table></center>";
			echo "<table class='Tbl2'>";
			echo "<tr>";
			echo "<td class='Td1'></td>";
			//echo "<td class='Td1'>".$_pagi_navegacion."</td>";
		}
		echo"<input name=orden type=hidden>";
	  ?>
	</tr>

</form>
</body>
</html>