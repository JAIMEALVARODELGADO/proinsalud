<?
session_start();
$usucitas=$_SESSION['usucitas'];
$areatra=$_SESSION['areatra'];
$dateh=date("Y-m-d");
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready
(
	function() 
	{		
		$("#course").autocomplete("autoarea.php", { 
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
$().ready
(
	function() 
	{		
		$("#coursecod").autocomplete("autocodarea.php", {          
		
		width: 260,
		minChars: 1,
		autoFill: false,
		mustMatch: false,
		matchContains: false,
		scroll: true,
		scrollHeight: 220            
		});	
		$("#coursecod").result(function(event, data, formatted) 
		{$("#coursenom").val(data['1']);
		});
	}	
);
</script>
<script language="javascript">
function busca()
{
	uno.target='';
	uno.action='areas0.php';
	uno.submit();
} 
function guarda()
{
	if(uno.narean.value=='')
	{
		alert("NOMBRE DE AREA VACIO");
		uno.narean.focus();
		return;
	}
	if(uno.municipio.value=='')
	{
		alert("SELECCIONE EL MUNICIPIO");
		uno.municipio.focus();
		return;
	}
	if(uno.codigo.value=='')
	{
		alert("CODIGO DE AREA VACIO");
		uno.codigo.focus();
		return;
	}
	if(uno.grusiigo.value=='')
	{
		alert("GRUPO SIIGO VACIO");
		uno.grusiigo.focus();
		return;
	}
	if(uno.grupocita.value=='')
	{
		alert("GRUPO CITAS VACIO");
		uno.grupocita.focus();
		return;
	}
	if(uno.unifuncional.value=='')
	{
		alert("UNIDAD FUNCIONAL VACIA");
		uno.unifuncional.focus();
		return;
	}
	if(uno.areaprin.value=='')
	{
		alert("AREA ORIGEN VACIA");
		uno.areaprin.focus();
		return;
	}
	
	uno.target='';
	uno.action='areas1.php';
	uno.submit();
}
</script>
</head>
<body style='position:absolute;margin-top:10'>
<style>

</style> 
<?	
    
    include ('php/conexion1.php');	
	
	echo"<form name=uno method=post>
	<br><br>
	<table align=center>
	<tr><td>
	<table align=center class='tbl' width=100%>
	<tr><th>ADMINISTRACION DE AREAS</th></tr>
	</table>
	<br>
	<table class='tbl' align=center width=100%>
	<tr>
	<th>BUSCAR DE AREA</th>
	<td align=center><input type=text id='course' class='caja' name='nomarea' size=40 value='$nomarea'> <input type=button class=boton value='>>' onclick=busca()> 
	</td>
	<input type='hidden' id='course_val' name='codarea' value='$codarea'>";
	ECHO"</td></tr>
	</table>
	<br>";

	if($codarea=='0')
	{
		
		$narean=substr($nomarea,6,300);
		$busgrupo=mysql_query("SELECT * FROM destipos WHERE codt_des = '58' ");
		$busgrupo2=mysql_query("SELECT * FROM destipos WHERE codt_des = '78' ");
		$busarea=mysql_query("SELECT * FROM areas ORDER BY nom_areas");
		
		$busmun=mysql_query("SELECT municipio.CODI_MUN, municipio.NOMB_MUN, municipio.DEPA_MUN
		FROM municipio WHERE (((municipio.DEPA_MUN)='52')) ORDER BY municipio.NOMB_MUN");
		
		$bustipo=mysql_query("SELECT areas.csii_area, areas.nsii_area
		FROM areas WHERE (((areas.nsii_area)<>'')) GROUP BY areas.csii_area, areas.nsii_area ORDER BY areas.nsii_area");
		echo"
		<table align=center class='tbl' width=100%>
		
		<tr>		
		<td>MUNICIPIO</td><td><select name=municipio class=caja>
		<option value=''></option>";
		while($rmun=mysql_fetch_array($busmun))
		{
			$cmun=$rmun['CODI_MUN'];
			$nmun=$rmun['NOMB_MUN'];
			echo"<option value='$cmun'>$nmun</option>";			    
		}
		echo"</select>
		</td>
		</tr>
		
		
		
		
		
		
		
		
		<tr>
		<td>NOMBRE AREA</td><td><input type=text SIZE=60 class='caja' name=narean value='$narean'></td>
		</tr>
		<tr>
		<td>CODIGO AREA</td><td><input type=text id='coursecod' size=20 maxlength=3 class='caja' name=codigo value=$codigo></td>
		<input type=hidden id='coursenom' size=2 maxlength=3 class='caja' name=descri value=$codigo>
		</tr>
		<tr>		
		<td>NOMBRE SIIGO</td><td><select name=grusiigo class=caja>
		<option value=''></option>";
		while($rgru=mysql_fetch_array($bustipo))
		{
			$cods=$rgru['csii_area'];
			$noms=$rgru['nsii_area'];
			$siigo=$cods.'-'.$noms;
			echo"<option value='$siigo'>$noms</option>";			    
		}
		echo"</select>
		</td>
		</tr>
		<tr>
		<td>GRUPO CITAS</td><td><select name=grupocita class=caja>
		<option value=''></option>";
		while($rgru=mysql_fetch_array($busgrupo))
		{
			$codg=$rgru['codi_des'];
			$nomg=$rgru['nomb_des'];
			echo"<option value='$codg'>$nomg</option>";			    
		}
		echo"</select>
		</td>
		</tr>
		<tr>		
		<td>UNIDAD FUNCIONAL</td><td><select name=unifuncional class=caja>
		<option value=''></option>";
		while($rgru=mysql_fetch_array($busgrupo2))
		{
			$codu=$rgru['codi_des'];
			$nomu=$rgru['nomb_des'];
			echo"<option value='$codu'>$nomu</option>";			    
		}
		echo"</select>
		</td>
		</tr>
		
		<tr>		
		<td>AREA ORIGEN</td><td><select name=areaprin class=caja>
		<option value=''></option>";
		while($rgru=mysql_fetch_array($busarea))
		{
			$coda=$rgru['cod_areas'];
			$noma=$rgru['nom_areas'];
			echo"<option value='$coda'>$noma</option>";			    
		}
		echo"</select>
		</td>
		</tr>
		<tr>
		<td colspan=2 align=center><input type=button class=boton value='GUARDAR' onclick='guarda()'></td>
		</tr>
		<table>";
	}
    echo"</table></form>";	
    
?>
</body>
</html>