<?php
session_start();
session_register('datos');
$datos[0]='codi_';
$datos[1]='nomb_';

?>
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
    <!--<meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>-->
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
    <title>Consulta de Terapia Fisica</title>
<script languaje="javascript">

function validar(){
    error='';
    var orden = parseInt(document.getElementById("numero_orden_this").value);
    
    if(isNaN(orden)){
        error+="La orden debe ser un número\n";
    }
    
    //if(document.form1.numero_orden_this.value==''){error+="Número de Orden\n";}    
    if(document.form1.servrem_.value==''){error+="Servicio que Remite\n";}
    if(document.form1.enfact_.value==''){error+="Enfermedad Actual\n";}
    if(document.form1.estfis_.value==''){error+="Estado Físico\n";}
    if(document.form1.dxprinc_.value==''){error+="Diagnóstico Principal\n";}
    if(document.form1.tpdxpr_.value==''){error+="Tipo de Dx Principal\n";}
    if(document.form1.cexter_.value==''){error+="Causa Externa\n";}
    if(document.form1.ambit_.value==''){error+="Ambito\n";}
    if(document.form1.sesion_.value==''){error+="Numero de Sesiones\n";}
    if(document.form1.tipoterapia_.value==''){error+="Tipo de Terapia\n";}    
    if(error!=''){
        alert("Para continuar debe completar la siguiente información\n"+error);
        return(false);
    }
    enviarDatos(); 
    //document.form1.submit();
}

function enviarDatos() {
    //Aqui se muestra la ventana modal de espera para guardar el registro
    modalEspera.style.display = "block";
    document.getElementById("msjGuardar").innerHTML="Guardando el registro...";
    
    var servrem_ = document.getElementById("servrem_").value;
    var medrem_ = "";
    var enfact_ = document.getElementById("enfact_").value;
    var estfis_ = document.getElementById("estfis_").value;
    var dxprinc_ = document.getElementById("course_val").value;
    var tpdxpr_ = document.getElementById("tpdxpr_").value;
    var cexter_ = document.getElementById("cexter_").value;
    var ambit_ = document.getElementById("ambit_").value;
    var calhum_ = document.getElementById("calhum_").checked ? 'S' : 'N';
    var crioter_ = document.getElementById("crioter_").checked ? 'S' : 'N';
    var contras_ = document.getElementById("contras_").checked ? 'S' : 'N';
    var ultraso_ = document.getElementById("ultraso_").checked ? 'S' : 'N';
    var estrasc_ = document.getElementById("estrasc_").checked ? 'S' : 'N';
    var msedat_ = document.getElementById("msedat_").checked ? 'S' : 'N';
    var mdesco_ = document.getElementById("mdesco_").checked ? 'S' : 'N';
    var pcasero_ = document.getElementById("pcasero_").checked ? 'S' : 'N';
    var tecnic_ = document.getElementById("tecnic_").value;
    var sesion_ = document.getElementById("sesion_").value;
    var numero_orden_this = document.getElementById("numero_orden_this").value;
    var tipoterapia_ = document.getElementById("tipoterapia_").value;

    var dxrel1_ = document.getElementById("course_val2").value;
    var dxrel2_ = document.getElementById("course_val3").value;
    var dxrel3_ = document.getElementById("course_val4").value;        

    $.ajax({
        url: 'ter_guarda_ptf.php',
        type: 'POST',
        data: {
            servrem_: servrem_,
            medrem_: "",
            enfact_: enfact_,
            estfis_: estfis_,
            dxprinc_: dxprinc_,
            tpdxpr_: tpdxpr_,
            cexter_: cexter_,
            ambit_: ambit_,
            calhum_: calhum_,
            crioter_: crioter_,
            contras_: contras_,
            ultraso_: ultraso_,
            estrasc_: estrasc_,
            msedat_: msedat_,
            mdesco_: mdesco_,
            pcasero_: pcasero_,
            tecnic_: tecnic_,
            sesion_: sesion_,
            numero_orden_this: numero_orden_this,
            tipoterapia_: tipoterapia_,
            dxrel1_: dxrel1_,
            dxrel2_: dxrel2_,
            dxrel3_: dxrel3_
        },
        success: function(response) {            
            // Acceder a los datos de la respuesta
            var parsedResponse = JSON.parse(response);
            var mensaje = parsedResponse.mensaje;             
            var codigo = parsedResponse.codigo;            
            document.getElementById("msjGuardar").innerHTML=mensaje;            

            if(codigo==1){
                botonAceptar.classList.remove('hidden');
                botonAceptar.href = "ter_citados.php";
                botonAceptar.target = "fr02";
                //Aqui se oculta la ventana modal de espera
                //modalEspera.style.display = "none";                
            }
            else{
                botonAceptar.classList.remove('hidden');
                botonAceptar.href = "#";
                botonAceptar.onclick = function() {
                    modalEspera.style.display = "none";
                    botonAceptar.classList.add('hidden');
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error: " + textStatus + " " + errorThrown);
        }
    });
}


function trae_cie(varcodigo,varnombre){
    
    codigo_cie=document.getElementById(varcodigo).value;    

    $.ajax({
        url: 'ter_consultacie.php',
        type: 'POST',
        data: {
            codigo_cie: codigo_cie
        },
        success: function(response) {            
            // Acceder a los datos de la respuesta
            var nombre_cie = response;
            //document.getElementById("course").value=nombre_cie;
            document.getElementById(varnombre).value=nombre_cie;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Error: " + textStatus + " " + errorThrown);
        }
    });
}

function cerrar(){    
    modalInfo.style.display = "none";
}

function confirmar(){    
    modalInfo.style.display = "block";
}
</script>

<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	
	$("#course").autocomplete("ter_autocompcie.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);
	});

	$("#course2").autocomplete("ter_autocompcie.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course2").result(function(event, data, formatted) {
		$("#course_val2").val(data[1]);
	});
	
	$("#course3").autocomplete("ter_autocompcie.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course3").result(function(event, data, formatted) {
		$("#course_val3").val(data[1]);
	});	
	
	$("#course4").autocomplete("ter_autocompcie.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course4").result(function(event, data, formatted) {
		$("#course_val4").val(data[1]);
	});        
    	
});
</script>

