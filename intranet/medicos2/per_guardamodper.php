<HTML>
<head>
<title>Regresa a la página anterior</title>
</head>

<Script Language="JavaScript">
function cargar(){
    per_guardamodper.submit()
}
</Script>
<?
//Conexion con la base
include ('php/conexion.php');
//echo $cod_medi;
$nom_medi=$pnom_medi.' '.$snom_medi.' '.$pape_medi.' '.$sape_medi;
$sql_="UPDATE medicos SET nom_medi='$nom_medi',dir__medi='$dir_medi',telf_medi='$telf_medi',are_medi='$are_medi',ced_medi='$ced_medi',reg_medi='$reg_medi',csii_med='$csii_med',espe_med='$espe_med',tido_medi='$tido_medi',pnom_medi='$pnom_medi',snom_medi='$snom_medi',pape_medi='$pape_medi',sape_medi='$sape_medi'
WHERE cod_medi='$cod_medi'";
//echo $sql_;
mysql_query($sql_);
?>
<body bgcolor='#E6E8FA' onload='javascript:cargar()'>
<form name='per_guardamodper' method='post' action='per_muestraper.php'>
  <input type='hidden' name='cod_medi' value='<?echo $cod_medi;?>'>
  <input type='hidden' name='orden' value='cod_medi'>
</form>
</body>

</HTML>
