<?php
session_start();
?>
<html>
<head>    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/estilo_2.css">
    <meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <title>Consulta de Terapia Fisica</title>
    <script lang="JavaScript">
        function aprobar(id){ 
            document.getElementById('modal_espera').style.display = 'flex';

            chkbx = document.getElementById('chk'+id);
            if(chkbx.checked==true){
                $.ajax({
                    url: 'aprobar_historia.php',
                    type: 'POST',
                    data: { iden_this: id },
                    success: function(response){                        
                        alert(response);
                        document.getElementById('modal_espera').style.display = 'none';
                    }
                });  
            } else {
                alert('La historia ya está aprobada');
                document.getElementById('chk'+id).checked=true;
                document.getElementById('modal_espera').style.display = 'none';
            }                       
            return false;
        }
    </script>
</head>
<body>
<form name="form1" method="post" action="">
    <h4>LISTA DE PACIENTES PARA APROBACION</h4>
    <div class="right">    
        <a href="ter_param_aprobarterapia.php" class="btnmenu">Regresar</a>        
    </div>
    <table class="table1">    
    <th>Fecha</th>
    <th>Identificación</th>
    <th>Nombre</th>
    <th>Nro.Orden</th>
    <th>Tipo</th>
    <th>Profesional</th>
    <th colspan='2'>Opciones</th>
    <?php
    include('php/conexion.php');
    include('php/funciones.php');
    $condicion="";
    if(!empty($fechaini)){
        $condicion=$condicion."tf.fecha_this BETWEEN '".cambiafecha($fechaini)." 00:00:00' and '".cambiafecha($fechafin)." 23:59:00' AND ";
    }
    if(!empty($contra)){$condicion=$condicion."cont_this='".$contra."' AND ";}
    if(!empty($identif)){$condicion=$condicion."nrod_usu='".$identif."' AND ";}
    if(!empty($tipo_terapia)){$condicion=$condicion."tipoterapia_this='".$tipo_terapia."' AND ";}    
    $condicion=substr($condicion,0,strlen($condicion)-5);
    //echo "<br>".$condicion;

    $consulta="SELECT tf.iden_this,tf.fecha_this,ser.nomb_des,med.nom_medi,tf.numero_orden_this, tf.codigo_aprobador,
    u.NROD_USU ,CONCAT(u.PNOM_USU,' ',u.SNOM_USU,' ',u.PAPE_USU,' ',u.SAPE_USU) AS nombre,
    c.NEPS_CON, t.nomb_des AS tipo_terapia
    FROM ter_historia AS tf
    INNER JOIN usuario u ON u.CODI_USU=tf.codi_usu
    INNER JOIN contrato c ON c.CODI_CON = tf.cont_this 
    INNER JOIN destipos AS ser ON ser.codi_des=tf.servrem_this
    INNER JOIN medicos AS med ON med.cod_medi=tf.codmedi_this
    LEFT JOIN destipos AS t on t.codi_des=tf.tipoterapia_this
    WHERE ".$condicion." ORDER BY tf.fecha_this";
    //echo $consulta;
    $consulta=mysql_query($consulta);
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";        
        echo "<td align='left'>$row[fecha_this]</td>";
        echo "<td align='left'>$row[NROD_USU]</td>";
        echo "<td align='left'>$row[nombre]</td>";
        echo "<td align='left'>$row[numero_orden_this]</td>";
        echo "<td align='left'>$row[tipo_terapia]</td>";
        echo "<td align='left'>$row[nom_medi]</td>";
        echo "<td align='center'><a href='ter_impretf.php?iden_this=$row[iden_this]' target='new'><img src='img/lupa.jpg' width='20' height='20' alt='Visualizar Historia'></a></td>";
        $nombre_check="chk".$row['iden_this'];
        if($row['codigo_aprobador']!=""){
            echo "<td><i class='fa-solid fa-check'></i></td>";
        } else {
            echo "<td><input type='checkbox' id='$nombre_check' onclick='aprobar($row[iden_this])'>Aprobar</td>";
        }        

        echo "</tr>";        
    }
    ?>    
    </table>
    
</form>

<div class="modalEspera" id="modal_espera">
    <br><br>
    <p>Registrando la aprobación....</p>    
</div>
    

</body>
</html>
