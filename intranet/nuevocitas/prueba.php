<HTML>
<BODY>


<?	
    // 192.168.4.20/intraweb/intranet/nuevocitas/prueba.php
	set_time_limit(300);
	$usuario   = "root";
	$pass      = "";
	$conexion = mysql_connect("localhost",$usuario,$pass);
	if(!$conexion)
	{
		echo "Error de conexion a la base de datos, Intente mas tarde.";
		exit();
	}
	mysql_select_db("proinsalud",$conexion);
	$bob=mysql_query("SELECT * FROM citas_pendientes WHERE esta_pen='A'");
	$n=0;
	$m=0;
	while($rob=mysql_fetch_array($bob))
	{
		$iden=$rob['iden_pen'];	
		$fecha=$rob['fecha_pen'];	
		$hora=$rob['hora_pen'];	
		$funci=$rob['funcionario_pen'];
		$tipo=$rob['tipo_pen'];
		$bpen=mysql_query("select * from citas_pendientes_deta where iden_pen='$iden' and fecha_pende='$fecha' and hora_pende LIKE '$hora%' and funcionario_pende='$funci'");
		if(mysql_num_rows($bpen)==0)
		{
			/*
			mysql_query("insert into citas_pendientes_deta 
			(iden_pende, iden_pen,fecha_pende,hora_pende, tipo_pende, funcionario_pende) 
			values (NULL, '$iden', '$fecha','$hora','$tipo', '$funci')");
			*/
			$n++;
		}
		else 
		{
			$m++;
		}
	}
	echo 'nuevos '.$n.'existentes '.$m;
?>
		
</BODY>
</HTML>		








	