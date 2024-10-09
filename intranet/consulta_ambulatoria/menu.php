<?php
	session_register('Gcod_mediconh'); 
	session_register('paciente');
	session_register('Gcontratonh');
	session_register('numcita');
	session_register('tiespe');
	session_register('concontrol');	
	session_register('rangoip');
	session_register('Gareanh');
	//echo $Gcod_mediconh ."<br/>";
	
	
	
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
	function ultima_conducta(usu)
	{
		url_='muestra_historico.php?codi_usu='+usu;
		//alert(url_);
		window.open(url_,'blank_','height=500,width=1300,top=250,left=200,status=no,directories=no,menubar=no,toolbar=no,location=no,titlebar=no');
	}
	function salir(dir,titu, dep)
	{		
		uno.titulo.value=titu;
		uno.target='area';
		uno.action=dir;
		uno.submit();		
	}
	function saliranes1(dir,titu, dep)
	{
		alert(dir);
		uno.titulo.value=titu;		
		//if(dep=='279')uno.target='TOP';
		//else 
		uno.target='_blank';
		uno.action=dir;
		//uno.submit();		
	}
	
	
	function ceraarcon(n)
	{
		if(uno.clorden.value==0 && uno.areal.value!='04' && uno.areal.value!='220' && uno.areal.value!='219' && uno.areal.value!='03' && uno.areal.value!='10' && uno.areal.value!='03' && uno.areal.value!='08' && uno.areal.value!='09')
		{
			alert("Registre al menos un item de las opciones de referencia y contrareferencia");
			uno.titulo.value="titu";
			uno.target='area';
			uno.action='ordenes0.php';
			uno.submit();
			return;
		}
		/*
		echo "<input type=hidden name=procontrol value=$procontrol>"; //valida si se cito a control 0=no, 1=si
		echo "<input type=hidden name=clorden value=$clorden>"; // valida si hay referencia 0=no 1=si
		echo "<input type=hidden name=numlab value=$nlab>"; //	valida si hay ordenes de laboratorio 0=no 1=si
		*/
		if(uno.numlab.value>0 && uno.procontrol.value==0 && uno.areal.value!='84' && uno.areal.value!='04' && uno.areal.value!='220' && uno.areal.value!='219' && uno.areal.value!='03' && uno.areal.value!='10' && uno.areal.value!='03' && uno.areal.value!='08' && uno.areal.value!='09')
		{			
			alert("la asignacion automatica de cita de laboratorio \n requiere que genere la orden para control");
			uno.titulo.value="titu";
			uno.target='area';
			uno.action='ordenes0.php';
			uno.submit();
			return;
				
		}
		if(n==1)
		{
			uno.target='area';
			uno.action='busca_causa.php';
			uno.submit();	
		}
		if(n==2)
		{
			uno.target='area';
			uno.action='guardahistoespe.php';
			uno.submit();	
		}		
	}
	function regresa()
	{
		uno.valregre.value='LP';
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
<form name=uno action="left.php" method="post" enctype="multipart/form-data" > 
<?php
//echo $Gcod_mediconh;
include('php/conexion1.php');
$besp=mysql_query("SELECT medicos.cod_medi, destipos.nomb_des, destipos.homo3_des
FROM medicos INNER JOIN destipos ON medicos.espe_med = destipos.codi_des
WHERE (((medicos.cod_medi)='$Gcod_mediconh'))");
$nesp=mysql_fetch_array($besp);
$tiespe=$nesp['homo3_des'];

if($Gareanh=='62')$concontrol='1';
else
{
	if($tiespe==2)
	{	
		$bhis=mysql_query("SELECT consultaprincipal.numc_cpl, encabesadohistoria.idus_ehi, consultaprincipal.feca_cpl, consultaprincipal.come_cpl, encabesadohistoria.cous_ehi, consultaprincipal.area_cpl
		FROM encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl
		WHERE (((consultaprincipal.come_cpl)='$Gcod_mediconh') AND ((encabesadohistoria.cous_ehi)='$paciente') AND ((consultaprincipal.area_cpl)='$Gareanh'))");
		if(mysql_num_rows($bhis)>0)$concontrol='2';
		else $concontrol='1';
	}
	else $concontrol='1';
}
$concontrol='1';
if($Gcod_mediconh=='1301')$concontrol='2';
//$concontrol='1';
//while($resp
include('php/conexion.php');
//base_general();
$consultausu=mysql_query("SELECT nomb_usua,tip_usuario FROM cut WHERE ide_usua='$Gcod_mediconh'");
$rowusu=mysql_fetch_array($consultausu);
$nombreusu=$rowusu[nomb_usua];
$tip_usuario=$rowusu[tip_usuario];

//echo '<br>'.$tiespe.' - '.$concontrol;
echo"<input type=hidden name=areal value='$Gareanh'>";
?>
<a name="top"></a>
<div class="screenBody" id="">
  
  <input type=hidden name=valregre>
  <input type=hidden name=codusu>
  <input type=hidden name=direccion>
  <input type=hidden name=codiprg>
  <input type=hidden name=titulo>
  <br>
    <table id="" cellspacing="0" cellpadding="0" width="100%" border="0" summary="Navigation Items Area">
      <?php
        $consulta=mysql_query("SELECT codi_men,descr_men FROM menu WHERE aplic_men='59' and nivel_men=1");
		while($row=mysql_fetch_array($consulta))
		{		
		  ?>
	        <tr>
	          <td>
                <div id="navLayout">				  
				  <?php $id='id'.$row[codi_men];?>
				  
                  <table border="0" cellspacing="0" cellpadding="0" width="100%" class="navOpened" id="<?php echo $id;?>">
                    <tr>
                      <td>
	                    <table border="0" cellspacing="0" cellpadding="0" width="100%" class="navTitle" onClick="return opentree ('<?echo $id;?>');">
	                      <tr>
	                        <td class="titleLeft" ><img src="icons/topleft.gif" border="0" alt=""/></td>
	                        <td class="titleText" width="100%"><?echo $row[descr_men];?></td>
	                        <td class="titleHandle"><img src="/skins/winxp.blue/images/1x1.gif" width="20" height="1" border="0" alt=""/></td>
	                      </tr>
	                    </table>
	                  </td>
	                </tr>
					<?php
					/*echo "SELECT menu.descr_men, menu.url_men, menu.img_men, menuxusu.ide_usua, menu.nivel_men, menu.depen_men, ord_men
						FROM menu INNER JOIN menuxusu ON menu.codi_men = menuxusu.codi_men
						WHERE (((menuxusu.ide_usua)='$Gcod_mediconh') AND ((menu.nivel_men)=2) AND ((menu.depen_men)='$row[codi_men]')) AND (img_men='3' or img_men='$concontrol')  ORDER BY ord_men";*/
					if($tip_usuario=='02')
					{
						$consultaopc=mysql_query("SELECT depen_men,codi_men,depen_men,descr_men,url_men,img_men, ord_men FROM menu WHERE nivel_men=2 and depen_men=$row[codi_men] AND (img_men='3' or img_men='$concontrol') ORDER BY ord_men");
					}					
					else
					{
						$consultaopc=mysql_query("SELECT menu.descr_men, menu.url_men, menu.img_men, menuxusu.ide_usua, menu.nivel_men, menu.depen_men, ord_men
						FROM menu INNER JOIN menuxusu ON menu.codi_men = menuxusu.codi_men
						WHERE (((menuxusu.ide_usua)='$Gcod_mediconh') AND ((menu.nivel_men)=2) AND ((menu.depen_men)='$row[codi_men]')) AND (img_men='3' or img_men='$concontrol')  ORDER BY ord_men");
					}
					if(mysql_num_rows($consultaopc)<>0){
					    $codi=1;
						 while($rowopc=mysql_fetch_array($consultaopc)){
					      ?>
					        <tr>
	                          <td>
				                <div class="tree">
	                              <table border="0" cellspacing="0" cellpadding="0" width="100%" id="usuarios" class="nodeActive">
	                                <tr>
	                                  <td class="nodeImage"><a href="#" title=""></a></td>
									    <?php
										$codterfli=$rowopc[codi_men];
										$dire=$rowopc[url_men];
										$titu=$rowopc[descr_men];
										$depen_men=$rowopc[depen_men];
										$orden=$rowopc[ord_men];
										if($concontrol==2)
										{
											if($orden==1)$archivo='tmp/11HC'.$numcita.'-'.$paciente.'.txt'; //SOAP
											if($orden==4)$archivo='tmp/3HC'.$numcita.'-'.$paciente.'.txt';//EXAMEN FISICO
											if($orden==5)$archivo='tmp/4HC'.$numcita.'-'.$paciente.'.txt'; //DIAGNOSTICOS
											if($orden==7)$archivo='tmp/5HC'.$numcita.'-'.$paciente.'.txt'; //ORDENES
											if($orden==8)$archivo='tmp/6HC'.$numcita.'-'.$paciente.'.txt'; //MEDICAMENTOS
											if($orden==9)$archivo='tmp/incaHC'.$numcita.'-'.$paciente.'.txt';//INCAPACIDADES
											if($orden==10)$archivo='tmp/8HC'.$numcita.'-'.$paciente.'.txt'; //RECOMENDACIONES
											if($orden==16)$archivo='tmp/13HC'.$numcita.'-'.$paciente.'.txt';//Conducta Referencia/Contrareferencia
											if($orden==18)$archivo='tmp/juntam'.$numcita.'-'.$paciente.'.txt';//Conducta Referencia/Contrareferencia
										}
										else
										{											
											$archivo='';											
											if($orden==2)$archivo='tmp/1HC'.$numcita.'-'.$paciente.'.txt'; //ANAMNESIS
											if($orden==3)$archivo='tmp/2HC'.$numcita.'-'.$paciente.'.txt'; //ANTECEDENTES
											if($orden==4)
											{
												if($Gareanh=='62')
												{
													$archivodolor='tmp/HCDOLOR'.$numcita.'-'.$paciente.'.txt';		
													if(file_exists($archivodolor)==TRUE)
													{
														$archivo='tmp/ex_fisi1-'.$numcita.'-'.$paciente.'.txt';
													}
													else
													{	
														$archivo='tmp/3HC'.$numcita.'-'.$paciente.'.txt'; //EXAMEN FISICO
													} 
												}
												else
												{
													$archivo='tmp/3HC'.$numcita.'-'.$paciente.'.txt'; //EXAMEN FISICO
												}	
											}
											if($orden==5)$archivo='tmp/4HC'.$numcita.'-'.$paciente.'.txt';//DIAGNOSTICOS
											if($orden==6)$archivo='tmp/12HC'.$numcita.'-'.$paciente.'.txt';//VALORACION DE LA FAMILIA
											if($orden==7)$archivo='tmp/5HC'.$numcita.'-'.$paciente.'.txt';//ORDENES
											if($orden==8)$archivo='tmp/6HC'.$numcita.'-'.$paciente.'.txt';//MEDICAMENTOS
											if($orden==9)$archivo='tmp/incaHC'.$numcita.'-'.$paciente.'.txt';//INCAPACIDADES
											if($orden==10)$archivo='tmp/8HC'.$numcita.'-'.$paciente.'.txt';//RECOMENDACIONES
											if($orden==1)$archivo='tmp/13HC'.$numcita.'-'.$paciente.'.txt';//Conducta Referencia/Contrareferencia
											if($orden==18)$archivo='tmp/juntam'.$numcita.'-'.$paciente.'.txt';//Conducta Referencia/Contrareferencia
										
										}
										
										if($depen_men==271)
										{
											if(file_exists($archivo)==TRUE)
											{
												echo"<td width='100%'><a href='#' onclick='salir(\"$dire\",\"$titu\",\"$depen_men\")' title='$rowopc[descr_men]'><img src='icons/ya.png' alt='' width='10' height='10' border='0'> $rowopc[descr_men]</a></td>";
											}
											else
											{
												echo"<td width='100%'><a href='#' onclick='salir(\"$dire\",\"$titu\",\"$depen_men\")' title='$rowopc[descr_men]'><img src='icons/yano.png' alt='' width='10' height='10' border='0'> $rowopc[descr_men]</a></td>";
											}
										}
										else
										{											
											if($Gareanh=='62' && ($codterfli=='280' || $codterfli=='281' || $codterfli=='282' || $codterfli=='284'))
											{
												echo"<td width='100%'> <a href='#' onclick='saliranes1(\"$dire\",\"$titu\",\"$depen_men\")' title='$rowopc[descr_men]'> $rowopc[descr_men]</a></td>";
											}
											else
											{
												echo"<td width='100%'> <a href='#' onclick='salir(\"$dire\",\"$titu\",\"$depen_men\")' title='$rowopc[descr_men]'> $rowopc[descr_men]</a></td>";
											}	
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
			
		  <?php
		}
		echo"<tr><td><a href= '#' onclick='regresa()'><font size=4 color='#FFFFFF'>Lista pacientes</font></a><br><br></td></tr>";
		echo"<tr><td><a href='#' onclick='ultima_conducta($paciente)'><font size=2 color='#FFFFFF'>Conducta Ultimos 3 Meses</a></td><tr>";
		$archivo1='tmp/1HC'.$numcita.'-'.$paciente.'.txt';
		$archivo2='tmp/2HC'.$numcita.'-'.$paciente.'.txt';
		$archivo3='tmp/3HC'.$numcita.'-'.$paciente.'.txt';
		$archivo4='tmp/4HC'.$numcita.'-'.$paciente.'.txt';
		$archivo11='tmp/11HC'.$numcita.'-'.$paciente.'.txt';
		$archivo12='tmp/12HC'.$numcita.'-'.$paciente.'.txt';		
        $archivo13='tmp/13HC'.$numcita.'-'.$paciente.'.txt';
		$archivojun='tmp/juntam'.$numcita.'-'.$paciente.'.txt';
		if($concontrol==1)
		{                            
			if($Gareanh=='01')
			{			
				include('php/conexion1.php');
				$d=0;
				$bfam=mysql_query("select * from conambfam where codi_usu='$paciente' order by fecha_cfa");
				while($rfam=mysql_fetch_array($bfam))
				{
					$apgpun_cfa=$rfam['apgpun_cfa'];
					$phqpun_cfa=$rfam['phqpun_cfa'];
					$fecha_cfa=$rfam['fecha_cfa'];
					$d++;					
					
				}
				$fecha=$fecha_cfa." 00:00:00";
				$segundos=strtotime('now') - strtotime($fecha);
				$difer=intval($segundos/60/60/24);
				//echo "La cantidad de días entre el ".$fecha." y hoy es <b>".$difer."</b>";
				
				if($apgpun_cfa>=0 && $apgpun_cfa<10)$dias1=365;
				if($apgpun_cfa>=10 && $apgpun_cfa<14)$dias1=365;
				if($apgpun_cfa>=14 && $apgpun_cfa<18)$dias1=90;
				if($apgpun_cfa>=18 && $apgpun_cfa<=20)$dias1=365;
				
				if($phqpun_cfa>=0 && $phqpun_cfa<5)$dias2=365;
				if($phqpun_cfa>=5 && $phqpun_cfa<10)$dias2=90;
				if($phqpun_cfa>=10 && $phqpun_cfa<15)$dias2=30;
				if($phqpun_cfa>=15 && $phqpun_cfa<20)$dias2=365;
				if($phqpun_cfa>=20 && $phqpun_cfa<=27)$dias2=365;
				
				$bedad=mysql_query("select FNAC_USU from usuario where CODI_USU='$paciente'");
				while($redad=mysql_fetch_array($bedad))
				{
					$fnac=$redad['FNAC_USU'];
				}
				$anospac=edadpaciente($fnac);	
				
				
								
				if($anospac>14)
				{
					if($dias1<=$difer || $dias2<=$difer || $d==0)
					{
						if(file_exists($archivo1)==TRUE && file_exists($archivo2)==TRUE && file_exists($archivo3)==TRUE && file_exists($archivo4)==TRUE && file_exists($archivo12)==TRUE)
						{				
							echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
						}
					}
					else
					{
						if(file_exists($archivo1)==TRUE && file_exists($archivo2)==TRUE && file_exists($archivo3)==TRUE && file_exists($archivo4)==TRUE)
						{				
							echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
						}
					}
				}
				else
				{
					if(file_exists($archivo1)==TRUE && file_exists($archivo2)==TRUE && file_exists($archivo3)==TRUE && file_exists($archivo4)==TRUE)
					{				
						echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
					}
				}
			}
			
			
			else if($Gareanh=='62')
			{
				$archivodolor='tmp/HCDOLOR'.$numcita.'-'.$paciente.'.txt';		
				if(file_exists($archivodolor)==TRUE)
				{
					$archivofis61='tmp/ex_fisi1-'.$numcita.'-'.$paciente.'.txt';
					if(file_exists($archivo1)==TRUE && file_exists($archivo2)==TRUE && file_exists($archivofis61)==TRUE && file_exists($archivo4)==TRUE)
					{	
						$concontrol=1;
						echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
					}	
				}
				else	
				{
					if(file_exists($archivo1)==TRUE && file_exists($archivo2)==TRUE && file_exists($archivo3)==TRUE && file_exists($archivo4)==TRUE)
					{
						echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
					}
				}	
			}
			else
			{				
				if(file_exists($archivo1)==TRUE && file_exists($archivo2)==TRUE && file_exists($archivo3)==TRUE && file_exists($archivo4)==TRUE)
				{
					echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
				}
			}
		}
                
		if($concontrol==2)
		{
            if($Gareanh=='878' && $Gcod_mediconh=='1301')
			{
				if(file_exists($archivo11)==TRUE && file_exists($archivo4)==TRUE && file_exists($archivojun)==TRUE)
				{
					echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
				}
			}
			else
			{
				if(file_exists($archivo11)==TRUE && file_exists($archivo4)==TRUE)
				{
					echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
				}
			}
		}
		
		
		
		
		$clorden='0';
		$archivo12='tmp/5HC'.$numcita.'-'.$paciente.'.txt';	
		$nlab=0;
		$procontrol=0;
		if(file_exists($archivo12))
		{
			$fp = fopen ($archivo12, "r" );
			$reg1=0;
			while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ) 
			{ 
				$reg++;
				$i = 0;
				foreach($data as $dato)
				{
					$campo[$i]=$dato;
					$i++ ;
				}
				$$campo[1]=$campo[2];
				if($reg % 8 == 0)
				{
					$ini=substr($codorden,0,2);
					if($ini=='90')$nlab=1;
					if($claseorden=="2" || $claseorden=="3" || $claseorden=="4" || $claseorden=="5")$clorden=1;
					if($claseorden=="4" || $claseorden=="3" || $claseorden=="2")$procontrol=1;
					
				}				
			}
		}
		echo "<input type=hidden name=procontrol value=$procontrol>"; //valida si se cito a control 0=no, 1=si
		echo "<input type=hidden name=clorden value=$clorden>"; // valida si hay referencia 0=no 1=si
		echo "<input type=hidden name=numlab value=$nlab>"; //	valida si hay ordenes de laboratorio 0=no 1=si
		
		$archivo14='tmp/8HC'.$numcita.'-'.$paciente.'.txt';	
		if(file_exists($archivo14))
		{
			$fp = fopen ($archivo14, "r" );
			$reg=0;
			while (( $data = fgetcsv ( $fp , 30000 , "|" )) !== FALSE ) 
			{ 
				$reg++;
				$i = 0;
				foreach($data as $dato)
				{
					$campo[$i]=$dato;
					$i++ ;
				}
				$$campo[1]=$campo[2];		
			}
		}
		echo "<input type=hidden name=tiproxiontrol value=$tiproxi>"; //> 0 < a 10 dias (0 o 1)
		echo "<input type=hidden name=proxicontrol value=$proxima>";	// numero de dias
		
		/*
		if($concontrol==1)
		{
			if(file_exists($archivo1)==TRUE && file_exists($archivo2)==TRUE && file_exists($archivo3)==TRUE && file_exists($archivo4)==TRUE)
			{
				echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
			}
		}
		if($concontrol==2)
		{
			if(file_exists($archivo11)==TRUE && file_exists($archivo4)==TRUE)
			{
				echo"<tr><td><a href='#' onclick='ceraarcon($concontrol)'><font size=4 color='#FFFFFF'>Cerrar consulta</font></a><br><br></td></tr>";
			}
		}
		*/
	function edadpaciente($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en n�meros enteros
        $dia=date("d");
        $mes=date("m");
        $anno=date("Y");
        //descomponer fecha de nacimiento
        $dia_nac=substr($fecha_nac, 8, 2);
        $mes_nac=substr($fecha_nac, 5, 2);
        $anno_nac=substr($fecha_nac, 0, 4);
        if($mes_nac>$mes)
        {
            $calc_edad= $anno-$anno_nac-1;
        }
        else
        {
            if($mes==$mes_nac AND $dia_nac>$dia)
            {
                $calc_edad= $anno-$anno_nac-1;
            }
            else
            {
                $calc_edad= $anno-$anno_nac;
            }
        }
        return $calc_edad;
    }
/*
1HC ANAMNESIS
2HC ANTECEDENTES
3HC EXAMEN FISICO
4HC DIAGNOSTICOS
5HC ORDENES
6HC MEDICAMENTOS
incaHC NCAPACIDADES
8HC RECOMENDACIONES
9HC 
10HC 
11HC SOAP
12HC VALORACION DE LA FAMILIA
13hc Conducta Referencia/Contrareferencia

*/
	
      ?>	  
	</table>
	
  </form>
</div>
<font size='1' color='#ffffff'>

</font>
</body>
</html>