<?
session_start();
$datos[0]='desc_';
$datos[1]='iden_';
?>
<html>
<head>
<title>FORMATO FURIPS</title>
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

	$("#course2").autocomplete("fac_autocompmun.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course2").result(function(event, data, formatted) {
		$("#course_val2").val(data[1]);		
	});

	$("#course3").autocomplete("fac_autocompmun.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course3").result(function(event, data, formatted) {
		$("#course_val3").val(data[1]);		
	});

        $("#course4").autocomplete("fac_autocompcie.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course4").result(function(event, data, formatted) {
		$("#course_val4").val(data[1]);                
	});
        
       $("#course5").autocomplete("fac_autocompcie.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course5").result(function(event, data, formatted) {
		$("#course_val5").val(data[1]);                
	});
        
       $("#course6").autocomplete("fac_autocompcie.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course6").result(function(event, data, formatted) {
		$("#course_val6").val(data[1]);                
	});
        
       $("#course7").autocomplete("fac_autocompcie.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course7").result(function(event, data, formatted) {
		$("#course_val7").val(data[1]);                
	});
        
       $("#course8").autocomplete("fac_autocompcie.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course8").result(function(event, data, formatted) {
		$("#course_val8").val(data[1]);                
	});
        
       $("#course9").autocomplete("fac_autocompcie.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course9").result(function(event, data, formatted) {
		$("#course_val9").val(data[1]);                
	});
        
       $("#course10").autocomplete("fac_autocompmedi.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course10").result(function(event, data, formatted) {
		$("#course_val10").val(data[1]);                
	});
        
        $("#course11").autocomplete("fac_autocompmun.php", {
		width: 260,
		matchContains: false,
		mustMatch: false,
		selectFirst: false
	});	
	$("#course11").result(function(event, data, formatted) {
		$("#course_val11").val(data[1]);		
	});

});
</script>

