<HTML>
<HEAD>
</HEAD>
<BODY style="font-family: Verdana">


<?
	//192.168.4.2/intraweb/intranet/formula/costos/busca_usuarios_multiformula2.php
	set_time_limit (100000);  
	//$cadcon=odbc_connect("COSTOFARMA","","");
	$obdcsal6="DELETE FROM repetidos WHERE 1";
	//$resultsal7=odbc_exec ($cadcon,$obdcsal6);	
    $link=Mysql_connect("localhost","root","");
	Mysql_select_db('formedica');
	$borra=mysql_query("DELETE FROM repetidos WHERE 1");
	$cont=0;
	$i=0;
	$archivo="temp/repetidos_09_2014.txt";
	if(file_exists($archivo)==TRUE)
	{		
		unlink($archivo);
	}
	
	
	$a="NUMERO\t";	
	$a.="REGISTRO\t";
	$a.="CEDULA\t";
	$a.="PACIENTE\t";
	$a.="FECHA\t";
	$a.="CODCONTRA\t";
	$a.="CONTRATO\t";
	$a.="CODAREA\t";
	$a.="AREA\t";
	$a.="CODMEDICO\t";
	$a.="MEDICO\t";
	$a.="CODBODEGA\t";		
	$a.="BODEGA\t";	
	$a.="CODPROD\t";
	$a.="PRODUCTO\t";
	$a.="CANTIDAD\t";
	$a.="COSTO\n";	
	$p=fopen($archivo,"a");
	if($p)
	{
		fputs($p,$a);
	}
	
	
	
	
    $cadmed=Mysql_query("SELECT formulamae.codi_usu, formulamae.fdis_for, formulamae.ccos_for, formulamae.scco_for, formulamae.tido_for, formulamae.codi_medi, formulamae.codi_bod, formuladet.codi_pro, 
	formuladet.cdis_for,formuladet.regi_for
	FROM formulamae INNER JOIN formuladet ON formulamae.nume_for = formuladet.nume_for
	WHERE ((((formulamae.fdis_for)>='2014-08-25') and (formulamae.fdis_for)<='2014-09-31') AND (formulamae.codi_bod)='2' AND ((formulamae.scco_for)='5' Or (formulamae.scco_for)='15' Or (formulamae.scco_for)='17') and formuladet.cdis_for>0 AND ((formulamae.tido_for)='1' Or (formulamae.tido_for)='2'))
	ORDER BY formulamae.codi_usu, formuladet.codi_pro, formulamae.fdis_for");
	$m=0;
	$n=0;
    while($row0 = mysql_fetch_array($cadmed))
    {
			
		if($n==0)
		{
			$cedula1=$row0['codi_usu'];  
			$fecha1=$row0['fdis_for'];
			$codprod1=$row0['codi_pro'];				
			$registro1=$row0['regi_for'];
			$codcontra1=$row0['ccos_for'];
			$codarea1=$row0['scco_for'];
			$tipodoc1=$row0['tido_for'];
			$codmedico1=$row0['codi_medi'];	
			$codbodega1=$row0['codi_bod'];		
			$canti1=$row0['cdis_for'];
		}
		if($n==1)
		{
			$cedula2=$row0['codi_usu'];  
			$fecha2=$row0['fdis_for'];
			$codprod2=$row0['codi_pro'];				
			$registro2=$row0['regi_for'];
			$codcontra2=$row0['ccos_for'];
			$codarea2=$row0['scco_for'];
			$tipodoc2=$row0['tido_for'];
			$codmedico2=$row0['codi_medi'];	
			$codbodega2=$row0['codi_bod'];		
			$canti2=$row0['cdis_for'];
		}
		if($n>1)
		{			
			$cedula3=$row0['codi_usu'];  
			$fecha3=$row0['fdis_for'];
			$codprod3=$row0['codi_pro'];				
			$registro3=$row0['regi_for'];
			$codcontra3=$row0['ccos_for'];
			$codarea3=$row0['scco_for'];
			$tipodoc3=$row0['tido_for'];
			$codmedico3=$row0['codi_medi'];	
			$codbodega3=$row0['codi_bod'];		
			$canti3=$row0['cdis_for'];
			
			$ced1=$cedula1;
			$fec1=$fecha1;
			$cod1=$codprod1;
			$ced2=$cedula2;
			$fec2=$fecha2;
			$cod2=$codprod2;
			$ced3=$cedula3;
			$fec3=$fecha3;
			$cod3=$codprod3;
								
			$an1=substr($fec1,0,4);
			$me1=substr($fec1,5,2);
			$di1=substr($fec1,8,2);
			$an2=substr($fec2,0,4);
			$me2=substr($fec2,5,2);
			$di2=substr($fec2,8,2);
			$an3=substr($fec3,0,4);
			$me3=substr($fec3,5,2);
			$di3=substr($fec3,8,2);		
			
			$tim1=mktime(0,0,0,$me1,$di1,$an1);
			$tim2=mktime(0,0,0,$me2,$di2,$an2);
			$tim3=mktime(0,0,0,$me3,$di3,$an3);
			
			$cuenta=60*60*24*15;
			$tiempo1=$tim2-$tim1;
			$tiempo2=$tim3-$tim2;
			
			$entra=0;
			if($ced1==$ced2 && $cod1==$cod2 && $tiempo1<$cuenta)$entra=1;
			if($ced2==$ced3 && $cod2==$cod3 && $tiempo2<$cuenta)$entra=1;
			//echo $ebtra.'<br>';
			if($entra==1)
			{				
				$$nombodega='';
				$nomarea='';
				$nomcontra='';
				$costou='';
				$nomusu='';
				$nommedico='';
				$nombre='';
				$codsiigo='';
				Mysql_select_db('proinsalud');
				$bussub=mysql_query("select * from usuario where NROD_USU='$cedula2'");
				$row2 = mysql_fetch_array($bussub);
				$nomusu=$row2['PNOM_USU'].' '.$row2['SNOM_USU'].' '.$row2['PAPE_USU'].' '.$row2['SAPE_USU'];
				$bussub=mysql_query("select * from medicos where csii_med='$codmedico2'");
				$row2 = mysql_fetch_array($bussub);
				$nommedico=$row2['nom_medi'];
				$busmedi=mysql_query("select * from medicamentos2 where codi_mdi='$codprod2'");
				$row2 = mysql_fetch_array($busmedi);
				$nombre=$row2['nomb_mdi'];
				$codsiigo=$row2['ncsi_medi'];
				Mysql_select_db('formedica');
				$busbod=mysql_query("select * from bodegas where codi_bod='$codbodega2'");
				$row2 = mysql_fetch_array($busbod);
				$nombodega=$row2['desc_bod'];
				$bussub=mysql_query("select * from subcentro where codigo='$codarea2'");
				$row2 = mysql_fetch_array($bussub);
				$nomarea=$row2['NomSubCenteo'];
				$bussub=mysql_query("select * from centro where codigo='$codcontra2'");
				$row2 = mysql_fetch_array($bussub);
				$nomcontra=$row2['NomCentro'];
				$bcos=mysql_query("select * from producto2013 where CODSIIGO='$codsiigo'");
				$rcos=mysql_fetch_array($bcos);
				$costou=$rcos['COSTO_UNITARIO'];
				
				
				$a="$n\t";	
				$a.="$registro2\t";
				$a.="$cedula2\t";
				$a.="$nomusu\t";
				$a.="$fecha2\t";
				$a.="$codcontra2\t";
				$a.="$nomcontra\t";
				$a.="$codarea2\t";
				$a.="$nomarea\t";
				$a.="$codmedico2\t";
				$a.="$nommedico\t";
				$a.="$codbodega2\t";	
				$a.="$nombodega\t";
				$a.="$codprod2\t";
				$a.="$nombre\t";
				$a.="$canti2\t";
				$a.="$costou\n";	
				$p=fopen($archivo,"a");
				if($p)
				{
					fputs($p,$a);
				}					
				$m++;			
			}
			$cedula1=$cedula2; 
			$fecha1=$fecha2;
			$codprod1=$codprod2;				
			$registro1=$registro2;
			$codcontra1=$codcontra2;
			$codarea1=$codarea2;
			$tipodoc1=$tipodoc2;
			$codmedico1=$codmedico2;	
			$codbodega1=$codbodega2;		
			$canti1=$canti2;
			
			$cedula2=$cedula3; 
			$fecha2=$fecha3;
			$codprod2=$codprod3;				
			$registro2=$registro3;
			$codcontra2=$codcontra3;
			$codarea2=$codarea3;
			$tipodoc2=$tipodoc3;
			$codmedico2=$codmedico3;	
			$codbodega2=$codbodega3;		
			$canti2=$canti3;
		}
		$n++;
	}
		
		
		
		
	echo 'FIN nn'.$n.' '.$m;
?>
</BODY>
</HTML>
