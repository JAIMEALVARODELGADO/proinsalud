<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
  
	function busca()
		{
			//alert("toy");
			uno.esta_ncf.value=1;
			uno.action='list_odval.php';
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
	echo"<br><table class='Tbl1' border=0><tr><th class='Th0'>LISTADOS PACIENTES VALIDADOS</th></tr></table>";
	
	echo"<table  border=0 align='center'>";	
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
		</script> </td>
		<script language=javascript>uno.ffin.value="<?echo $ffin?>";</script>
	
	<?
	echo"<td><input type=submit name='Buscar' value='Buscar' onclick='busca()'></td></td></tr></table>";
				
	?><script language='Javascript'>uno.grup_lab.value="<?echo $grup_lab?>";</script>
	
	<?
	
	
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

	<?
	
		if($esta_ncf==1)
		{
		
			
		
		
		
		
		
		
		
		
		
		}
	
	?>
	
	
	
	
	
	
	</BODY>
</HTML>