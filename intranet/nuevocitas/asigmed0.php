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
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />  
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
	function salir(n)
	{		
            uno.opc.value=n;           
            uno.action='asigmed1.php';
            uno.target='';
            uno.submit();			
	}
	function salto()
	{		
            if(uno.nomarea.value=='')uno.codarea.value='';
            if(uno.nommedi.value=='')uno.codmedi.value='';
            uno.action='asigmed0.php';                
            uno.target='';
            uno.submit();			
	}
        
        
        function salto1()
	{		
            if (event.keyCode == 13)
            {
                if(uno.nomarea.value=='')uno.codarea.value='';
                if(uno.nommedi.value=='')uno.codmedi.value='';
                uno.action='asigmed0.php';                
		uno.target='';
		uno.submit();
            }
	}	
</script>
</head>
<body style="position:absolute;margin-top:10"'>
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
    include ('php/conexion.php');
    $bususua=mysql_query("SELECT * FROM cut Order By nomb_usua");	//usuarios del sistema
    include ('php/conexion1.php');
    echo"<form name=uno method=post>
    <input type=hidden name=opc>
    <table align=center>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2>CREAR RELACION MEDICOS Y AREAS</th></tr>
    <tr>
    <th>AREA</th><th>MEDICO</th></tr>
    <tr>
    <td align=center><input type=text id='course1' class='caja' name='nomarea' onkeyup='salto1()' size=40 value='$nomarea'></td>
    <td align=center><input type=text id='course' class='caja' name='nommedi' size=40 onkeyup='salto1()' value='$nommedi'></td>
    <input type='hidden' id='course_val1' name='codarea' value='$codarea'>
    <input type='hidden' id='course_val' name='codmedi' value='$codmedi'>";
    ECHO"
    </td></tr>";
    if(empty($codmedi) && empty($codarea))        
    {
        $opcion=1;
        $busca=mysql_query("SELECT medicos.cod_medi as cmed, medicos.nom_medi as nmed, areas.cod_areas as care, areas.nom_areas as nare, areas_medic.cod_ar,areas_medic.esta_ar
        FROM (medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar) INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas
		WHERE medicos.esta_medi='A'
        ORDER BY areas.nom_areas, medicos.nom_medi");
    } 
    if(empty($codmedi) && !empty($codarea))        
    {
        $opcion=2;
        $busca=mysql_query("SELECT medicos.cod_medi AS cmed, medicos.nom_medi AS nmed, areas.cod_areas AS care, areas.nom_areas AS nare, areas_medic.cod_ar,areas_medic.esta_ar
        FROM (medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar) INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas
        WHERE (((areas.cod_areas)='$codarea')) AND medicos.esta_medi='A'
        ORDER BY areas.nom_areas, medicos.nom_medi"); 
    }   
    if(!empty($codmedi) && empty($codarea))        
    {
        $opcion=3;
        $busca=mysql_query("SELECT medicos.cod_medi AS cmed, medicos.nom_medi AS nmed, areas.cod_areas AS care, areas.nom_areas AS nare, areas_medic.cod_ar,areas_medic.esta_ar
        FROM (medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar) INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas
        WHERE (((medicos.cod_medi)='$codmedi')) AND medicos.esta_medi='A'
        ORDER BY areas.nom_areas, medicos.nom_medi");
    }   
    if(!empty($codmedi) && !empty($codarea))        
    {
        $opcion=4;
        $busca=mysql_query("SELECT medicos.cod_medi AS cmed, medicos.nom_medi AS nmed, areas.cod_areas AS care, areas.nom_areas AS nare, areas_medic.cod_ar,areas_medic.esta_ar
        FROM (medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar) INNER JOIN areas ON areas_medic.areas_ar = areas.cod_areas
        WHERE (((medicos.cod_medi)='$codmedi') AND ((areas.cod_areas)='$codarea')) AND medicos.esta_medi='A'
        ORDER BY areas.nom_areas, medicos.nom_medi");
    }
    if($opcion==4 && mysql_num_rows($busca)==0)
    {  
        echo"<tr><th align=center height=20 colspan=2>
        <INPUT type=button class='boton' value='Crear' onClick='salir(1)'>
        </th></tr>";
    }
    else
    { 
        echo"<tr><th align=center height=20 colspan=2>
        <INPUT type=button class='boton' value='Crear' onClick='salir(1)' disabled>
        </th></tr>";
    } 
    echo"</table>
    <br><br>"; 
    echo"
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2>ACTIVAR O DESACTIVAR RELACION MEDICOS Y AREAS</th></tr> 
    </table>"; 
    if(mysql_num_rows($busca)>10) 
    {
        ECHO"<div id='conte'>";
    }
    echo"<table align=center class='tbl' width=100%>";       
    $n=0;
    while($rarea=mysql_fetch_array($busca))
    {
        $codar=$rarea['care'];
        $nomar=$rarea['nare'];
        $codmedico=$rarea['cmed'];
        $nomme=$rarea['nmed'];
        $iden=$rarea['cod_ar']; 
        $estado=$rarea['esta_ar'];
        $nomvar='codar'.$n;
        echo"<input type=hidden name=$nomvar value='$codar'>";
        $nomvar='codmedico'.$n;
        echo"<input type=hidden name=$nomvar value='$codmedico'>";
        $nomvar='iden'.$n;
        echo"<input type=hidden name=$nomvar value='$iden'>";               
        $nomvar='estasig'.$n;
        echo "<tr><td>";
        if($estado=='A')echo"<input type=checkbox name=$nomvar checked value='1'>";
        else echo"<input type=checkbox name=$nomvar value='1'>";
        echo"</td>
        <td>$codar</td>  
        <td>$nomar</td> 
        <td>$codmedico</td> 
        <td>$nomme</td>            
        </tr>";            
        $n++;       
    }
    $finarasig=$n;
    echo"<input type=hidden name=finarasig value=$finarasig>";
    echo" </table>
     <br>";
    if(mysql_num_rows($busca)>10) 
    {
        ECHO"</div>";
    }      
    echo"<table align=center class='tbl' width=100%>
    <tr><th align=center height=20>
    <INPUT type=button class='boton' id='botace' value='Modificar' onClick='salir(2);'>
    </th></tr>		
    </table>";
 echo"</td></tr></table>";
 echo"</form>";
?>
</body>
</html>