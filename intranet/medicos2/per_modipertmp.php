
<meta http-equiv="Context-Type" content="text/html; charset=ISO-8859-1">
<?php
session_start();
session_register('datos');
$datos[0]='codi_';
$datos[1]='nomb_';
?>
<html>
<head><title>Modifica Persona</title>

<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar(form){
    var error = "Para continuar, complete los siguientes campos:\n\n";
    var a = ""    
    if (form.tipo_iden.value == "") { a += "Tipo de Identificación\n"; }
    if (form.numer_iden.value == "") { a += "Número de Identificación\n"; }
    if (form.pnombre.value == "") { a += "Primer Nombre\n"; }
    if (form.papellido.value == "") { a += "Primer Apellido\n"; }
    if (form.fecha_nac.value == "") { a += "Fecha de Nacimiento\n"; }
    if (form.sexo.value == "") { a += "Sexo\n"; }
    if(document.form1.chkasistencial.checked){
        if (form.cod_medi.value == "") { a += "Codigo\n"; }
        if (form.are_medi.value == "") { a += "Cargo\n"; }
        if (form.reg_medi.value == "") { a += "Registro Medico\n"; }
        //if (form.areas_ar.value == "") { a += "Area\n"; }
        if (form.espe_med.value == "") { a += "Especialidad\n"; }
        if (form.csii_med.value == "") { a += "Codigo Siigo\n"; }
    }
    if(document.form1.chkocupacional.checked){
        if (form.etnia.value == "") { a += "Pertenencia Etnica\n"; }
        if (form.niveledu.value == "") { a += "Nivel Educativo\n"; }
        if (form.ocupa.value == "") { a += "Ocupacion\n"; }
        if (form.eciv.value == "") { a += "Estado Civil\n"; }        
    }

    if (a != ""){alert(error + a);return true;}
    document.form1.cod_medi.disabled=false;
    document.form1.action='per_guardamodpertmp.php';
    document.form1.submit()
}
function validasig(){
  form1.csii_med.value=(form1.cod_medi.value.substr(form1.cod_medi.value.length-4,4));
}
function recargar(){
    document.form1.submit();
}
function activa_asistencial(){    
    if(document.form1.chkasistencial.checked){
        document.form1.cod_medi.disabled=false;
        document.form1.are_medi.disabled=false;
        document.form1.reg_medi.disabled=false;
        //document.form1.areas_ar.disabled=false;
        document.form1.espe_med.disabled=false;
        document.form1.csii_med.disabled=false;
    }
    else{
        document.form1.cod_medi.disabled=true;
        document.form1.are_medi.disabled=true;
        document.form1.reg_medi.disabled=true;
        //document.form1.areas_ar.disabled=true;
        document.form1.espe_med.disabled=true;
        document.form1.csii_med.disabled=true;
    }
}
function activa_ocupacional(){    
    if(document.form1.chkocupacional.checked){        
        document.form1.etnia.disabled=false;
        document.form1.niveledu.disabled=false;
        document.form1.ocupa.disabled=false;
        document.form1.eciv.disabled=false;
    }
    else{
        document.form1.etnia.disabled=true;
        document.form1.niveledu.disabled=true;
        document.form1.ocupa.disabled=true;
        document.form1.eciv.disabled=true;
    }
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
    $("#course").autocomplete("../ryc/ryc_autocompciuo.php", {
        width: 500,
        matchContains: true,
        mustMatch: true,
        selectFirst: false
    });
    $("#course").result(function(event, data, formatted) {
        $("#course_val").val(data[1]);
    });
        
});
</script>
</head>
<body >

<form method="POST" name="form1" action="per_modipertmp.php"><br>
<!--per_guardaper.php-->
<?
//Conexion con la base
include ('php/conexion.php');
?>
  <center><h2>Modifica Datos de la Persona</h2></center>
