<?php
session_start();
?>
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
    <meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Consulta de Terapia Fisica</title>
</head>
<body>
<form name="form1" method="post" action="">
    <h4>LISTA DE PACIENTES PARA APROBACION</h4>
    <table class="table1">    
    <th>Fecha</th>
    <th>Identificación</th>
    <th>Nombre</th>
    <th>Nro.Orden</th>
    <th>Remite</th>
    <th>Profesional</th>
    <th>Opciones</th>
    <?php
    include('php/conexion.php');
    include('php/funciones.php');
    $condicion="";
    if(!empty($fechaini)){
        $condicion=$condicion."tf.fecha_this BETWEEN '".cambiafecha($fechaini)." 00:00:00' and '".cambiafecha($fechafin)." 23:59:00' AND ";
    }
    if(!empty($contra)){$condicion=$condicion."cont_this='".$contra."' AND ";}
    if(!empty($identif)){$condicion=$condicion."nrod_usu='".$identif."' AND ";}    
    $condicion=substr($condicion,0,strlen($condicion)-5);
    echo "<br>".$condicion;


    $consulta="SELECT tf.iden_this,tf.fecha_this,ser.nomb_des,med.nom_medi,tf.numero_orden_this, 
    u.NROD_USU ,CONCAT(u.PNOM_USU,' ',u.SNOM_USU,' ',u.PAPE_USU,' ',u.SAPE_USU) AS nombre,
    c.NEPS_CON 
    FROM ter_historia AS tf
    INNER JOIN usuario u ON u.CODI_USU=tf.codi_usu
    INNER JOIN contrato c ON c.CODI_CON = tf.cont_this 
    INNER JOIN destipos AS ser ON ser.codi_des=tf.servrem_this
    INNER JOIN medicos AS med ON med.cod_medi=tf.codmedi_this
    WHERE ".$condicion." ORDER BY tf.fecha_this";
    echo $consulta;
    $consulta=mysql_query($consulta);
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";        
        echo "<td align='left'>$row[fecha_this]</td>";
        echo "<td align='left'>$row[NROD_USU]</td>";
        echo "<td align='left'>$row[nombre]</td>";
        echo "<td align='left'>$row[numero_orden_this]</td>";
        echo "<td align='left'>$row[nomb_des]</td>";
        echo "<td align='left'>$row[nom_medi]</td>";
        echo "<td align='center'><a href='ter_impretf.php?iden_this=$row[iden_this]' target='new'><img src='img/lupa.jpg' width='20' height='20' alt='Mirar'></a></td>";
        echo "</tr>";        
    }
    ?>
    </table>
</form>
</body>
</html>
