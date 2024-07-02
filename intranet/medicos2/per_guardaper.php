<?
include("php/conexion.php");
//Aqui controlo la accion a tomar
$nom_medi=$pnom_medi.' '.$snom_medi.' '.$pape_medi.' '.$sape_medi;
$sql_="INSERT INTO medicos (cod_medi,nom_medi,dir__medi,telf_medi,are_medi,esta_medi,ced_medi,reg_medi,csii_med,espe_med,tido_medi,pnom_medi,snom_medi,pape_medi,sape_medi) 
VALUES ('$cod_medi','$nom_medi','$dir_medi','$telf_medi','$are_medi','A','$ced_medi','$reg_medi',$csii_med,'$espe_med','$tido_medi','$pnom_medi','$snom_medi','$pape_medi','$sape_medi')";
//echo $sql_;
mysql_query($sql_);

$sql_="INSERT INTO areas_medic (areas_ar,cod_med_ar,esta_ar) VALUES ('$areas_ar','$cod_medi','A')";
//echo $sql_;
mysql_query($sql_);

$sql_="INSERT INTO medico_especialidad(cod_medi,espe_medi) VALUES ('$cod_medi','$espe_med')";
//echo $sql_;
mysql_query($sql_);

mysql_close();
//exit();
// mysql_free_result($consulta);
?>
<!-- Regresa a la pagina anterior -->
<HTML>
<head>
<title>Regresa a la p?gina anterior</title>
<Script Language="JavaScript">
function cargar(){    
    med_guardamed.submit()    
}
</Script>
</head>
<body bgcolor='#E6E8FA' onload='javascript:cargar()'>
<form name='med_guardamed' method='post' action='per_muestraper.php'>
  <input type='hidden' name='cod_medi' value='<?echo $cod_medi;?>'>
</form>
</body>
</HTML>
