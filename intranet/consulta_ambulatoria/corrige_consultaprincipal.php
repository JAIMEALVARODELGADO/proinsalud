<?
	include ('php/conexion1.php');
	$bncup=mysql_query("select * from encabesadoformula where feco_efo>='2023-10-01' AND coen_efo LIKE ' Meses%'");
	//192.168.4.20/intraweb/intranet/consulta_ambulatoria/corrige_consultaprincipal.php
	
	while($rncup=mysql_fetch_array($bncup))
	{
		$nufo_efo=$rncup['nufo_efo'];		
		$coen_efo=$rncup['coen_efo'];
		$obfo_efo=$rncup['obfo_efo'];
		$feco_efo=$rncup['feco_efo'];
		$largo=strlen($coen_efo);
		
		
			
			
			
			echo $feco_efo.' '.$nufo_efo.' --- '.$coen_efo.' --- '.$largo.'<br>';
			$upd=mysql_query("update encabesadoformula set coen_efo='' WHERE nufo_efo='$nufo_efo'");
		
	}	
	
?>
