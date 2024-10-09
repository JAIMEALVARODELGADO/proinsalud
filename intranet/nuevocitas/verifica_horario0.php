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
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" />  
  <script type="text/javascript" src="java/calendar/calendar.js"></script> 
  <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script>
  <script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
    <script type="text/javascript">
    $().ready
    (
        function() 
        {		
            $("#course1").autocomplete("autocomp1.php", {          
            
            width: 260,
            minChars: 3,
            autoFill: false,
            mustMatch: false,
            matchContains: false,
            scroll: true,
            scrollHeight: 220            
            });	
            $("#course1").result(function(event, data, formatted) 
            {$("#course_val1").val(data['1']);
            });
        }	
    );
    $().ready
    (
        function() 
        {		
            $("#course").autocomplete("autocomp.php", {          
            
            width: 260,
            minChars: 3,
            autoFill: false,
            mustMatch: false,
            matchContains: false,
            scroll: true,
            scrollHeight: 220            
            });	
            $("#course").result(function(event, data, formatted) 
            {$("#course_val").val(data['1']);
            });
        }	
    );
    </script>

<script language="javascript">
	function salir()
	{                
		if(uno.municipio.value=='')
		{
			alert("Seleccione el municipio");			
			uno.municipio.focus();
			return;			
		}
		if(uno.fechaini.value=='')
		{
			alert("Digite la fecha");			
			uno.fechaini.focus();
			return;			
		}		
		
		uno.action="verifica_horario1.php";;
		uno.target='';
		uno.submit();			
	}
    
   
        
	
</script>
</head>
<body lang=ES style='tab-interval:35.4pt'>
 
<?	
    //	http://192.168.4.2/intraweb/intranet/nuevocitas/verifica_horario0.php
    $dateh=date("Y-m-d");	    
    include ('php/conexion1.php');
	
	$busmun=mysql_query("SELECT municipio.CODI_MUN, municipio.NOMB_MUN, municipio.DEPA_MUN
	FROM municipio WHERE (((municipio.DEPA_MUN)='52')) ORDER BY municipio.NOMB_MUN");	
    
	
	
	echo"<form name=uno method=post>
    
    <br><br>
    <table align=center width='350'>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2 height=40>LISTADO DE VERIFICACION DE HORARIOS</th></tr>
	
    <tr><th height=30>MUNICIPIO</th>
	<td><select name=municipio>
	<option value=''></option>";
	while($rmun=mysql_fetch_array($busmun))
	{
		$codm=$rmun['CODI_MUN'];
		$nomm=$rmun['NOMB_MUN'];
		echo"<option value=$codm>$nomm</option>";
	}
	echo"</select>
	</td></tr>";
	

	echo"       
	<tr>
	<th height=30>FECHA</th>
	<td align=center>";
	?>
	<input type="text" name="fechaini" class='caja'  size="10" maxlength="10" value="<?echo $fechaini;?>" id="fini" <?echo $disp;?>>
	<input type="button" class='caja' id="lanzador1" name="bot1" value="..." <?echo $disp;?>/>
	<!-- script que define y configura el calendario--> 
	<script type="text/javascript"> 
	Calendar.setup({ 
	inputField     :    "fini",     // id del campo de texto 
	ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
	button     :    "lanzador1"     // el id del botón que lanzará el calendario 				
	}); 
	</script> 				
	<?		
	echo"</td>		
	</tr>
	
     <tr><th colspan=2 align=center valign=top height=20><INPUT type=button class='boton' value='ACEPTAR' onClick='salir();'></th></tr>
	
	</table>
	</table>
	</form>";
?>
</body>
</html>