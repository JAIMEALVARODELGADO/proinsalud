<?
session_start();
$usucitas=$_SESSION['usucitas'];

$dateh=date("Y-m-d");

foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
}
//echo $codusu.' '.$codcontra;
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
        f=uno.finrefs.value;
		car='';
		con=0;
		for(i=0;i<f;i++)
		{
			val="uno.selref"+i+".checked";
			
			if(eval(val)==true)
			{
				are="uno.areades"+i+".value";
				dare="uno.nomarea"+i+".value";
				if(eval(are)!=car)
				{
					con=(con/1)+1;
				}
				car=eval(are);
			}			
		}
		if(con!=1)
		{
			alert("Seleccione solo los registros que correspondan al mismo servicio");
			uno.codareauto.value='';
			uno.desareauto.value='';
			 uno.target='';
			uno.action='asigna1.php';
			uno.submit();
		}		
		uno.codareauto.value=eval(are);
        uno.desareauto.value=eval(dare);
        uno.control.value=1;        
        uno.medico.value='';       
        uno.target='';
        uno.action='asigna1.php';
        uno.submit();
    }
    function valida(a,m)
    {
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
	function seleccion(n)
	{
		f=uno.finrefs.value;		
		if(n==1)
		{
			for(i=0;i<f;i++)
			{
				val="uno.selref"+i+".checked=true";
				eval(val);
				
			}
		}
		if(n==2)
		{
			for(i=0;i<f;i++)
			{
				val="uno.selref"+i+".checked=false";
				eval(val);
			}
		}
	
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
	function bususu()
	{
		if (event.keyCode == 13)
        {            
			uno.action="../nuevocitas/consuref.php";
            uno.target='';			
            uno.submit();		
        }
	
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
.margen_izq {
margin-left:10px;
} 
a{text-decoration:none}
</style> 
<?
    echo"<form name=uno method=post>";
	/*
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
	*/
    include ('php/conexion1.php');
    $fecano=date("Y");
    $fecmes=date("m");
    $fecdia=date("d");
	$fecimpre=
    $ffano=$fecano-1;
    $fechlim=$ffano.'-'.$fecmes.'-'.$fecdia;	
    if($control==1)$areas=$codareauto;
	//echo 'mmmmmmmmmmmmmmm '.$areas;
	if(!empty($cedula))
	{
		$bcedu=mysql_query("select * from usuario where NROD_USU='$cedula'");
		$rcedu=mysql_fetch_array($bcedu);
		$codusu=$rcedu['CODI_USU'];
	
	}
	if(empty($codusu))
	{
		echo"
		<table align=center class='tbl'>
		<tr>
		<td>Documento de identificacion</td>
		<td><input type=text name=cedula onKeypress='bususu()'></td>
		</tr>
		</table>
		";
	
	
	}
	else
	{
		
		
		echo"
		<input type=hidden name=proxi>
		<input type=hidden name=codusu value='$codusu'>";
		$bususu=mysql_query("SELECT usuario.CODI_USU, usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, contrato.NEPS_CON, ucontrato.CONT_UCO, ucontrato.ESTA_UCO
		FROM (ucontrato INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) INNER JOIN usuario ON ucontrato.CUSU_UCO = usuario.CODI_USU
		WHERE (((usuario.CODI_USU)='$codusu'))");
		$j=0;
		echo" <table align=center class='tbl'>";
		while($rusu=mysql_fetch_array($bususu))
		{
			$cedu=$rusu['NROD_USU'];
			$nombre=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
			$nomcontra=$rusu['NEPS_CON'];
			$codcontra=$rusu['CONT_UCO'];
			$estacon=$rusu['ESTA_UCO'];
			if($j==0)
			{
				echo"<tr>
				<th colspan=2>USUARIO</th>
				</tr>
				<tr>
				<td align=center>Documento: $cedu</th>
				<td align=center>Nombre: $nombre</th>
				</tr>
				<tr><th colspan=2>CONTRATOS</th></tr>";			
			
			}
			echo"
			<tr>
			<td align=center>$nomcontra</th>
			<td align=center>Estado: $estacon</th>
			</tr>";
			$j++;
		}
		
		$hor=date("Y-m-d")."    ". date("H").":".date("i");
		echo"
		<tr><td align=center colspan=2>Fecha y hora de impresión: $hor</td>
		</tr>
		</table>
	   <br>
	   
	   
	   ";
		
	echo"<table align=center><tr><td>"; 

	echo"<table align=center valign=top><tr><td>";

		   
			//echo"<div id='contecit'>";
			
			
		$fech='2012-01-01';
		$cn=0;
		$bcitant=mysql_query("SELECT citas.Idusu_citas, horarios.Fecha_horario, horarios.Hora_horario, medicos.nom_medi, areas.nom_areas, citas.Clase_citas, citas.esta_cita
		FROM ((citas INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) INNER JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN areas ON horarios.Cserv_horario = areas.cod_areas
		WHERE (((citas.Idusu_citas)='$codusu') AND ((horarios.Fecha_horario)>'$fech') AND ((citas.Clase_citas)<'6'))
		ORDER BY horarios.Fecha_horario DESC , horarios.Hora_horario DESC"); 
		echo"  
				
				<table align=center class='tbl' width=98%>
				<tr><th colspan=5 align=center>HISTORICO DE CITAS</th></tr>
				<tr>
				<th align=center width=13%>FECHA</td>
				<th align=center width=7%>HORA</td>
				<th align=center width=35%>MEDICO</td>
				<th align=center width=35%>AREA</td>
				<th align=center width=35%>ESTADO</td>
				</tr>";
		while($rcitant=mysql_fetch_array($bcitant))
		{
			
			$Fhorario=$rcitant['Fecha_horario'];
			$Hhorario=$rcitant['Hora_horario'];
			$nmedi=$rcitant['nom_medi'];
			$nareas=$rcitant['nom_areas'];
			$estaci=$rcitant['esta_cita'];
			$bec=mysql_query("SELECT * FROM esta_cita where cod_estaci='$estaci'");
			$rec=mysql_fetch_array($bec);
			$desesta=$rec['descrip_estaci']; 
			
			
			echo"<tr>
			<td align=center width=13%>$Fhorario</td>
			<td align=center width=8%>$Hhorario</td>
			<td width=36%>$nmedi</td>
			<td width=33%>$nareas</td>	
			<td width=33%>$desesta</td>				
			</tr>";	
		}	
			
			
			
			
						  
			echo"</table><br>";  
			echo"<br><br><br>";
			
		//BUSCAR AUTORIZACIONES         
		  
			//echo"<div id='conteref'>";
			echo"
			<table align=center class='tbl' width=100%>";
			echo"<tr>
			<th colspan=7>AUTORIZACIONES</th>				
			</tr>
			<tr>";
			
			
			$nomtab1='usutmp1'.$usucitas;
			$bref1=mysql_query("CREATE TEMPORARY TABLE $nomtab1 SELECT referencia.asol_ref AS asol_ref, referencia.idre_ref AS idre, detareferencia.obsv_dre AS obsv_dre, detareferencia.codi_dre AS codi, detareferencia.cant_dre AS cant, detareferencia.iden_dre AS iden, referencia.fech_ref AS fech, detareferencia.cant_dre AS ncit, detareferencia.alse_dre AS alse, detareferencia.marc_dre AS marc_dre, detareferencia.cant_cit AS cant_cit, ucontrato.CUSU_UCO, ucontrato.CONT_UCO
			FROM (detareferencia INNER JOIN referencia ON detareferencia.idre_dre = referencia.idre_ref) INNER JOIN ucontrato ON referencia.cuco_ref = ucontrato.IDEN_UCO
			WHERE ((detareferencia.alse_dre)<>'') AND ((ucontrato.CUSU_UCO)='$codusu') AND ((ucontrato.CONT_UCO)='$codcontra')");

			$bref2=mysql_query("insert into $nomtab1 SELECT referencia2.asol_rf2 AS asol_ref, referencia2.nume_rf2 AS idre, detareferencia.obsv_dre AS obsv_dre, detareferencia.codi_dre AS codi, detareferencia.cant_dre AS cant, detareferencia.iden_dre AS iden, referencia2.fech_rf2 AS fech, detareferencia.cant_dre AS ncit, detareferencia.alse_dre AS alse, detareferencia.marc_dre AS marc_dre, detareferencia.cant_cit AS cant_cit, ucontrato.CUSU_UCO, ucontrato.CONT_UCO
			FROM ucontrato INNER JOIN (referencia2 INNER JOIN detareferencia ON referencia2.nume_rf2 = detareferencia.idre_dre) ON ucontrato.IDEN_UCO = referencia2.cuco_rf2
			WHERE ((detareferencia.alse_dre)<>'') AND ((ucontrato.CUSU_UCO)='$codusu') AND ((ucontrato.CONT_UCO)='$codcontra')");
			
			$bref1=mysql_query("select * from $nomtab1");
			
			
			
			
			
			echo"
			<th width=10%>SERVICIO SOLICITADO</th>
			<th width=10%>FECHA</th>
			<th width=40%>AYUDA O PROCEDIMIENTO</th>        			
			<th width=10%>CANTIDAD SOLICITADA</th>
			<th width=10%>CANTIDAD ASIGNADA</th>
			<th width=10%>ESTADO</th>		
			</tr>
			";
			
			
			
			
			
			
			
		while($rar=mysql_fetch_array($bref1))
		{
			
			$numeroid=$rar['idre'];
			$codproced=$rar['codi'];	
			$codservic=$rar['alse'];	
			$cant=$rar['cant'];		//codigo procedimiento 
			$idendetaref=$rar['iden'];	//identificador tabla detareferencia
			$fecharef=$rar['fech'];		//Fecha
			$numcitas=$rar['ncit']; //numero de citas autorizadas
			$aresol=$rar['asol_ref'];
			$citasig=$rar['cant_cit'];		
			$estado=$rar['marc_dre'];
			$obsref=$rar['obsv_dre'];		
			$valcita=0;
			
			$busdes=mysql_query("SELECT destipos.codi_des, destipos.valo_des, destipos.nomb_des, areas.nom_areas
			FROM destipos INNER JOIN areas ON destipos.valo_des = areas.cod_areas
			WHERE (((destipos.codi_des)='$codservic'))");
			while($rusdes=mysql_fetch_array($busdes))	
			{			
				$nomservic=$rusdes['nomb_des'];   //Nombre servicio al que se remite
				$areades=$rusdes['valo_des'];
				$nomarea=$rusdes['nom_areas'];
			}	

			$busesta=mysql_query("SELECT nomb_des
			FROM destipos 
			WHERE codi_des='$estado'");
			while($rusesta=mysql_fetch_array($busesta))	
			{			
				$nomesta=$rusesta['nomb_des'];   //Nombre servicio al que se remite
			}		
			
			$descrimap='';	
			if(strlen($codproced)>4)
			{	
						
				$busmap=mysql_query("select * from cups where codigo='$codproced'");
				while($rusmap=mysql_fetch_array($busmap))	
				{
					$descrimap=$rusmap['descrip'];			
				}
			}			
			echo"<tr>
			<td>$idendetaref $nomarea</td>
			<td align=center>$fecharef</td>			
			<td>$descrimap</td>            
			<td align=center>$numcitas</td>	
			<td align=center>$citasig</td>
			<td align=center>$nomesta</td>";		
		}			
		echo"</table>";			
		
	}
?>
</body>
</html>