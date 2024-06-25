<?
session_start();
$usucitas=$_SESSION['usucitas'];
$areatra=$_SESSION['areatra'];
header('Content-Type: text/html; charset=UTF-8'); 
$dateh=date("Y-m-d");

foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
?>
<html>
<head>

<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" />
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
    function salto2()
    {	
		//if(uno.usucita.value=='12991944')alert(uno.areas.value);
		uno.target='';
        uno.action='asigna1.php';
        uno.submit();
    }
	function saltogran()
    {
        uno.seleccion.value='';
		uno.target='';
        uno.action='asigna1.php';
        uno.submit();
    }	   
    function salto3()
    {
        if(uno.usucita.value=='12991944')
		{
			
			alert("prueba");
		
			
			f=uno.finrefs.value;
			car='';
			ctra='';
			con=0;
			
			
			for(i=0;i<f;i++)
			{
				
				val="uno.selref"+i+".checked";
				if(eval(val)==true)
				{
					
					contra="uno.cont_uco"+i+".value";
					
					//uno.codcontra.value=eval(contra);	
					
					are="uno.areades"+i+".value";
					dare="uno.nomarea"+i+".value";
					dare="uno.nomarea"+i+".value";
					if(eval(are)!=car || eval(contra)!=ctra)
					{
						con=(con/1)+1;
					}
					car=eval(are);
					ctra=eval(contra);
				}
				
			}			
			
			if(con!=1)
			{
				alert("Seleccione solo los registros que correspondan al mismo servicio y contrato");
				uno.codareauto.value='';
				uno.desareauto.value='';
				uno.contrauto.value='';			
				//uno.codcontra.value='';
				uno.target='';
				uno.action='asigna1.php';
				uno.submit();
			}		
			else
			{
				
				uno.codareauto.value=eval(are);
				uno.desareauto.value=eval(dare);
				uno.contrauto.value=eval(contra);
				uno.control.value=1;        
				uno.medico.value='';       
				uno.target='';
				uno.action='asigna1.php';
				
				uno.submit();
			}
			
		}
		else
		{	
		
			f=uno.finrefs.value;
			car='';
			ctra='';
			con=0;
			for(i=0;i<f;i++)
			{
				
				val="uno.selref"+i+".checked";
				if(eval(val)==true)
				{
					
					contra="uno.cont_uco"+i+".value";
					
					//uno.codcontra.value=eval(contra);	
					
					are="uno.areades"+i+".value";
					dare="uno.nomarea"+i+".value";
					dare="uno.nomarea"+i+".value";
					if(eval(are)!=car || eval(contra)!=ctra)
					{
						con=(con/1)+1;
					}
					car=eval(are);
					ctra=eval(contra);
				}
				
			}
			
			if(con!=1)
			{
				alert("Seleccione solo los registros que correspondan al mismo servicio y contrato");
				uno.codareauto.value='';
				uno.desareauto.value='';
				uno.contrauto.value='';			
				//uno.codcontra.value='';
				uno.target='';
				uno.action='asigna1.php';
				uno.submit();
			}		
			else
			{
				
				uno.codareauto.value=eval(are);
				uno.desareauto.value=eval(dare);
				uno.contrauto.value=eval(contra);
				uno.control.value=1;        
				uno.medico.value='';       
				uno.target='';
				uno.action='asigna1.php';
				
				uno.submit();
			}
		}
	}
    function valida(a,m)
    {
        if(uno.tipoci.value=='')
		{
			alert('SELECCIONE EL TIPO DE SOLICITUD DE CITA');
			uno.tipoci.focus();                
            return;
		}
		
		if(uno.fecreque.value<uno.fhoy.value)
		{
			
			alert('FECHA REQUERIDA INCORRECTA');
			uno.fecreque.focus();                
            return;
		}
		if(uno.tipocon.value=='0')
		{
			alert('SELECCIONE EL TIPO DE CONSULTA');
			uno.tipocon.focus();                
            return;
		}
		
		
		
		
		if(uno.esprimera.value=='S')
		{
			opcion = document.getElementsByName("pricita");
			var anu=0;
			for(var i=0; i<2; i++)
			{			
				if(opcion[0].checked)
				{				
					var anu=1;
				}
				if(opcion[1].checked)
				{				 
					var anu=1;
				}			
			}
			if(anu==0)
			{
				alert("Seleccione si la cita es primera vez en el año");
				return;
			}	
		}
		
		
		for(i=0;i<a;i++)
        {
            re='uno.ndispo'+i+'.value';
            po='uno.canres'+i+'.value';
            fo='uno.canres'+i+'.focus()';			
            if(eval(re)<eval(po))
            {
                alert('ERROR');
                eval(fo);
                return;
            }
            if(eval(po)=='' || eval(po)=='0')
            {
                alert('ERROR');
                eval(fo);
                return;
            }				
        }		
		//alert(uno.seleccion.value+' '+uno.horaele.value+' '+uno.valusado.value+' '+uno.horsig.value+' '+uno.horsig1.value);		
		uno.bot.disabled=true;
        uno.target='';
		uno.action='asigna2.php';
        uno.submit();		
    }
    function borrar(cu)
    {
        num=uno.cont.value;
        if(cu < num)
        {		
            for(i=cu;i<num;i++)
            {
                z=i/1+1/1;
                de='uno.vecdia'+i+'.value=uno.vecdia'+z+'.value';
                eval(de);	
                disp='uno.ndispo'+i+'.value=uno.ndispo'+z+'.value';
                eval(disp);	
                reser='uno.canres'+i+'.value=uno.canres'+z+'.value';
                eval(reser);	
                serv='uno.servi'+i+'.value=uno.servi'+z+'.value';
                eval(serv);					
            }
        }		
        uno.cont.value=uno.cont.value/1-1/1;
        uno.action='asigna1.php';
        uno.submit();	
    }
    function calen(dia)
    {
        uno.seleccion.value='';
        if(dia<10)dia='0'+dia
        uno.fechaele.value=uno.ano.value+'-'+uno.mes.value+'-'+dia;		
        ref='uno.vecdia.value=uno.fechaele.value';
        eval(ref);		
        uno.target='';
        uno.action='asigna1.php';
        uno.submit();
    }
    function busdia(num,hor,usa,nhs,nhss)
    {
        //alert(num+' '+hor+' '+usa+' '+nhs+' '+nhss);		
		uno.horsig.value=nhs;		
        uno.horsig1.value=nhss;
		uno.valusado.value=usa;		
        uno.seleccion.value=num;
        uno.horaele.value=hor;
        uno.target='';
        uno.action='asigna1.php';
        uno.submit();
    }
    function histo(n)
    {
        document.getElementById('conteref').style.display='none';
        document.getElementById('contecit').style.display='none';
		document.getElementById('agrupa').style.display='none';
        if(n==0)n=uno.valvar.value;
        if(n==1)
        {
            document.getElementById('conteref').style.display='none';
            document.getElementById('contecit').style.display='inline';    
			document.getElementById('agrupa').style.display='none'; 
            
        }
        if(n==2)
        {
            document.getElementById('contecit').style.display='none';
            document.getElementById('conteref').style.display='inline';  
			document.getElementById('agrupa').style.display='inline';
        }
        uno.valvar.value=n;
    }
	function chequear()
	{
		//alert('aqui');
		/*
		f=uno.finrefs.value;		
		if(n==1)
		{
			for(i=0;i<f;i++)
			{
				esc="uno.estacon"+i+".value";
				if(eval(esc)=='AC')
				{
					val="uno.selref"+i+".checked=true";
					eval(val);
				}
				
			}
		}
		if(n==2)
		{
		*/
		f=uno.finrefs.value;
		for(i=0;i<f;i++)
		{
			esc="uno.estacon"+i+".value";
			if(eval(esc)=='AC')
			{
				val="uno.selref"+i+".checked=false";
				eval(val);
			}
		}
		//}
		uno.codareauto.value='';
		uno.desareauto.value='';
		uno.contrauto.value='';
		//uno.codcontra.value='';
		uno.target='';
        uno.action='asigna1.php';
        uno.submit();
		
	
	}
	
    function cambiomes(n)
	{
		a=uno.ano.value;
		m=uno.mes.value;
		ani=uno.anoini.value;
		if(m=='01')m=1;if(m=='02')m=2;if(m=='03')m=3;if(m=='04')m=4;if(m=='05')m=5;if(m=='06')m=6;if(m=='07')m=7;if(m=='08')m=8;if(m=='09')m=9;if(m=='10')m=10;if(m=='11')m=11;if(m=='12')m=12;
		if(n==1)
		{			
			if(a != ani || m != '1')
			{
				m=(m/1)-1;
				if(m==0)
				{
					m=12;
					a=(a/1)-1;
				}	
			}
		}
		if(n==2)
		{
			if(a!=((ani/1)+2) || m!=12)
			{
				m=(m/1)+1;
				if(m==13)
				{
					m=1;
					a=(a/1)+1;
				}
			}
		}
		
		//anoini
		
		if(m==1)m='01';if(m==2)m='02';if(m==3)m='03';if(m==4)m='04';if(m==5)m='05';if(m==6)m='06';if(m==7)m='07';if(m==8)m='08';if(m==9)m='09';if(m==10)m='10';if(m==11)m='11';if(m==12)m='12';
		uno.ano.value=a;
		uno.mes.value=m;
		uno.target='';
        uno.action='asigna1.php';
        uno.submit();
	}
	function selhorman(idhor,fec,hor,cmed,a,m)
	{
		uno.ano.value=a;
		uno.mes.value=m;
		uno.medico.value=cmed;		
		uno.vecdia.value=fec;
		
		uno.horaele.value=hor;
		
		uno.seleccion.value=idhor;
		uno.target='';		
		uno.action='asigna1.php';
		
        uno.submit();
	}
	function proxima(n)
	{
		uno.proxi.value=n;
		uno.target='';	
		uno.action='asigna1.php';
        uno.submit();
	}
	
	function pendientes(n)
	{
		if(n==1)
		{
			if(uno.pendi1.checked==true)
			{
				uno.pendi2.checked=false;
			}
		}
		if(n==2)
		{
			if(uno.pendi2.checked==true)
			{
				uno.pendi1.checked=false;
			}
		}
		if(uno.pendi1.checked==true || uno.pendi2.checked==true)
		{			
			document.getElementById('botpen1').style.display='inline';
		}
		else
		{
			
			document.getElementById('botpen1').style.display='none';
		}	
		if(n==3)
		{
			
			uno.target='';	
			uno.action='asigna_pendiente.php';
			uno.submit();
		}
		
	}
	//document.getElementById('conteref').style.display='none';
    //document.getElementById('contecit').style.display='inline';
	
	function canceref(ref)
	{
		var respuesta = confirm("ANULAR ORDEN?");
        if (respuesta==false)return;	
		uno.idendetarefer.value=ref;
		uno.target='';	
		uno.action='eli_refer.php';
		uno.submit();
	}

	function activarFactura(){
		alert();
	}
	
	
	
