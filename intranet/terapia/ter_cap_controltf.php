<?php
session_start();
session_register('datos');
$datos[0]='codi_';
$datos[1]='nomb_';
?>
<meta http-equiv="Context-Type" content="text/html; charset=UTF-8">
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
    <meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
    <title>EVOLUCION POR FISIOTERAPIA</title>
<script languaje="javascript">
function validar(){
    error='';
    if(document.form1.evolu_.value==''){error+="Evoluci�n\n";}
    if(document.form1.obser_.value==''){error+="Observaci�n\n";}
    if(document.form1.proced_.value==''){error+="Procedimiento\n";}
    if(error!=''){
        alert("Para continuar debe completar la siguiente informaci�n\n"+error);
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
	$("#course5").autocomplete("ter_autocompcup.php", {
		width: 460,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course5").result(function(event, data, formatted) {
		$("#course_val5").val(data[1]);
        $("#course_val6").val(data[2]);
	});	
});
</script>
</head>
<body>
<form name="form1" method="post" action="ter_guarda_ctf.php">
    <?php
    include('php/conexion.php');
    include('php/funciones.php');
    ?>
    <center><h3><font color='#A60C63'>EVOLUCION POR FISIOTERAPIA</font></h3></center>
    <?php
    include('datos_usu.php');
    ?>

    <table border="0" width='100%'>
        <tr>
            <td align="right">Evoluci�n:</td>
            <td align="left" colspan="5">
                <textarea name="evolu_" cols="100" rows="4"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right">Observaciones:</td>
            <td align="left" colspan="5">
                <textarea name="obser_" cols="100" rows="4"></textarea>
            </td>
        </tr>
    </table>
    <table border="0" width='100%'>
        <tr>
            <td align="left" colspan="5">Procedimiento (CUPS)</td>
        </tr>
        <tr>
            <td align="right">1</td>
            <td align="left">
                <input type='hidden' id='course_val5' name='proced_' value='<?echo $proced_;?>' size='8' maxlength='8'>                
            </td>
            <td align="left"><input type="text" id='course5' class='texto' name="descproc" value="<?echo $descproc;?>" size="100" maxlength="70"></td>
        </tr>
    </table>
    
    <!--<input type="hidden" name="controlva" value="0">
    <input type="hidden" name="controlviene" value="0">-->
    <table border="0" width="50%">
        <tr>
            <td><a href="#" onclick="validar()">Guardar</a></td>
            <td><a href="ter_citados.php" target='fr02'>Finalizar</a></td>
        </tr>
    </table>
</form>
</body>
</html><html><head></head><body></body></html>