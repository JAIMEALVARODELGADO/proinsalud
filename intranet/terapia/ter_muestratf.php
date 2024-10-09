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
    <center><h3><font color='#A60C63'>HISTORIAL DE TERAPIA FISICA</font></h3></center>
    <table border="1" bordercolor="#">
    <th>Opciones</th>
    <th>Fecha</th>
    <th>Remite</th>
    <th>Profesional</th>
    <?php
    include('php/conexion.php');
    include('php/funciones.php');
    $consulta="SELECT tf.iden_this,tf.fecha_this,ser.nomb_des,med.nom_medi
    FROM ter_historia AS tf 
    INNER JOIN destipos AS ser ON ser.codi_des=tf.servrem_this
    INNER JOIN medicos AS med ON med.cod_medi=tf.codmedi_this
    WHERE tf.codi_usu='$_SESSION[codi_usu]' ORDER BY tf.iden_this";
    //echo $consulta;
    $consulta=mysql_query($consulta);
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";
        echo "<td align='center'><a href='ter_impretf.php?iden_this=$row[iden_this]' target='new'><img src='img/lupa.jpg' width='20' height='20' alt='Mirar'></a></td>";
        echo "<td align='left'>$row[fecha_this]</td>";
        echo "<td align='left'>$row[nomb_des]</td>";
        echo "<td align='left'>$row[nom_medi]</td>";
        echo "</tr>";        
    }
    ?>
    </table>
</form>
</body>
</html>
