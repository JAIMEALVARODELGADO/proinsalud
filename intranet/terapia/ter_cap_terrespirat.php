<?php
session_start();
session_register('datos');
$datos[0]='codi_';
$datos[1]='nomb_';
include('php/conexion.php');
include('php/funciones.php');
?>
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
    <meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
    <title>Consulta de Terapia Fisica</title>
<script languaje="javascript">
function validar(){
var error='';
    if(document.form1.tipo_=='1'){
        if(document.form1.antper_.value==''){error+="Antecedentes Personales\n";}
        if(document.form1.ayudxant_.value==''){error+="Ayudas Diagnosticas Anteriores\n";}
        if(document.form1.dxprinc_.value==''){error+="Diagnostico Principal\n";}
        if(document.form1.tpdxpr_.value==''){error+="Tipo de Diagnostico Principal\n";}
        if(document.form1.sesion_.value==''){error+="Numero de Sesiones\n";}
    }
    if(document.form1.cexter_.value==''){error+="Causa Externa\n";}
    if(document.form1.ambit_.value==''){error+="Ambito\n";}
    if(document.form1.fcard_.value==''){error+="Frecuencia Cardiaca\n";}
    if(document.form1.fres_.value==''){error+="Frecuencia Respiratoria\n";}
    if(document.form1.satur_.value==''){error+="Saturacion de Oxigeno\n";}
    if(document.form1.eval_.value==''){error+="Evaluacion\n";}
    if(document.form1.tratam_.value==''){error+="Tratamiento (CUPS)\n";}
    if(document.form1.resp_.value==''){error+="Respuesta al Tratamiento\n";}
    if(error!=''){
        alert("Para continuar debe completar la siguiente información\n"+error);
        return(false);
    }
    document.form1.submit();
}

</script>

<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	
	$("#course").autocomplete("ter_autocompcie.php", {
		width: 460,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);
	});

	$("#course2").autocomplete("ter_autocompcie.php", {
		width: 460,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course2").result(function(event, data, formatted) {
		$("#course_val2").val(data[1]);
	});
	
	$("#course3").autocomplete("ter_autocompcie.php", {
		width: 460,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course3").result(function(event, data, formatted) {
		$("#course_val3").val(data[1]);
	});	
	
	$("#course4").autocomplete("ter_autocompcie.php", {
		width: 460,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course4").result(function(event, data, formatted) {
		$("#course_val4").val(data[1]);
	});
        $("#course5").autocomplete("ter_autocompcup.php", {
		width: 460,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course5").result(function(event, data, formatted) {
		$("#course_val5").val(data[1]);
	});	
});
</script>

