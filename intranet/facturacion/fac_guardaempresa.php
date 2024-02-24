<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>
<script language='javascript'>
function cargar(){
  document.form1.submit();
}
</script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//include('php/funciones.php');
include('php/conexion.php');
mysql_query("UPDATE empresa SET nite_emp='$nite_emp',razo_emp='$razo_emp',codp_emp='$codp_emp',dire_emp='$dire_emp',tele_emp='$tele_emp',enca_emp='$enca_emp',pie_emp='$pie_emp',pref_emp='$pref_emp',rela_emp='$rela_emp',ctades_emp='$ctades_emp',ctacaj_emp='$ctacaj_emp' 
WHERE codi_emp=$codi_emp");
mysql_close();
echo "<body onload='cargar()'>";
?>
<form name='form1' method="POST" action='fac_empresa.php'>
</form>
</body>
</html>