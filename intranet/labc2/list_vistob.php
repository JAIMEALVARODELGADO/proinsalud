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
   function cambio(campo)
	{
		campo.select();
	}
	function abrecierra(it,mt)
	{
		uno.it.value=it;
		uno.mcu.value=mt;
		//alert(uno.it.value);
		uno.action='modi_labs.php';
		uno.submit();
	}
	
	function ver1(form,a)
	{
	  form.cuentas1.value=(10/1)*a/1;	 
		alert(form.cuentas1.value);	  
	  form.action='list_vistob.php';
	  form.submit();
	}
	function enviar(valori,valorj)
	{
		uno.prim.value=valori;
		uno.segun.value=valorj;		
		uno.action='imagen1.php';
		uno.submit();
	}
	function busca()
		{
			//alert("toy");
			uno.esta_ncf.value=1;
			uno.action='list_vistob.php';
			uno.target='';
			uno.submit();
		}

	
	function busca2()
		{
			//alert("toy");
			//uno.fin.value=fin;
			uno.action='list_vistob.php';
			uno.target='';
			uno.submit();
		}
	function bus_ced()
	{
	
		uno.action='list_vistob.php';
		uno.target='';
		uno.submit();
	
	}
	function abrir2(fec_var,hor_var) {
		
		uno.ghor_.value=hor_var;
		uno.gfec_.value=fec_var;
		
		//alert(uno.gfec_.value);
		uno.submit();
	}
	function cargar()
	{
		//alert("se fue");
		uno.action='gen_rips_hospi.php';
		uno.submit();
	}
	function validar(i,j)
	{
		 if(event.keyCode==13)
		 {
			cual=eval("uno.num_fac"+i+j+".value");
			
			uno.action='list_vistob.php';
			uno.target='';
			uno.submit();
			//return true;
		 }
			
	}
	function prueba(i)
	{
		var nombre ="uno.norden"+i+".value";
		nord=eval(nombre)
		alert(nord)
		uno.norden.value=nord;
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
	echo"<br><table class='Tbl1' border=0><tr><th class='Th0'>LISTADOS DE PACIENTES PENDIENTE VALIDACION</th></tr></table>";
	
	echo"<table class='Tbl1'>";	
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
		echo"<br><table class='Tbl21' border=0>
		<tr>         
		<th class='Th0'>ORDEN</th>
		<th class='Th0'>DOCUMENTO</th>
		<th class='Th0'>NOMBRE</th>
		<th class='Th0'>OP</th>
		</TR>
		<tr>   	 
		<th height=12></th>
		</TR>";
		
		$condicion="el.fchr_labs='$ffin' AND dl.estd_dlab='PR'";
		
		if((!empty($grup_lab))) 
		{
			$condicion=$condicion.' AND cp.grup_quim='.$grup_lab;
		}	
		if(!empty($n_ord))
		{
			$condicion=$condicion.' AND dl.nord_dlab='.$n_ord ;
		}
	
		
		$cons=mysql_query("SELECT el.iden_labs,dl.estd_dlab,
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
					 
					  $codusu=$rowx['CODI_USU'];
					  $iden_labs=$rowx['iden_labs'];
					  $cod_usu=$rowx[NROD_USU];
					  $num_ord=$rowx[nord_dlab];
					  echo "<tr bgcolor=#FEE9BC>";
					  $nomvar='codchk'.$i;
					  $valor=$$nomvar;
					 
					  
					  $nomvar='codusu'.$i;
					  echo "<input type=hidden name=$nomvar value=$rowx[CODI_USU]>";	
					  
					  $nomvar='iden_labs'.$i;
					  echo "<input type=hidden name=$nomvar value=$iden_labs>";	
					  
					  $nomvar='num_ord'.$i;
					  echo "<input type=hidden name='$nomvar'  value='$num_ord' >";	
								  
					  echo"<th class='Td0'>$rowx[nord_dlab]</td>";
					  echo"<th class='Td0'>$rowx[NROD_USU]</td>";
					  echo "<th class='Td0'>$rowx[PNOM_USU] $rowx[PAPE_USU]</td>";
					  echo"</tr>";
					
 					$cond2="iden_labs='$iden_labs' and detalle_labs.estd_dlab='PR'";
					if(!empty($grup_lab))
					{
					  $cond2=$cond2.' AND cups.grup_quim='.$grup_lab;
					}
					  
					$conex=mysql_query("SELECT detalle_labs.iden_labs,detalle_labs.iden_dlab ,detalle_labs.codigo,cups.descrip,detalle_labs.obsv_dlab,detalle_labs.unid_dlab,detalle_labs.refe_dlab
					FROM detalle_labs INNER JOIN cups ON detalle_labs.codigo = cups.codigo WHERE $cond2");
					
					$mcu=1;
					while ($rowexa=mysql_fetch_array($conex))
					{
						$desc=$rowexa['descrip'];
						$cod=$rowexa['codigo'];
						$obsv=$rowexa['obsv_dlab'];
						$unlabcup=$rowexa['unid_dlab'];
						$refercup=$rowexa['refe_dlab'];
						$iden_dlab=$rowexa['iden_dlab'];
						
						//echo $obsv;
													
						$nomvar='cod'.$i.$mcu;
						echo "<input type=hidden name='$nomvar' value='$cod'>";
										
						$nomvar='selec'.$i.$mcu;									
						echo "<input type=hidden name='$nomvar' value=1>";
										
						$nomvar='obs'.$i.$mcu;
						echo "<input type=hidden name='$nomvar' value='$obsv'>";
						
						$nomvar='uni'.$i.$mcu;
						echo"<input type=hidden name='$nomvar' value='$unlabcup'>";
						
						$nomvar='ref'.$i.$mcu;
						echo"<input type=hidden name='$nomvar' value='$refercup'>";
								
						$nomvar='iden_dlab'.$i.$mcu;
						echo"<input type=hidden name='$nomvar' value='$iden_dlab'>";
						
						
						$cql[$mcu]=$desc;
								   
							
						$mcu++;
								    
					}
					mysql_free_result($conex);
					echo "<td align='left'><span class='tm1'><a href='#' onclick='abrecierra($i,$mcu)'><img src='imagenes/search.gif' width=15 alt='Examenes'></span></a>
						</td></tr>";
					$i++;
			}
			mysql_free_result($cons);
		}

		else
		{
		
		 echo "<th class='Td0'><span  class='tm1'><b>NO EXISTEN PENDIENTES PARA LA FECHA</td></tr></table>";

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