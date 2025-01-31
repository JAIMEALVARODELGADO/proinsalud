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
    if(document.getElementById("iden_this").value===''){
        error+="Debe seleccionar la historia de primera vez a la que pertenece el control\n";
    }
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

function seleccionar(id){
    //alert(id);    
    document.getElementById("iden_this").value=id;;
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
    $consultater="SELECT th.iden_this, th.fecha_this,th.enfact_this,th.dxprinc_this ,th.numero_orden_this,
    d.nomb_des AS servicio_remitente,c.nom_cie10,t.nomb_des tipo_terapia
    FROM ter_historia th 
    INNER JOIN cie_10 c ON c.cod_cie10 =th.dxprinc_this 
    INNER JOIN destipos d ON d.codi_des = th.servrem_this
    LEFT JOIN destipos t on t.codi_des = th.tipoterapia_this     
    WHERE codi_usu='$codi_usu' and esta_this='A'";    
    //echo $consultater;
    
    $consultater=mysql_query($consultater);
    $terapias_abiertas = mysql_num_rows($consultater);
    
    ?>
    <br><br>
    <div>
        
        <table class='table1'>
            <tr>
                <th colspan='7'>HISTORIAS ABIERTAS</th>
            </tr>
            <tr>
                <th>Sel</th>
                <th>Fecha Apert</th>
                <th>Tipo de Terapia</th>
                <th>Servicio Remitente</th>
                <th>Diagnóstico</th>
                <th>Enfermedad Actual</th>
                <th>Orden</th>
            </tr>            
            <?php
                while($rowter = mysql_fetch_array($consultater)){                    
                    
                    echo "<tr>";                    
                    echo "<td><input type='radio' id='sel_terapia' name='sel_terapia' onclick='seleccionar($rowter[iden_this])'></td>";
                    echo "<td><a href='#' onclick=\"window.open('ter_impretf.php?iden_this=$rowter[iden_this]', 'newwindow', 'width=800,height=600'); return false;\" title='Visualizar Historia'>$rowter[fecha_this]</a></td>";
                    echo "<td><a href=''>$rowter[tipo_terapia]</a></td>";
                    echo "<td>$rowter[servicio_remitente]</td>";
                    echo "<td>$rowter[nom_cie10]</td>";
                    echo "<td>$rowter[enfact_this]</td>";                    
                    echo "<td>$rowter[numero_orden_this]</td>";
                    echo "</tr>";
                }
            ?>
            
        </table>
        <input type="hidden" name="iden_this" id="iden_this">
    </div>
    <br><br>
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
    /*btn.onclick = function() {    
        modal.style.display = "block";
    }*/

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
