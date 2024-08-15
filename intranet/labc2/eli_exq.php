<?
session_register('Gidusulab'); 
?>
<html>
<script language="javascript">
function enviar()
{
	if(form1.opc_aux.value==1)
	{
		form1.action='eord_aux.php';
		form1.submit();
	
	}
	else
	{
		form1.action='exp_fac.php';
		form1.submit();
	}
}
</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head> 
<hr align="center"width="100%">
<form name='form1' method="POST"  action="" target="fr2">  
<p align="center" class="Estilo6"><strong>
<?
//COMPROBACION DE ENVIO
	$colfondo="#DFDFDF";
	
	echo"factura:<br>".$iden_lab;
	echo"codigo examen:".$cont;
	
	echo"<table width=806 height=50 border=0 align=center cellpadding=0 cellspacing=1 bordercolor=#D0D0F0 bgcolor=#FFFFFF>";
	//echo" <tr><td width=142><div align=left class=Estilo32><a href=exp_fac.php?cod_usu=$usu&num_fac=$fac&con=$contrato>Atras</a></td></tr>";
	
	echo"<input type=text name=cont value=$cont>";
	echo"<input type=text name=usu value=$usu>";
	echo"<input type=text name=iden_uco value=$iden_uco >";
	echo"<input type=text name=iden_labs value=$iden_labs>";
	echo"<input type=hidden name=iden_dlab value=$iden_dlab>";
	echo"<input type=hidden name=dva value=$dva>";
	echo"<input type=hidden name=opc_aux value=$opc_aux >";
	echo"<input type=hidden name=nord_lab value=$nord_lab>";
	echo"<input type=hidden name=cod value=$cod>";
	
	$fecha=time();
	$fec=date ("Y-m-d",$fecha);
	$hor=date ("H:i",$fecha);
	
	include('php/conexion.php');
	
	if($cont==1)
	{
		$sql="UPDATE detalle_labs  SET estd_dlab='EL',fech_dlab='$fec',hora_dlab='$hor',cod_medi='$Gidusulab' WHERE iden_dlab='$dva'";
		//echo $sql;
        mysql_query($sql);
        $sqlint="DELETE FROM labo_winsislab WHERE COD_EXAMEN='$cod'";
		//echo $sqlint;
        mysql_query($sqlint);
        mysql_close();
	}
	
	if($cont==2)
	{
		$sql="UPDATE coprol SET esta_ord='EL' WHERE iden_cop='$dva' ";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==3)
	{
		$sql="UPDATE esper SET esta_ord='EL' WHERE iden_esp='$dva' ";
		mysql_query($sql);
		mysql_close();
	}
	
	if($cont==4)
	{
		$sql="UPDATE cuadroh SET esta_ord='EL' WHERE iden_che='$dva'";
		mysql_query($sql);
		mysql_close();
	}
	
	if($cont=='5')
	{
		$sql="UPDATE frotis SET esta_ord='EL' WHERE iden_fro='$dva' ";
		mysql_query($sql);
		mysql_close();
	}
	if($cont=='6')
	{
		$sql="UPDATE hcg SET esta_ord='EL' WHERE iden_hcg='$dva'";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==7)
	{
		$sql="UPDATE uroana SET esta_ord='EL' WHERE iden_uro='$dva'";
		//echo $sql;
		mysql_query($sql);
		mysql_close();
	}
	
	if($cont==8)
	{
		$sql="UPDATE labo_lqd SET esta_ord='EL' WHERE iden_lqd='$dva'";
		mysql_query($sql);
		mysql_close();
	}
	
	if($cont==9)
	{
		$sql="UPDATE dat_varios SET esta_ord='EL' WHERE iden_dva='$dva'";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==10)
	{
		$sql="UPDATE labo_bhc SET esta_ord='EL' WHERE iden_bhc='$dva' ";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==11)
	{
		$sql="UPDATE labo_inm SET esta_ord='EL' WHERE iden_inm='$dva' ";
		mysql_query($sql);
		mysql_close();
	}
	
	if($cont==12)
	{
		$sql="UPDATE labo_tri  SET esta_ord='EL' WHERE iden_tri='$dva'";
		mysql_query($sql);
		mysql_close();
	}
	/**/
	if($cont==13)
	{
		$sql="UPDATE labo_oexa SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex=904105";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==14)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL'  WHERE iden_dlab='$iden_labs' AND cod_loex=904107";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==15)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex=904510";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==16)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex=904601";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==17)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex=904503";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==18)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex=906446";
		//echo $sql;
		mysql_query($sql);
		mysql_close();
	}
	if($cont==19)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex=903427";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==20)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex='902219'";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==21)
	{
		$sql="UPDATE labo_sgre  SET esta_esp='EL' WHERE iden_dlab='$iden_labs'";
		mysql_query($sql);
		mysql_close();
	}
	if($cont==22)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex=901305";
		//echo $sql;
		mysql_query($sql);
		mysql_close();
	}
	if($cont==23)
	{
		$sql="UPDATE labo_oex2 SET `est_oex2` = 'EL' WHERE `iden_dlab`='$iden_labs'";
		//echo $sql;
		mysql_query($sql);
		mysql_close();
	}
	
	if($cont==24)
	{
		$sql="UPDATE labo_oex2 SET `est_oex2` = 'EL' WHERE `iden_dlab`='$iden_labs' and cod_exam='901107'";
		//echo $sql;
		mysql_query($sql);
		mysql_close();
	}
	if($cont==26)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex='904903'";
		//echo $sql;
		mysql_query($sql);
		mysql_close();
	}
	if($cont==27)
	{
		$sql="UPDATE labo_oex2 SET `est_oex2` = 'EL' WHERE `iden_dlab`='$iden_labs' and cod_exam='907002'";
		//echo $sql;
		mysql_query($sql);
		mysql_close();
	}
	if($cont==28)
	{
		$sql="UPDATE labo_oexa  SET esta_ord='EL' WHERE iden_dlab='$iden_labs' AND cod_loex='906610'";
		//echo $sql;
		mysql_query($sql);
		mysql_close();
	}
	echo"<body onload='enviar()'>";
	
?>
</form>
<hr align= center width= 100% >
</html>