<script language="JavaScript" src="funcionesfs.js"></script>
<script language="JavaScript">
function validar(){
var error="";    
    if(document.form1.resp_rec.value!="" && document.form1.radant_rec.value==""){error+="Numero de Radicado Anterior\n";}
    if(document.form1.natu_rec.value==""){error+="Naturaleza del Evento\n";}
    if(document.form1.natu_rec.value=="17" && document.form1.desot_rec.value==""){error+="Descripcion de la Otra Naturaleza del Evento\n";}
    if(document.form1.direoc_rec.value==""){error+="Direccion de Ocurrencia del Evento\n";}
    if(document.form1.fechoc_rec.value==""){error+="Fecha del Evento\n";}
    /*if(validafecha(form1.fechoc_rec.value)==false){
        error+="Fecha del Evento Invalida\n";
    }
    if(validahoy(form1.fechoc_rec.value)==false){
        error+="La fecha del evento no puede ser mayor a la de hoy\n";
    }*/
    if(document.form1.horaoc_rec.value==""){error+="Hora del Evento\n";}
    if(document.form1.munioc_rec.value==""){error+="Municipio del Evento\n";}
    if(document.form1.zonaoc_rec.value==""){error+="Zona del Evento\n";}
    if(document.form1.estase_veh.value==""){error+="Estado de Aseguramiento\n";}
    if(document.form1.estase_veh.value=="1" || document.form1.estase_veh.value=="2" || document.form1.estase_veh.value=="4"){
        if(document.form1.marca_veh.value==""){error+="Marca del Vehiculo\n";}
        if(document.form1.tdoc_con.value==""){error+="Tipo de Documento de Identificacion del Propietario del Vehiculo\n";}
        if(document.form1.ndoc_pro.value==""){error+="Identificacion del Propietario del Vehiculo\n";}
        if(document.form1.pape_pro.value==""){error+="Primer Apellido del Propietario del Vehiculo\n";}
        if(document.form1.pnom_pro.value==""){error+="Primer Nombre del Propietario del Vehiculo\n";}
        if(document.form1.dire_pro.value==""){error+="Direccion del Propietario del Vehiculo\n";}
        if(document.form1.tele_pro.value==""){error+="Telefono del Propietario del Vehiculo\n";}
        if(document.form1.mres_pro.value==""){error+="Municipio del Propietario del Vehiculo\n";}
        if(document.form1.tdoc_con.value==""){error+="Tipo de Documento de Identificacion del Conductor\n";}
        if(document.form1.ndoc_con.value==""){error+="Numero  de Documento de Identificacion del Conductor\n";}
        if(document.form1.pape_con.value==""){error+="Primer Apellido del Conductor\n";}
        if(document.form1.pnom_con.value==""){error+="Primer Nombre del Conductor\n";}
        if(document.form1.dire_con.value==""){error+="Direccion del Conductor\n";}
        if(document.form1.tele_con.value==""){error+="Telefono del Conductor\n";}
        if(document.form1.muni_con.value==""){error+="Municipio del Conductor\n";}
    }
    if(document.form1.estase_veh.value=="1" || document.form1.estase_veh.value=="2" || document.form1.estase_veh.value=="4" || document.form1.estase_veh.value=="5"){
        if(document.form1.placa_veh.value==""){error+="Placa del Vehiculo\n";}
        if(document.form1.tipo_veh.value==""){error+="Tipo de Vehiculo\n";}        
    }
    if(document.form1.estase_veh.value=="1" || document.form1.estase_veh.value=="4"){
        if(document.form1.codi_con.value==""){error+="Aseguradora del Vehiculo\n";}
        if(document.form1.poliza_veh.value==""){error+="Numero de Poliza\n";}
        if(document.form1.finipol_veh.value==""){error+="Fecha de Inicio de Poliza\n";}
        /*if(validafecha(form1.finipol_veh.value)==false){
            error+="Fecha de Inicio de la Poliza Invalida\n";
        }*/       
        if(document.form1.ffinpol_veh.value==""){error+="Fecha Final de Poliza\n";}
        /*if(validafecha(form1.ffinpol_veh.value)==false){
            error+="Fecha Final de la Poliza Invalida\n";
        }*/
    }
    if(document.form1.inter_veh.value==""){error+="Intervencion de la Autoridad\n";}
    if(document.form1.exced_veh.value==""){error+="Cobro por Excedente de la Poliza\n";}
    if(document.form1.fecing_ate.value==""){error+="Fecha de Ingreso a la Atencion\n";}
    if(document.form1.horing_ate.value==""){error+="Hora de Ingreso a la Atencion\n";}
    if(document.form1.fecsal_ate.value==""){error+="Fecha de Salida de la Atencion\n";}
    if(document.form1.horsa_ate.value==""){error+="Hora de Salida de la Atencion\n";}
    if(document.form1.diapri_ate.value==""){error+="Diagnostico Principal al Ingreso\n";}
    if(document.form1.dxprieg_ate.value==""){error+="Diagnostico Principal al Egreso\n";}
    if(document.form1.cod_medi.value==""){error+="Medico Tratante\n";}
    if(document.form1.foli_ate.value==""){error+="Numero de Folios\n";}

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
<form name="form1" method="POST" action="fac_5guardafurips.php">
<!--target='fr02'    -->
<table class="Tbl0"><tr><td class="Td0" align='center'>NUEVO FURIPS</td></tr></table><br>
<?
include('php/conexion.php');
include('php/funciones.php');
if(empty($iden_fac)){
    $consusu="SELECT usu.codi_usu,usu.nrod_usu,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu) AS nombre,usu.fnac_usu,usu.sexo_usu,usu.dire_usu,usu.mate_usu,
        ef.iden_fac
        FROM encabezado_factura AS ef
        INNER JOIN usuario AS usu ON usu.codi_usu=ef.codi_usu
        WHERE ef.pref_fac='$pref_fac' AND ef.nume_fac='$num_fac'";
}
else{
        $consusu="SELECT usu.codi_usu,usu.nrod_usu,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu) AS nombre,usu.fnac_usu,usu.sexo_usu,usu.dire_usu,usu.mate_usu,
        ef.iden_fac
        FROM encabezado_factura AS ef
        INNER JOIN usuario AS usu ON usu.codi_usu=ef.codi_usu
        WHERE ef.pref_fac='$pref_fac' AND ef.iden_fac='$iden_fac'";
}
//usu.nrod_usu='$nrod_usu'
//echo $consusu;
$consusu=mysql_query($consusu);
if(mysql_num_rows($consusu)==0){
    echo "<table class='Tbl0'><tr><td class='Td1' align='center'>Usuario NO Encontrado</td></tr></table>";}
else{
    $rowusu=mysql_fetch_array($consusu);
}
include('fac_5captufurips.php');
?>


<input type="hidden" name="codi_usu" value="<?echo $rowusu[codi_usu]?>">
<input type="hidden" name="iden_fac" value="<?echo $rowusu[iden_fac]?>">
<table class="Tbl0"><tr><td class="Td1" align='center'><a href="#" onclick="validar()"><img src="icons/feed_go.png">Siguiente</a></td></tr></table>
<?
    //mysql_free_result($consulta);
    mysql_close();
?>
</form>
</body>
</html>