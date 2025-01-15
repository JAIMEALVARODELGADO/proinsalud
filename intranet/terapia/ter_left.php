<?php
session_start();
include('php/conexion.php');
?>
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
</head>
<body bgcolor="#AAC1E9">
<br>
<?php
//echo $_SESSION[ter_codmedi];
$consmed="SELECT nom_medi FROM medicos WHERE cod_medi='$_SESSION[ter_codmedi]'";
//echo $consmed;
$consmed=mysql_query($consmed);
$rowmed=mysql_fetch_array($consmed);
echo "Usuario:";
echo "<br>".$rowmed[nom_medi];
echo "<br><br>";
include('php/conexiones_g.php');
base_general();
$consultamenu="SELECT codi_men,descr_men FROM menu WHERE aplic_men='58' and nivel_men=1";
$consultamenu=mysql_query($consultamenu);
$rowmenu=mysql_fetch_array($consultamenu);
$consultaopc="SELECT descr_men,url_men,img_men FROM menu AS m
    INNER JOIN menuxusu AS mxu ON mxu.codi_men=m.codi_men
    WHERE mxu.ide_usua='$_SESSION[ter_codmedi]' and m.nivel_men=2 and m.depen_men=$rowmenu[codi_men]";
//echo $consultaopc;
$consultaopc=mysql_query($consultaopc);
echo "<table>";
while($rowopc=mysql_fetch_array($consultaopc)){
    echo "<tr>";
    echo "<td style=font-size:14><img><a href='$rowopc[url_men]' target='fr04' class='btnmenu'>$rowopc[descr_men]</a><td>";
    echo "</tr>";    
}
echo "</table>";    
?>        
<br><br><br><a href='ter_citados.php' target='fr02' class='btnmenu'>Listado de Pacientes</a>
</body>
</html>