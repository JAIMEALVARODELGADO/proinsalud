<?php
session_start();

?>
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
    <meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Consulta de Terapia Respiratoria</title>
</head>
<body>
<form name="form1" method="post" action="">
    <center><h3><font color='#A60C63'>HISTORIAL DE TERAPIA RESPIRATORIA<font></h3></center>
    <table border="1" bordercolor="#">
    <th>Opciones</th>
    <th>Fecha</th>
    <th>Profesional</th>
    <?php
    include('php/conexion.php');
    include('php/funciones.php');
    $consulta="SELECT tr.iden_tre,tr.fecha_tre,med.nom_medi
    FROM tres_historia AS tr 
    INNER JOIN medicos AS med ON med.cod_medi=tr.codmedi_tre
    WHERE tr.tipo_tre='1' AND tr.codi_usu='$_SESSION[codi_usu]' ORDER BY tr.iden_tre";
    //echo $consulta;
    $consulta=mysql_query($consulta);
    while($row=mysql_fetch_array($consulta)){
        echo "<tr>";
        echo "<td align='center'><a href='ter_impretr.php?iden_tre=$row[iden_tre]' target='new'><img src='img/lupa.jpg' width='20' height='20' alt='Mirar'></a></td>";
        echo "<td align='left'>$row[fecha_tre]</td>";
        echo "<td align='left'>$row[nom_medi]</td>";
        echo "</tr>";        
    }
    ?>
    </table>
</form>
</body>
</html>
