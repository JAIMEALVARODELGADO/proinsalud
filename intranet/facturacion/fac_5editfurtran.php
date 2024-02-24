<?
session_start();
$datos[0]='desc_';
$datos[1]='iden_';
$_SESSION[iden_rec]=$iden_rec1;
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION - FURTRAN</title>
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<link rel="stylesheet" href="css/style.css" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/estyles.css">
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	$("#course").autocomplete("fac_autocompmun.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);		
	});

});
</script>
<script language="JavaScript" src="funcionesfs.js"></script>
<SCRIPT LANGUAGE=JavaScript>
function validar(){
var error="";
    if(document.form1.resp_rec.value!="" && document.form1.radant_rec.value==""){error+="Numero de Radicado Anterior\n";}
    if(document.form1.tipeve_rec.value==""){error+="Tipo de Evento\n";}
    if(document.form1.dire_rec.value==""){error+="Direccion donde se recoge a la victima\n";}
    if(document.form1.muni_rec.value=="17" && document.form1.desot_rec.value==""){error+="Descripcion de la Otra Naturaleza del Evento\n";}
    if(document.form1.muni_rec.value==""){error+="Municipio\n";}
    if(document.form1.zona_rec.value==""){error+="Zona\n";}
    if(document.form1.fectra_rec.value==""){error+="Fecha de Traslado\n";}
    if(validafecha(form1.fectra_rec.value)==false){
        error+="Fecha Invalida\n";
    }
    if(validahoy(form1.fectra_rec.value)==false){
        error+="La Fecha no puede ser mayor a la de hoy\n";
    }
    if(document.form1.hortra_rec.value==""){error+="Hora de traslado\n";}
    if(document.form1.totfol_rec.value==""){error+="Total Folios\n";}
    if(error!=""){
        alert("La siguiente informacion es obligatoria\n"+error);
        return(false);        
    }
    else{
        document.form1.submit();
    }
}

</script>

<script language='vBscript'>
//Funcion que retorna true si la fecha es vlida y false si la fecha no es vlida
//Parmetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafecha(fecha_)
  validafecha=IsDate(fecha_)
end function

//Funcion que retorna true si la fecha1 es mayor a fecha2
//Parmetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validafechamen(fecha1_,fecha2_)
  diferencia=(DateDiff("d",fecha2_,fecha1_))  
  if(diferencia>=0) then
    validafechamen=false
  else
    validafechamen=true
  end if
end function

//Funcion que retorna true si la fecha es menor a la fecha actual
//Parmetros: fecha_ : Es la fecha que se va a validar, debe llegar en formato dd/mm/aaaa
function validahoy(fecha_)
  hoy=now
  hoy=mid(hoy,1,10)
  if IsDate(fecha_) then
    diferencia=(DateDiff("d",fecha_,hoy))
  else
    diferencia=0
  end if
  if(diferencia>=0) then
    validahoy=true
  else
    validahoy=false
  end if
end function

</script>

</head>
<body>
<form name="form1" method="POST" action="fac_5guardaeditfurtran.php" target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'>NUEVO FURTRAN</td></tr></table><br>
<?
include('php/conexion.php');
include('php/funciones.php');
include('fac_5captufurtran.php');
$consulta="SELECT rec.iden_rec,rec.resp_rec,rec.radant_rec,rec.tipeve_rec,rec.dire_rec,rec.muni_rec,rec.zona_rec,rec.fectra_rec,rec.hortra_rec,rec.codips_rec,rec.totfol_rec,
mun.nomb_mun
FROM ft_reclamacion AS rec
INNER JOIN municipio AS mun ON mun.codi_mun=rec.muni_rec
WHERE iden_rec='$_SESSION[iden_rec]'";        
//echo $consulta;
$consulta=mysql_query($consulta);
$row=mysql_fetch_array($consulta);
$fectra_rec=cambiafechadmy($row[fectra_rec]);
?>
<script language="JavaScript">
    document.form1.resp_rec.value='<?php echo $row[resp_rec]?>';
    document.form1.radant_rec.value='<?php echo $row[radant_rec]?>';
    document.form1.tipeve_rec.value='<?php echo $row[tipeve_rec]?>';
    document.form1.dire_rec.value='<?php echo $row[dire_rec]?>';
    document.form1.nommuni.value='<?php echo $row[nomb_mun]?>';
    document.form1.muni_rec.value='<?php echo $row[muni_rec]?>';
    document.form1.zona_rec.value='<?php echo $row[zona_rec]?>';    
    document.form1.fectra_rec.value='<?php echo $fectra_rec?>';
    document.form1.hortra_rec.value='<?php echo $row[hortra_rec]?>';
    document.form1.totfol_rec.value='<?php echo $row[totfol_rec]?>';
</script>


<table class="Tbl0"><tr><td class="Td1" align='center'><a href="#" onclick="validar()"><img src="icons/feed_go.png">Siguiente</a></td></tr></table>
</form>
</body>
</html>
