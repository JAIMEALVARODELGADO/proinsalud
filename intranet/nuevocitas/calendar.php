
<HTML>
<HEAD>
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

</HEAD>
<BODY background='imagenes/fondo3.jpg' oncontextmenu="return false;">

<?
	
	
		echo"<table class='tbl' align=center>
		<tr>
		<td>FECHA INICIO/FINAL</td>	
		<td>";
		?>
			<input type="text" name="fecha" size="10" maxlength="10" value="<?echo $fecha;?>" id="fec" <?echo $disp;?>>
			<input type="button" id="lanzador1" value="..." <?echo $disp;?>/>
			<!-- script que define y configura el calendario--> 
			<script type="text/javascript"> 
			Calendar.setup({ 
			inputField     :    "fec",     // id del campo de texto 
			ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
			button     :    "lanzador1"     // el id del botón que lanzará el calendario 				
			}); 
			</script> 	
				
			
		<?
		
?>
</BODY>
</HTML>
