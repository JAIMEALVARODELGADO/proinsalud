<!-- Captura la identificación del usuario a buscar -->
<html>
<head><title>ESTADOS DE LAS ORDENES</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<script language="Javascript">
function busca()
{
	uno.esta_ncf.value=1;
	uno.action='frm_ltw.php';
	uno.target='';
	uno.submit();
}
function imprimir()
{
	uno.esta_ncf.value=1;
    //alert(uno.grup_lab.value);
	uno.action='imp_ltw.php';
	uno.target='FR2';
	//uno.submit();
}
</script>

</head>
<body bgcolor="#E6E8FA">
<!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
<form name="uno" method="POST">

<table class='Tbl0' border='0'>
    <tr><td class='Td1' align='center'><STRONG>LISTADOS DE TRABAJO POR SECCIONES </strong></td></tr>
</table>
<!--<Table width="40%" border="1" align="center" cellpadding=0 Cellspacing=1 BorderColor="#fffff" BgColor="D0D0F0">-->
<br>
<?
	$fecha=time();
	$fecdia=date ("Y-m-d",$fecha);
	if(empty($fin))$fin=$fecdia;
	if(empty($ffin))$ffin=$fecdia;
?>
<table border='1' width="40%" align='center'>
 <tr> 
	
	<td align="right"><B>Fecha Solicitud:</td><td>
		<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
		<?php echo "<input type=text name=ffin id=ffin size='10' value= >";?>
		<input type="button" id="lanzador2" value="..." />
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField   :    "ffin",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
		button       :    "lanzador2"     // el id del botn que lanzar el calendario 
		}); 
		</script> 
	</td>
	<script language=javascript>uno.ffin.value="<?echo $ffin?>";</script>
	
	<?php
	
	include('php/conexion.php');
	
	
	echo"<td><b>Seccion:</td>
	<td  align=center>";
	echo"<select name='grup_lab'>";
	echo "<option value=''> </option>";
	
	$con_des=Mysql_query("SELECT * FROM destipos WHERE codt_des ='46'");
	
	while ($row=mysql_fetch_array($con_des))
	{
		
		echo "<option value=$row[codi_des]>$row[nomb_des]</option>";
			
	}
	echo  "</select></td>";?>
	<script language=javascript>uno.grup_lab.value="<?echo $grup_lab?>";</script><?
	/*<td><input type=submit name='Buscar' value='Buscar' onclick='busca()'></td>
	</tr></table>*/
	echo  "<td colspan=4><input type=submit name='Buscar' value='Buscar' onclick='busca()'></td></td></tr></table>";
	
	if($esta_ncf=='1' )
	{
		$condicion="el.fchr_labs='$ffin' AND dl.estd_dlab<>'CU' AND dl.estd_dlab <> 'EL' ";
			
		if((!empty($grup_lab))) 
		{
			if($grup_lab=='4613')
			{
				$grup_lab2='4602 OR cp.grup_quim=4605 OR cp.grup_quim=4611)';
				$condicion=$condicion.' AND (cp.grup_quim='.$grup_lab2;
			}
			else
			{
				$condicion=$condicion.' AND cp.grup_quim='.$grup_lab;
			}
			if($grup_lab=='4610')
			{
				$condicion="el.fchr_labs='$ffin' AND dl.estd_dlab='RE'";
				//$condicion=$condicion.' AND cp.grup_quim='.$grup_lab;
			}
		}

		echo"<br><table class='Tbl0'border=0 width=80%>
			<tr>         
			<th class='Th0'>ORDEN</th>
			<th class='Th0'>DOCUMENTO</th>
			<th class='Th0'>NOMBRE</th>
			<th class='Th0'>EXAMENES</th>
			</TR>
			<tr>   	 
			<th height=12></th>
			</TR>";
		
		
		//echo $grup_lab;
		$con_cum=mysql_query("SELECT el.iden_labs,dl.estd_dlab,el.fchr_labs,el.fche_labs,el.hrar_labs, 
				us.NROD_USU,us.CODI_USU ,us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU,dl.nord_dlab 
				FROM detalle_labs AS dl
				INNER JOIN encabezado_labs as el ON el.iden_labs=dl.iden_labs
				INNER JOIN usuario AS us ON us.codi_usu=el.codi_usu 
				INNER JOIN cups AS cp ON dl.codigo=cp.codigo
				WHERE $condicion 
				GROUP BY dl.nord_dlab
				order by dl.nord_dlab");
		
		//Echo $con_cum;
		
		if(mysql_num_rows($con_cum)<>0)
		{
			while ($rowx=mysql_fetch_array($con_cum))
			{
				
				$nombre= "$rowx[PNOM_USU] $rowx[PAPE_USU]";
				//$fech=$rowx[fchr_labs].'/'.$rowx[hrar_labs];
				$NROD_USU=$rowx[NROD_USU];
				$codusu=$rowx[codi_usu];
				$iden_labs=$rowx[iden_labs];
				$nord_dlab=$rowx[nord_dlab];
			
				echo "<tr><td class='Td0' width='2%'><strong>$nord_dlab</td>
					  <td class='Td0' width='5%'><strong>$NROD_USU</td>
					  <td class='Td0' width='10%'><strong>$nombre</td>";
				
				if(!empty($grup_lab))
				{
					
					if($grup_lab=='4610')
					{
						$condicion2="detalle_labs.estd_dlab='RE'";
					}
					else
					{	
						$condicion2="cp.grup_quim='$grup_lab' AND detalle_labs.estd_dlab='P'";
						//$condicion2=$condicion2.'cp.grup_quim='.$grup_lab.' AND detalle_labs.estd_dlab="P"';
					}
				
				}
                                
				$conex=mysql_query("SELECT detalle_labs.iden_labs,detalle_labs.iden_dlab ,detalle_labs.codigo, cp.descrip
						FROM detalle_labs AS detalle_labs
						INNER JOIN cups AS cp ON detalle_labs.codigo = cp.codigo
						WHERE detalle_labs.nord_dlab='$nord_dlab' AND $condicion2");	
				//echo $conex;
				//echo " g".$grup_lab;
				
				
				while ($roword=mysql_fetch_array($conex))
				{
					$exam_=substr($roword[descrip],0,50);
					echo"<td class='Td0' width='20%'>$exam_<br>
						  </a></td>";	
			
				}
			
			}
		}
		
		echo  "</tr><tr><td colspan=4><input type=submit name='Imprimir' value='IMPRIMIR' onclick='imprimir()'></td></td>";
	
	
	}
	
	
	echo "</tr></table>";
	 echo "<input type=hidden name=esta_ncf>";
	?>

</form>
</body>
</html>