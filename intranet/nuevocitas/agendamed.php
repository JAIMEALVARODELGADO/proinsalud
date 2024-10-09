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
            minChars: 1,
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
            minChars: 1,
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
            if(uno.codmedi.value=='')
			{
				alert("Seleccione el médico");
				uno.nommedi.focus();
				return;			
			}
			
			if(uno.fechaini.value=='')
			{
				alert("Seleccione la fecha");
				uno.fechaini.focus();
				return;			
			}			
            uno.action='agendamed1.php';
            uno.target='';
            uno.submit();			
	}
    
    function salto(n)
	{             
		uno.action='agendamed.php';
		uno.target='';
		uno.submit();			
	}
   
</script>
</head>
<body lang=ES style='tab-interval:35.4pt'>
<style>
#conte {
overflow:auto;
height: 300px;
width: 600px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
}
.margen_izq {
margin-left:10px;
}
</style> 
<?	
    //onload="setScrollPos('conte')"
	echo $opcimenu;
	//ECHO $destino;
   
    $fechasig=date("Y-m-d");	
    
    if(empty($fechaini))$fechaini=$fechasig; 
    include ('php/conexion1.php');
    $busgru=mysql_query("SELECT * FROM grupos Order By nomb_gru");	//grupos
    echo"<form name=uno method=post>
    <input type=hidden name=fecrec value='$fechaini'>
	<input type=hidden name=fechafin>
	
	
	
	<input type=hidden name=jornada value='D'>
	<input type=hidden name=impripor value='3'>
	<input type=hidden name=contra value=''>
	
   
    <input type=hidden name=opc>
    
    <br><br>
    <table align=center width='350'>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2 height=40>AGENDA MEDICA</th></tr>
    <tr><th colspan=2 height=30>";
 
	echo"<tr>
	<th height=30>MEDICO</th>
	<td align=center><input type=text id='course' class='caja' name='nommedi' size=40 value='$nommedi'><INPUT type=button class='boton' value='...' onClick='salto(1);'></td>
	<input type='hidden' id='course_val' name='codmedi' value='$codmedi'>
	</tr>";
    
    
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

     if(!empty($codmedi))
    {   
        echo"</td>		
        </tr>
		 <tr><th colspan=2 align=center valign=top height=20><INPUT type=button class='boton' value='ACEPTAR' onClick='salir();'></th></tr>
		";
    }
	
	
 echo"    
</table>
     </table>
     </form>";
?>
</body>
</html>