</head>
<body>
<form name="form1" method="post">
    <?php
    include('php/conexion.php');
    include('php/funciones.php');
    ?>
    <center><h3><font color='#A60C63'>CONSULTA DE TERAPIA FISICA</font></h3></center>
    <?php
    include('datos_usu.php');

    $consultater="SELECT iden_this FROM ter_historia WHERE codi_usu='$codi_usu' and esta_this='A'";
    //echo $consultater;
    $consultater=mysql_query($consultater);
    $terapias_abiertas = mysql_num_rows($consultater);    
    ?>
    
    <table border="0" width='100%'>
        <tr>
            <td align="right">Número de Orden:</td>
            <td align="left"><input type='text' id='numero_orden_this' name='numero_orden_this' value='<?php echo $numero_orden_this;?>' size='7' maxlength='7'></td>
        </tr>
        <tr>
            <td align="right">Del Servicio:</td>
            <td align="left"><select name="servrem_" id="servrem_">
                    <option value=""></option>
                    <?php
                    $consulta="SELECT codi_des,nomb_des FROM destipos WHERE codt_des='06' ORDER BY nomb_des";
                    $consulta=mysql_query($consulta);
                    while($row=mysql_fetch_array($consulta)){
                        echo "<option value='$row[codi_des]'>$row[nomb_des]</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">Resumen de Enfermedad Actual:</td>
            <td align="left" colspan="5">
                <textarea name="enfact_" id="enfact_" cols="100" rows="4"><?php echo $enfact_;?></textarea>
            </td>
        </tr>
        <tr>
            <td align="right">Estado Fisico(Datos Positivos):</td>
            <td align="left" colspan="5">
                <textarea name="estfis_" id="estfis_" cols="100" rows="4"><?php echo $estfis_;?></textarea>
            </td>
        </tr>
    </table>
    
    <table border="0" width='100%'>
        <tr>
            <td align="left" colspan="5">Impresión Diagnóstica:</td>
        </tr>
        <tr>
            <td align="right" width="2%">1</td>
            <td align="left" width="8%"><input type='text' id='course_val' name='dxprinc_' value='<?echo $dxprinc_;?>' size='4' maxlength='4' onblur="trae_cie('course_val','course')"></td>
            <td align="left" width="55%"><input type="text" id='course' class='texto' name="descdxpr" value="<?echo $descdxpr;?>" size="70" maxlength="70"></td>
            <td align="right" width="5%">Tipo:</td>
            <td align="left" width="30%">
                <select name="tpdxpr_" id="tpdxpr_">
                    <option value=""></option>
                    <option value="1">Impresión Diagnóstica</option>
                    <option value="2">Confirmado Nuevo</option>
                    <option value="3">Confirmado Repetido</option>
                </select>
            </td>
        </tr>    
        <tr>
            <td align="right">2</td>
            <td align="left"><input type='text' id='course_val2' name='dxrel1_' value='<?echo $dxrel1_;?>' size='4' maxlength='4' onblur="trae_cie('course_val2','course2')"></td>
            <td align="left"><input type="text" id='course2' class='texto' name="descdxr1" value="<?echo $descdxr1;?>" size="70" maxlength="70"></td>
        </tr>
        <tr>
            <td align="right">3</td>
            <td align="left"><input type='text' id='course_val3' name='dxrel2_' value='<?echo $dxrel2_;?>' size='4' maxlength='4' onblur="trae_cie('course_val3','course3')"></td>
            <td align="left"><input type="text" id='course3' class='texto' name="descdxr2" value="<?echo $descdxr2;?>" size="70" maxlength="70"></td>
        </tr>
        <tr>
            <td align="right">4</td>
            <td align="left"><input type='text' id='course_val4' name='dxrel3_' value='<?echo $dxrel3_;?>' size='4' maxlength='4' onblur="trae_cie('course_val4','course4')"></td>
            <td align="left"><input type="text" id='course4' class='texto' name="descdxr3" value="<?echo $descdxr3;?>" size="70" maxlength="70"></td>
        </tr>
    </table>
    <table border="0" width='100%'>
        <tr>
            <td align="right">Causa Externa</td>
            <td align="left">
                <select name="cexter_" id="cexter_">
                    <option value=""></option>
                    <?
                    $consulta="SELECT codi_des,nomb_des FROM destipos WHERE codt_des='12'";
                    $consulta=mysql_query($consulta);
                    while($row=mysql_fetch_array($consulta)){
                        echo "<option value='$row[codi_des]'>$row[nomb_des]</option>";
                    }
                    ?>
                </select>
            </td>
            <td align="right">Ambito</td>
            <td align="left">
                <select name="ambit_" id="ambit_">
                    <option value=""></option>
                    <option value='1'>Ambulatorio</option>
                    <option value='2'>Hospitalario</option>
                    <option value='3'>Urgencias</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">Tipo de terapia</td>            
            <td align="left">
                <select name="tipoterapia_" id="tipoterapia_">
                    <option value=""></option>
                    <?php
                        $consulta="SELECT codi_des,nomb_des FROM destipos WHERE codt_des='HC' ORDER BY nomb_des";
                        $consulta=mysql_query($consulta);
                        while($row=mysql_fetch_array($consulta)){
                            echo "<option value='$row[codi_des]'>$row[nomb_des]</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <br>
    <table class="table1">
        <tr>
            <td align="left" colspan="4">Conducta</td>
        </tr>
        <tr>
            <td align="right">1 Modalidades Físicas Convencionales:</td>
            <td align="left"><input type="checkbox" name="calhum_" id="calhum_" value="S">Calor Húmedo</td>
            <td align="left"><input type="checkbox" name="crioter_" id="crioter_" value="S">Crioterapia</td>
            <td align="left"><input type="checkbox" name="contras_" id="contras_" value="S">Contraste</td>
        </tr>
        <tr>
            <td align="right">2 Ultrasonido:</td>
            <td align="left"><input type="checkbox" name="ultraso_" id="ultraso_" value="S"></td>
        </tr>
        <tr>
            <td align="right">3 Estimulación Nerviosa Transcutánea:</td>
            <td align="left"><input type="checkbox" name="estrasc_" id="estrasc_" value="S"></td>
        </tr>
        <tr>
            <td align="right">4 Masaje:</td>
            <td align="left"><input type="checkbox" name="msedat_" id="msedat_" value="S">Sedativo</td>
            <td align="left"><input type="checkbox" name="mdesco_" id="mdesco_" value="S">Descontracturante</td>
        </tr>
        <tr>
            <td align="right">5 Plan Casero:</td>
            <td align="left"><input type="checkbox" name="pcasero_" id="pcasero_" value="S"></td>
        </tr>
        <tr>
            <td align="right">6 Técnicas Específicas:</td>
            <td align="left" colspan="3">
                <textarea name="tecnic_" id="tecnic_" cols="100" rows="4"><?php echo $tecnic_;?></textarea> 
            </td>
        </tr>
        <tr>
            <td align="right">Número de Sesiones:</td>
            <td align="left">
                <input type='number' id='sesion_' name='sesion_'  min="1" max="30" step="1">                
            </td>
        </tr>
    </table>

    <script language="JavaScript">
    document.form1.servrem_.value="<?php echo $servrem_;?>";
    document.form1.cexter_.value="<?php echo $cexter_;?>";
    document.form1.ambit_.value="<?php echo $ambit_;?>";
    document.form1.sesion_.value="<?php echo $sesion_;?>";
    document.form1.tpdxpr_.value="<?php echo $tpdxpr_;?>";
    </script>
    <?php
    if($calhum_=="S"){
        echo "<script languaje='JavaScript'>document.form1.calhum_.checked=true</script>";
    }
    if($crioter_=="S"){
        echo "<script languaje='JavaScript'>document.form1.crioter_.checked=true</script>";
    }
    if($contras_=="S"){
        echo "<script languaje='JavaScript'>document.form1.contras_.checked=true</script>";
    }
    if($ultraso_=="S"){
        echo "<script languaje='JavaScript'>document.form1.ultraso_.checked=true</script>";
    }
    if($estrasc_=="S"){
        echo "<script languaje='JavaScript'>document.form1.estrasc_.checked=true</script>";
    }
    if($msedat_=="S"){
        echo "<script languaje='JavaScript'>document.form1.msedat_.checked=true</script>";
    }
    if($mdesco_=="S"){
        echo "<script languaje='JavaScript'>document.form1.mdesco_.checked=true</script>";
    }
    if($pcasero_=="S"){
        echo "<script languaje='JavaScript'>document.form1.pcasero_.checked=true</script>";
    }
    if(!empty($dxprinc_)){
        $desccie=buscacie($dxprinc_);        
        echo "<script languaje='JavaScript'>document.form1.descdxpr.value='$desccie'</script>";
    }
    if(!empty($dxrel1_)){
        $descdxr1=buscacie($dxrel1_);        
        echo "<script languaje='JavaScript'>document.form1.descdxr1.value='$descdxr1'</script>";
    }
    if(!empty($dxrel2_)){
        $descdxr2=buscacie($dxrel2_);        
        echo "<script languaje='JavaScript'>document.form1.descdxr2.value='$descdxr2'</script>";
    }
    if(!empty($dxrel3_)){
        $descdxr3=buscacie($dxrel3_);        
        echo "<script languaje='JavaScript'>document.form1.descdxr3.value='$descdxr3'</script>";
    }
    
    
    
    ?>
    
    <!--<input type="hidden" name="controlva" value="0">
    <input type="hidden" name="controlviene" value="0">-->
    <table border="0" width="50%">
        <tr>
            <td><a href="#" onclick="validar()" class='btn'>Guardar</a></td>
            <td><a href="ter_citados.php" target='fr02' class='btn'>Salir</a></td>
        </tr>
    </table>
</form>

<div id="modalInfo" class="modal">
    <div class="modal-content">
        <!--<span class="close">&times;</span>-->
        <p>El usuario ya ha tiene una o más hitorias abiertas</p>
        <p>Si desea crear una nueva historia de primera vez, pulse el botón Nueva Historia</p>
        <p>Si desea realizar la historia de control, pulse el botón Historia de Control</p>
        <p>Si desea regresar a la lista de pacientes, pulse el botón Cerrar</p>
        <center>
        <a class="btn" title="Continúa con la creación de la historia de primera vez" href="#" onclick="cerrar()">Nueva Historia</a>
        <a class="btn" title="Ir a la historia de control" href="ter_cap_controltf.php">Historia de Control</a>
        <a class="btn" title="Ir a la lista de pacientes" href="ter_citados.php" target='fr02'" onclick="cerrar()">Cerrar</a>
        </center>        
    </div>
</div>

<div id="modalEspera" class="modalEspera">
    <br><br>
    <i id="msjGuardar"></i> 
    <br><br>    
    <a href="#" id='btnAceptar' class="btn">Aceptar</a>    
</div>

</body>
</html>

<?php
function buscacie($codi_){
    $consultacie_=mysql_query("SELECT nom_cie10 FROM cie_10 WHERE cod_cie10='$codi_'");
    if(mysql_num_rows($consultacie_)<>0){
        $rowcie_=mysql_fetch_array($consultacie_);
        $desc_=$rowcie_[nom_cie10];
    }
    ///mysql_free_result($consultacie_);
    return($desc_);
}

if($terapias_abiertas>0){
    ?>
        <script>confirmar();</script>
    <?php
}
?>

<script lang='JavaScript'>    
    // Obtener el modal
    var modal = document.getElementById("modalInfo");
    //modal.style.display = "block";

    // Obtener el botón que abre el modal
    //var btn = document.getElementById("myBtn");

    // Obtener el elemento <span> que cierra el modal
    var span = document.getElementsByClassName("close")[0];

    // Cuando el usuario hace clic en el botón, abre el modal
    /*btn.onclick = function() {    
        modal.style.display = "block";
    }*/

    // Cuando el usuario hace clic en <span> (x), cierra el modal
    /*span.onclick = function() {
        modal.style.display = "none";
    }*/

    // Cuando el usuario hace clic fuera del modal, lo cierra
    /*window.onclick = function(event) {        
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }*/

    modalEspera=document.getElementById("modalEspera");
    modalEspera.style.display = "none";

    var botonAceptar = document.getElementById('btnAceptar');
    botonAceptar.classList.add('hidden');
</script>