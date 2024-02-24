<?
session_start();
session_register('datos');
//session_register('Gidusufac');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<style> 
</style> 
<head>
	<link rel="shortcut icon" href="/favicon.ico">
	<title>Facturacion</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<link rel="stylesheet" type="text/css" href="css/left.css">
	<link rel="stylesheet" type="text/css" href="css/left/custom.css">
	<link rel="stylesheet" type="text/css" href="css/left/layout.css">
</head>
<script language="javascript" type="text/javascript" src="javascript/leftframe.js"></script>
<body>
<?
include('php/conexiones_g.php');
base_general();
$consultausu=mysql_query("SELECT nomb_usua,tip_usuario FROM cut WHERE ide_usua='$Gidusufac'");
$rowusu=mysql_fetch_array($consultausu);
$nombreusu=$rowusu[nomb_usua];
$tip_usuario=$rowusu[tip_usuario];
?>
<a name="top"></a>
<div class="screenBody" id="">
  <form action="left.php" method="post" enctype="multipart/form-data" >
    <table id="navArea" cellspacing="0" cellpadding="0" width="100%" border="0" summary="Navigation Items Area">
      <?
        $consulta=mysql_query("SELECT codi_men,descr_men FROM menu WHERE aplic_men='35' and nivel_men=1");
		while($row=mysql_fetch_array($consulta)){
		  ?>
	        <tr>
	          <td>
                <div id="navLayout">
				  <?$id='id'.$row[codi_men];?>
                  <table border="0" cellspacing="0" cellpadding="0" width="100%" class="navOpened" id="<?echo $id;?>">
                    <tr>
                      <td>
	                    <table border="0" cellspacing="0" cellpadding="0" width="100%" class="navTitle" onClick="return opentree ('<?echo $id;?>');">
	                      <tr>
	                        <td class="titleLeft"><img src="icons/topleft.gif" border="0" alt=""/></td>
	                        <td class="titleText" width="100%"><?echo $row[descr_men];?></td>
	                        <td class="titleHandle"><img src="/skins/winxp.blue/images/1x1.gif" width="20" height="1" border="0" alt=""/></td>
	                        <!--<td class="titleRight"><img src="topright.gif" alt="" width="3" height="3" border="0"/></td>-->
	                      </tr>
	                    </table>
	                  </td>
	                </tr>
					<?
					  if($tip_usuario=='02'){
					    $consultaopc=mysql_query("SELECT descr_men,url_men,img_men FROM menu WHERE nivel_men=2 and depen_men=$row[codi_men]");}
					  else{$consultaopc=mysql_query("SELECT descr_men,url_men,img_men FROM menu AS m
                           INNER JOIN menuxusu AS mxu ON mxu.codi_men=m.codi_men AND mxu.ide_usua='$Gidusufac'
                           WHERE m.nivel_men=2 and m.depen_men=$row[codi_men]");}
					  if(mysql_num_rows($consultaopc)<>0){
					    while($rowopc=mysql_fetch_array($consultaopc)){
					      ?>
					        <tr>
	                          <td>
				                <div class="tree">
	                              <table border="0" cellspacing="0" cellpadding="0" width="100%" id="usuarios" class="nodeActive">
	                                <tr>
	                                  <td class="nodeImage"><a href="#" title=""></a></td>
	                                  <td width="100%"><a href='<?echo $rowopc[url_men];?>' title='<?echo $rowopc[descr_men];?>' target=fr2><img src="<?echo $rowopc[img_men];?>" alt="" width="25" height="25" border="0"/><?echo $rowopc[descr_men];?></a></td>
                                    </tr>
                                  </table>
				                </div>
				              </td>
                            </tr>						  
						  <?
						}
					  }
					?>
				  </table>
				</div>
			  </td>
			</tr>
		  <?
		}
      ?>
	</table>
  </form>
</div>
<font size='1' color='#ffffff'>
Usuario:
<br><?echo $nombreusu;?>
</font>
</body>
</html>