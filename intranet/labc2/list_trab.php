<?
//session_register('Gcod_medico');
SET_TIME_LIMIT(2000);
?> 

<!--DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->
<HEAD>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 

<!-- librera principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librera para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librera que declara la funcin Calendar.setup, que ayuda a generar un calendario en unas pocas lneas de cdigo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

 <TITLE>LISTADOS DE USUARIOS</TITLE>
 <link rel="stylesheet" href="css/style.css" type="text/css" />
   <script language='Javascript'>
   
	function abrecierra(it,mt)
	{
		uno.it.value=it;
		uno.mcu.value=mt;
		uno.action='gresul_.php';
		uno.submit();
	}
	
	

	function busca()
		{
			uno.esta_ncf.value=1;
			uno.action='list_trab.php';
			uno.target='';
			uno.submit();
		}



    </script>
</HEAD>
<BODY >
<style>
.tm1{
color: #1D669E;

}
.tm
{
color:#1D669E;
}
.enlace {
border: 0;
padding: 0;
background-image: url('img/feed_go.png');
width:70%;
height:22;
background-repeat:no-repeat;
color: blue;
border-bottom: 1px solid blue;
TEXT-DECORATION: none;
}
</style>
<?    	
	
	$link=Mysql_connect("localhost","root","");
	if(!$link){echo"no hay conexion";}
	Mysql_select_db('proinsalud',$link);
	
	
	$anno=date('Y');	
	$mes=date('m');	
	$dia=date('d');		
	
    echo "<form name=uno method=post action=list_trab.php target='frm12'>";
	echo"<br><table class='Tbl1' border=0><tr><th class='Th0'>LISTADOS DE TRABAJO</th></tr></table>";
	
	echo"<table class='Tbl21'>";	
	$fecha=time();
	$fecdia=date ("Y-m-d",$fecha);
	if(empty($fin))$fin=$fecdia;
	if(empty($ffin))$ffin=$fecdia;

		
	?>
		<!-- fecha de recepcion de Muetras -->
		<tr>
		<td><strong> Nº.Orden:</strong></td><td><input type=text name=n_ord  size='10' maxlength='12' >
		<script language='Javascript'>uno.n_ord.value="<?echo $n_ord?>";</script></td>
		<td colspan=2><strong> Fecha Solicitud:</strong></td><td colspan='3' >
		<!-- formulario con el campo de texto y el botn para lanzar el calendario--> 
		<?php echo "<input type=text name=ffin id=ffin size='10' value= >";?>
		<input type="button" id="lanzador2" value="..." />
		<!-- script que define y configura el calendario--> 
		<script type="text/javascript"> 
		Calendar.setup({ 
		inputField   :    "ffin",     // id del campo de texto 
		ifFormat     :     "%Y-%m-%d",     // formato de la fecha que se escriba en el campo de texto 
		button       :    "lanzador2"     // el id del botn que lanzar el calendario 
		}); 
		</script> </td></tr>
		<script language=javascript>uno.ffin.value="<?echo $ffin?>";</script>
	
	<?
	echo"<td><strong>Grupo</td><td>";
	
	$con_gpo=mysql_query("SELECT codi_des,codt_des,nomb_des,valo_des,val2_des,homo_esp FROM destipos WHERE codt_des=46 order by nomb_des");
	echo"<select name='grup_lab'>";
	echo "<option value=''></option>";
	while($row_gpo=mysql_fetch_array($con_gpo))
	{
		echo "<option value=$row_gpo[codi_des]>$row_gpo[nomb_des]</option>";
	}
	echo  "</select></td><td colspan=4><input type=submit name='Buscar' value='Buscar' onclick='busca()'></td></td></tr></table>";
				
	?><script language='Javascript'>uno.grup_lab.value="<?echo $grup_lab?>";</script>
	
	<?
	if($esta_ncf=='1' )
	{
		echo"<br><table class='Tbl21'border=0 align='left'>
		<tr>         
		<th class='Th0'>ORDEN</th>
		<th class='Th0'>DOCUMENTO</th>
		<th class='Th0'>NOMBRE</th>
		<th class='Th0'>OP</th>
		</TR>
		<tr>   	 
		<th height=12></th>
		</TR>";
		
		$condicion="el.fchr_labs='$ffin' AND (dl.estd_dlab='P' or dl.estd_dlab='PU')";
		
		if((!empty($grup_lab))) 
		{
			if($grup_lab=='4613')
			{
				$grup_lab2='4602 OR cp.grup_quim=4605 OR cp.grup_quim=4611)';
				$condicion=$condicion.' AND (cp.grup_quim='.$grup_lab2;
			}
			else
			{
				$condicion=$condicion.' AND cp.grup_quim='.$grup_lab;
			}
		}	
		if(!empty($n_ord))
		{
			$condicion=$condicion.' AND dl.nord_dlab='.$n_ord ;
		}
	
			
		$cons=MYSQL_QUERY("SELECT el.iden_labs,dl.estd_dlab,
			us.NROD_USU,us.CODI_USU ,us.PNOM_USU, us.SNOM_USU, us.PAPE_USU, us.SAPE_USU,dl.nord_dlab 
			FROM detalle_labs AS dl
			INNER JOIN encabezado_labs as el ON el.iden_labs=dl.iden_labs
			INNER JOIN usuario AS us ON us.codi_usu=el.codi_usu 
			INNER JOIN cups AS cp ON dl.codigo=cp.codigo
			WHERE $condicion 
			GROUP BY dl.nord_dlab
			order by dl.nord_dlab");		
			
			//echo $cons;
	
			if(mysql_num_rows($cons)<>0)	
			{
				$i=0;
				while ($rowx=mysql_fetch_array($cons))
				{
						// echo "aqui toy";
						  $codusu=$rowx['CODI_USU'];
						  $neps_con=$rowx['NEPS_CON'];
						  $iden_labs=$rowx['iden_labs'];
						  $cod_usu=$rowx[NROD_USU];
						  echo "<tr bgcolor=#FEE9BC>";
						  $nomvar='codchk'.$i;
						  $valor=$$nomvar;
				      	  $num_ord=$rowx['nord_dlab'];
				          
						  
						  $nomvar='codusu'.$i;
						  echo "<input type=hidden name=$nomvar value=$codusu>";	
						  
						  $nomvar='iden_labs'.$i;
						  echo "<input type=hidden name=$nomvar value=$iden_labs>";	
						  
						  $nomvar='num_ord'.$i;
						  echo "<input type=hidden name=$nomvar value=$num_ord>";	
						  
						  echo"<th class='Td0'><p align='left'>$rowx[nord_dlab]</td>";
						  echo"<th class='Td0'><p align='left'>$rowx[NROD_USU]</td>";
						  echo"<th class='Td0'><p align='left'>$rowx[PNOM_USU] $rowx[PAPE_USU]</td>";
						  //echo"</tr>";
						
	 					$cond2="iden_labs='$iden_labs' AND (detalle_labs.estd_dlab='PU' or  detalle_labs.estd_dlab='P') AND detalle_labs.etdv_dlab=' '";
					
						if(!empty($grup_lab))
						{
						  if($grup_lab=='4613')
						  {
							$grup_lab2='4602 OR cp.grup_quim=4605 OR cp.grup_quim=4611)';
							$cond2=$cond2.' AND (cp.grup_quim='.$grup_lab2;
							//echo $condicion;
						  }
						  else
						  {
							$cond2=$cond2.' AND cp.grup_quim='.$grup_lab;
						  }
						}
						$conex=mysql_query("SELECT detalle_labs.iden_labs,detalle_labs.iden_dlab ,detalle_labs.codigo, cp.descrip
						FROM detalle_labs AS detalle_labs
						INNER JOIN cups AS cp ON detalle_labs.codigo = cp.codigo
						WHERE $cond2");
						
						//echo $conex;
						
						$mcu=1;
						while ($rowexa=mysql_fetch_array($conex))
						{
							$desc=$rowexa['descrip'];
							$cod=$rowexa['codigo'];
							$iden_dlab=$rowexa['iden_dlab'];
														
							$nomvar='cod'.$i.$mcu;
							echo "<input type=hidden name=$nomvar value=$cod>";
											
							$nomvar='selec'.$i.$mcu;									
							echo "<input type=hidden name=$nomvar value=1>";
							
							$nomvar='iden_dlab'.$i.$mcu;
							echo "<input type=hidden name=$nomvar value=$iden_dlab>";	
											
							$cql[$mcu]=$desc;
									   
								
							$mcu++;
									    
						}		 
						mysql_free_result($conex);
						echo "<th class='Td0' ><span  class='tm1'><p align='left'><a href='#' onclick='abrecierra($i,$mcu)'><img src='imagenes/search.gif' width=15 alt='Examenes'></span></a>
						</td></tr>";
					$i++;
				}
				mysql_free_result($cons);
				echo "</table>";
		}
		else
		{
		
		 echo "<th class='Td0'><span  class='tm1'><b>NO EXISTEN EXAMENES PARA LA FECHA</td></tr></table>";

		}
			
		
		echo "<input type=hidden name=it>";
		echo "<input type=hidden name=mcu>";
	}
		 echo "<input type=hidden name=ctrl value=1>";
		 echo "<input type=hidden name=item1>";
		 echo "<input type=hidden name=item2>";
		 echo "<input type=hidden name=ser value=$ser>";
		 echo "<input type=hidden name=gfec_ value='$gfec_'>";	
		 echo "<input type=hidden name=ghor_ value='$ghor'>";
		 
		 echo "<input type=hidden name=idfin>";
		 echo "<input type=hidden name=ide_cita>";	
		 echo "<input type=hidden name=codig_usu >";
		 echo "<input type=hidden name=esta_ncf>";
?>
</BODY>
</HTML>
<html><head></head><body></body></html>