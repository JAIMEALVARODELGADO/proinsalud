<?php
session_register('Gideusu');
?>
<html>
<head>
<title>Ordenes</title>

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

function abrir2(fecha,ingre,evo) 
{
	form1.ide_ing.value=ingre;
	form1.iden_evo.value=evo;
	//alert(ing);
	form1.submit();
}

function cargar(ing,evol)
{
	//form1.action="../uci/ord_med.php";
	//http://192.168.4.12/intraweb/intranet/uci/impr_ord.php
	form1.target='';
	form1.ide_ing.value=ing;
	form1.id_ing.value=ing;
	form1.iden_evo.value=evol;
	form1.submit();
	form1.action="../uci/impr_ord.php";
	form1.target='top';
	form1.submit();

}

</script>

</script>
<?
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

//echo "hide".$HIdeIng;
//echo "ide".$ide_ing;
if(empty($HIdeIng))
	{$HIdeIng=$ide_ing;}


echo "<form name=form1 METHOD=POST ACTION='ord_med.php'>";



//include ('php/conexiones_g.php');
//include ('php/sql.php');
include ('../Libreria/Php/conexiones_g.php');
include ('../Libreria/Php/sql.php');
include ('php/funciones.php'); 
base_proinsalud(); 



//echo 'ff'.$HIdeIng;
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

echo "<Table width='90%' border='0' align='center' cellpadding='0' Cellspacing='1' borderColor='#ffffff'>";

	$consciru="SELECT hist_var.fech_var, ingreso_hospitalario.id_ing, hist_evo.hora_evo, Max(hist_evo.iden_evo) AS mdievo
	FROM (hist_evo 
	INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) 
	INNER JOIN ingreso_hospitalario ON hist_evo.id_ing = ingreso_hospitalario.id_ing
	WHERE ingreso_hospitalario.id_ing='$id_ing'
	GROUP BY hist_var.fech_var, ingreso_hospitalario.id_ing, hist_evo.hora_evo";
	
	//echo $consciru;
	$consciru=mysql_query($consciru);
	$i=0;
	while($rowciru=mysql_fetch_array($consciru)){
	  $iden_evo=$rowciru[mdievo];
	  $fecha_vari=$rowciru[fech_var];
	  $hora_vari=$rowciru[hora_evo];
	  echo"<tr bgcolor='#E6E8FA' align='center'>";
	  $nomvar2='codchk2'.$i;
	  $valor2=$$nomvar2;
	  $HIdeIng=$rowciru[id_ing];
	  //echo "vl2".$valor2;
	  echo "<input type=hidden name=cod_usu value='$usu'>";
	  	if($valor2==1)
		{
			$nomvar2='codchk2'.$i;
			echo "<td class='Td2'><input type=checkbox name='$nomvar2' value=1 checked onclick='abrir2(\"$fecha_vari\",\"$HIdeIng\",\"$iden_evo\")'></td>";
	  	}
	  	else
		{
			$nomvar2='codchk2'.$i;
			echo "<td class='Td2'><input type=checkbox  name='$nomvar2' value=1 onclick='abrir2(\"$fecha_vari\",\"$HIdeIng\",\"$iden_evo\")'></td>";
	  	}
		echo "<td align='left' colspan=2><span class='tm'><a href='#' onclick='cargar(\"$HIdeIng\",\"$iden_evo\")'>$iden_evo -$fecha_vari - $hora_vari</a>";
		echo "<input type=hidden name=usu>";
		echo "</tr>";

		$i++;
						
		echo "</tr>";			 

		if($valor2==1)
		{ 
			$consdes=mysql_query("SELECT ih.id_ing, he.iden_evo,hv.iden_ser,cp.descrip, hv.fech_var, hv.hora_var
					FROM ingreso_hospitalario AS ih
					INNER JOIN hist_evo AS he ON he.id_ing = ih.id_ing
					INNER JOIN hist_var AS hv ON hv.iden_evo=he.iden_evo
					INNER JOIN cups AS cp ON cp.codigo=hv.iden_ser
					WHERE (((he.iden_evo) ='$iden_evo') AND ((cp.artic_cup) = '21' OR (cp.artic_cup) = '19') AND hv.fech_var='$fecha_vari')");
							
							 
							//echo $consdes;
							$m=1;
							while($rowdes=mysql_fetch_array($consdes))
							{
							  $desc=$rowdes['descrip'];
							  echo "<td align=left></td>";
							  echo "<td></td>";
							  echo "<td class='tm'>$m. $desc<br></td>";
							  echo "<td ></td>";
							  echo "<td ></td>";
							  echo "</tr>";
							  $m++;
							}
							
		}
		
	}						
echo "</table>";

 echo "<input type=hidden name=i>";
 echo "<input type=hidden name=item2>";
 echo "<input type=hidden name=num_fac>";

 //echo "<input type=hidden name=cod_usu>";


 ?> 
  <input type=hidden name=cedula value='<?php echo $cedula;?>'>
  <input type=hidden name=id_ing>
  <input type=hidden name=ide_ing>
  <input type=hidden name=iden_evo>
  
</form >
</body>
</html>