</script>
</head>
<body >
<style>
#contecit {
overflow:auto;
height: 208px;
width: 500px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
display: inline;
}
#contecitgra {
overflow:auto;
height: 208px;
width: 700px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
display: inline;
}
#conteref {
overflow:auto;
height: 208px;
width: 500px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
display: inline;
}
#conterefgra {
overflow:auto;
height: 208px;
width: 700px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
display: inline;
}

.margen_izq {
margin-left:10px;
} 
a{text-decoration:none}
</style> 
<?
   set_time_limit(300);
   
   
   
   //echo 'ERNEY '.$control.' '.$codareauto;
  // ECHO "AREA ". $areas;
	$consel=substr($areas,0,3);
	$areas=substr($areas,3,5);	
	
	//ECHO '<BR>'.$consel.' '.$areas;
	 
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	
    include ('php/conexion1.php');
    $fecano=date("Y");
    $fecmes=date("m");
    $fecdia=date("d");
    $ffano=$fecano-1;
    $fechlim=$ffano.'-'.$fecmes.'-'.$fecdia;
	$feciniipi=date("Y-m-d");
	
    if($control==1)$areas=$codareauto;
    echo"<input type=hidden name=munate value=$munate>";
    echo"<form name=uno method=post>
	<input type=hidden name=idendetarefer>
	<input type=hidden name=fhoy value=$feciniipi>
	<input type=hidden name=iden_uco value=$iden_uco>
	<input type=hidden name=proxi>
	<input type=hidden name=viene value=$viene>
	<input type=hidden name=usucita value='$usucitas'>
    <input type=hidden name=codusu value='$codusu'>
    <input type=hidden name=tipafi value=$tipafi>    
    <input type=hidden name=clasifica value=$clasifica>
    <input type=hidden name=telres value=$telres>
    <input type=hidden name=nocontra value=$nocontra>
    <input type=hidden name=codareauto value=$codareauto>
    <input type=hidden name=numcitauto value=$numcitauto>    
    <input type=hidden name=desareauto value='$desareauto'>
	<input type=hidden name=contrauto value='$contrauto'>
    <input type=hidden name=control value='$control'>
    <input type=hidden name=numauto value='$numauto'>
    <input type=hidden name=fincit value=$fincit>
    <input type=hidden name=finrefs value=$finrefs>
    <input type=hidden name=finrefn value=$finrefn>
    <input type=hidden name=valvar value=$valvar>	
    <table align=center class='tbl'>
    <tr><th colspan=2>ASIGNACION DE CITA</th></tr>
    <tr>
    ";
    if($viene=='REFERENCIA')
	{
		echo "
		<th>$cedulausu</th>
		<th>$nombreusu</th>";	
	}
    echo"</td>
    </tr>
    </table><br>";
	
	
	
  
echo"<table align=center><tr><td>"; 

