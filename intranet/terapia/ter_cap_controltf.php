<?php
session_start();
session_register('datos');
$datos[0]='codi_';
$datos[1]='nomb_';
?>
<!--<meta http-equiv="Context-Type" content="text/html; charset=UTF-8">-->
<meta charset="UTF-8">
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
    <meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
    <title>EVOLUCION POR FISIOTERAPIA</title>
<script languaje="javascript">
function validar(){
    error='';
    if(document.form1.evolu_.value==''){error+="Evolución\n";}
    if(document.form1.obser_.value==''){error+="Observación\n";}
    if(document.form1.proced_.value==''){error+="Procedimiento\n";}    
    if(document.getElementById("fin_historia").checked === true && document.getElementById("resumen").value === ""){
        error+="Resumen de la historia \n";
    }
    var resumen = document.getElementById("resumen");    
    if (resumen.value.length > 500) {
        resumen.value = resumen.value.substring(0, 500);        
        error+="El Resumen de la historia no puede superar los 500 caracteres \n";
    }
    if(error!=''){
        alert("Para continuar debe completar la siguiente información\n"+error);
        return(false);
    }
    if(document.getElementById("fin_historia").checked === false && document.getElementById("resumen").value !== ""){
        document.getElementById("resumen").value="";
    }
    document.form1.submit();
}

function activar_resumen(){
    var finalizar = document.getElementById("fin_historia").checked;
    
    if(finalizar){        
        document.getElementById("resumen").style.display = "block";
        document.getElementById("texto_resumen").style.display = "block";
    }
    else{        
        document.getElementById("resumen").style.display = "none";
        document.getElementById("texto_resumen").style.display = "none";
    }

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

    //echo "Codigo usuario".$codi_usu;
    $consultater="SELECT iden_this FROM ter_historia WHERE codi_usu='$codi_usu' and esta_this='A'";
    //echo $consultater;
    $consultater=mysql_query($consultater);
    $terapias_abiertas = mysql_num_rows($consultater);
    
    ?>

    <table border="0" width='100%'>
        <tr>
            <td align="right">Evolución:</td>
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
    <div>
        <br><input type="checkbox" name="fin_historia" id="fin_historia" onclick="activar_resumen()"> Finalizar Terapias (Cerrar la historia de terapia)
        <p class="oculto" id="texto_resumen">Resumen de la atención:</p>
        <br><textarea id="resumen" name="resumen" cols="200" rows="4" class="oculto"></textarea>
    </div>
    <br>
    
    <!--<input type="hidden" name="controlva" value="0">
    <input type="hidden" name="controlviene" value="0">-->
    <table border="0" width="50%">
        <tr>
            <td><a href="#" onclick="validar()" class='btn'>Guardar</a></td>
            <td><a href="ter_citados.php" target='fr02' class='btn'>Salir</a></td>
        </tr>
    </table>
</form>

<!--<button id="myBtn">Abrir Ventana</button>-->
<!-- La ventana emergente -->
<div id="modalRetornar" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>El usuario no tiene una hitoria de terapia de primera vez abierta</p>
        <p>Pulse el botón Continuar para ir a la historia de primera vez</p>
        <center>
        <a class="btn" href="ter_cap_terfisica.php">Continuar</a>
        </center>        
    </div>
</div>


</body>
</html>


<script lang='JavaScript'>
    // Obtener el modal
    var modal = document.getElementById("modalRetornar");

    // Obtener el botón que abre el modal
    var btn = document.getElementById("myBtn");

    // Obtener el elemento <span> que cierra el modal
    var span = document.getElementsByClassName("close")[0];

    // Cuando el usuario hace clic en el botón, abre el modal
    btn.onclick = function() {    
        modal.style.display = "block";
    }

    // Cuando el usuario hace clic en <span> (x), cierra el modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cuando el usuario hace clic fuera del modal, lo cierra
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<?php

if($terapias_abiertas==0){
    
    ?>
    <script>
        modal.style.display = "block";
    </script>
    
    <?php
}
?>
