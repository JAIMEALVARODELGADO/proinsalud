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
		if(uno.numlab.value>0 && uno.areal.value!='04')
		{
			/*
			opcionp = document.getElementsByName("tiproxi");
			var anup=0;
			for(var i=0; i<2; i++)
			{			
				if(opcionp[0].checked)
				{				
					var anup=1;
				}
				if(opcionp[1].checked)
				{				 
					var anup=2;
				}			
			}
			if(anup ==0)
			{
				alert("Seleccione el tiempo para la proxima consulta");
				return;
			}
			if(anup==2)
			{
				if(uno.proxima.value<10)
				{				
					alert("El numero de dias debe ser igual o mayor que 10");
					return;
				}
				
			}
			*/
		}
		else
		{
			if(uno.areal.value!='04')
			{
				if(uno.recom.value=='')
				{
					alert("No hay informacion registrada");				
					return;
				}
			}
		}
		uno.action='almacena.php';
		uno.target='';
		uno.submit();
	
	}
	
	function habidias()
	{
		opcionp = document.getElementsByName("tiproxi");
		var anup=0;
		for(var i=0; i<2; i++)
		{			
			if(opcionp[0].checked)
			{				
				uno.proxima.disabled=true;
			}
			if(opcionp[1].checked)
			{				 
				uno.proxima.disabled=false;
			}			
		}
	}
	function validanum()
	{
		opcionp = document.getElementsByName("tiproxi");
		var anup=0;
		for(var i=0; i<2; i++)
		{			
			if(opcionp[1].checked && uno.proxima.value<10)
			{				 
				alert("Digite una cantidad igual o mayor a 10");
				uno.proxima.value='';				
				return;
			}			
		}
	}
</script>
</head>	
<body>

<?	
	include ('php/conexion1.php');
	$archivo2='tmp/5HC'.$numcita.'-'.$paciente.'.txt';	
	$nlab=0;
	if(file_exists($archivo2))
	{
		$fp = fopen ($archivo2, "r" );
		$reg1=0;
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
			if($reg % 8 == 0)
			{
				$ini=substr($codorden,0,2);
				if($ini=='90')$nlab=1;; 
			}				
		}
	}
	$archivo='tmp/8HC'.$numcita.'-'.$paciente.'.txt';	
	if(file_exists($archivo))
	{
		$fp = fopen ($archivo, "r" );
		$reg=0;
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
		}
	}
	$ch1='';$ch1='';
	if($tiproxi=='0')$ch1='checked';
	if($tiproxi=='1')$ch2='checked';
	echo"
	<form name=uno method=post>	
	<input type=hidden name=areal value='$Gareanh'>	
	<input type=hidden name=numlab value=$nlab>
	<input type=hidden name=codiprg value='8'>	
	<center><table align=center width=80%>
	<tr><td>
	
	<table align=center class='tbl' width=100%>
	<tr><th>RECOMENDACIONES GENERALES</th></tr>
	</table>
	<br><br>

	<table align=center class='tbl' width=100%>	";
		
		$recom=str_replace( "Æ",chr(10),$recom);
		
		/*
		echo"
		<tr>
		<th align=center height=20>PROXIMA CONSULTA</th>
		<td valign=top height=20 align=center>
		<input type=radio name=tiproxi $ch1 onclick='habidias()' value='0'> MENOR A 10 DIAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type=radio name=tiproxi $ch2 onclick='habidias()' value='1'> IGUAL O MAYOR A 10 DIAS
		</td>
		<td height=20 width=40%>NUMERO DE DIAS: &nbsp;&nbsp;&nbsp;&nbsp; <INPUT type=number disabled onPaste='return false' min=10 onblur='validanum()' max=365 class='caja' size=50 name='proxima' value='$proxima'></td>
		</tr>";
		*/
		
		echo"
		
		<tr><th align=center height=20>RECOMENDACIONES</th>
		<td height=20 colspan=2><textarea name=recom cols=120 rows=6 class='caja'>$recom</textarea></td></tr>
	
	<table>
	<br>
	<table align=center class='tbl' width=100%>
	<tr><th colspan=2 align=center valign=top height=30><a ><INPUT type=button class='boton' value=Guardar registro onClick='valida();'></th></tr>	
	<table>
	</td></tr></table>
	";
	
?>
</body>
</html>