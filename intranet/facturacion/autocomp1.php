<?session_start();?>
<HTML>
<HEAD>
<?
require('php/conexion.php');
?>
<link rel="stylesheet" type="text/css" href="css/estyles.css">
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<script type="text/javascript">
$().ready(function() {
	
	$("#course").autocomplete("autocomp2.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		selectFirst: false
	});
	
	$("#course").result(function(event, data, formatted) {
		$("#course_val").val(data[1]);
	});
});
</script>
</HEAD>
<BODY>
<?
$datos[0]='desc_map';
$datos[1]='iden_map';
$datos[2]='mapii';
?>
<form name='AdmisionesCitas_Edit' action='AdmisionesCitas_Edit.php' method='post'>
  <table class=tbl1>
    <thead>
      <tr>
        <td align='left'>Opcion: Cancelar...</td>
        <td align='right'></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class='td_0' colspan='2'>&nbsp</td>
      </tr>
      <tr>
        <td class='td_i2'><b>Procedimiento:</b> <br>a buscar</td>
        <td class='td_d2'><input type='text' id='course' class='texto' name='usu' size='40' value='<?echo $usu;?>'></td>
        <input type='hidden' id='course_val' name='val' value='$val'>
      </tr>
    </tbody>
  </table>
</form>
<?
mysql_close();
?>
</BODY>
</HTML>