<html>
<head>
<title></title>
</head>
<script language='javascript'>
function buscar()
	{
		alert('toy');
		//form1.target='';
		//form1.action='buscacup.php';
		//form1.submit();
			
	}
</script>
<form name="form1" method="POST" >
<?
echo"<body onload='regresar()'>";
$consdes=mysql_query("SELECT usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON,ingreso_hospitalario.id_ing ,ingreso_hospitalario.fecin_ing,hist_var.iden_var,hist_var.fech_var,  cups.codigo,cups.descrip,  hist_evo.cod_medi, hist_evo.iden_evo ,hist_var.hora_var,hist_var.iden_var
									FROM usuario
									INNER JOIN ucontrato AS ucontrato ON usuario.CODI_USU=ucontrato.CUSU_UCO
									INNER JOIN contrato AS contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
									INNER JOIN ingreso_hospitalario AS ingreso_hospitalario ON usuario.CODI_USU = ingreso_hospitalario.codius_ing
									INNER JOIN hist_evo AS hist_evo ON hist_evo.id_ing = ingreso_hospitalario.id_ing
									INNER JOIN hist_var AS hist_var ON hist_evo.iden_evo = hist_var.iden_evo
									INNER JOIN hist_traza AS hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing
									INNER JOIN cups AS cups ON hist_var.iden_ser = cups.codigo
									WHERE hist_var.fech_var='$rot' AND usuario.NROD_USU='$rot2' AND cups.tipo='1803' AND hist_traza.horas_tra=-1 AND hist_var.esta_var='SO' AND ucontrato.ESTA_UCO='AC' 
									ORDER BY hist_var.fech_var desc")

echo"</body>";
?>
</html>
</form>