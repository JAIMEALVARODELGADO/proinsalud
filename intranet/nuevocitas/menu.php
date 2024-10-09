<?
session_start();
$usucitas=$_SESSION['usucitas'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<style> 
</style> 
<head>
	<link rel="shortcut icon" href="/favicon.ico">
	<title>Citas medicas SIIMA</title>	
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
	<link rel="stylesheet" type="text/css" href="css/left.css">
	<link rel="stylesheet" type="text/css" href="css/left/custom.css">
	<link rel="stylesheet" type="text/css" href="css/left/layout.css">
	<script language="javascript">
	function salir(dir,titu,opci)
	{
		
		uno.action='titulo.php';
        uno.target='titulopag';
        uno.submit();
		
		uno.opcimenu.value=opci;
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
	function bushisto()
	{
		uno.target='area';
		uno.action='consuref.php';
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
<script language = "JavaScript" type = "text/Javacript" src = "javascript/leftframe.js;"></script>
<body>
<?
include('php/conexion.php');


$consultausu=mysql_query("SELECT nomb_usua,tip_usuario FROM cut WHERE ide_usua='$usucitas'");
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
  <input type=hidden name=opcimenu>

    <table id="navArea" cellspacing="0" cellpadding="0" width="100%" border="0" summary="Navigation Items Area">
      <?
		$n=0;
        $consulta=mysql_query("SELECT codi_men,descr_men FROM menu WHERE aplic_men='44' and nivel_men=1");
		while($row=mysql_fetch_array($consulta)){
		  ?>
	        <tr>
	          <td>
                <div id="navLayout">
				  <?$id='id'.$row[codi_men];?>
                  <table border="0" cellspacing="0" cellpadding="0" width="100%" class="navOpened" id="<?echo $id;?>">
                    <tr>
                      <td>
	                    <table border="0" cellspacing="0" cellpadding="0" width="100%" class="navTitle" onClick="return opentree ('<? echo $id;?>');">
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
                                if($tip_usuario=='02')
                                {
                                    $consultaopc=mysql_query("SELECT depen_men,codi_men,depen_men,descr_men,url_men,img_men FROM menu WHERE nivel_men=2 and depen_men=$row[codi_men] ORDER BY codi_men");
                                }
                                else
                                {
                                    $consultaopc=mysql_query("SELECT menu.descr_men, menu.url_men, menu.img_men, menuxusu.ide_usua, menu.nivel_men, menu.depen_men, menu.codi_men
                                    FROM menu INNER JOIN menuxusu ON menu.codi_men = menuxusu.codi_men
                                    WHERE (((menuxusu.ide_usua)='$usucitas') AND ((menu.nivel_men)=2) AND ((menu.depen_men)='$row[codi_men]')) ORDER BY menu.codi_men");
									
                                }
//echo mysql_num_rows($consultaopc);
                                if(mysql_num_rows($consultaopc)<>0){
                                $codi=1;
                                while($rowopc=mysql_fetch_array($consultaopc)){
                                ?>
								<tr>
								<td>
								<div class="tree">
	                              <table border="0" cellspacing="0" cellpadding="0" width="100%" id="usuarios" class="nodeActive">
	                                <tr>
	                                  <!--<td class="nodeImage"><a href="#" title=""></a></td>-->
                                            <? 	
                                                $dire=$rowopc[url_men];
                                                $titu=$rowopc[descr_men];
                                                $depen_men=$rowopc[depen_men];
                                                $opmen=$rowopc[img_men];
												$codi_men=$rowopc[codi_men];
													
                                                echo"<td width='100%'><a href='#' onclick='salir(\"$dire\",\"$titu\",\"$opmen\")' title='$rowopc[descr_men]'> $rowopc[descr_men]</a></td>";
													
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
					  $n++;
					  if($n==1)
					  {	
						  echo"
						  <div class='tree'>
						  <tr> <td width='100%'><a href='#' onclick='bushisto()'>Historico de citas</a></td></tr>
						  </div>
						  ";
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
</body>
</html>