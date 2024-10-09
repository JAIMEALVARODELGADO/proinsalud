<?session_register('Gidusulab'); ?>
<html>
<head>
<script language='JavaScript'>
	
function enviar()
{
		form1.target='';
		form1.action='edit_examen.php';
		form1.submit();	

}
</script>
</head>

<?
	include('php/conexion.php');
	
	echo"<form name=form1 method=POST>";
	$fecha=time();
	$fec=date ("Y/m/d",$fecha);
	$hor=date ("H:i",$fecha);
	
	echo"<input type=hidden name=iden_uco value=$iden_uco>";
	echo"<input type=hidden name=iden_labs value=$iden_labs>";
	echo"<input type=hidden name=nord_lab value=$nord_lab>";
	
	echo "<input type=text name=codig_usu value=$codig_usu>";
	echo"<input type=text name=nord_lab value=$nord_lab>";
	echo"<input type=text name=idein value=$idein>";

	$var0="res_annar";
	$var1="id_wlab";
	//for($i=0;$i<$anar;$i++)
	//{
		$var="res_annar".$anar;
		$resu=$$var;
		$var="id_wlab".$anar;
		$ideanar=$$var;
		echo '<br>'.$resu.''.$ideanar;
	
		if($resu<>' ')
		{	
			$actuan="UPDATE `labo_inter_winsislab` SET `RESULTADO` = '$resu' WHERE `labo_inter_winsislab`.`id_inter_winsislab` ='$ideanar'";
			mysql_query($actuan);
			//echo $actuan;
			$eval="INSERT INTO `vitac_orden` (iden_labs,nord_lab ,cup_vord, fech_vord, hora_vord, codu_vord, eord_vord, dato_vord, resp_vord) 
			VALUES ('$iden_labs','$nord_lab','$ideanar', '$fec', '$hor', '$codig_usu', 'CR', 'Correjido a la BD - Annar', '$Gidusulab')";	
			mysql_query($eval);
		}
		
			echo "<body onload='enviar()'>";
		
	//}
	
	//echo ($actuann);
	
	
	//echo $ideanar.''.$result;
	echo "<body onload='enviar()'>";
	?>
</body>
</html>