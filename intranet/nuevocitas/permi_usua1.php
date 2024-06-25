<?
session_start();
    $usucitas=$_SESSION['usucitas'];

?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function salir()
	{		
		uno.action='permi_usua0.php';
		uno.target='';
		uno.submit();			
	}
		
</script>
</head>
<body onload='salir()'>

<?	
	
	set_time_limit(300);
	foreach($_POST as $nombre_campo => $valor)
	{ 
	   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	   eval($asignacion); 
	} 	
    if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	include ('php/conexion1.php');
	if($opcion=='1')
	{
		
		for($n=0;$n<$finn;$n++)
		{
			
			$nomvar='codar'.$n;
			$codarea=$$nomvar;				
			$nomvar='nomar'.$n;
			$nomar=$$nomvar;		
			$nomvar='tipoper'.$n;
			$tipoper=$$nomvar;
			$nomvar='finm'.$n;
			$finm=$$nomvar;			
			if($tipoper=='T')$estado='A';
			if($tipoper=='P')$estado='A';
			if($tipoper=='N')$estado='I';			
			
			$bcontra=mysql_query("SELECT * FROM permisos_citas WHERE serv_per='$codarea' and usua_per='$emple' and area_per='$areatra'");
			if(mysql_num_rows($bcontra)==0)
			{
				//echo ' - '.$finn.' - ';
				$insper=mysql_query("INSERT INTO `permisos_citas` ( `iden_per` , `usua_per` , `serv_per` , `tipo_per` , `esta_per` , `area_per`  ) 
				VALUES (0 , '$emple', '$codarea', '$tipoper', '$estado', '$areatra')");				
			}
			else
			{
				$rco=mysql_fetch_array($bcontra);
				$idenper=$rco['iden_per'];
				$inse=mysql_query("UPDATE permisos_citas SET tipo_per='$tipoper', esta_per='$estado' WHERE iden_per='$idenper'");	
				
			}
			
			
			
		}
	}
	if($opcion=='2')
	{		
		$bser=mysql_query("SELECT * FROM permisos_citas WHERE usua_per='$emple' and area_per='$areatra' and serv_per='$areasel'");	
		if(mysql_num_rows($bser)==0)
		{
			$insper=mysql_query("INSERT INTO `permisos_citas` ( `iden_per` , `usua_per` , `serv_per` , `tipo_per` , `esta_per` , `area_per`  ) 
			VALUES (0 , '$emple', '$areasel', 'P', 'A', '$areatra')");		
			$idenper=Mysql_insert_id();
		}
		else
		{			
			$rser=mysql_fetch_array($bser);
			$idenper=$rser['iden_per'];
			$inse=mysql_query("UPDATE permisos_citas SET tipo_per='P', esta_per='A' WHERE iden_per='$idenper'");
		}
		
		for($n=0;$n<$fincon;$n++)
		{			
			$nomvar='cidicon'.$n;
			$cidicon=$$nomvar;
			$nomvar='estacon'.$n;
			$estacon=$$nomvar;
			$nomvar='codcon'.$n;
			$codcon=$$nomvar;
			$bccon=mysql_query("SELECT permisos_citascon.iden_pco
			FROM permisos_citascon
			WHERE (((permisos_citascon.iden_per)='$idenper') AND ((permisos_citascon.usua_pco)='$emple') AND ((permisos_citascon.serv_pco)='$areasel') AND ((permisos_citascon.area_pco)='$areatra') AND ((permisos_citascon.cont_pco)='$codcon'))");
			if(mysql_num_rows($bccon)==0)
			{
				mysql_query("INSERT INTO `permisos_citascon` ( `iden_pco` , `iden_per` , `usua_pco` , `serv_pco` , `area_pco` , `cont_pco` , `esta_pco` , `cidi_pco`  ) 
				VALUES (0 ,'$idenper', '$emple', '$areasel', '$areatra', '$codcon', '$estacon', '$cidicon')");
			}
			else
			{
				$rccon=mysql_fetch_array($bccon);
				$idenpco=$rccon['iden_pco'];
				$inse=mysql_query("UPDATE permisos_citascon SET esta_pco='$estacon', cidi_pco='$cidicon' WHERE iden_pco='$idenpco'");
			}
			
		}
		
	}
	
	echo"<form name=uno method=post>
	<input type=hidden name=emple value='$emple'>
    <input type=hidden name=nomemple value='$nomemple'>      
	<input type=hidden name=areatra value='$areatra'> 
	</form>";
	
?>
</body>
</html>