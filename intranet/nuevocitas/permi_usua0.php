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
            $("#course").autocomplete("autocomp2.php", {          
            
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
		uno.action='permi_usua1.php';
		uno.target='';
		//alert(uno.areatra.value);
		uno.submit();			
	}
	function salto()
	{		
		uno.action='permi_usua0.php';
		uno.target='';
		uno.submit();			
	}
	
	function contrato(n)
	{
		uno.areasel.value=n;
		uno.action='permi_contra0.php';
		uno.target='';
		uno.submit();	
	}
	function abil(n)
	{		
		f=uno.finn.value;		
		for(i=0;i<f;i++)
		{
			opcion = document.getElementsByName("tipoper"+i);			
			if(n==1)
			{
				opcion[0].checked=true;
				opcion[1].checked=false
			}
			if(n==2)
			{
				opcion[1].checked=true;
				opcion[0].checked=false
			}
	        
			
		}
	}
</script>
</head>
<body style="position:absolute;margin-top:10"'>
<style>
#conte {
overflow:auto;
height: 300px;
width: 500px;
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
    set_time_limit(300);
	//if($usucitas=='12991944')
	//{
		include ('php/conexion1.php');
		echo"<form name=uno method=post>
		<input type=hidden name=opcion value='1'>
		<input type=hidden name=areasel>
		<input type=hidden name=regm>
		<table align=center>
		<tr><td>
		<table align=center class='tbl' width=100%>
		<tr><th>ADMINISTRACION DE USUARIOS</th></tr>
		</table>
		<br>
		<table class='tbl' align=center width=100%>
		<tr>
		<th>USUARIO</th>
		<td align=center><input type=text id='course' class='caja' name='nomemple' size=40 value='$nomemple'></td>
		<input type='hidden' id='course_val' name='emple' value='$emple'>";
		ECHO"</td></tr>";
		
		if(!empty($emple))
		{ 
			$busarelog=mysql_query("SELECT * FROM destipos where codt_des ='58'");	//busca el area desde donde se asigna la cita
			echo"<tr>";
			echo"<th>AREA DE TRABAJO</th>
			<td><select class=caja name=areatra onchange='salto()'>
			<option value=''></option>";
			while($rusu=mysql_fetch_array($busarelog))
			{               
				$codides=$rusu['codi_des'];
				$nombdes=$rusu['nomb_des'];			
				if($areatra==$codides)echo"<option value='$codides' selected>$nombdes </option>";	
				else echo"<option value='$codides'>$nombdes </option>";
			}	
			echo"</select>";        
		} 
		echo"</td></tr></table><br>";
		if(!empty($emple) && !empty($areatra))        
		{		
			
		   echo"
			<table align=center class='tbl' width=100%>
			<tr>
			<th rowspan=2 width=50%>SERVICIOS</th>
			<th colspan=3=2 width=50%>CONTRATOS</th>
			</tr>
			<tr>
			<th  width=17%>NINGUNO <input type=radio name=ningu onclick='abil(1)'></th>
			<th  width=17%>TODOS <input type=radio name=ningu onclick='abil(2)'></th>
			<th  width=16%>PERSONALIZADO</th>
			</tr>
			</table>        
			<div id='conte'>
			<br>
			<table align=center class='tbl' width=100%>"; 
			$busar=mysql_query("SELECT areas.cod_areas, areas.nom_areas, areas.esta_area, areas.arci_area
			FROM areas WHERE (((areas.arci_area)='$areatra')) ORDER BY areas.nom_areas");
			$n=0;
			
			
			
			while($row=mysql_fetch_array($busar))
			{
				$codar=$row['cod_areas'];
				$nomar=$row['nom_areas'];
				$tipoper='';
				$estapermi='';			
				$idenarea='';
				$barpe=mysql_query("SELECT permisos_citas.usua_per, permisos_citas.serv_per, permisos_citas.tipo_per, permisos_citas.esta_per, permisos_citas.iden_per
				FROM permisos_citas WHERE (((permisos_citas.usua_per)='$emple') AND ((permisos_citas.serv_per)='$codar'))");	
				
				
				$rare=mysql_fetch_array($barpe);					
				$tipoper=$rare['tipo_per'];
				$estapermi=$rare['esta_per'];			
				$idenarea=$rare['iden_per'];	
				
				$nomvar='codar'.$n;			
				echo"<input type=hidden name=$nomvar value='$codar'>";					
				echo "<tr><td  width=50%>$nomar</td>";
				$ch1='';$ch2='';$ch3='';
				if(empty($tipoper))$tipoper='N';
				if($tipoper=='N')$ch1='checked';
				if($tipoper=='T')$ch2='checked';
				if($tipoper=='P')$ch3='checked';
				$nomvar='tipoper'.$n;
				echo"</td>
				<td align=center width=16%><input type=radio $ch1 name=$nomvar value='N'></td>
				<td align=center width=16%><input type=radio $ch2 name=$nomvar value='T'></td>
				<td align=center width=16%><input type=radio $ch3 name=$nomvar value='P' onclick='contrato(\"$codar\")'></td>
				</tr>"; 
				$n++;
			}	
			echo"<input type=hidden name=finn value=$n>
			
			</table>
			 <br>
			</div> 
			<table align=center class='tbl' width=100%>			
			<tr><th align=center height=20>
			<INPUT type=button class='boton' value='Guardar' onClick='salir();'>
			</th></tr>		
			</table>";
		}
		echo"</td></tr></table>";
		echo"</form>";
	
	
?>
</body>
</html>