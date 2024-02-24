<?
session_start();
$datos[0]='desc_';
$datos[1]='iden_';
$_SESSION[iden_rec]=$iden_rec1;
?>
<html>
<head>
<title>PROGRAMA DE FACTURACION - FURIPS</title>
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
    if(document.form1.fact_rec.value==""){error+="Numero de Factura\n";}
    if(document.form1.natu_rec.value==""){error+="Naturaleza del Evento\n";}
    //if(document.form1.natu_rec.value=="17" && document.form1.desot_rec.value==""){error+="Descripcion de la Otra Naturaleza del Evento\n";}
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
<form name="form1" method="POST" action="fac_5guardaedtfurips.php" target='fr02'>

<table class="Tbl0"><tr><td class="Td0" align='center'>EDITA FURIPS</td></tr></table><br>
<?
include('php/conexion.php');
include('php/funciones.php');
$consusu="SELECT usu.codi_usu,usu.nrod_usu,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu) AS nombre,usu.fnac_usu,usu.sexo_usu,usu.dire_usu,usu.mate_usu,
    ef.nume_fac,mun.nomb_mun,
    rec.resp_rec,rec.radant_rec,rec.iden_fac,rec.nume_rec,rec.codi_usu,rec.cond_rec,rec.natu_rec,rec.desot_rec,rec.direoc_rec,rec.fechoc_rec,rec.horaoc_rec,rec.munioc_rec,rec.zonaoc_rec
    FROM fr_reclamacion AS rec
    INNER JOIN encabezado_factura AS ef ON ef.iden_fac=rec.iden_fac
    INNER JOIN usuario AS usu ON usu.codi_usu=rec.codi_usu
    INNER JOIN municipio AS mun ON mun.codi_mun=rec.munioc_rec
    WHERE rec.iden_rec='$_SESSION[iden_rec]'";
//echo $consusu;
$consusu=mysql_query($consusu);
if(mysql_num_rows($consusu)==0){
    echo "<table class='Tbl0'><tr><td class='Td1' align='center'>Usuario NO Encontrado</td></tr></table>";}
else{
    $rowusu=mysql_fetch_array($consusu);
}
$fechoc_rec=cambiafechadmy($rowusu[fechoc_rec]);
include('fac_5captufurips.php');

$consveh="SELECT * FROM fr_vehiculo WHERE iden_rec='$_SESSION[iden_rec]'";
$consveh=mysql_query($consveh);
$rowveh=mysql_fetch_array($consveh);
$finipol_veh=cambiafechadmy($rowveh[finipol_veh]);
$ffinpol_veh=cambiafechadmy($rowveh[ffinpol_veh]);

$conspro="SELECT tdoc_pro,ndoc_pro,pape_pro,sape_pro,pnom_pro,snom_pro,dire_pro,tele_pro,mres_pro,
nomb_mun
FROM fr_propietario 
INNER JOIN municipio ON codi_mun=mres_pro
WHERE iden_rec='$_SESSION[iden_rec]'";
$conspro=mysql_query($conspro);
$rowpro=mysql_fetch_array($conspro);

$conscdtor="SELECT pape_con,sape_con,pnom_con,snom_con,tdoc_con,ndoc_con,dire_con,muni_con,tele_con,nomb_mun
FROM fr_conductor
INNER JOIN municipio ON codi_mun=muni_con
WHERE iden_rec='$_SESSION[iden_rec]'";
$conscdtor=mysql_query($conscdtor);
$rowcdtor=mysql_fetch_array($conscdtor);

$consrem="SELECT tipo_rem,fech_rem,hsal_rem,nomb_rem,cargo_rem,ipsrec_rem,direips_rem,fing_rem,hing_rem,nomrec_rem,carrec_rem,munrec_rem,nomb_mun
FROM fr_remision
INNER JOIN municipio ON codi_mun=munrec_rem
WHERE iden_rec='$_SESSION[iden_rec]'";
$consrem=mysql_query($consrem);
$rowrem=mysql_fetch_array($consrem);
$fech_rem=cambiafechadmy($rowrem[fech_rem]);
$fing_rem=cambiafechadmy($rowrem[fing_rem]);

$constra="SELECT tdoc_tra,ndoc_tra,pape_tra,sape_tra,pnom_tra,snom_tra,placa_tra,recini_tra,recfin_tra,tipser_tra,zona_tra
FROM fr_transporte
WHERE iden_rec='$_SESSION[iden_rec]'";
$constra=mysql_query($constra);
$rowtra=mysql_fetch_array($constra);


