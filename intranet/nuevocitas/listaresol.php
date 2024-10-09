<?
session_start();
    $usucitas=$_SESSION['usucitas'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
//echo $opcimenu;
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
  <script type="text/javascript" src="java/calendar/calendar.js"></script> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script>
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

    

<script language="javascript">
	function salir()
	{	
		if(uno.fechaini.value=='')
		{
			alert("Seleccione la fecha inicial");
			uno.fechaini.focus();
			return;
		}
		if(uno.fechafin.value=='')
		{
			alert("Seleccione la fecha final");
			uno.fechafin.focus();	
			return;
		}
		if(uno.area.value=='')
		{
			alert("Seleccione el fecha");
			uno.area.focus();
			return;
		}
		
		uno.action='listaresol1.php';
		uno.target='';
		uno.submit();			
	}
	function buscar()
	{ 	
		uno.action='listaresol.php';
		uno.target='';
		uno.submit();			
	}
	function cambio()
	{ 	
		f=uno.fin.value;
		
		if(uno.selecto.checked==true)
		{
			for(i=0;i<f;i++)
			{	
				val="uno.selec"+i+".checked=true";
				eval(val);		
			}		
		}
		else
		{
			for(i=0;i<f;i++)
			{
				val="uno.selec"+i+".checked=false";
				eval(val);
			}		
		}			
	}
	function habil(n)
	{ 			
		val="uno.selec"+n+".checked"		
		if(eval(val)==false)
		{			
			val=uno.selecto.checked=false;
			eval(val);						
		}	
		else
		{
			f=uno.fin.value;
			m=0;			
			for(i=0;i<f;i++)
			{	
				val="uno.selec"+i+".checked";
				if(eval(val)==false)m=1;		
			}		
			if(m==0)
			{			
				val=uno.selecto.checked=true;					
			}
		}
	}
	function ver()
	{
		alert("SI");
	
	}
	
	
	
        
	
</script>
</head>
<body>

<?	
    //onload="setScrollPos('conte')"
	echo $opcimenu;
	ECHO $destino;
	/*
    if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	*/
    $dateh=date("Y-m-d");	
    
    if(empty($fechafin))$fechafin=date("Y-m-d");
	if(empty($fechaini))$fechaini=date("Y-m-d",strtotime($fechafin."- 30 days"));
   
   
    include ('php/conexion1.php');
    echo"<form name=uno method=post>
   
    
    <br><br>
    <table align=center width='350'>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2 height=40>$titulo</th></tr>
    <tr><th colspan=2 height=30>";
    
	echo"       
	<tr>
	<th height=30>FECHA</th>
	<td align=center>";
	?>
	<input type="text" name="fechaini" class='caja' size="10" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
	<input type="button" class='caja' id="lanzador1" value="..." <?echo $disp;?>/>
	<!-- script que define y configura el calendario--> 
	<script type="text/javascript"> 
	Calendar.setup({ 
	inputField     :    "fini",     // id del campo de texto 
	ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
	button     :    "lanzador1"     // el id del botón que lanzará el calendario 				
	}); 
	</script> 					
	<?			

	?>
	<input type="text" name="fechafin" class='caja' size="10" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
	<input type="button" class='caja' id="lanzador2" value="..." <?echo $disp;?>/>
	<!-- script que define y configura el calendario--> 
	<script type="text/javascript"> 
	Calendar.setup({ 
	inputField     :    "ffin",     // id del campo de texto 
	ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
	button     :    "lanzador2"     // el id del botón que lanzará el calendario 				
	}); 
	</script> 			
	<?	
	echo"
	<INPUT type=button class='boton' value='continuar' onClick='buscar();'> 
	</td></tr>
	";
	
	
	$bcon=mysql_query("SELECT contrato.CODI_CON, contrato.NEPS_CON
	FROM (horarios INNER JOIN citas ON horarios.ID_horario = citas.ID_horario) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON
	WHERE (((horarios.Fecha_horario)>='$fechaini' And (horarios.Fecha_horario)<='$fechafin'))
	GROUP BY contrato.CODI_CON, contrato.NEPS_CON
	ORDER BY contrato.NEPS_CON");
	$numcon=mysql_fetch_array($bcon);
	echo"
	<tr>
	<th>Contrato</td>
	<td align=center>
	<select class='caja' name=contra onchange='buscar()'>";
	if($numcon>0)
	{
		if($contra=='1')echo"<option selected value='1'>TODOS</option>";
		else echo"<option value='1'>TODOS</option>";
	}
	while($rcon=mysql_fetch_array($bcon))
	{
		$codc=$rcon['CODI_CON'];
		$nomc=$rcon['NEPS_CON'];
		if($contra==$codc)echo"<option selected value='$codc'>$nomc</option>";
		else echo"<option value='$codc'>$nomc</option>";
	}	
	echo"
	</select>
	</td></tr>";
	
	
	
	
	
	
	
	$bgup=mysql_query("SELECT destipos.codi_des, destipos.nomb_des
	FROM areas INNER JOIN destipos ON areas.grup_area = destipos.codi_des
	WHERE (((destipos.codt_des)='78'))
	GROUP BY destipos.codi_des, destipos.nomb_des");
	echo"
	<tr>
	<th>area</td>
	<td align=center>
	<select class='caja' name=area onchange='buscar()'>";
	while($rgup=mysql_fetch_array($bgup))
	{
		$cod=$rgup['codi_des'];
		$nom=$rgup['nomb_des'];
		if($area==$cod)echo"<option selected value='$cod'>$nom</option>";
		else echo"<option value='$cod'>$nom</option>";
	}
	if($area=='1')echo"<option selected value='1'>TODAS</option>";
	else echo"<option value='1'>TODAS</option>";
	echo"
	</select>
	</td></tr>
	</tr>
	</table>
	</table><br><br>";
	if(!empty($area))
	{
		$cad='';
		if($area!='1')$cad= "and areas.grup_area='$area'";		
		$busar=mysql_query("SELECT areas.cod_areas, areas.nom_areas
		FROM (citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN (areas INNER JOIN destipos ON areas.grup_area = destipos.codi_des) ON horarios.Cserv_horario = areas.cod_areas
		WHERE horarios.Fecha_horario>='$fechaini' And horarios.Fecha_horario<='$fechafin' $cad
		GROUP BY areas.cod_areas, areas.nom_areas
		ORDER BY areas.nom_areas");
		
		
		
		echo"<table align=center class='tbl'>
		<tr>
		<th align=center valign=top height=20>
		SELECCIONAR TODO <INPUT type=checkbox checked class='caja' name=selecto onClick='cambio();'>
		</th>
		</tr>";
		echo"<table align=center class='tbl'>";
		$n=0;
		while($rar=mysql_fetch_array($busar))
		{
			$codar=$rar['cod_areas'];
			$nomar=$rar['nom_areas'];
			//echo $codar.' '.$nomar.'<br>';	
			if($n%5==0)
			{
				echo"</tr>";			
			}
			$nomvar='codarea'.$n;
			echo"<input type=hidden name=$nomvar value='$codar'>";
			$nomvar='nomarea'.$n;
			echo"<input type=hidden name=$nomvar value='$nomar'>";
			$nomvar='selec'.$n;
			echo"<td><input type=checkbox checked name='$nomvar' value=1 onclick='habil($n)'> $nomar</td>";
			$n++;
		}
		echo"<input type=hidden name=fin value=$n>";		
	}
	echo"
	</table>
	<br>
	<table align=center class='tbl'>
	<tr>
	<th colspan=2 align=center valign=top height=20>
	<INPUT type=button class='boton' value='ACEPTAR' onClick='salir();'>
	</th>
	
	</form>";
	
	
	
	
	
?>
</body>
</html>