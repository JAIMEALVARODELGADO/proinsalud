<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?
session_register('Gidusu'); 

?>
<html>
<style> 
</style> 
<head>
	<link rel="shortcut icon" href="/favicon.ico">
	<title>psa</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<link rel="stylesheet" type="text/css" href="/intranet/Libreria/css/left.css">
	<link rel="stylesheet" type="text/css" href="/intranet/libreria/css/left/custom.css">
	<link rel="stylesheet" type="text/css" href="/intranet/Libreria/css/left/layout.css">
</head>
	<script language="javascript" type="text/javascript" src="/intranet/Libreria/java/frame/leftframe.js"></script>
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
	<td class="titleLeft"><img src="/intranet/Libreria/img/icons/topleft.gif" border="0" alt=""/></td>
	<td class="titleText" width="100%">Menu Citas Medicas Urgencias</td>
	<td class="titleHandle"><img src="/skins/winxp.blue/images/1x1.gif" width="20" height="1" border="0" alt=""/></td>
	<td class="titleRight"><img src="/intranet/Libreria/img/icons/topright.gif" alt="" width="3" height="3" border="0"/></td>
	</tr>
	</table>
	</td>
	</tr><tr>
	<td>
	<?
	include ('/Inetpub/wwwroot/intranet/Libreria/Php/conexiones_g.php');
	base_general();
	$ssql = "SELECT cut.tip_usuario, acc_principal.acc_prin, cut.ide_usua, opc_principal.nom_opcpri, aplicacion.cod_apli, cut.nomb_usua, aplicacion.nomb_apli FROM ((cut INNER JOIN aplicacion ON cut.ide_usua = aplicacion.id_usu) INNER JOIN acc_principal ON (aplicacion.cod_apli = acc_principal.cod_apli) AND (cut.ide_usua = acc_principal.id_us)) INNER JOIN opc_principal ON (acc_principal.cod_apli = opc_principal.cod_aplica) AND (acc_principal.acc_prin = opc_principal.cod_opcpri) WHERE (((cut.ide_usua)='$Gidusu') AND ((aplicacion.cod_apli)='04'));"; 
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

	echo "<a href=frm_lisurg.php title=usuarios target=fr2>";
    }
    }
    }
	?>
    <img src="icons/reloj.gif" alt="" width="25" height="25" border="0"/> Mirar Listado</a>
	</td>
	</tr>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
	<td><table border="0" cellspacing="0" cellpadding="0" width="100%" id="dependencias" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="Usuarios"></a></td>
	<td width="100%">
		<?
		
	if ($menu<>""){
	foreach($menu as $menuper) { 
    if ($menuper=="002"  or $us=="02"){
    echo "<a href=cd_frabuscar.html title=usuarios target=fr2>";
    
	}
    }
    }
	?>
	

	
	<img src="/intranet/Libreria/img/icons/darcita.gif" alt="" width="25" height="25" border="0"/>Asignar Cita</a>
	</td>
	</tr>
	</table><table border="0" cellspacing="0" cellpadding="0" width="100%" id="salidas" class="nodeActive">
	<tr>
	<td class="nodeImage"><a href="#" title="salidas"></a></td>
	<td width="100%">
		<?
			if ($menu<>"" ){
	foreach($menu as $menuper) { 
    if ($menuper=="003"  or $us=="02"  ){
    echo "<a href=CBus_cita.php title=usuarios target=fr2>";
    
	}
    }
    }
	?>



	<img src="/intranet/Libreria/img/icons/elicita.gif" alt="" width="25" height="25" border="0"/>Eliminar Cita</a>
	</td>
	</tr>
	</table>
	
	
	</td>
	</tr>
	</table>
	</div>
	</td>
	</tr>
	
	
	
	
	
	
	
	
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