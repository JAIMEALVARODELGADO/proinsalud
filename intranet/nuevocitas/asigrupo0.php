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
    </script>

<script language="javascript">
	function salir(n)
	{		
            uno.opc.value=n;           
            uno.action='asigrupo1.php';
            uno.target='';
            uno.submit();			
	}
	function salto()
	{		
            if(uno.nomarea.value=='')uno.codarea.value='';
            uno.action='asigrupo0.php';                
            uno.target='';
            uno.submit();			
	}
        
        
        function salto1()
	{		
            if (event.keyCode == 13)
            {                
                if(uno.nomarea.value=='')uno.codarea.value='';               
                uno.action='asigrupo0.php';                
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
    include ('php/conexion1.php');
    $busgru=mysql_query("SELECT * FROM grupos Order By nomb_gru");	//grupos
    echo"<form name=uno method=post>
    <input type=hidden name=opc>
    <table align=center>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2>CREAR AGRUPACION DE AREAS</th></tr>
    <tr>
    <th>GRUPO</th><th>AREA</th></tr>
    <tr>
    <td align=center>
    <select class='caja' name=grupo onchange='salto()'>
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
    <td align=center><input type=text id='course1' class='caja' name='nomarea' onkeypress='salto1()' onblur='salto()' size=40 value='$nomarea'></td>    
    <input type='hidden' id='course_val1' name='codarea' value='$codarea'>";
    ECHO"
    </td></tr>";
    if(empty($grupo) && empty($codarea))        
    {
        $opcion=1;
        $busca=mysql_query("SELECT grupos.codi_gru, grupos.nomb_gru, areas.cod_areas AS care, areas.nom_areas AS nare,grup_area.codi_grar
        FROM (grup_area INNER JOIN grupos ON grup_area.cogr_grar = grupos.codi_gru) INNER JOIN areas ON grup_area.coar_grar = areas.cod_areas
        ORDER BY grupos.nomb_gru, areas.nom_areas");
    } 
    if(empty($grupo) && !empty($codarea))        
    {
        $opcion=2;
        $busca=mysql_query("SELECT grupos.codi_gru, grupos.nomb_gru, areas.cod_areas AS care, areas.nom_areas AS nare,grup_area.codi_grar
        FROM (grup_area INNER JOIN grupos ON grup_area.cogr_grar = grupos.codi_gru) INNER JOIN areas ON grup_area.coar_grar = areas.cod_areas
        WHERE (((areas.cod_areas)='$codarea'))
        ORDER BY grupos.nomb_gru, areas.nom_areas"); 
    }   
    if(!empty($grupo) && empty($codarea))        
    {
        $opcion=3;
        $busca=mysql_query("SELECT grupos.codi_gru, grupos.nomb_gru, areas.cod_areas AS care, areas.nom_areas AS nare,grup_area.codi_grar
        FROM (grup_area INNER JOIN grupos ON grup_area.cogr_grar = grupos.codi_gru) INNER JOIN areas ON grup_area.coar_grar = areas.cod_areas
        WHERE (((grupos.codi_gru)='$grupo'))
        ORDER BY grupos.nomb_gru, areas.nom_areas");
    }   
    if(!empty($grupo) && !empty($codarea))        
    {
        $opcion=4;
        $busca=mysql_query("SELECT grupos.codi_gru, grupos.nomb_gru, areas.cod_areas AS care, areas.nom_areas AS nare,grup_area.codi_grar
        FROM (grup_area INNER JOIN grupos ON grup_area.cogr_grar = grupos.codi_gru) INNER JOIN areas ON grup_area.coar_grar = areas.cod_areas
        WHERE (((grupos.codi_gru)='$grupo') AND ((areas.cod_areas)='$codarea'))
        ORDER BY grupos.nomb_gru, areas.nom_areas");
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
    <tr><th colspan=2>ELIMINAR AREA DE UN GRUPO</th></tr> 
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
        $cogru=$rarea['codi_gru'];
        $nogru=$rarea['nomb_gru'];
        $iden=$rarea['codi_grar'];
        
        $nomvar='codar'.$n;
        echo"<input type=hidden name=$nomvar value='$codar'>";
        $nomvar='cogru'.$n;
        echo"<input type=hidden name=$nomvar value='$cogru'>";
        $nomvar='iden'.$n;
        echo"<input type=hidden name=$nomvar value='$iden'>";               
        
        $nomvar='estasig'.$n;
        echo "<tr><td>";        
        echo"<input type=checkbox name=$nomvar value='1'>";
        echo"</td>
        <td>$cogru</td> 
        <td>$nogru</td>  
        <td>$codar</td>  
        <td>$nomar</td> 
                  
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
    <INPUT type=button class='boton' id='botace' value='Eliminar' onClick='salir(2);'>
    </th></tr>		
    </table>";
 echo"</td></tr></table>";
 echo"</form>";
?>
</body>
</html>