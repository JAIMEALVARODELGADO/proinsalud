<?
session_register('Gidusu'); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<style> 
</style> 
<head>
	<link rel="shortcut icon" href="/favicon.ico">
	<title>psa</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<link rel="stylesheet" type="text/css" href="css/left.css">
	<link rel="stylesheet" type="text/css" href="css/left/custom.css">
	<link rel="stylesheet" type="text/css" href="css/left/layout.css">
</head>
	<script language="javascript" type="text/javascript" src="javascript/leftframe.js"></script>
<body>
<a name="top"></a>
<div class="screenBody" id="">
<form action="left.php" method="post" enctype="multipart/form-data" >
<table id="navArea" cellspacing="0" cellpadding="0" width="100%" border="0" summary="Navigation Items Area"><tr><td>
	<div id="navLayout">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="navOpened" id="general">
	<tr>
	<td>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="navTitle" onClick="return opentree ('general');">
	<tr>
	<td class="titleLeft"><img src="icons/topleft.gif" border="0" alt=""/></td>
	<td class="titleText" width="100%">Menu Citas Medicas</td>
	<td class="titleHandle"><img src="/skins/winxp.blue/images/1x1.gif" width="20" height="1" border="0" alt=""/></td>
	<td class="titleRight"><img src="topright.gif" alt="" width="3" height="3" border="0"/></td>
	</tr>
	</table>
	</td>
	</tr><tr>
	<td>
	<?
	include ('php/conexion.php');
	$ssql = "SELECT tip_usuario,acc_prin,cut.ide_usua, opc_principal.nom_opcpri, aplicacion.cod_apli, cut.nomb_usua, aplicacion.nomb_apli FROM ((cut INNER JOIN aplicacion ON cut.ide_usua = aplicacion.id_usu) INNER JOIN acc_principal ON cut.ide_usua = acc_principal.id_us) INNER JOIN opc_principal ON acc_principal.acc_prin = opc_principal.cod_opcpri WHERE aplicacion.cod_apli='01' and cut.ide_usua='$Gidusu' "; 
    $rs = mysql_query($ssql); 
     if (mysql_num_rows($rs)!=0){ 

	while ($row=mysql_fetch_array($rs))
    {
      $v1=$row["acc_prin"];
	$con=$con+1;	
	
	$menu[$con]=$v1;
	$us=$row["tip_usuario"];
	//echo $us;
	}
	}
 