</head>
<body>
<form name="form1" method="post" action="ter_guarda_tresp.php">
    <center><h3><font color='#A60C63'>CONSULTA DE TERAPIA RESPIRATORIA</font></h3></center>
    <?php
    include('datos_usu.php');
    $tipo_='1';
    $constr="SELECT tres.iden_tre,tres.sesion_tre FROM tres_historia AS tres  
    WHERE tres.tipo_tre='1' AND tres.esta_tre='A' AND tres.codi_usu=
    (SELECT usu.codi_usu FROM usuario AS usu
    INNER JOIN citas AS cita ON cita.idusu_citas=usu.codi_usu
    WHERE id_cita='$_SESSION[id_cita]')";
    //echo $constr;
    $constr=mysql_query($constr);
    if(mysql_num_rows($constr)<>0){
        $rowtr=mysql_fetch_array($constr);
        $tipo_='2';
        $nter_=$rowtr[sesion_tre];
    }   
    
    if($tipo_=='1'){?> 
    <table border="0">
        <tr>
            <td align="right">Antecedentes Personales:</td>
            <td align="left" colspan="5">
                <textarea name="antper_" cols="100" rows="4"></textarea>
            </td>
        </tr>
    </table>
    <table border="0" width='100%'>
        <tr>
            <td align="right">Ayudas Diagnósticas Anteriores:</td>
            <td align="left"><select name="ayudxant_">
                    <option value=""></option>
                    <option value="S">Si</option>
                    <option value="N">No</option>
                    <option value="NA">No Aplica</option>
                </select>
            </td>
            <td align="left" colspan="5">
                <textarea name="descayu_" cols="85" rows="4"></textarea>
            </td>
        </tr>
    </table>
    
    <table border="0" width='100%'>
        <tr>
            <td align="left" colspan="5">Diagnóstico:</td>
        </tr>
        <tr>
            <td align="right">1</td>
            <td align="left"><input type="text" id='course_val' name="dxprinc_" size="4" maxlength="4" value="<?php echo $dxprinc_;?>"></td>
            <td align="left"><input type="text" id='course' class='texto' name="descdxpr" size="100" maxlength="100"></td>
            <td align="right">Tipo:</td>
            <td align="left"><select name="tpdxpr_">
                    <option value=""></option>
                    <option value="1">Impresión Diagnóstica</option>
                    <option value="2">Confirmado Nuevo</option>
                    <option value="3">Confirmado Repetido</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">2</td>
            <td align="left"><input type="text" id='course_val2' name="dxrela1_" size="4" maxlength="4"></td>
            <td align="left"><input type="text" id='course2' class='texto' name="descdxr1" size="100" maxlength="100"></td>
        </tr>
        <tr>
            <td align="right">3</td>
            <td align="left"><input type="text" id='course_val3' name="dxrela2_" size="4" maxlength="4"></td>
            <td align="left"><input type="text" id='course3' class='texto' name="descdxr2" size="100" maxlength="100"></td>
        </tr>
        <tr>
            <td align="right">4</td>
            <td align="left"><input type="text" id='course_val4' name="dxrela3_" size="4" maxlength="4"></td>
            <td align="left"><input type="text" id='course4' class='texto' name="descdxr3" size="100" maxlength="100"></td>
        </tr>
    </table>
    <?php
    }
    ?>
    <table border="0" width='100%'>
        <tr>
            <td align="right">Causa Externa</td>
            <td align="left">
                <select name="cexter_">
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
                <select name="ambit_">
                    <option value=""></option>
                    <option value='1'>Ambulatorio</option>
                    <option value='2'>Hospitalario</option>
                    <option value='3'>Urgencias</option>
                </select>
            </td>
            
        </tr>
    </table>
    <br>
    <table border="0" width='100%'>
        <tr>
            <td align="center" colspan="6">Exámen Físico Respiratorio</td>
        </tr>
        <tr>
            <td align="left">Frecuencia Cardiaca</td>
            <td align="left"><input type="text" name="fcard_" size="3" maxlength="3"></td>
            <td align="left">Frecuencia Respiratoria</td>
            <td align="left"><input type="text" name="fres_" size="3" maxlength="3"></td>
            <td align="left">Saturación de Oxígeno</td>
            <td align="left"><input type="text" name="satur_" size="3" maxlength="3">%</td>
        </tr>
        <tr>
            <td align="left" colspan="6">Evaluación     
                <br><textarea name="eval_" cols="100" rows="4"></textarea>
            </td>
        </tr>
    </table>
    <br>
    <table border="0" width='100%'>
        <tr>
            <td align="left" colspan="3">Tratamiento (CUPS)</td>
        </tr>
        <tr>
            <td align="right">1</td>
            <td align="left"><input type="hidden" id='course_val5' name="tratam_" size="8" maxlength="8"></td>
            <td align="left"><input type="text" id='course5' class='texto' name="desctrat" size="100" maxlength="100"></td>
        </tr>
        <tr>
            <td align="left" colspan="3">
                <textarea name="obse_" cols="100" rows="4"></textarea>
            </td>
        </tr>
        <?php
        if($tipo_=='1'){?>
        <tr>
            <td align="right" colspan="2">Nro de Sesiones:</td>
            <td align="left"><select name="sesion_">
                    <option value=""></option>
                    <option value="1">Sesión Unica</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td align="left" colspan="3">
                Respuesta al Tratamiento:<br>
                <textarea name="resp_" cols="100" rows="4"></textarea>
            </td>
        </tr>
    </table>
    
    
    <input type="hidden" name="tipo_" value="<?php echo $tipo_?>">
    <!--<input type="hidden" name="controlviene" value="0">-->
    <table border="0" width="50%">
        <tr>
            <td><a href="#" onclick="validar()">Guardar</a></td>
            <td><a href="ter_citados.php">Finalizar</a></td>
        </tr>
    </table>
</form>
</body>
</html>