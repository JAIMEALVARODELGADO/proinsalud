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
            if(uno.fechaini.value>uno.fechafin.value)
			{
				alert("La fecha de inicio no puede ser mayor a la fecha final");
				uno.fechaini.value=uno.fecrec.value
				uno.fechaini.focus();
				return;			
			}		
			destino=uno.opcimenu.value;
			//alert(destino);
            uno.action=destino;
            uno.target='';
            uno.submit();			
	}
	function salir2()
	{
		uno.action="confirmar_cita.php";
		uno.target='';
		uno.submit();	
	}
    
    function salto(n)
	{		
            uno.opc.value=n;  
            if(uno.nommedi.value=='')uno.codmedi.value='';
            if(uno.nomarea.value=='')uno.codarea.value='';
            uno.action='listados.php';
            uno.target='';
            uno.submit();			
	}
    function salto4(n)
	{		
            uno.opc.value=n;              
            uno.action='listados.php';
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
    if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
    $dateh=date("Y-m-d");	
    $anoini=substr($dateh,0,4);
    $mesini=substr($dateh,5,2);
    $diaini=substr($dateh,8,2);
    $dateini = gmmktime ( 00, 00, 00, $mesini, $diaini, $anoini);	
    $diaprog=$dateini+86400;
    $fechasig=gmdate ( "Y-m-d", $diaprog);
    if(empty($fechaini))$fechaini=$fechasig;
    if(empty($fechafin))$fechafin=$fechasig;  
    include ('php/conexion1.php');
    $busgru=mysql_query("SELECT * FROM grupos Order By nomb_gru");	//grupos
    echo"<form name=uno method=post>
    <input type=hidden name=fecrec value='$fechaini'>
    <input type=hidden name=titulo value='$titulo'>
    <input type=hidden name=opc>
    <input type=hidden name=opcimenu value='$opcimenu'>
    <br><br>
    <table align=center width='350'>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2 height=40>$titulo</th></tr>
    <tr><th colspan=2 height=30>";
    if($impripor==1)echo"GRUPO<input type=radio name=impripor checked value='1' onclick='salto4(1)'>";
    else echo"GRUPO<input type=radio name=impripor value='1' onclick='salto4(1)'>";
    if($impripor==2)echo"AREA<input type=radio name=impripor checked value='2' onclick='salto4(2)'>";
    else echo"AREA<input type=radio name=impripor value='2' onclick='salto4(2)'>";
    if($impripor==3)echo"MEDICO<input type=radio name=impripor checked value='3' onclick='salto4(3)'>";
    else echo"MEDICO<input type=radio name=impripor value='3' onclick='salto4(3)'>";
    echo"</th></tr>";
    if($impripor=='1')
    {
        echo"<tr>
        <th height=30>GRUPO</td>
        <td align=center>   
        <select class='caja' name=grupo onchange='salto(3)'>
        <option value=''></option>";
        while($rgru=mysql_fetch_array($busgru))
        {
            $codgru=$rgru['codi_gru'];
            $nomgru=$rgru['nomb_gru'];
            if($codgru==$grupo)
            {
                echo"<option selected value='$codgru'>$nomgru</option>";
            }
            else
            {
                echo"<option value='$codgru'>$nomgru</option>";
            }
        }
        echo"</select>
        </td>    
        </tr>"; 
    }
    if($impripor=='2')
    {
        echo"<tr>
        <th height=30>AREA</th>
        <td align=center><input type=text id='course1' class='caja' name='nomarea' onblur='salto(2)' onkeyup='salto1()' size=40 value='$nomarea'></td>
        <input type='hidden' id='course_val1' name='codarea' value='$codarea'>
        </tr>";
    }
    if($impripor=='3')
    {
        echo"<tr>
        <th height=30>MEDICO</th>
        <td align=center><input type=text id='course' class='caja' name='nommedi' size=40 onblur='salto(1)' onkeyup='salto1()' value='$nommedi'></td>
        <input type='hidden' id='course_val' name='codmedi' value='$codmedi'>
        </tr>";
    }
    if($impripor=='1' || $impripor=='2' || $impripor=='3')
    {
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

        ?>
        <input type="text" name="fechafin" class='caja' size="10" maxlength="10" value="<?echo $fechafin;?>" id="ffin" <?echo $disp;?>>
        <input type="button" class='caja' id="lanzador2" name="bot2" value="..." <?echo $disp;?>/>
        <!-- script que define y configura el calendario--> 
        <script type="text/javascript"> 
        Calendar.setup({ 
        inputField     :    "ffin",     // id del campo de texto 
        ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
        button     :    "lanzador2"     // el id del botón que lanzará el calendario 				
        }); 
        </script> 				
        <?		
        echo"</td>		
        </tr>
        
         <tr>
        <th height=30>JORNADA</th>
        <td align=center>";
        if(empty($jornada))$jornada='D';
        if($jornada=='D')echo"TODO EL DIA<input type=radio name=jornada checked value='D'><font color='#FFFFFF'>------</font>";
        else echo"TODO EL DIA<input type=radio name=jornada value='D'><font color='#FFFFFF'>------</font>";
        if($jornada=='M')echo"MAÑANA<input type=radio name=jornada checked value='M'><font color='#FFFFFF'>------</font>";
        else echo"MAÑANA<input type=radio name=jornada value='M'><font color='#FFFFFF'>------</font>";
        if($jornada=='T')echo"TARDE<input type=radio name=jornada checked value='T'>";
        else echo"TARDE<input type=radio name=jornada value='T'>";
        echo"</td>
        </tr>"; 
		if($opcimenu=='listaprogramados.php' || $opcimenu=='listarips.php')
		{
			$bcon=mysql_query("select * from contrato order by NEPS_CON");
			echo"
			<tr><th height=30>CONTRATO</th>
			<td align=center>
			<select class='caja' name=contra>
			<option value=''>TODOS</option>";
			while($rcon=mysql_fetch_array($bcon))
			{
				$ccod=$rcon['CODI_CON'];
				$ncod=$rcon['NEPS_CON'];
				echo "<option value=$ccod>$ncod</option>";
			}
		}
    
    }
	
	
 echo"
     <tr><th colspan=2 align=center valign=top height=20>";
	 
	 if($usucitas=='12991944')
	 {
		echo "<INPUT type=button class='boton' value='Imprimir listado' onClick='salir();'>
		<INPUT type=button class='boton' value='Confirmar cita' onClick='salir2();'>";
	 }
	 else
	 {
		echo "<INPUT type=button class='boton' value='ACEPTAR' onClick='salir();'>";
	 }
	 echo"</th></tr>
</table>
     </table>
     </form>";
?>
</body>
</html>