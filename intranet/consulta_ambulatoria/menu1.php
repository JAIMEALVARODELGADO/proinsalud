<?
	session_register('Gcod_mediconh'); 
	session_register('paciente');
	session_register('Gcontratonh');
	session_register('numcita');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<style> 
</style> 
<head>
	<link rel="shortcut icon" href="/favicon.ico">
	<title>Consultas Generales SIIMA</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<link rel="stylesheet" type="text/css" href="css/left.css">
	<link rel="stylesheet" type="text/css" href="css/left/custom.css">
	<link rel="stylesheet" type="text/css" href="css/left/layout.css">
	<script language="javascript">
	function salir(dir,titu)
	{
		uno.titulo.value=titu;
		uno.target='area';
		uno.action=dir;
		uno.submit();		
	}
	function ceraarcon()
	{
		
		uno.target='area';
		uno.action='guardahisto.php';
		uno.submit();		
	}
	function regresa()
	{
		uno.codusu.value=''
		uno.target='menu';
		uno.action='blanco.php';
		uno.submit();
		uno.target='titulo';
		uno.action='titulo.php';
		uno.submit();		
		uno.target='area';
		uno.action='regresa.php';
		uno.submit();		
	}	
	/*
	ClosingVar=true
	window.onbeforeunload  = ExitCheck;
	function ExitCheck()
	{  	
		uno.target='area';
		uno.action='regresa.php';
		uno.submit();		
	}	
	*/
	</script>	
</head>
<script language="javascript" type="text/javascript" src="javascript/leftframe.js"></script>
<body>
<?
include('php/conexion.php');
//base_general();
$consultausu=mysql_query("SELECT nomb_usua,tip_usuario FROM cut WHERE ide_usua='$Gcod_mediconh'");
$rowusu=mysql_fetch_array($consultausu);
$nombreusu=$rowusu[nomb_usua];
$tip_usuario=$rowusu[tip_usuario];
?>
<a name="top"></a>
<div class="screenBody" id="">
  <form name=uno action="left.php" method="post" enctype="multipart/form-data" >
  <input type=hidden name=codusu>
  <input type=hidden name=direccion>
  <input type=hidden name=codiprg>
  <input type=hidden name=titulo>
    <table id="navArea" cellspacing="0" cellpadding="0" width="100%" border="0" summary="Navigation Items Area">
      <?
        $consulta=mysql_query("SELECT codi_men,descr_men FROM menu WHERE aplic_men='38' and nivel_men=1");
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
	                        <td class="titleLeft" ><img src="icons/topleft.gif" border="0" alt=""/></td>
	                        <td class="titleText" width="100%"><?echo $row[descr_men];?></td>
	                        <td class="titleHandle"><img src="/skins/winxp.blue/images/1x1.gif" width="20" height="1" border="0" alt=""/></td>
	                        <!--<td class="titleRight"><img src="topright.gif" alt="" width="3" height="3" border="0"/></td>-->
	                      </tr>
	                    </table>
	                  </td>
	                </tr>
					<?
					  
					  if($tip_usuario=='02'){
					    $consultaopc=mysql_query("SELECT depen_men,codi_men,depen_men,descr_men,url_men,img_men FROM menu WHERE nivel_men=2 and depen_men=$row[codi_men]");}
					 
					 else{$consultaopc=mysql_query("SELECT menu.descr_men, menu.url_men, menu.img_men, menuxusu.ide_usua, menu.nivel_men, menu.depen_men
					FROM menu INNER JOIN menuxusu ON menu.codi_men = menuxusu.codi_men
					WHERE (((menuxusu.ide_usua)='$Gcod_mediconh') AND ((menu.nivel_men)=2) AND ((menu.depen_men)='$row[codi_men]'))");}

					  if(mysql_num_rows($consultaopc)<>0)
					  
					 
					  {
					    $codi=1;
					    while($rowopc=mysql_fetch_array($consultaopc)){
					      ?>
					        <tr>
	                          <td>
				                <div class="tree">
	                              <table border="0" cellspacing="0" cellpadding="0" width="100%" id="usuarios" class="nodeActive">
	                                <tr>
	                                  <td class="nodeImage"><a href="#" title=""></a></td>
									    <? 	
										$dire=$rowopc[url_men];
										$titu=$rowopc[descr_men];
										$depen_men=$rowopc[depen_men];
										$archivo='tmp/'.$codi.'HC'.$numcita.'-'.$paciente.'.txt';
										if($depen_men==66)
										{
											if(file_exists($archivo)==TRUE)
											{
												echo"<td width='100%'><a href='#' onclick='salir(\"$dire\",\"$titu\")' title='$rowopc[descr_men]'><img src='icons/ya.png' alt='' width='10' height='10' border='0'> $rowopc[descr_men]</a></td>";
											}
											else
											{
												echo"<td width='100%'><a href='#' onclick='salir(\"$dire\",\"$titu\")' title='$rowopc[descr_men]'><img src='icons/yano.png' alt='' width='10' height='10' border='0'> $rowopc[descr_men]</a></td>";											
											}
										}
										else
										{											
											echo"<td width='100%'><a href='#' onclick='salir(\"$dire\",\"$titu\")' title='$rowopc[descr_men]'> $rowopc[descr_men]</a></td>";
										}										
										?>
									</tr>
                                  </table>
				                </div>
				              </td>
                            </tr>						  
						  <?						  
						  $codi=$codi+1;
						}
					  }
					?>
				  </table>
				</div>				
			  </td>
			</tr>
			
		  <?
		}
		echo"<tr><td><a href= '#' onclick='regresa()'><font size=4 color='#FFFFFF'>Lista pacientes</font></a><br><br></td></tr>";
		$archivo1='tmp/1HC'.$numcita.'-'.$paciente.'.txt';
		$archivo2='tmp/2HC'.$numcita.'-'.$paciente.'.txt';
		$archivo3='tmp/3HC'.$numcita.'-'.$paciente.'.txt';
		$archivo4='tmp/4HC'.$numcita.'-'.$paciente.'.txt';
		if(file_exists($archivo1)==TRUE && file_exists($archivo2)==TRUE && file_exists($archivo3)==TRUE && file_exists($archivo4)==TRUE)
		{
			echo"<tr><td><a href='#' onclick='ceraarcon()'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
		}		
      ?>	  
	</table>
	
  </form>
</div>
<font size='1' color='#ffffff'>

</font>
</body>
</html>