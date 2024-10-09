<?
	include ('php/conexion1.php');
	$bncup=mysql_query("select * from cups_historia");
	
	while($rncup=mysql_fetch_array($bncup))
	{
		
		$codinuevo=$rncup['codi_cuh'];
		$gruponuevo=$rncup['grup_cuh'];
		$nivelnuevo=$rncup['nive_cuh'];
		$descrip=$rncup['desc_cuh'];
		$primer=substr($codinuevo,0,1);
		$resto=substr($codinuevo,1,5);
		if($primer=='0')$codi=$resto;
		else $codi=$codinuevo;
		
		echo $codi.' ';
		$bvc=mysql_query("select * from cups where codigo='$codi'");
		if(mysql_num_rows($bvc)>0)
		{
			$cambio=mysql_query("UPDATE cups SET grup_cup ='$gruponuevo',
			nive_cup='$nivelnuevo' WHERE codigo='$codi'");
		}
		else
		{
			if($nivelnuevo==4)$pos='N';
			else $pos='S';
			$entra=mysql_query("INSERT INTO`proinsalud`.`cups` ( `iden_tar` , `codigo` , `descrip` , `pos_con` , `valor` , `tipo` , `prep_cup` , `artic_cup` , `refe_cup` , `unlab_med` , `grup_quim` , `grup_cup` , `nive_cup` )
			VALUES ( '4','$codi','$descrip','$pos','',NULL ,NULL ,'','','','','$gruponuevo','$nivelnuevo')");
		}	
	}	
	
?>
