<?
	session_register('paciente');
	session_register('numcita');
	session_register('Gareanh');
	if(empty($paciente))
	{
		echo"<br><br><table align=center class='tbl'>
		<tr><th>POR SEGURIDAD SU SESIÓN SE CERRÓ. EIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
		</table>";
		exit;
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="JavaScript">
	function valida()
	{			
		
		uno.action='almacena.php';
		uno.target='';
		uno.submit();
	
	}	
	function elimina(n)
	{	
		uno.itemeli.value=n;		
		uno.target='';
		uno.action='eliminareg.php';
		uno.submit();	
	}		
	
</script>
</head>	
<body>

<?	
	include ('php/conexion1.php');
	
	
	echo"
	<form name=uno method=post>	
	<input type=hidden name=itemeli>
	<input type=hidden name=codiprg value='juntam'>	
	<br><br><br>
	<center><table align=center>
	<tr><td>
	
	<table align=center class='tbl' width=100%>
	<tr><th>PARTICIPANTES JUNTA MEDICA</th></tr>
	</table>
	<br>

	<table align=center class='tbl' width=100%>	
	<tr>	
	<th align=center height=20>NOMBRE DEL MEDICO</th>
	<th align=center height=20>ESPECIALIDAD</th>
	<th align=center height=20>REGISTRO MEDICO</th>
	<th align=center height=20>ELIMINAR</th>
	</tr>";
	$archivo='tmp/juntam'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivo))
	{			
		echo"</tr>";			
		$fp = fopen ($archivo, "r" );
		$reg=0;
		$cont=0;
		while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
		{ 
			$reg++;
			$i = 0;
			foreach($data as $dato)
			{
				$campo[$i]=$dato;
				$i++ ;
			}
			$$campo[1]=$campo[2];
			if($reg % 3 == 0)
			{					
				echo"<tr>							
				<td align=center>$nommedico<BR></td>
				<td align=center>$espmedico<BR></td>
				<td align=center>$regmedico</td>					
				<td align=center><a href='#' onclick='elimina($cont)'><img src='img/eli.png' border=0></a></td>
				</tr>";
				$cont=$cont+1;
			}
		}
	}
	echo"
	<tr><td colspan=4 height=10></td></tr>
	<tr>		
	<td align=center><input type=text size=40 name=nommedico class='caja' value=''></td>
	<td align=center><input type=text size=40 name=espmedico class='caja' value=''></td>
	<td align=center colspan=2><input type=text name=regmedico class='caja' value=''></td>
	</tr>
	<tr><td colspan=4 height=10></td></tr>
	<tr>
	<th colspan=4 align=center valign=top height=30><a ><INPUT type=button class='boton' value=Guardar registro onClick='valida();'></th>
	</tr>	
	<table>
	</td></tr></table>
	";
	
?>
</body>
</html>