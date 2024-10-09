
<meta http-equiv="Context-Type" content="text/html; charset=UTF-8">
<?php
session_start();
session_register('datos');
$datos[0]='codi_';
$datos[1]='nomb_';
?>
<html>
<head><title>Nueva Persona</title>

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
        if (form.areas_ar.value == "") { a += "Area\n"; }
        if (form.espe_med.value == "") { a += "Especialidad\n"; }
        if (form.csii_med.value == "") { a += "Codigo Siigo\n"; }
    }
    /*if(document.form1.chkasistencial.checked){
        if (form.cod_medi.value == "") { a += "Codigo\n"; }
        if (form.are_medi.value == "") { a += "Cargo\n"; }
        if (form.reg_medi.value == "") { a += "Registro Medico\n"; }
        if (form.areas_ar.value == "") { a += "Area\n"; }
        if (form.espe_med.value == "") { a += "Especialidad\n"; }
        if (form.csii_med.value == "") { a += "Codigo Siigo\n"; }
    }*/
    if(document.form1.chkocupacional.checked){
        if (form.etnia.value == "") { a += "Pertenencia Etnica\n"; }
        if (form.niveledu.value == "") { a += "Nivel Educativo\n"; }
        if (form.ocupa.value == "") { a += "Ocupacion\n"; }
        if (form.eciv.value == "") { a += "Estado Civil\n"; }        
    }

    if (a != ""){alert(error + a);return true;}
    document.form1.action='per_guardapertmp.php';
    document.form1.submit()
}
function validasig(){
  form1.csii_med.value=(form1.cod_medi.value.substr(form1.cod_medi.value.length-4,4));
}
function recargar(){
    document.form1.submit();
}
function activa_asistencial(){    
    if(document.form1.chkasistencial.checked==true){
        document.form1.cod_medi.disabled=false;
        document.form1.are_medi.disabled=false;
        document.form1.reg_medi.disabled=false;
        document.form1.areas_ar.disabled=false;
        document.form1.espe_med.disabled=false;
        document.form1.csii_med.disabled=false;        
    }
    else{
        document.form1.cod_medi.disabled=true;
        document.form1.are_medi.disabled=true;
        document.form1.reg_medi.disabled=true;
        document.form1.areas_ar.disabled=true;
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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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

<form method="POST" name="form1" action="per_nuevopertmp.php"><br>
<!--per_guardaper.php-->
<?
//Conexion con la base
include ('php/conexion.php');
?>
  <center><h2>Nueva Persona</h2></center>
<?php
$pnombre=$pnombre;
$snombre=$snombre;
$papellido=$papellido;
$sapellido=$sapellido;
$fecha_nac=$fecha_nac;
$sexo=$sexo;
$direccion=$direccion;
$telefono=$telefono;
$email=$email;
$hemoclasif=$hemoclasif;
$etnia=$etnia;
$niveledu=$niveledu;
$ocupa=$ocupa;
$eciv=$eciv;
$disponible='';
$mensaje='';
//echo $numer_iden;
//if(!empty($numer_iden)){
    $consulta="SELECT nrod_usu,pnom_usu,snom_usu,pape_usu,sape_usu,fnac_usu,sexo_usu,dire_usu,tres_usu,emai_usu,hemo_usu,etni_usu,nedu_usu,ocup_usu,eciv_usu FROM usuario WHERE tdoc_usu='$tipo_iden' AND nrod_usu='$numer_iden'";
    //echo "<br>".$consulta;
    $consulta=mysql_query($consulta);    
    if(mysql_num_rows($consulta)>0){
        $row=mysql_fetch_array($consulta);
        $pnombre=$row[pnom_usu];
        $snombre=$row[snom_usu];
        $papellido=$row[pape_usu];
        $sapellido=$row[sape_usu];
        $fecha_nac=$row[fnac_usu];
        $sexo=$row[sexo_usu];
        $direccion=$row[dire_usu];
        $telefono=$row[tres_usu];
        $email=$row[emai_usu];
        $hemoclasif=$row[hemo_usu];
        $etnia=$row[etni_usu];
        $niveledu=$row[nedu_usu];
        //$ocupa=$row[ocup_usu];
        $codigo_ciuo=$row[ocup_usu];
        $eciv=$row[eciv_usu];
        $consact="SELECT codigo_ciuo,descri_ciuo FROM ciuo WHERE codigo_ciuo='$codigo_ciuo'";
        //echo "<br>".$consact;
        $consact=mysql_query($consact);
        if(mysql_num_rows($consact)<>0){
            $rowocu=mysql_fetch_array($consact);
            $ocupa=$rowocu[descri_ciuo];
            //echo "<br>".$ocupa;
        }
    //}
    //else{
        $consulta="SELECT cod_medi,tido_medi,ced_medi,pnom_medi,snom_medi,pape_medi,sape_medi,dir__medi,telf_medi,are_medi,reg_medi,espe_med,csii_med FROM medicos WHERE tido_medi='$tipo_iden' AND ced_medi='$numer_iden'";
        //echo "<br>".$consulta;
        $consulta=mysql_query($consulta);    
        if(mysql_num_rows($consulta)>0){
            $row=mysql_fetch_array($consulta);
            $pnombre=$row[pnom_medi];
            $snombre=$row[snom_medi];
            $papellido=$row[pape_medi];
            $sapellido=$row[sape_medi];
            $fecha_nac='';
            $sexo='';
            $direccion=$row[dir__medi];
            $telefono=$row[telf_medi];
            $email='';
            $hemoclasif='';
            $etnia='';
            $niveledu='';
            $ocupa='';
            $eciv='';
            $cod_medi=$row[cod_medi];
            $are_medi=$row[are_medi];
            $reg_medi=$row[reg_medi];
            $espe_med=$row[espe_med];
            $csii_med=$row[csii_med];
        }
    //}
    $consulta="SELECT id_persona FROM persona WHERE tipo_iden='$tipo_iden' AND numer_iden='$numer_iden'";
    //echo "<br>".$consulta;
    $consulta=mysql_query($consulta);
    if(mysql_num_rows($consulta)<>0){
        $mensaje='La persona ya se encuentra registra';
        $disponible='disabled';
    }
}        

require('per_capturatmp.php');
echo "<br>";
require('per_capturaotdatostmp.php');

//Aqui valido que el codigo del medico no exista
if(!empty($cod_medi)){
    $sql="SELECT cod_medi FROM medicos WHERE cod_medi='$cod_medi'";
    //echo $sql;
    $sql=mysql_query($sql);
    if(mysql_num_rows($sql)<>0){
        echo "<br>El código del médico ya existe...";
    }
}
if(!empty($csii_med)){
    $sql="SELECT csii_med FROM medicos WHERE csii_med='$csii_med'";
    //echo $sql;
    $sql=mysql_query($sql);
    if(mysql_num_rows($sql)<>0){
        echo "<br>El SIIGO del médico ya existe...";
    }
}
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

    document.form1.etnia.value='<?php echo $etnia;?>'
    document.form1.niveledu.value='<?php echo $niveledu;?>'
    document.form1.ocupa.value='<?php echo $ocupa;?>'
    document.form1.eciv.value='<?php echo $eciv;?>'

    document.form1.cod_medi.value='<?php echo $cod_medi;?>'
    document.form1.are_medi.value='<?php echo $are_medi;?>'
    document.form1.reg_medi.value='<?php echo $reg_medi;?>'
    document.form1.espe_med.value='<?php echo $espe_med;?>'
    document.form1.areas_ar.value='<?php echo $areas_ar;?>'
    document.form1.csii_med.value='<?php echo $csii_med;?>'

    if(document.form1.numer_iden.value!=''){document.form1.pnombre.focus();}

    document.form1.cod_medi.disabled=true;
    document.form1.are_medi.disabled=true;
    document.form1.reg_medi.disabled=true;
    document.form1.areas_ar.disabled=true;
    document.form1.espe_med.disabled=true;
    document.form1.csii_med.disabled=true;
    document.form1.etnia.disabled=true;
    document.form1.niveledu.disabled=true;
    document.form1.ocupa.disabled=true;
    document.form1.eciv.disabled=true;
</script>

<?php
if($chkasistencial=='on'){    
    ?>
        <script language='JavaScript'>
            document.form1.chkasistencial.checked=true;
            activa_asistencial();
        </script>
    <?php
}
?>

</form>
</body>
</html><html><head></head><body></body></html>