<?
session_start();
$usucitas=$_SESSION['usucitas'];
?>
<HTML>
<TITLE>TURNOS CITAS</TITLE>
<head>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
	function buscar()
	{
		if(uno.fechaini.value>uno.fechafin.value)
		{
			alert("La fecha de inicio no puede ser mayor a la fecha final");
			uno.fechaini.focus();
			return;
		}
		uno.action='turnos_fun.php';
		uno.target='';
		uno.submit();
	}

</script>	
</head>
<BODY bgcolor=#EFF8FB>
<form name='uno' method='post'>
<?php
	// http://192.168.4.12/intraweb/intranet/nuevocitas/turnos_fun.php
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
	
	$link=Mysql_connect("localhost","root","");
    if(!$link)echo"no hay conexion";
    Mysql_select_db('proinsalud',$link);		
		
	echo"
	<br>
	<table class='tbl5' align=center>
	<tr>
	<th colspan=3 align=center><b>TURNOS PARA CITAS PRESENCIALES</td>
	</tr>
	<tr>
	<th><b>FECHA INICIAL</th>
	<th><b>FECHA FINAL</th>
	<th><b>BUSCAR</th>
	
	</tr>
	<tr>
	<th align=center>";
	?>
	
	<input type="text" name="fechaini" class='caja' size="8" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
	<input type="button" class='caja' id="lanzador1" name="bot1" value="..." <?echo $disp;?>/>
	<!-- script que define y configura el calendario--> 
	<script type="text/javascript">
	Calendar.setup({
	inputField     :    "fini",     // id del campo de texto
	ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto
	button     :    "lanzador1"     // el id del botn que lanzar el calendario
	});
	</script>
	<?php			
	echo"</td>
	
	<th align=center>";
	?>
	
	<input type="text" name="fechafin" class='caja' size="8" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
	<input type="button" class='caja' id="lanzador2" name="bot2" value="..." <?echo $disp;?>/>
	<!-- script que define y configura el calendario--> 
	<script type="text/javascript"> 
	Calendar.setup({ 
	inputField     :    "ffin",     // id del campo de texto 
	ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
	button     :    "lanzador2"     // el id del boton que lanzar el calendario 				
	}); 
	</script> 				
	<?php		
	echo"</td>
	<th align=center><input type=button class=boton value='>>' onclick=buscar()></th>	
	</tr>		
	</table>";
	$numfun=6;
	
	
	if($numfun==5);
	{
		$ciclo=18;
		$fecha_comodin= "2019/07/23";		
	}
	if($numfun==6)
	{
		$ciclo=30;
		$fecha_comodin= "2019/06/10";		
	}
	
	if($fechaini!='' && $fechafin!='')
	{
		
		$numcomodin=strtotime($fecha_comodin);
		
		$dias=dias_pasados($fecha_comodin,$fechaini);		
		
		// 0=domingo 6=sabado;
		$n=0;
		for($i=1;$i<=$dias;$i++)
		{
			$num=$numcomodin+$i*86400;
			$fec=date('Y-m-d',$num);
			$dia=date('w',$num);					
			if($dia>0 && $dia<6)
			{
				$bfec=mysql_query("SELECT * FROM festivos WHERE fecha='$fec'");
				if(mysql_num_rows($bfec)==0)$n=$n+1;
				
				
			}
		}
		
		$numcomodin2=strtotime($fechaini);
		$numdiaini=date('w',$numcomodin2);
		$diasp=dias_pasados($fechaini,$fechafin);		
		
		if($numdiaini==0 || $numdiaini==6)$n=$n+1;
		
		echo"<br>
		<table class='tbl5' align=center>
		<tr>
		<th><b>A&#209;O</b></th>
		<th><b>MES</th>		
		<th><b>DIA</th>
		<th><b>DIA SEMANA</th>
		<th COLSPAN=2><b>MA&#209;ANA</th>
		<th COLSPAN=2><b>TARDE</th>
		</tr>
		";
		
		$m=0;	
		for($i=0;$i<=$diasp;$i++)
		{
			
			$num2=$numcomodin2+$i*86400;
			$fec2=date('Y-m-d',$num2);
			$dia2=date('w',$num2);
			
			$ano=substr($fec2,0,4);
			$mes=substr($fec2,5,2);
			$diac=substr($fec2,8,2);
			if($mes=='01')$nmes="ENERO";
			if($mes=='02')$nmes="FEBRERO";
			if($mes=='03')$nmes="MARZO";
			if($mes=='04')$nmes="ABRIL";
			if($mes=='05')$nmes="MAYO";
			if($mes=='06')$nmes="JUNIO";
			if($mes=='07')$nmes="JULIO";
			if($mes=='08')$nmes="AGOSTO";
			if($mes=='09')$nmes="SEPTIEMBRE";
			if($mes=='10')$nmes="OCTUBRE";
			if($mes=='11')$nmes="NOVIEMBRE";
			if($mes=='12')$nmes="DICIEMBRE";			
			if($dia2==0)$ndia="DOMINGO";
			if($dia2==1)$ndia="LUNES";
			if($dia2==2)$ndia="MARTES";
			if($dia2==3)$ndia="MIERCOLES";
			if($dia2==4)$ndia="JUEVES";
			if($dia2==5)$ndia="VIERNES";
			if($dia2==6)$ndia="SABADO";
			
					
			if($dia2>0 && $dia2<6)
			{
				
				
				$bfec=mysql_query("SELECT * FROM festivos WHERE fecha='$fec2'");
				if(mysql_num_rows($bfec)==0)
				{
					
					$nucon=$n+$m;					
					$nuid=$nucon % $ciclo;
					if($nuid==0)$nuid=$ciclo;
					
					$btur=mysql_query("SELECT * FROM turnos_citas WHERE id='$nuid' and numfunci='$numfun'");
					while($rtur=mysql_fetch_array($btur))
					{
						
						$man1=$rtur['M1'];
						$man2=$rtur['M2'];
						$tar1=$rtur['T1'];
						$tar2=$rtur['T2'];
						if($numfun==5)
						{
							if($man1==3)$man1=6;
							if($man2==3)$man2=6;
							if($tar1==3)$tar1=6;
							if($tar2==3)$tar2=6;
						} 
						
						if($man1==1)$col1='#AD4CA6';
						if($man1==2)$col1='#FF0000';
						if($man1==3)$col1='#22B14C';
						if($man1==4)$col1='#0080FF';
						if($man1==5)$col1='#FFFF00';
						if($man1==6)$col1='#FF8000';
						if($man1==7)$col1='#80FFFF';
						if($man1==8)$col1='#712F04';
						
						if($man2==1)$col2='#C3C3C3';
						if($man2==2)$col2='#FF0000';
						if($man2==3)$col2='#22B14C';
						if($man2==4)$col2='#0080FF';
						if($man2==5)$col2='#FFFF00';
						if($man2==6)$col2='#FF8000';
						if($man2==7)$col2='#80FFFF';
						if($man2==8)$col2='#712F04';
						
						if($tar1==1)$col3='#C3C3C3';
						if($tar1==2)$col3='#FF0000';
						if($tar1==3)$col3='#22B14C';
						if($tar1==4)$col3='#0080FF';
						if($tar1==5)$col3='#FFFF00';
						if($tar1==6)$col3='#FF8000';
						if($tar1==7)$col3='#80FFFF';
						if($tar1==8)$col3='#712F04';
						
						if($tar2==1)$col4='#C3C3C3';
						if($tar2==2)$col4='#FF0000';
						if($tar2==3)$col4='#22B14C';
						if($tar2==4)$col4='#0080FF';
						if($tar2==5)$col4='#FFFF00';
						if($tar2==6)$col4='#FF8000';
						if($tar2==7)$col4='#80FFFF';
						if($tar2==8)$col4='#712F04';
		
						
						
						echo"<tr>
						<th>$ano</th>
						<th>$nmes</th>
						<th>$diac</th>
						<th align=center>$ndia</td>
						<td align=center bgcolor=$col1>$man1</td>
						<td align=center bgcolor=$col2>$man2</td>
						<td align=center bgcolor=$col3>$tar1</td>
						<td align=center bgcolor=$col4>$tar2</td>
						</tr>";
					}
					$m=$m+1;
				}
				else
				{					
					
					echo"<tr>
					<th>$ano</th>
					<th>$nmes</th>
					<th>$diac</th>
					<th align=center>$ndia</td>
					<th align=center colspan=4>FESTIVO</td>
					</tr>";
				}
				
			}
			else
			{				
				echo"<tr>
				<th>$ano</th>
				<th>$nmes</th>
				<th>$diac</th>
				<th align=center>$ndia</td>
				<th align=center colspan=4></td>
				</tr>";
			}
			
		}
		echo"</table>";
	}
	function dias_pasados($fecha_comodin,$fechaini)
	{
		$dias = (strtotime($fecha_comodin)-strtotime($fechaini))/86400;
		//ECHO 'dias '.$dias.' ';
		
		$dias = abs($dias); $dias = floor($dias);
		return $dias;
	}
		
	
?>
</form>
</BODY>
</HTML>