<?php
$pnombre='';
$snombre='';
$papellido='';
$sapellido='';
$fecha_nac='';
$sexo='';
$direccion='';
$telefono='';
$email='';
$hemoclasif='';
$etnia='';
$niveledu='';
$ocupa='';
$eciv='';
$disponible='';
$mensaje='';
if(!empty($numer_iden)){
    $consulta="SELECT id_persona FROM persona WHERE tipo_iden='$tipo_iden' AND numer_iden='$numer_iden' AND id_persona!='$id_persona'";
    //echo "<br>".$consulta;
    $consulta=mysql_query($consulta);
    if(mysql_num_rows($consulta)<>0){
        $mensaje="La identificación ".$tipo_iden." ".$numer_iden." Corresponde a otra persona";
        $disponible='disabled';
    }    
}
if(!empty($id_persona)){
    $consulta="SELECT id_persona,tipo_iden,numer_iden,pnombre,snombre,papellido,sapellido,fecha_nac,direccion,telefono,sexo,email,hemoclasif FROM persona WHERE id_persona='$id_persona'";
    //echo "<br>".$consulta;
    $consulta=mysql_query($consulta);    
    if(mysql_num_rows($consulta)>0){
        $row=mysql_fetch_array($consulta);
        if(empty($tipo_iden)){$tipo_iden=$row[tipo_iden];}
        if(empty($numer_iden)){$numer_iden=$row[numer_iden];}
        $pnombre=$row[pnombre];
        $snombre=$row[snombre];
        $papellido=$row[papellido];
        $sapellido=$row[sapellido];
        $fecha_nac=$row[fecha_nac];
        $direccion=$row[direccion];
        $telefono=$row[telefono];
        $sexo=$row[sexo];
        $email=$row[email];
        $hemoclasif=$row[hemoclasif];
    }
}
//$consulta="SELECT cod_medi,are_medi,reg_medi,espe_med,csii_med FROM medicos WHERE tido_medi='$tipo_iden' AND ced_medi='$numer_iden'";
if($chkasistencial!='on'){
    $consulta="SELECT cod_medi,are_medi,reg_medi,espe_med,csii_med FROM medicos WHERE ced_medi='".SUBSTR($numer_iden,0,10)."'";
    //echo "<br>".$consulta;
    $consulta=mysql_query($consulta);    
    if(mysql_num_rows($consulta)>0){
        $row=mysql_fetch_array($consulta);            
        $cod_medi=$row[cod_medi];
        $are_medi=$row[are_medi];    
        $reg_medi=$row[reg_medi];
        $espe_med=$row[espe_med];
        $csii_med=$row[csii_med];
    }
}
if(!empty($codi_usu)){
    $consulta="SELECT CODI_USU,ETNI_USU,NEDU_USU,OCUP_USU,ECIV_USU FROM usuario WHERE CODI_USU='$codi_usu'";
}
else{
    $consulta="SELECT CODI_USU,ETNI_USU,NEDU_USU,OCUP_USU,ECIV_USU FROM usuario WHERE TDOC_USU='$tipo_iden' AND NROD_USU='$numer_iden'";
}
//echo "<br>".$consulta;
$consulta=mysql_query($consulta);    
if(mysql_num_rows($consulta)>0){
    $row=mysql_fetch_array($consulta);
    $codi_usu=$row[CODI_USU];
    $etnia=$row[ETNI_USU];
    $niveledu=$row[NEDU_USU];
    //$ocupa=$row[OCUP_USU];
    $codigo_ciuo=$row[OCUP_USU];
    $eciv=$row[ECIV_USU];
    
    $consact="SELECT codigo_ciuo,descri_ciuo FROM ciuo WHERE codigo_ciuo='$codigo_ciuo'";
    //echo "<br>".$consact;
    $consact=mysql_query($consact);
    if(mysql_num_rows($consact)<>0){
        $rowocu=mysql_fetch_array($consact);
        $ocupa=$rowocu[descri_ciuo];
        //echo "<br>".$ocupa;
    }
}

require('per_capturatmp.php');
echo "<br>";
require('per_capturaotdatostmp.php');
echo "<input type='hidden' name='id_persona' value='$id_persona'/>";
echo "<input type='hidden' name='codi_usu' value='$codi_usu'/>";
?>
<center><?php echo $mensaje;?></center>
<br>
<center><input type="button" name="btnnuevo" value="Guardar" onclick="validar(this.form)" <?php echo $disponible;?>></center>
</center>

<script language='JavaScript'>    
    document.form1.tipo_iden.value='<?php echo $tipo_iden;?>'
    document.form1.numer_iden.value='<?php echo $numer_iden;?>'
    document.form1.pnombre.value='<?php echo $pnombre;?>'
    document.form1.snombre.value='<?php echo $snombre;?>'
    document.form1.papellido.value='<?php echo $papellido;?>'
    document.form1.sapellido.value='<?php echo $sapellido;?>'
    document.form1.fecha_nac.value='<?php echo $fecha_nac;?>'
    document.form1.sexo.value='<?php echo $sexo;?>'
    document.form1.direccion.value='<?php echo $direccion;?>'
    document.form1.telefono.value='<?php echo $telefono;?>'
    document.form1.email.value='<?php echo $email;?>'
    document.form1.hemoclasif.value='<?php echo $hemoclasif;?>'

    document.form1.cod_medi.value='<?php echo $cod_medi;?>'
    document.form1.are_medi.value='<?php echo $are_medi;?>'
    document.form1.reg_medi.value='<?php echo $reg_medi;?>'
    //document.form1.areas_ar.value='<?php echo $areas_ar;?>'
    document.form1.espe_med.value='<?php echo $espe_med;?>'
    document.form1.csii_med.value='<?php echo $csii_med;?>'

    document.form1.cod_medi.disabled=true;
    document.form1.are_medi.disabled=true;
    document.form1.reg_medi.disabled=true;
    document.form1.areas_ar.disabled=true;
    document.form1.espe_med.disabled=true;
    document.form1.csii_med.disabled=true;

    document.form1.etnia.value='<?php echo $etnia;?>'
    document.form1.niveledu.value='<?php echo $niveledu;?>'
    document.form1.codigo_ciuo.value='<?php echo $codigo_ciuo;?>'
    document.form1.ocupa.value='<?php echo $ocupa;?>'
    document.form1.eciv.value='<?php echo $eciv;?>'

    if(document.form1.numer_iden.value!=''){document.form1.pnombre.focus();}
    
    document.form1.etnia.disabled=true;
    document.form1.niveledu.disabled=true;
    document.form1.ocupa.disabled=true;
    document.form1.eciv.disabled=true;
</script>
<?php
if($chkasistencial=='on'){
    ?>
    <script language='JavaScript'>
    document.form1.cod_medi.disabled=false;
    document.form1.are_medi.disabled=false;
    document.form1.reg_medi.disabled=false;
    document.form1.espe_med.disabled=false;
    document.form1.csii_med.disabled=false;
    document.form1.chkasistencial.checked = true;
    </script>
    <?php
}
?>

</form>
</body>
</html><html><head></head><body></body></html>