else{
	$ssql2 = "SELECT tip_usuario, ide_usua FROM cut  WHERE  ide_usua='$Gidusu' "; 
    $rs2 = mysql_query($ssql2); 
     if (mysql_num_rows($rs2)!=0){ 
    $menu[0]="a";
	while ($row2=mysql_fetch_array($rs2))
    {
    $us=$row2["tip_usuario"];
	
	}
	}
	}	
	
	?>
	
	
	<div class="tree">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" id="usuarios" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="usuarios"></a></td>
	<td width="100%">
	<?
	if ($menu<>"" ){
	foreach($menu as $menuper) { 
	if (($menuper=='001')or($us=="02")){
	echo "<a href=frm_gehor.php title=usuarios target=fr2>";
    }
    }
    }
	?>
    <img src="icons/reloj.gif" alt="" width="25" height="25" border="0"/> Generar Horarios</a>
	</td>
	</tr>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
	<td><table border="0" cellspacing="0" cellpadding="0" width="100%" id="auxiliar" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="Aplicaciones"></a></td>
	<td width="100%">
	<?
		if ($menu<>""){
	foreach($menu as $menuper) { 
	if ($menuper=="002"  or $us=="02"){
    echo "<a href=frm_eligehor.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>
	
	<img src="icons/eliminar_ho.gif" alt="" width="25" height="25" border="0"/>Eliminar Horarios</a>
	</td>
	</tr>
	</table><table border="0" cellspacing="0" cellpadding="0" width="100%" id="dependencias" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="Usuarios"></a></td>
	<td width="100%">
		<?
	if ($menu<>""){
	foreach($menu as $menuper) { 
    if ($menuper=="003"  or $us=="02"){
    echo "<a href=cd_frabuscar.html title=usuarios target=fr2>";
    
	}
    }
    }
	?>
	

	
	<img src="icons/darcita.gif" alt="" width="25" height="25" border="0"/>Asignar Cita</a>
	</td>
	</tr>
	</table><table border="0" cellspacing="0" cellpadding="0" width="100%" id="salidas" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="salidas"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="004"  or $us=="02"  ){
    echo "<a href=CBus_cita.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>



	<img src="icons/elicita.gif" alt="" width="25" height="25" border="0"/>Eliminar Cita</a>
	</td>
	</tr>
	</table><table border="0" cellspacing="0" cellpadding="0" width="100%" id="solicitudes" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="solicitudes"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="005"  or $us=="02"){
    echo "<a href=frm_asmed.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>
	
	<img src="icons/medico.gif" alt="" width="25" height="25" border="0"/>Asignar Medico</a>
	</td>
	</tr>
	</table>
	
	
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	
	
	
	<div id="navLayout">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="navClosed" id="general1">
	<tr>
	<td>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="navTitle" onClick="return opentree ('general1');">
	<tr>
	<td class="titleLeft"><img src="icons/topleft.gif" border="0" alt=""/></td>
	<td class="titleText" width="100%">Impresion</td>
	<td class="titleHandle"><img src="/skins/winxp.blue/images/1x1.gif" width="20" height="1" border="0" alt=""/></td>
	<td class="titleRight"><img src="icons/topright.gif" alt="" width="3" height="3" border="0"/></td>
	</tr>
	</table>
	</td>
	</tr><tr>
	<td>

	
	<div class="tree">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" id="usuarios" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="usuarios"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="006"  or $us=="02"){
    echo "<a href=frm_impre.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>
	
	<img src="icons/listado.gif" alt="" width="25" height="25" border="0"/> Listado Medicos</a>
	</td>
	</tr>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
	<td><table border="0" cellspacing="0" cellpadding="0" width="100%" id="auxiliar" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="Aplicaciones"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="007"  or $us=="02"){
    echo "<a href=frm_impre2.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>
	
	<img src="icons/listado.gif" alt="" width="25" height="25" border="0"/>Listado Areas</a>
	</td>
	</tr>
	</table><table border="0" cellspacing="0" cellpadding="0" width="100%" id="dependencias" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="Usuarios"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="008"  or $us=="02"){
    echo "<a href=reportes/frm_impre.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>

	<img src="icons/listado.gif" alt="" width="25" height="25" border="0"/>Listado Horarios</a>
	</td>
	</tr>
	</table><table border="0" cellspacing="0" cellpadding="0" width="100%" id="salidas" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="salidas"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="009"  or $us=="02"){
    echo "<a href=reportes/frm_rips.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>

	<img src="icons/listado.gif" alt="" width="25" height="25" border="0"/>Listado Rips</a>
	</td>
	</tr>
	</table><table border="0" cellspacing="0" cellpadding="0" width="100%" id="solicitudes" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="solicitudes"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="010"  or $us=="02"){
    echo "<a href=frm_impre3.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>
	
	<img src="icons/listado.gif" alt="" width="25" height="25" border="0"/>Listado Suspendidos</a>
	</td>
	</tr>
	</table>
	

	
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	</table>
	</div>
	
	<div id="navLayout">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="navClosed" id="general2">
	<tr>
	<td>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" class="navTitle" onClick="return opentree ('general2');">
	<tr>
	<td class="titleLeft"><img src="icons/topleft.gif" border="0" alt=""/></td>
	<td class="titleText" width="100%">Herramientas del Sistema</td>
	<td class="titleHandle"><img src="/skins/winxp.blue/images/1x1.gif" width="20" height="1" border="0" alt=""/></td>
	<td class="titleRight"><img src="icons/topright.gif" alt="" width="3" height="3" border="0"/></td>
	</tr>
	</table>
	</td>
	</tr><tr>
	<td>

	
	
	<div class="tree">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" id="usuarios" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="usuarios"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="011"  or $us=="02"){
    echo "<a href=frm_desblo.php title=usuarios target=fr2>";
    }
	}
    }
    ?>

	<img src="icons/herra.gif" alt="" width="25" height="25" border="0"/> Desbloquear Servicios</a>
	</td>
	</tr>
	</table>
	
	
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	</table>
	</div>
	
	
	</td>
	</tr>
</table>

</form>
</div>


	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
</table>
</form>
</div>


</body>
</html>