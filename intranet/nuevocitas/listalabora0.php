<?
session_start();
    $usucitas=$_SESSION['usucitas'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?>
<html>
<head>
    


    <link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" />  
    <script type="text/javascript" src="java/calendar/calendar.js"></script> 
    <script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script>
    <script type="text/javascript" src="java/calendar/calendar-setup.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css"/>    
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
        uno.action='listalabora1.php';
        uno.target='top';
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
    <br><br>
    <table align=center width='350'>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2 height=40>$titulo</th></tr>
    <tr><th colspan=2 height=30>";
    
    echo"<tr>
    <th height=30>MEDICO</th>
    <td align=center>";
    
	
	$bmed=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi, areas_medic.areas_ar, areas_medic.esta_ar
FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
WHERE (((areas_medic.areas_ar)='80') AND ((areas_medic.esta_ar)='A'))
ORDER BY medicos.nom_medi");
	
    
    
    echo"
    <select class='caja' name=codmedi>
    <option value=''></option>";
    while($rmed=mysql_fetch_array($bmed))
    {
        $cmedi=$rmed['cod_medi'];
        $nmedi=$rmed['nom_medi'];
        if($cmedi==$codmedi)echo"<option selected value=$cmedi>$nmedi</option>";
        else echo"<option value=$cmedi>$nmedi</option>";
    }    
    echo"
    </select>
    <td></tr>";
    
    
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
        <th height=30>TIPO</th>
        <td align=center>";
        if(empty($tipoex))$tipoex='B';
        if($tipoex=='B')echo"BASICO<input type=radio name=tipoex checked value='B'><font color='#FFFFFF'>------</font>";
        else echo"BASICO<input type=radio name=tipoex value='B'><font color='#FFFFFF'>------</font>";
        if($tipoex=='E')echo"ESPECIAL<input type=radio name=tipoex checked value='E'><font color='#FFFFFF'>------</font>";
        else echo"ESPECIAL<input type=radio name=tipoex value='E'><font color='#FFFFFF'>------</font>";
        if($tipoex=='R')echo"REMITIDO<input type=radio name=tipoex checked value='R'>";
        else echo"REMITIDO<input type=radio name=tipoex value='R'>";
        echo"</td>
        </tr>
        ";
   
    
 echo"
     <tr><th colspan=2 align=center valign=top height=20><INPUT type=button class='boton' value='ACEPTAR' onClick='salir();'></th></tr>


</table>
     </table>
     </form>";
?>
</body>
</html>