$consate="SELECT aten.fecing_ate,aten.horing_ate,aten.fecsal_ate,aten.horsa_ate,aten.diapri_ate,aten.diaas1_ate,aten.diaas2_ate,aten.dxprieg_ate,aten.dxaseg1_ate,aten.dxaseg2_ate,aten.cod_medi,aten.totfac_ate,aten.totrec_ate,aten.totftra_ate,aten.totrtra_ate,aten.foli_ate,
med.nom_medi
FROM fr_atencion AS aten
INNER JOIN medicos AS med ON med.cod_medi=aten.cod_medi
WHERE iden_rec='$_SESSION[iden_rec]'";
$consate=mysql_query($consate);
$rowate=mysql_fetch_array($consate);
$fecing_ate=cambiafechadmy($rowate[fecing_ate]);
$fecsal_ate=cambiafechadmy($rowate[fecsal_ate]);
$desdiapri_ate=traenomcie($rowate[diapri_ate]);
$desdxprieg_ate=traenomcie($rowate[dxprieg_ate]);
$desdiaas1_ate=traenomcie($rowate[diaas1_ate]);
$desdxaseg1_ate=traenomcie($rowate[dxaseg1_ate]);
$desdiaas2_ate=traenomcie($rowate[diaas2_ate]);
$desdxaseg2_ate=traenomcie($rowate[dxaseg2_ate]);
?>
<script language="JavaScript">
    document.form1.resp_rec.value='<?php echo $rowusu[resp_rec]?>';
    document.form1.radant_rec.value='<?php echo $rowusu[radant_rec]?>';
    document.form1.fact_rec.value='<?php echo $rowusu[nume_fac]?>';
    document.form1.natu_rec.value='<?php echo $rowusu[natu_rec]?>';
    document.form1.desot_rec.value='<?php echo $rowusu[desot_rec]?>';
    document.form1.cond_rec.value='<?php echo $rowusu[cond_rec]?>';
    document.form1.direoc_rec.value='<?php echo $rowusu[direoc_rec]?>';
    document.form1.fechoc_rec.value='<?php echo $fechoc_rec?>';
    document.form1.horaoc_rec.value='<?php echo $rowusu[horaoc_rec]?>';
    document.form1.nommuni.value='<?php echo $rowusu[nomb_mun]?>';
    document.form1.munioc_rec.value='<?php echo $rowusu[munioc_rec]?>';
    document.form1.zonaoc_rec.value='<?php echo $rowusu[zonaoc_rec]?>';
    
    document.form1.estase_veh.value='<?php echo $rowveh[estase_veh]?>';
    document.form1.marca_veh.value='<?php echo $rowveh[marca_veh]?>';
    document.form1.placa_veh.value='<?php echo $rowveh[placa_veh]?>';
    document.form1.tipo_veh.value='<?php echo $rowveh[tipo_veh]?>';
    document.form1.codi_con.value='<?php echo $rowveh[codi_con]?>';
    document.form1.poliza_veh.value='<?php echo $rowveh[poliza_veh]?>';
    document.form1.finipol_veh.value='<?php echo $finipol_veh?>';
    document.form1.ffinpol_veh.value='<?php echo $ffinpol_veh?>';
    document.form1.inter_veh.value='<?php echo $rowveh[inter_veh]?>';
    document.form1.exced_veh.value='<?php echo $rowveh[exced_veh]?>';
    document.form1.placaseg_veh.value='<?php echo $rowveh[placaseg_veh]?>';
    document.form1.tdocseg_veh.value='<?php echo $rowveh[tdocseg_veh]?>';
    document.form1.ndocseg_veh.value='<?php echo $rowveh[ndocseg_veh]?>';
    document.form1.placater_veh.value='<?php echo $rowveh[placater_veh]?>';
    document.form1.tdocter_veh.value='<?php echo $rowveh[tdocter_veh]?>';
    document.form1.ndocter_veh.value='<?php echo $rowveh[ndocter_veh]?>';    
    
    document.form1.tdoc_pro.value='<?php echo $rowpro[tdoc_pro]?>';
    document.form1.ndoc_pro.value='<?php echo $rowpro[ndoc_pro]?>';
    document.form1.pape_pro.value='<?php echo $rowpro[pape_pro]?>';
    document.form1.sape_pro.value='<?php echo $rowpro[sape_pro]?>';
    document.form1.pnom_pro.value='<?php echo $rowpro[pnom_pro]?>';
    document.form1.snom_pro.value='<?php echo $rowpro[snom_pro]?>';
    document.form1.dire_pro.value='<?php echo $rowpro[dire_pro]?>';
    document.form1.tele_pro.value='<?php echo $rowpro[tele_pro]?>';
    document.form1.nommunpro.value='<?php echo $rowpro[nomb_mun]?>';
    document.form1.mres_pro.value='<?php echo $rowpro[mres_pro]?>';
    
    document.form1.pape_con.value='<?php echo $rowcdtor[pape_con]?>';
    document.form1.sape_con.value='<?php echo $rowcdtor[sape_con]?>';
    document.form1.pnom_con.value='<?php echo $rowcdtor[pnom_con]?>';
    document.form1.snom_con.value='<?php echo $rowcdtor[snom_con]?>';
    document.form1.tdoc_con.value='<?php echo $rowcdtor[tdoc_con]?>';
    document.form1.ndoc_con.value='<?php echo $rowcdtor[ndoc_con]?>';
    document.form1.dire_con.value='<?php echo $rowcdtor[dire_con]?>';
    document.form1.tele_con.value='<?php echo $rowcdtor[tele_con]?>';    
    document.form1.nommuncon.value='<?php echo $rowcdtor[nomb_mun]?>';
    document.form1.muni_con.value='<?php echo $rowcdtor[muni_con]?>';
    
    document.form1.tipo_rem.value='<?php echo $rowrem[tipo_rem]?>';
    document.form1.fech_rem.value='<?php echo $fech_rem?>';
    document.form1.hsal_rem.value='<?php echo $rowrem[hsal_rem]?>';
    document.form1.nomb_rem.value='<?php echo $rowrem[nomb_rem]?>';
    document.form1.cargo_rem.value='<?php echo $rowrem[cargo_rem]?>';
    document.form1.ipsrec_rem.value='<?php echo $rowrem[ipsrec_rem]?>';
    document.form1.direips_rem.value='<?php echo $rowrem[direips_rem]?>';
    document.form1.fing_rem.value='<?php echo $fing_rem?>';
    document.form1.hing_rem.value='<?php echo $rowrem[hing_rem]?>';
    document.form1.nomrec_rem.value='<?php echo $rowrem[nomrec_rem]?>';
    document.form1.carrec_rem.value='<?php echo $rowrem[carrec_rem]?>';
    document.form1.nommunrec.value='<?php echo $rowrem[nomb_mun]?>';
    document.form1.munrec_rem.value='<?php echo $rowrem[munrec_rem]?>';
    
    document.form1.tdoc_tra.value='<?php echo $rowtra[tdoc_tra]?>';
    document.form1.ndoc_tra.value='<?php echo $rowtra[ndoc_tra]?>';
    document.form1.pnom_tra.value='<?php echo $rowtra[pnom_tra]?>';
    document.form1.snom_tra.value='<?php echo $rowtra[snom_tra]?>';
    document.form1.pape_tra.value='<?php echo $rowtra[pape_tra]?>';
    document.form1.sape_tra.value='<?php echo $rowtra[sape_tra]?>';
    document.form1.placa_tra.value='<?php echo $rowtra[placa_tra]?>';
    document.form1.recini_tra.value='<?php echo $rowtra[recini_tra]?>';
    document.form1.recfin_tra.value='<?php echo $rowtra[recfin_tra]?>';
    document.form1.tipser_tra.value='<?php echo $rowtra[tipser_tra]?>';
    document.form1.zona_tra.value='<?php echo $rowtra[zona_tra]?>';
    
    document.form1.fecing_ate.value='<?php echo $fecing_ate?>';
    document.form1.horing_ate.value='<?php echo $rowate[horing_ate]?>';
    document.form1.fecsal_ate.value='<?php echo $fecsal_ate?>';
    document.form1.horsa_ate.value='<?php echo $rowate[horsa_ate]?>';
    document.form1.diapri_ate.value='<?php echo $rowate[diapri_ate]?>';
    document.form1.desdiapri_ate.value='<?php echo $desdiapri_ate?>';
    document.form1.dxprieg_ate.value='<?php echo $rowate[dxprieg_ate]?>';
    document.form1.desdxprieg_ate.value='<?php echo $desdxprieg_ate?>';
    document.form1.diaas1_ate.value='<?php echo $rowate[diaas1_ate]?>';
    document.form1.desdiaas1_ate.value='<?php echo $desdiaas1_ate?>';
    document.form1.dxaseg1_ate.value='<?php echo $rowate[dxaseg1_ate]?>';
    document.form1.desdxaseg1_ate.value='<?php echo $desdxaseg1_ate?>';
    document.form1.diaas2_ate.value='<?php echo $rowate[diaas2_ate]?>';
    document.form1.desdiaas2_ate.value='<?php echo $desdiaas2_ate?>';
    document.form1.dxaseg2_ate.value='<?php echo $rowate[dxaseg2_ate]?>';
    document.form1.desdxaseg2_ate.value='<?php echo $desdxaseg2_ate?>';
    document.form1.cod_medi.value='<?php echo $rowate[cod_medi]?>';
    document.form1.nomb_medi.value='<?php echo $rowate[nom_medi]?>';
    document.form1.totfac_ate.value='<?php echo $rowate[totfac_ate]?>';
    document.form1.totrec_ate.value='<?php echo $rowate[totrec_ate]?>';
    document.form1.totftra_ate.value='<?php echo $rowate[totftra_ate]?>';
    document.form1.totrtra_ate.value='<?php echo $rowate[totrtra_ate]?>';
    document.form1.foli_ate.value='<?php echo $rowate[foli_ate]?>';
</script>

<table class="Tbl0"><tr><td class="Td1" align='center'><a href="#" onclick="validar()"><img src="icons/feed_go.png">Siguiente</a></td></tr></table><br>
<?    
    mysql_free_result($consusu);
    mysql_free_result($consveh);
    mysql_free_result($conspro);
    mysql_free_result($conscdtor);
    mysql_free_result($consrem);
    mysql_free_result($constra);
    mysql_free_result($consate);
    mysql_close();
?>
</form>
</body>
</html>

