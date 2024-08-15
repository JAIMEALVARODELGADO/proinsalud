<?php
session_register('Gideusu');
?>
<html>
<head>
<title>Ordenes</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>

<body  background="img/cuerpo2.jpg" style="overflow-x:hidden; overflow-y:auto;">
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px;  }
.tm {font-family: Arial, Helvetica, sans-serif; font-size: 10px;  color:#FF6600;}
-->
</style>

<script LANGUAGE =javascript>
function imprimir(id_at9){
  var URL="../uci/anexo9_impresion.php?iden_rat="+id_at9;
  var titulo="Anexo Tecnico 9" 
  var x=0 
  var y=0 
  var ancho=900
  var alto=700
  var herramientas=0
  var direccion=0
  var barras=1
  ventana= window.open(URL,titulo,"left="+x+",top="+y+",width="+ancho+",height="+alto+",toolbar="+herramientas+",location="+direccion+",scrollbars="+barras) 
} 

</script>
<?php
echo "<form name=form1 METHOD=POST ACTION='ord_med.php'>";
include ('../Libreria/Php/conexiones_g.php');
include ('../Libreria/Php/sql.php');
include ('php/funciones.php'); 
base_proinsalud(); 
$pagi3=("SELECT CODI_USU, NROD_USU,PNOM_USU,SNOM_USU,PAPE_USU,SAPE_USU,FNAC_USU,SEXO_USU,DIRE_USU ,TRES_USU,MRES_USU,TPAF_USU CONT_UCO,NEPS_CON,IDEN_UCO,MRES_USU 
	FROM usuario
	INNER JOIN ucontrato ON ucontrato.CUSU_UCO=usuario.CODI_USU
	INNER JOIN contrato ON contrato.CODI_CON=ucontrato.CONT_UCO
	WHERE NROD_USU='$cedula'"); 
//echo $pagi3;
$pagi4=mysql_query($pagi3);
$rowY = mysql_fetch_array($pagi4);
$codi_usu=$rowY["CODI_USU"];
$nom_usu=$rowY["PNOM_USU"]." ". $rowY["SNOM_USU"]." ".$rowY["PAPE_USU"]." " .$rowY["SAPE_USU"];
$usu=$rowY["NROD_USU"];
$contrato=$rowY["NEPS_CON"];
$unidad='';
$edad=calculaedad2($rowY[FNAC_USU],$unidad);

echo "<Table width='90%' border='0' align='center' cellpadding='0' Cellspacing='1'>
	<tr bgcolor='#E6E8FA' align='center'>
	<th class='Estilo7' width='10%'><font color=#00137F>$usu</font></th>
	<th class='Estilo6' width='10%'><font color=#00137F>$nom_usu</th>
	<th class='Estilo7' width='10%'><font color=#00137F>$edad $unidad</font></th>
	<th class='Estilo6' width='10%'><font color=#00137F>$contrato</font></th>
	</tr></table>";

echo "<br><br><Table width='90%' border='0' align='center' cellpadding='0' Cellspacing='1' borderColor='#ffffff'>";
echo "<tr bgcolor='#E6E8FA' align='center'>
	<th class='Estilo7'><font color=#00137F>Opcion</font></th>
	<th class='Estilo6'><font color=#00137F>Evolución</th>
	<th class='Estilo7'><font color=#00137F>Nro AT 9</font></th>
	<th class='Estilo6'><font color=#00137F>Fecha AT9</font></th>
	<th class='Estilo6'><font color=#00137F>Profesional</font></th>
	</tr>";
	$consat="select refer_at910.iden_rat,refer_at910.fecha_rat,hist_evo.iden_evo,ingreso_hospitalario.id_ing,medicos.nom_medi 
		from refer_at910
		inner join (hist_evo
		inner join ingreso_hospitalario on ingreso_hospitalario.id_ing =hist_evo.id_ing 
		inner join medicos on medicos.cod_medi = hist_evo.cod_medi 
		) on hist_evo.iden_evo =refer_at910.idenorig_rat
		where refer_at910.servorig_rat ='HO' and ingreso_hospitalario.id_ing ='$id_ing'";
	
	//echo $consat;
	$consat=mysql_query($consat);
	$i=0;
	while($rowat=mysql_fetch_array($consat)){
		echo"<tr bgcolor='#E6E8FA' align='center'>";
		echo "<td class='Td2'>
		<a href='#' onclick='imprimir($rowat[iden_rat])'><img hspace=0 width=20 height=20 src='img/feed_magnify.png' alt='Visualizar AT9' title='Visualizar AT9' border=0></a>
		</td>";
		echo "<td align='left'><span class='tm'>$rowat[iden_evo]";
		echo "<td align='left'><span class='tm'>$rowat[iden_rat]";
		echo "<td align='left'><span class='tm'>$rowat[fecha_rat]";
		echo "<td align='left'><span class='tm'>$rowat[nom_medi]";
		echo "</tr>";
	}		
echo "</table>";
 ?>
</form >
</body>
</html>