echo"<table align=center valign=top><tr><td>";

       
	    if($usucitas=='12991944' || $usucitas=='11')echo"<div id='contecitgra'>";
		else echo"<div id='conteref'>";
        //echo"<div id='contecit'>";
        
		if($fincit>0)
        {	
            echo"  
            
            <table align=center class='tbl' width=98%>
            <tr><th colspan=7 align=center>HISTORICO DE CITAS</th></tr>
            <tr>
            <td align=center width=10%>FECHA</td>
            <td align=center width=5%>HORA</td>
            <td align=center width=25%>MEDICO</td>
            <td align=center width=25%>AREA</td>
			<td align=center width=20%>ESTADO</td>
			<td align=center width=5%>TIPO</td>
			<td align=center width=5%>Opc</td>
            </tr>";
            $m=0;
            for($cn=0;$cn<$fincit;$cn++)
            {
                $nomauto='Fhorario'.$cn;
                $Fhorario=$$nomauto;
                echo"<input type=hidden name=$nomauto value='$Fhorario'>";
                $nomauto='Hhorario'.$cn;
                $Hhorario=$$nomauto;
                echo"<input type=hidden name=$nomauto value='$Hhorario'>";
                $nomauto='nmedi'.$cn;
                $nmedi=$$nomauto;
                echo"<input type=hidden name=$nomauto value='$nmedi'>";
                $nomauto='nareas'.$cn;
                $nareas=$$nomauto;
                echo"<input type=hidden name=$nomauto value='$nareas'>";
				$nomauto='desesta'.$cn;
				$desesta=$$nomauto;
				echo"<input type=hidden name=$nomauto value='$desesta'>";
				$nomauto='tipocon'.$cn;
				$tipoconsu=$$nomauto;
				echo"<input type=hidden name=$nomauto value='$tipoconsu'>";
				
				
				
                echo"<tr>
                <td align=center width=13%>$Fhorario</td>
                <td align=center width=8%>$Hhorario</td>
                <td width=36%>$nmedi</td>
                <td width=33%>$nareas</td>	
				<td width=33%>$desesta</td>	
				<td width=33% align=center>$tipoconsu</td>				
				<td width=5% align=center><a href='#' onclick=activarFactura()><img src='img/feed_add.png' alt='Facturar' title='Facturar' width='10'></a></td>
                </tr>";			
            }		
            echo"</table><br>";            
        }		
        $cn=0;
        echo"</div><br><br><br>";
		
    //BUSCAR AUTORIZACIONES         
       
        
		if($viene=='REFERENCIA')
		{
			
		
		}
		else
		{
		
			if($usucitas=='12991944' || $usucitas=='11')echo"<div id='conterefgra'>";
			else echo"<div id='conteref'>";
			echo"
			<table align=center class='tbl' width=100%>";
			echo"<tr>
			<th colspan=9>AUTORIZACIONES</th>				
			</tr>
			<tr>
			<th width=10%>SEL.</th>
			<th width=10%>SERVICIO SOLICITADO</th>
			<th width=10%>FECHA</th>
			<th width=10%>CONTRATO</th>
			<th width=10%>CANTIDAD SOLICITADA</th>
			<th width=10%>CANTIDAD ASIGNADA</th>
			<th width=40%>AYUDA O PROCEDIMIENTO</th> 
			<th width=40%>MEDICO SOLICITANTE</th>
			<th width=40%>ANULAR</th>
			</tr>
			";
			for($cn=0;$cn<$finrefs;$cn++)
			{		
				$nomautos='cont_uco'.$cn;
				$cont_uco=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$cont_uco'>";
				$nomautos='estacon'.$cn;
				$estacon=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$estacon'>";				
				$nomautos='nomarsol'.$cn;
				$nomarsol=$$nomautos;
				echo"<input type=hidden name=$nomautos value=$nomarsol>";
				$nomautos='fecharef'.$cn;
				$fecharef=$$nomautos;
				echo"<input type=hidden name=$nomautos value=$fecharef>";
				$nomautos='descrimap'.$cn;
				$descrimap=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$descrimap'>";
				$nomautos='nomarea'.$cn;
				$nomarea=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$nomarea'>";
				$nomautos='cant'.$cn;
				$cant=$$nomautos;
				echo"<input type=hidden name=$nomautos value=$cant>";
				$nomautos='numeroid'.$cn;
				$numeroid=$$nomautos;
				echo"<input type=hidden name=$nomautos value=$numeroid>";
				$nomautos='areades'.$cn;
				$areades=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$areades'>";
				$nomautos='clase'.$cn;
				$clase=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$clase'>";            
				$nomautos='numcitas'.$cn;
				$numcitas=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$numcitas'>";
				$nomautos='citasig'.$cn;
				$citasig=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$citasig'>";			
				$nomautos='idendetaref'.$cn;
				$idendetaref=$$nomautos;             
				echo"<input type=hidden name=$nomautos value='$idendetaref'>";				
				$nomautos='obsref'.$cn;
				$obsref=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$obsref'>";			
				$nomautos='nommedsol'.$cn;
				$nommedsol=$$nomautos; 
				echo"<input type=hidden name=$nomautos value='$nommedsol'>";
				$nomautos='permiso'.$cn;
				$permiso=$$nomautos;
				echo"<input type=hidden name=$nomautos value='$permiso'>";				
				$nomautos='selref'.$cn;   
				$selref=$$nomautos; 
				echo"<tr>";			
				if($estacon=='AC')
				{
					if($permiso=='S')
					{			
						/*
						$valcita=0;
						$diasdif=verifica($fecharef);
						if($diasdif>60)$valcita=1;
						if($valcita==0)
						{
							if($selref==1)echo"<td align=center><input type=checkbox checked name=$nomautos value='1'></td>";
							else echo"<td align=center><input type=checkbox name=$nomautos value='1'></td>";
						}
						else
						{
							echo"<td align=center><a href='#' TITLE='ORDEN VENCIDA'>---</a></td>";
							echo"<input type=hidden name=$nomautos value=''>";
						}
						*/
						
											
							if($selref==1)echo"<td align=center><input type=checkbox checked name=$nomautos value='1'></td>";
							else echo"<td align=center><input type=checkbox name=$nomautos value='1'></td>";
						
						ECHO"
						<td>$idendetaref $nomarea</td>
						<td align=center>$fecharef</td>	
						<td align=center>$cont_uco $estacon</td>
						<td align=center>$numcitas</td>	
						<td align=center>$citasig</td>
						<td>$descrimap</td> 
						<td>$nommedsol</td>";
						echo"<td><a href='#' onclick=canceref($idendetaref)>anular</a></td>";
							
						echo"</tr>
						<tr><td></td><td colspan=5><font color='#B00C06'>$obsref</font></td></tr>";
					
					
					
					}
					
					else
					{
						//echo"<td align=center><a href='#' TITLE='FUNCIONARIO SIN PERMISOS'>---</a></td>
						echo"<input type=hidden name=$nomautos value=''>";
					}
					
				}
				
				else
				{
					//echo"<td align=center><a href='#' TITLE='USUARIO SUSPENDIDO'>---</a></td>
					echo"<input type=hidden name=$nomautos value=''>";
				}		
				
				
			
				
			}
			echo"</table>";
			/*
			echo"
			<table class='tbl' align=right>
			<tr>
			<td>SELECCINAR TODO <input type=radio name=selgru value='0' onclick='seleccion(1)'></td>
			<td>QUITAR SELECCION <input type=radio name=selgru value='1' onclick='seleccion(2)'></td>
			<td><input type=button class=boton onclick='salto3()' value='Continuar'></td>		
			</tr>
			</table>";
			*/
			echo"</div>";
			
			ECHO"
			<table class='tbl' align=right>
			<tr>
			
			<td><input type=button class=boton onclick='chequear()' value='Quitar selección'></td>
			<td><input type=button class=boton onclick='salto3()' value='Continuar'></td>		
			</tr>
			</table>";
		}
		
		echo"</td>
		<td width=30></td>
		<td  valign=top>";		
		
		$busperm=mysql_query("SELECT permisos_citas.area_per, permisos_citas.usua_per, permisos_citas.esta_per, permisos_citascon.esta_pco, permisos_citascon.cidi_pco, permisos_citas.serv_per, permisos_citascon.cont_pco, areas.nom_areas
		FROM (permisos_citas INNER JOIN permisos_citascon ON permisos_citas.iden_per = permisos_citascon.iden_per) INNER JOIN areas ON permisos_citas.serv_per = areas.cod_areas
		WHERE (((permisos_citascon.cont_pco)<>'002') AND ((permisos_citas.area_per)='$areatra') AND ((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A') AND ((permisos_citas.tipo_per)='P') AND ((permisos_citascon.esta_pco)='A') AND ((permisos_citascon.cidi_pco)='A'))");

		
		$bdescon=mysql_query("SELECT ucontrato.CUSU_UCO, ucontrato.ESTA_UCO, contrato.NEPS_CON, contrato.CODI_CON
		FROM contrato INNER JOIN ucontrato ON contrato.CODI_CON = ucontrato.CONT_UCO
		WHERE (((ucontrato.CUSU_UCO)='$codusu') AND ((ucontrato.ESTA_UCO)='AC'))");
		$cuentacon=mysql_num_rows($bdescon);
		
		
		ECHO"
        <table class='tbl' align=center width=100%>
        <tr>
        <th>CONTRATO</th>
		<td align=left>";
				
		$j=1;
		
		while($rdescon=mysql_fetch_array($bdescon))
		{
			$nombrecontrato=$rdescon['NEPS_CON'];
			$codicontrato=$rdescon['CODI_CON'];
			echo $codicontrato.' - '.$nombrecontrato;
			if($j<$cuentacon)echo'<br>';
			$j++;
						
		}		
		echo"
		<br></td>
		</tr>
		<tr>
		<th>AREA</th>		

		<td><select name=areas class='caja' onchange='salto2()'>";
		//echo"<option value=''></option>";	

		if($viene=='REFERENCIA')
		{
			$unido=$contrauto.$codareauto;
			echo "<option value='$unido'>1 $contrauto - $desareauto</option>";	
			$contrareal=$contrauto;
		}
		else
		{				
			if(!empty($codareauto)) 
			{
				$sel1='';
				if($areas==$codareauto)$sel1='selected';			
				$unido=$contrauto.$codareauto;
				$contrareal=$contrauto;
				echo "<option $sel1 value='$unido'>2 $contrauto - $desareauto</option>";
				if($codareauto==85)
				{
					$sel2='';$sel3='';
					if($areas=='86')$sel2='selected';	
					if($areas=='26')$sel3='selected';
					$unido=$contrauto.'86';
					echo"<option $sel2 value='$unido'>3 $contrauto - IMAGENOLOGIA2</option>";
					$unido=$contrauto.'26';
					echo"<option $sel3 value='$unido'>4 $contrauto - IMAGENOLOGIA3</option>";
				}
				
			}
			$n=0;
			$nc=0;
			while($rareper=mysql_fetch_array($busperm))
			{		
				$codare=$rareper['serv_per'];
				$nomare=$rareper['nom_areas'];
				$contraper=$rareper['cont_pco'];
				//echo 'm '.$contraper;
				$bconh=mysql_query("SELECT ucontrato.CUSU_UCO, ucontrato.CONT_UCO, ucontrato.ESTA_UCO
				FROM ucontrato
				WHERE (((ucontrato.CUSU_UCO)='$codusu') AND ((ucontrato.CONT_UCO)='$contraper'))");
				
				
				
				if(mysql_num_rows($bconh)>0)
				{
					$rconh=mysql_fetch_array($bconh);
					if($rconh['ESTA_UCO']=='AC')
					{
						if($nc==0 and empty($areas))$areas=$codare;
						$unido=$contraper.$codare;
						if($consel.$areas==$unido)echo"<option selected value='$unido'>5 $contraper $nomare </option>";	
						else echo"<option value='$unido'>6 $contraper $nomare $areas</option>";
						$contrareal=$contraper;
						$nc++;
					}
				}
						
			}
		}
        echo"</select>";
		
		
		
		
		
		
		
		if(!empty($areas))
		{		
			echo"<input type=button class='caja' value='Proximas' onclick='proxima(1)'>";
		}
		//echo 'AREAS '.$areas;
		echo"
		</td>		
		</tr>
		<tr>
		<th>MEDICO</th>";
		
		//if(empty($areas))$areas=$codare;
		/*
        $bmedi=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi, areas_medic.esta_ar
		FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
		WHERE (((areas_medic.areas_ar)='$areas' And (areas_medic.areas_ar)<>'') AND ((areas_medic.esta_ar)='A'))
		ORDER BY medicos.nom_medi");
		*/
		
		/*	
		function getRealIP() 
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))return $_SERVER['HTTP_CLIENT_IP'];
			if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))return $_SERVER['HTTP_X_FORWARDED_FOR'];
			return $_SERVER['REMOTE_ADDR'];
		}
		$ip=getRealIP();
		$tok = strtok ($ip,".");
		$n=0;
		while ($tok) 
		{	
			$tok = strtok (".");
			$vec[$n]=$tok;
			$n++;	
		}
		$rangoip=$vec[1];
		include ('php/conexion1.php');
		$busori=mysql_query("select * from origen_consulta where codi_ori='$rangoip'");
		$codimunicipio='';
		while($rusori=mysql_fetch_array($busori))
		{
			$codimunicipio=$rusori['codmuni_ori'];		
		}    
		*/
		//$munate
		
		//echo 'con '.$contrareal.'<br>';
		//if($contrareal=='')$contrareal=$contraper;
		
		$bmate=mysql_query("SELECT * FROM usuario WHERE CODI_USU='$codusu'");
		$rmate=mysql_fetch_array($bmate);
		$munate=$rmate['MATE_USU'];
		
		$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$contrareal'";
		$consultamag=mysql_query($consultamag);
		$rowmag=mysql_fetch_array($consultamag);
		$regmag_con=$rowmag[REGMAG_CON];
		
		//ECHO $areas.' '.$contrareal.' '.$munate;				
		if($feciniipi>='2015-06-23')
		{
			
			if(($areas=='01' || $areas=='151') && $regmag_con=='S' && ($munate=='52001' || $munate=='52356'))
			{
				/*$bmedi="SELECT usuario.CODI_USU, medicos.cod_medi, medicos.nom_medi,cotadicional.MEDF_COT,cotadicional.MEDF2_COT
				FROM (usuario INNER JOIN usuario AS usuario_1 ON usuario.DCOT_USU = usuario_1.NROD_USU) INNER JOIN (medicos INNER JOIN cotadicional ON medicos.cod_medi = cotadicional.MEDF_COT) ON usuario_1.CODI_USU = cotadicional.CUSU_COT
				WHERE (((usuario.CODI_USU)='$codusu'))";*/			
				/*
				$bmedi="SELECT cotadicional.MEDF_COT,cotadicional.MEDF2_COT
				FROM (usuario INNER JOIN usuario AS usuario_1 ON usuario.DCOT_USU = usuario_1.NROD_USU) INNER JOIN cotadicional ON usuario_1.CODI_USU = cotadicional.CUSU_COT
				WHERE (((usuario.CODI_USU)='$codusu'))";				
				$bmedi=mysql_query($bmedi);
				$row=mysql_fetch_array($bmedi);
				
				if(empty($medico)){
					$medico=$row[MEDF_COT];
				}
				
				$condicion="medicos.cod_medi='$row[MEDF_COT]'";
				if(!empty($row[MEDF2_COT])){
					$condicion=$condicion." OR medicos.cod_medI='$row[MEDF2_COT]'";
				}
				*/
				$bmedi="SELECT medicos.nom_medi, medicos.cod_medi, areas_medic.esta_ar
				FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
				WHERE (((areas_medic.esta_ar)='A') AND ((areas_medic.areas_ar)='$areas' And (areas_medic.areas_ar)<>'') AND ((medicos.esta_medi)='A'))
				ORDER BY medicos.nom_medi";
			}
			/*else if($areas=='151' && $contrareal=='002' && $munate=='52356')
			{
				/*$bmedi="SELECT usuario.CODI_USU, medicos.cod_medi, medicos.nom_medi,cotadicional.MEDF_COT,cotadicional.MEDF2_COT
				FROM (usuario INNER JOIN usuario AS usuario_1 ON usuario.DCOT_USU = usuario_1.NROD_USU) INNER JOIN (medicos INNER JOIN cotadicional ON medicos.cod_medi = cotadicional.MEDF_COT) ON usuario_1.CODI_USU = cotadicional.CUSU_COT
				WHERE (((usuario.CODI_USU)='$codusu'))";
			}*/
			
			else
			{
				$bmedi="SELECT medicos.nom_medi, medicos.cod_medi, areas_medic.esta_ar
				FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
				WHERE (((areas_medic.areas_ar)='$areas' And (areas_medic.areas_ar)<>'') AND ((areas_medic.esta_ar)='A') AND ((medicos.esta_medi)='A'))  
				ORDER BY medicos.nom_medi";
			}
			//echo $bmedi;
			$bmedi=mysql_query($bmedi);
		}
		else
		{		
			if($areas=='01' && $regmag_con=='S' && $munate=='52001')
			{
				$bmedi="SELECT usuario.CODI_USU, medicos.cod_medi, medicos.nom_medi
				FROM (usuario INNER JOIN usuario AS usuario_1 ON usuario.DCOT_USU = usuario_1.NROD_USU) INNER JOIN (medicos INNER JOIN cotadicional ON medicos.cod_medi = cotadicional.MEDF_COT) ON usuario_1.CODI_USU = cotadicional.CUSU_COT
				WHERE (((usuario.CODI_USU)='$codusu'))";
			}		
			else
			{
				$bmedi="SELECT medicos.nom_medi, medicos.cod_medi, areas_medic.esta_ar
				FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
				WHERE (((areas_medic.areas_ar)='$areas' And (areas_medic.areas_ar)<>'') AND ((areas_medic.esta_ar)='A'))
				ORDER BY medicos.nom_medi";
			}			
			$bmedi=mysql_query($bmedi);
		}
		
		echo"<td>
        <select name=medico class='caja' onchange='salto2()'>
        <option value='0'></option>";			
        while($rmedi=mysql_fetch_array($bmedi))
        {
            $codimed=$rmedi['cod_medi'];
            $nombmed=$rmedi['nom_medi'];                    	
            if($medico==$codimed)echo"<option selected value=$codimed>$nombmed</option>";
            else echo"<option value=$codimed>$nombmed</option>";			
        }
        $busti=mysql_query("Select cod_ticita ,des_ticita  From tip_cita  where cod_ticita<=5 and estado<>'I' Order By cod_ticita");
        echo"</td>
		</tr>
		<tr>
        <th>TIPO SOLICITUD</th>";
		
		echo "<td><select class='caja' name=tipoci>";
		echo "<option value=''></option>";
        while ($row1=mysql_fetch_array($busti))
        {
            $codtip=$row1["cod_ticita"];
            $nomtip=$row1["des_ticita"];
            if($tipoci==$codtip)echo "<option selected value='$codtip'>$nomtip</option>"; 
            else echo "<option value='$codtip'>$nomtip</option>"; 
        }		
		echo"</td></tr>
		
		<tr>
			<th>FECHA REQUERIDA</th>
			<td>";
			?>
			<input type="text" name="fecreque"  class='caja' size="10"  maxlength="10" value="<?echo $fecreque;?>" id="fven01" <?echo $disp;?>>
			<input type="button" class='caja' id="lanzador01" name="bot01" value="..." <?echo $disp;?>/>
			<!-- script que define y configura el calendario--> 
			<script type="text/javascript"> 
			Calendar.setup({ 
			inputField     :    "fven01",     // id del campo de texto 
			ifFormat     :     "%Y-%m-%d",   // formato de la fecha que se escriba en el campo de texto 
			button     :    "lanzador01"     // el id del botón que lanzará el calendario 				
			}); 
			</script> 				
			<?		
			echo"</td>
		</tr>
		
		
		
		<tr>
        <th>CONCESION CON USUARIO</th>";
		$bconce=mysql_query("select * from destipos where codt_des='94' AND valo_des='A' order by nomb_des");
		echo "<td><select class='caja' name=concesion>
		<option value='0'></option>";
        while ($rconce=mysql_fetch_array($bconce))
        {
            $coddes=$rconce["codi_des"];
            $nomdes=$rconce["nomb_des"];
            if($concesion==$coddes)echo "<option selected value='$coddes'>$nomdes</option>"; 
            else echo "<option value='$coddes'>$nomdes</option>"; 
        }
	$s1='';$s2='';$s3='';$s4='';
	
	if($tipocon=='0')$s1='selected';
	if($tipocon=='P')$s2='selected';
	if($tipocon=='V')$s3='selected';
	if($tipocon=='D')$s4='selected';
	
	$tc1='selected';$tc2='selected';
	if($tipoControl=='P')$tc1='selected';
	if($tipoControl=='C')$tc2='selected';
	
	echo"</select></td></tr>
		<tr>
        <th>TIPO DE CONSULTA</th>
		<td>
		<select class='caja' name=tipocon>	
		<option $s1 value='0'></option>
		<option $s2 value='P'>PRESENCIAL</option>
		<option $s3 value='V'>VIRTUAL</option>
		<option $s4 value='D'>DOMICILIARIA</option>
	</td></tr>
	";
	/*
	<tr>
	
	<tr>
	<th>PCIENTE COVID 19</th>
	<td>
	
	<select name=covid class='caja'>
	<option value=''></option>
	<option value='P'>PRIMERA VEZ </option>
	<option value='C'>CONTROL</option>
	</select>";
	
	ECHO"
	<select name=covid class='caja'>
	<option value=''></option>";
	$bcov=mysql_query("SELECT * FROM destipos WHERE codt_des='E1'");
	while($rcov=mysql_fetch_array($bcov))
	{
		$codcov=$rcov['codi_des'];
		$nomcov=$rcov['nomb_des'];
		if($covid==$codcov)echo"<option selected value='$codcov'>$nomcov</option>";
		else echo"<option value='$codcov'>$nomcov</option>";
	}
	ECHO"</select>
	
	
	</td></tr>
	*/
	echo"
	<tr>
	<th>OBSERVACION</th><td><textarea name=obsecit class='caja' cols=50 rows=2>$obsecit</textarea></td>		
	</td></tr>";
	
	$bcuo=mysql_query("select * from contrato where codi_con='$consel'");
	while($rcuo=mysql_fetch_array($bcuo))
	{
		$reqcuo=$rcuo['RCUOT_CON'];
		$reqcop=$rcuo['RCOPA_CON']; 
	}
	$tipago='';
	if($tipafi=='C')
	{
		if($reqcuo=='S')$tipago='1';	//requiere pago de cuota moderadora
	}
	if($tipafi=='B')
	{
		if($reqcop=='S')$tipago='2';	//requiere pago de copago
		else
		{
			if($reqcuo=='S')$tipago='1';	//requiere pago de cuota moderadora
		}
	}	
	if($tipago=='1')
	{
		$bc=mysql_query("select * from recaudo 
		where codi_usu='$codusu' and codi_con='$concel' AND estado_rec='B201' AND tipo_rec='01'");
		echo"<tr><th>CUOTA MODERADORA </th><td align=center>
		<select name=selcuota>
		<option value=''></option>";
		while($rc=mysql_fetch_array($bc))
		{
			$idrecaudo=$rc['id_recaudo'];
			$pagado=$rc['pagado_rec'];
			if($pagado=='S')$despago='PAGADO';
			if($pagado=='N')$despago='PENDIENTE DE PAGO';
			echo"<option value='$idrecaudo'>$idrecaudo - $despago</option>";
		}
		echo"<option value='0'>GENERAR NUEVO</option>";
	}	
	if($tipago=='2')
	{
		$bc=mysql_query("select * from recaudo 
		where codi_usu='$codusu' and codi_con='$concel' AND estado_rec='B201' AND tipo_rec='02'");
		echo"<tr><th>COPAGO </th><td align=center>
		<select name=selcopago>
		<option value=''></option>";
		while($rc=mysql_fetch_array($bc))
		{
			$idrecaudo=$rc['id_recaudo'];
			$pagado=$rc['pagado_rec'];
			if($pagado=='S')$despago='PAGADO';
			if($pagado=='N')$despago='PENDIENTE DE PAGO';
			echo"<option value='$idrecaudo'>$idrecaudo - $despago</option>";
		}
		echo"<option value='0'>GENERAR NUEVO</option>";
	}
	echo "<input type=hidden name=tipago value='$tipago'>";	
		
		
		if($areas=='80')
        {
            echo"<tr><th>TIPO DE CITA</th>
			<td>";             
            if(empty($tipoex))$tipoex='B';
            if($tipoex=='B')echo"BASICO<input type=radio name=tipoex checked value='B'><font color='#FFFFFF'>-</font>";
            else echo"BASICO<input type=radio name=tipoex value='B'><font color='#FFFFFF'>-</font>";
            if($tipoex=='E')echo"ESPECIAL<input type=radio name=tipoex checked value='E'><font color='#FFFFFF'>-</font>";
            else echo"ESPECIAL<input type=radio name=tipoex value='E'><font color='#FFFFFF'>-</font>";
            if($tipoex=='R')echo"REMITIDO<input type=radio name=tipoex checked value='R'>";
            else echo"REMITIDO<input type=radio name=tipoex value='R'>";	
			echo"</td>
			</tr>
			<tr>		
			<th>OBSERVACIONES</th>
			<td>
            <textarea name=obsecitlab class='caja' rows=2 cols=30>$obsecitlab</textarea>
            </td></tr>";
        }

		
		$esprimera='';
		$bpricita=mysql_query("select primeracita from areas where cod_areas='$areas'");			
		$rpricita=mysql_fetch_array($bpricita);			
		$esprimera=$rpricita['primeracita'];
		
		$esprimera=='S';
		echo"<input type=hidden name=esprimera value='$esprimera'>";

		
	
		//echo $areas.' ES PRIMERA '.$esprimera;
		if($esprimera=='S')
		{
			$chpri='';
			if($pricita=='S')$chpri1='checked';
			if($pricita=='N')$chpri2='checked';
			echo"<tr>
			<th> CITA EN EL A&#209;O</th>
			<td>
				<input type=radio class='caja' $chpri1 name=pricita value='S'> PRIMERA VEZ
				<input type=radio class='caja' $chpri2 name=pricita value='N'> CONTROL 
			</td>
			</tr>";
		}
			
		
		
		
        echo"</table>";
		
	   //if(!empty($medico))
        //{			
           
			
			$fecha=date('Y-m-d');
		
            if(empty($mes))$mes=(date("m"));
            if(empty($ano))$ano=(date("Y"));	
            $num=mktime(0,0,0,$mes,1,$ano);
            $pridia=(date("w",$num));
            $numdias=(date("t",$num));
            echo"<br><br>
            <table width=100%>
            <tr><td>";
            echo"				
            <table class='tbl' align=center>
            <input type=hidden name=servicio value=$servicio>	
            <input type=hidden name=cedula value='$cedula' >
            <tr>";
            // echo"<td  align=center height=40>M</td>";
            echo"<th align=center colspan=4>
			
			<a href='#' onclick='cambiomes(1)'> <<<< </a>
			
            <select name=mes class='caja' onChange='salto2()'>";
            if($mes=='01') echo"<option value='01' selected>Enero</option>";
            else echo"<option value='01'>Enero</option>";
            if($mes=='02') echo"<option value='02' selected>Febrero</option>";
            else echo"<option value='02'>Febrero</option>";
            if($mes=='03') echo"<option value='03' selected>Marzo</option>";
            else echo"<option value='03'>Marzo</option>";
            if($mes=='04') echo"<option value='04' selected>Abril</option>";
            else echo"<option value='04'>Abril</option>";
            if($mes=='05') echo"<option value='05' selected>Mayo</option>";
            else echo"<option value='05'>Mayo</option>";
            if($mes=='06') echo"<option value='06' selected>Junio</option>";
            else echo"<option value='06'>Junio</option>";
            if($mes=='07') echo"<option value='07' selected>Julio</option>";
            else echo"<option value='07'>Julio</option>";
            if($mes=='08') echo"<option value='08' selected>Agosto</option>";
            else echo"<option value='08'>Agosto</option>";
            if($mes=='09') echo"<option value='09' selected>Septiembre</option>";
            else echo"<option value='09'>Septiembre</option>";
            if($mes=='10') echo"<option value='10' selected>Octubre</option>";
            else echo"<option value='10'>Octubre</option>";
            if($mes=='11') echo"<option value='11' selected>Noviembre</option>";
            else echo"<option value='11'>Noviembre</option>";
            if($mes=='12') echo"<option value='12' selected>Diciembre</option>";	
            else echo"<option value='12'>Diciembre</option>";	
            echo"</select>
			<a href='#' onclick='cambiomes(2)'> >>>> </a>
            </td>";
            $an=(date("Y"));
            $ano1=$an+1;
            $ano2=$an+2;
			echo "<input type=hidden name=anoini value='$an'>";
            //echo"<td  align=center height=40>A</td>";
            echo"<th align=center colspan=3>
            <select name=ano  class='caja' onChange='salto2()'>";
            if($ano==$an)echo"<option value='$an' selected>$an</option>";
            else echo"<option value='$an'>$an</option>";
            if($ano==$ano1)echo"<option value='$ano1' selected>$ano1</option>";
            else echo"<option value='$ano1'>$ano1</option>";
            if($ano==$ano2)echo"<option value='$ano2' selected>$ano2</option>";
            else echo"<option value='$ano2'>$ano2</option>";	
            echo"</select>
            </td>
            </tr>
            <tr>
            <th>Lun</th>
            <th>Mar</th>
            <th>Mie</th>
            <th>Jue</th>
            <th>Vie</th>
            <th bgcolor><font color='#ff2222'>Sab</th>
            <th><font color='#ff2222'>Dom</font></th>
            </tr>";
            if($pridia==0)$pridia=7;
            $pridia=$pridia+1;
            //echo $pridia;
            $nd=$pridia+$numdias;
            echo"<tr>";
            $k=1;
            for($i=1;$i<=$nd;$i++)
            {
                if($k>$numdias)break;
                if($i<$pridia-1)
                {
                    echo"<td></td>";			
                }		
                else
                {					
                    if($k<10)$di=$ano.'-'.$mes.'-0'.$k;
                    else $di=$ano.'-'.$mes.'-'.$k;						
                    $bdi=mysql_query("SELECT Count(horarios.Cmed_horario) AS cuentadis
                    FROM horarios WHERE (((horarios.Fecha_horario)='$di') AND ((horarios.Usado_horario)>0) AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areas'))");
                    while($ndispo=mysql_fetch_array($bdi))
                    {
                        $cuentadispo=$ndispo['cuentadis'];
                    }
                    if($di>=$fecha)
                    {							
                        if($cuentadispo>0)
                        {								
                            if((($pridia+$k-1)%(7)==0) || (($pridia+$k-2)%(7)==0))
                            {									
                                $color=0;														
                                if($vecdia==$di)$color=1;														
                                if($color==1)								
                                {
                                    echo"<td align=center bgcolor='#FAFF9E'><font color='#FF0000'>$k</td>";
                                }
                                else
                                {
                                    echo"<td align=center><a href='#' onclick='calen($k)' title='$cuentadispo'><font color='#FF0000'>$k</a></td>";
                                }						
                            }
                            else
                            {									
                                $color=0;														
                                if($vecdia==$di)$color=1;
                                if($color==1)
                                {
                                    echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$k</td>";
                                }
                                else
                                {
                                    echo"<td align=center><a href='#' onclick='calen($k)' title='$cuentadispo'><font color='#0000FF'>$k</a></td>";
                                }													
                            }
                        }
                        else
                        {				
                            echo"<td align=center><font color='#888888' size='2'>$k</td>";
                        }
                    }
                    else
                    {				
                       echo"<td align=center><font color='#888888' size='2'>$k</td>";
                    }
                    $k++;
                }
                if($i%7==0)
                {
                    echo"</tr>";
                    echo"<tr>";
                }
            }
			
            $aele=substr($vecdia,0,4);
            $mele=substr($vecdia,5,2);
            $dele=substr($vecdia,8,2);
            $timnum=gmmktime ( 0, 0, 0, $mele, $dele, $aele);
		//echo 'kkkkk '.$timnum;
            if($timnum>0)$ds=getdate ($timnum);
			else $ds=0;
            $diasem=$ds['wday'];
            if($diasem==0)$dise='LUNES';
            if($diasem==1)$dise='MARTES';
            if($diasem==2)$dise='MIERCOLES';
            if($diasem==3)$dise='JUEVES';
            if($diasem==4)$dise='VIERNES';
            if($diasem==5)$dise='SABADO';
            if($diasem==6)$dise='DOMINGO';
			$ch1='';$ch2='';$ch3='';
			if(empty($turxcita))$turxcita=1;			
			if($turxcita==1)$ch1='selected';			
			if($turxcita==2)$ch2='selected';			
			if($turxcita==3)$ch3='selected';
            echo"</table>				
            <td/></tr>
			<tr><td height=10>
			<table class='tbl' align=center>
			<tr><td>Turnos por cita 
			<select name=turxcita class='caja' onchange='saltogran()'>
			<option $ch1 value='1'>1</option>
			<option $ch2 value='2'>2</option>
			<option $ch3 value='3'>3</option>		
			</select>
			</td>
			
			
			</tr>
			
			</table>
			
			</td><tr>
			
			<tr><td  valign=top>					
            <table class='tbl' align=center>
            <tr><th align=center colspan=6>FECHA: $dise $vecdia<font color='#FFFFFF'>------------------</font>HORA: $horaele</td></tr>";
            if(empty($cont))$cont=0;
            //echo 'vectia '.$vecdia;		
            $bdispo=mysql_query("SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario
            FROM horarios WHERE (((horarios.Fecha_horario)='$vecdia') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areas')) ORDER BY horarios.Hora_horario");
            $nreg=mysql_num_rows($bdispo);
			$n=0;
			$Usadosig=0;
			$Usadosig1=0;
			$listo=1000;
            echo"<tr>";
            while($rdispo=mysql_fetch_array($bdispo))
            {
                $Fecha_horario=$rdispo['Fecha_horario'];
                $Usado_horario=$rdispo['Usado_horario'];
                $Cmed_horario=$rdispo['Cmed_horario'];
                $Hora_horario=$rdispo['Hora_horario'];
                $Cserv_horario=$rdispo['Cserv_horario'];
                $ID_horario=$rdispo['ID_horario'];
                $hora=substr($Hora_horario,11,5);
                if($n % 6==0)echo"</tr><tr>";
				if($turxcita==1)
				{
					$color1=0;														
					if($seleccion==$ID_horario)$color1=1;				
					$buscithor=mysql_query("SELECT citas.ID_horario, citas.Idusu_citas FROM citas
					WHERE (((citas.ID_horario)='$ID_horario') AND ((citas.Idusu_citas)='$codusu') AND ((citas.Clase_citas)<'6')	) ");
					$idhorsig=0;
					$idhorsig1=0;
					if($Usado_horario<1)
					{
						
						echo"<td align=center><font color='#BBBBBB'>$hora $Usado_horario</td>";
										
					}
					else
					{
						if(mysql_fetch_array($buscithor)>0)
						{
							echo"<td align=center><font color='#888888'>$hora $Usado_horario</td>";
						}
						else
						{
							if($color1==1)
							{
								echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$hora $Usado_horario</td>";
							}
							else
							{
								$titu=$Usado_horario.' turnos disponibles';
								echo"<td align=center><a href='#' onclick='busdia($ID_horario,\"$hora\",\"$Usado_horario\",\"$idhorsig\",\"$idhorsig1\")' title='$titu'><font color='#0000FF'>$hora $Usado_horario</a></td>";
							}
						}					
					}
				}
				if($turxcita==2)
				{
					$color1=0;														
					if($seleccion==$ID_horario)$color1=1;				
					$buscithor=mysql_query("SELECT citas.ID_horario, citas.Idusu_citas FROM citas
					WHERE (((citas.ID_horario)='$ID_horario') AND ((citas.Idusu_citas)='$codusu') and citas.Clase_citas <6)");				
					if($Usado_horario<1)
					{						
						echo"<td align=center><font color='#BBBBBB'>$hora $Usado_horario</td>";										
					}
					else
					{
						$holar="0001-01-01 ".$hora.":00";
						
						$bsig=mysql_query("SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario
						FROM horarios WHERE (((horarios.Fecha_horario)='$vecdia') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areas') AND ((horarios.Hora_horario)>'$holar')) ORDER BY horarios.Hora_horario");
						/*
						if($usucitas=='12991944')
						{
							echo "SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario
							FROM horarios WHERE (((horarios.Fecha_horario)='$vecdia') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areas') AND ((horarios.Hora_horario)>'$holar')) ORDER BY horarios.Hora_horario";
						
						}
						*/
						
						
						/*
						echo "SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario
						FROM horarios WHERE (((horarios.Fecha_horario)='$vecdia') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areas') AND ((horarios.ID_horario)>'$ID_horario')) ORDER BY horarios.Hora_horario";
						*/
						$r=0;
						while($rsig=mysql_fetch_array($bsig))
						{
							if($r==0)
							{
								$Usadosig=$rsig['Usado_horario'];								
								$idhorsig=$rsig['ID_horario'];
								$idhorsig1=0;
								break;
							}
							$r++;
						}	
						/*
						if($usucitas=='12991944')
						{
							echo $ID_horario.' '.$Usadosig.' '.$idhorsig.'<br>';
						
						}
						*/
						if(mysql_fetch_array($buscithor)>0)
						{
							echo"<td align=center><font color='#888888'>$hora $Usado_horario</td>";
						}
						else
						{
							if($color1==1)
							{
								echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$hora $Usado_horario</td>";
								$listo=$n;
							}
							else
							{
								if($n==$listo+1)$colsig='#FAFF9E';
								else $colsig='#FFFFFF';
								if($Usadosig>0  && $n<$nreg-1)
								{
									
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center bgcolor=$colsig><a href='#' onclick='busdia($ID_horario,\"$hora\",\"$Usado_horario\",\"$idhorsig\",\"$idhorsig1\")' title='$titu'><font color='#0000FF'>$hora $Usado_horario</a></td>";
								}
								else
								{
									//echo $Usadosig.' '.$n.' '.$nreg.'<br>';
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center bgcolor=$colsig><font color='#0000FF'>$hora  $Usado_horario</td>";
									
								}
							}
						}					
					}
				}
				if($turxcita==3)
				{
					$color1=0;														
					if($seleccion==$ID_horario)$color1=1;
					$buscithor=mysql_query("SELECT citas.ID_horario, citas.Idusu_citas FROM citas
					WHERE (((citas.ID_horario)='$ID_horario') AND ((citas.Idusu_citas)='$codusu') and citas.Clase_citas <6)");				
					if($Usado_horario<1)
					{						
						echo"<td align=center><font color='#BBBBBB'>$hora $Usado_horario</td>";										
					}
					else
					{						
						$holar="0001-01-01 ".$hora.":00";
						$bsig3=mysql_query("SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario
						FROM horarios WHERE (((horarios.Fecha_horario)='$vecdia') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areas') AND ((horarios.Hora_horario)>'$holar')) ORDER BY horarios.Hora_horario");
						$r=0;
						while($rsig3=mysql_fetch_array($bsig3))
						{
							if($r==0)
							{
								$Usadosig=$rsig3['Usado_horario'];
								$idhorsig=$rsig3['ID_horario'];
							}
							if($r==1)
							{
								$Usadosig1=$rsig3['Usado_horario'];
								$idhorsig1=$rsig3['ID_horario'];
								break;
							}
							$r++;
						}						
						if(mysql_fetch_array($buscithor)>0)
						{
							echo"<td align=center><font color='#888888'>$hora $Usado_horario</td>";
						}
						else
						{
							if($color1==1)
							{
								echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$hora $Usado_horario</td>";
								$listo=$n;
							}
							else
							{
								if($n==$listo+1 || $n==$listo+2)$colsig='#FAFF9E';
								else $colsig='#FFFFFF';
								if($Usadosig>0 && $Usadosig1>0 && $n<$nreg-2)
								{
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center bgcolor=$colsig><a href='#' onclick='busdia($ID_horario,\"$hora\",\"$Usado_horario\",\"$idhorsig\",\"$idhorsig1\")' title='$titu'><font color='#0000FF'>$hora  $Usado_horario</a></td>";									
								}
								else
								{
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center bgcolor=$colsig><font color='#0000FF'>$hora $Usado_horario</td>";
								}
							}
						}					
					}
				}
				$n++;	
            }
            echo"</tr>";
            echo"</table>";
            echo"<td/><tr/>
            </table>";
            ECHO "<input type=hidden name=valusado value='$valusado'>";
			ECHO "<input type=hidden name=horsig value='$horsig'>";
            ECHO "<input type=hidden name=horsig1 value='$horsig1'>";
        //}
		ECHO "<input type=hidden name=seleccion value='$seleccion'>";
		ECHO "<input type=hidden name=fechaele value='$fechaele'>";
		ECHO "<input type=hidden name=vecdia value='$vecdia'>";
		ECHO "<input type=hidden name=horaele value='$horaele'>";
		ECHO "<input type=hidden name=anodos>";
		ECHO "<input type=hidden name=mesdos>";
		
		if($seleccion!='')
        {
			echo"
			<table align=center class='tbl'>
			<tr><th align=center height=20>
			<INPUT type=button class='boton' name='bot' value='Asignar cita' onClick='valida();'>";
			echo"</th></tr>		
			</table>
			";
        } 

		echo"
		<br><br>
		<table align=center class='tbl'>
		<tr>
			<th>CITA PENDIENTE POR</td>
		</tr>
		<tr>
			<td align=center>OFERTA <input type=checkbox name=pendi1 value='O' onclick='pendientes(1)'> 
			PACIENTE <input type=checkbox name=pendi2 value='P' onclick='pendientes(2)'></td>
		</tr>
		<tr>
			<th><input type=button class='boton' id='botpen1' name=botpen value='Marcar como pendiente' onclick='pendientes(3)'></td>
		</tr>
		</table>
		</td></tr>
		</table>
		";	
        echo"</tr>		
		
		
</td></tr>	
</table><br>";
        
if($proxi==1)
{
	$hoy=date("Y-m-d");
	$horhoy= date("H:i");
	$horhor="0001-01-01 ".$horhoy.":00";
	$buscitar=mysql_query("SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.dia_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario, medicos.nom_medi
	FROM horarios INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi
	WHERE (((horarios.Fecha_horario)>='$hoy') AND ((horarios.Usado_horario)>'0') AND ((horarios.Cserv_horario)='$areas') AND (( horarios.Hora_horario)>='$horhor'))
	ORDER BY horarios.Fecha_horario, horarios.Hora_horario");
	echo"<table align=center class='tbl'>";
	$cc=0;
	if(mysql_fetch_array($buscitar))
	{
		echo"<tr>
		<td>SELECCIONAR</td>
		<td>FECHA</td>
		<td>DIA</td>
		<td>HORA</td>
		<td>$medtodos</td>
		<td>$idhortodos</td>
		";
		while($rescitar=mysql_fetch_array($buscitar))
		{
			$fechatodos=$rescitar['Fecha_horario'];
			$diatodos=$rescitar['dia_horario'];
			$horados=$rescitar['Hora_horario'];
			$horatodos=substr($horados,11,5);
			$medtodos=$rescitar['nom_medi'];
			$cmed=$rescitar['Cmed_horario'];
			$idhortodos=$rescitar['ID_horario'];
			$anocam=substr($fechatodos,0,4);
			$mescam=substr($fechatodos,5,2);
			$s=0;
			if($fechatodos==$hoy && $horados>$horhoy)$s=1;
			if($s==0)
			{	
				echo"
				<tr>
				<td><a href='#' onclick='selhorman($idhortodos,\"$fechatodos\",\"$horados\",\"$cmed\",\"$anocam\",\"$mescam\")'><img src='imagenes/next.JPG' width=18 height=18 border=0></a></td>
				<td>$fechatodos</td>
				<td>$diatodos</td>
				<td>$horatodos</td>
				<td>$medtodos</td>
				<td>$idhortodos</td>
				";
				$cc++;
				if($cc>=40)break;
			}
		}
	}
	echo "</table>";
}
	

	
         
    echo "</form>";
	function calculaedad($fecha_)
    {
        $ano_=substr($fecha_,0,4);
        $mes_=substr($fecha_,5,2);
        $dia_=substr($fecha_,8,2);
        if($mes_==2)
        {
            $diasmes_=28;
        }
        else
        {
            if($mes_==1 || $mes_==3 || $mes_==5 || $mes_==7 || $mes_==8 || $mes_==10 || $mes_==12)
            {
                $diasmes_=31;
            }
            else
            {
                $diasmes_=30;			
            }
        }
        $anos_=date("Y")-$ano_;
        $meses_=date("m")-$mes_;
        $dias_=date("d")-$dia_;    
        if($dias_<0)
        {
            if($meses_>0)
            {
                    $meses_=$meses_-1;
            }
            $dias_=$diasmes_+$dias_;
        }
        if($meses_<0)
        {
            $meses_=12+$meses_;
            if(date("d")-$dia_<0)
            {
                $meses_=$meses_-1;
            }
            $anos_=$anos_-1;
        }
        if($meses_==0 & date("d")-$dia_<0 & $anos_>0)
        {
            if(date("m")-$mes_==0 & date("d")-$dia_<0)
            {
                $anos_=$anos_-1;
            }
            $meses_=11;
        }
        if($anos_<>0)
        {
            $edad_=$anos_;
            if($edad_==1)
            {
                $unidad_=" Ao";
            }
            else
            {
                $unidad_=" Aos";
            }
        }
        else
        {
            if($meses_<>0)
            {
                $edad_=$meses_;
                if($edad_==1)
                {
                    $unidad_=" Mes";
                }
                else    
                {
                    $unidad_=" Meses";
                }
            }
            else
            {
                $edad_=$dias_;
                if($edad_==1)
                {
                    $unidad_=" Da";
                }
                else
                {
                    $unidad_=" Das";
                }
            }
        }
        return($edad_.$unidad_);  
    }
	
	function verifica($fecjus)
	{      
		//defino fecha 1 	 
		$ano1 = substr($fecjus,0,4); 
		$mes1 = substr($fecjus,5,2); 
		$dia1 = substr($fecjus,8,2); 
		//defino fecha 2 	
		$dia2=date("d");
		$mes2=date("m");
		$ano2=date("Y");
		//calculo timestam de las dos fechas 
		$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
		$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2); 
		//resto a una fecha la otra 
		$segundos_diferencia = $timestamp1 - $timestamp2; 
		//echo $segundos_diferencia; 
		//convierto segundos en das 
		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 
		//obtengo el valor absoulto de los das (quito el posible signo negativo) 
		$dias_diferencia = abs($dias_diferencia); 
		//quito los decimales a los das de diferencia 
		$dias_diferencia = floor($dias_diferencia); 
		return $dias_diferencia;         //1=justificado; 2=No justificado
	}	
?>
</body>
</html>