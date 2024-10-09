<?
session_start();
$usucitas=$_SESSION['usucitas'];

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
    if($control==1)$areas=$codareauto;
	//echo 'mmmmmmmmmmmmmmm '.$areas;
    echo"
    <tr><td>";
    echo"<form name=uno method=post>	
    <input type=hidden name=codusu value='$codusu'>
    <input type=hidden name=tipafi value=$tipafi>    
    <input type=hidden name=clasifica value=$clasifica>
    <input type=hidden name=telres value=$telres>
    <input type=hidden name=tipafi value='$tipafi'>
    <input type=hidden name=tipafi value='$clasi'>
    <input type=hidden name=codcontra value='$codcontra'>
    <input type=hidden name=nocontra value=$nocontra>
    <input type=hidden name=codareauto value=$codareauto>
    <input type=hidden name=numcitauto value=$numcitauto>    
    <input type=hidden name=desareauto value='$desareauto'>
    <input type=hidden name=control value='$control'>
    <input type=hidden name=numauto value='$numauto'>
    <input type=hidden name=fincit value=$fincit>
    <input type=hidden name=finrefs value=$finrefs>
    <input type=hidden name=finrefn value=$finrefn>
    <input type=hidden name=valvar value=$valvar>
    <table align=center class='tbl'>
    <tr><th>ASIGNACION DE CITA</th></tr>
    <tr>
    <td align=center>";
   /*
    if($fincit>0)echo"<INPUT type=button class='boton' value='HISTORICO' onClick='histo(1)'>";
    else echo"<INPUT type=button class='boton' value='HISTORICO' disabled='true'>";
    if($finrefs>0)echo"<INPUT type=button class='boton' value='AUTORIZACIONES' onClick='histo(2)'>";
    else echo"<INPUT type=button class='boton' value='AUTORIZACIONES' disabled='true'>";
	*/
    echo"</td>
    </tr>
    </table><br>";
    //BUSCAR CITAS ANTERIORES
echo"<table align=center><tr><td>"; 

echo"<table align=center valign=top><tr><td>";

       
        echo"<div id='contecit'>";
        
		if($fincit>0)
        {	
            echo"  
            
            <table align=center class='tbl' width=98%>
            <tr><th colspan=5 align=center>HISTORICO DE CITAS</th></tr>
            <tr>
            <td align=center width=13%>FECHA</td>
            <td align=center width=7%>HORA</td>
            <td align=center width=35%>MEDICO</td>
            <td align=center width=35%>AREA</td>
			<td align=center width=35%>ESTADO</td>
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
				
                echo"<tr>
                <td align=center width=13%>$Fhorario</td>
                <td align=center width=8%>$Hhorario</td>
                <td width=36%>$nmedi</td>
                <td width=33%>$nareas</td>	
				<td width=33%>$desesta</td>				
                </tr>";			
            }		
            echo"</table><br>";            
        }		
        $cn=0;
        echo"</div><br><br><br>";
		
    //BUSCAR AUTORIZACIONES         
        
        echo"<div id='conteref'>";
		echo"
        <table align=center class='tbl' width=100%>";
        echo"<tr>
        <th colspan=7>AUTORIZACIONES</th>				
        </tr>
        <tr>
		
		<th width=10%>SERVICIO SOLICITADO</th>
        <th width=10%>FECHA</th>
        <th width=40%>AYUDA O PROCEDIMIENTO</th>        			
        <th width=10%>CANTIDAD SOLICITADA</th>
		<th width=10%>CANTIDAD ASIGNADA</th>
<th width=10%>SELECCIONAR</th>		
        </tr>
        ";
        for($cn=0;$cn<$finrefs;$cn++)
        {		
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
			
			$nomautos='selref'.$cn;   
			$selref=$$nomautos; 
            echo"<tr>
			<td>$idendetaref $nomarea</td>
            <td align=center>$fecharef</td>			
            <td>$descrimap</td>            
            <td align=center>$numcitas</td>	
			<td align=center>$citasig</td>";
			if($selref==1)echo"<td align=center><input type=checkbox checked name=$nomautos value='1'></td>";
			else echo"<td align=center><input type=checkbox name=$nomautos value='1'></td>";
            echo"</tr>
			<tr><td></td><td colspan=5><font color='#B00C06'>$obsref</font></td></tr>";
        }
		
        echo"</table>
		
		
		<table class='tbl' align=right>
		<tr>
		<td>SELECCINAR TODO <input type=radio name=selgru value='0' onclick='seleccion(1)'></td>
		<td>QUITAR SELECCION <input type=radio name=selgru value='1' onclick='seleccion(2)'></td>
		<td><input type=button class=boton onclick='salto3()' value='Continuar'></td>		
		</tr>
		</table>";
		echo"</div>";
		
echo"</td>
<td width=30></td>
<td  valign=top>
";	
       
		$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$codcontra'";
		$consultamag=mysql_query($consultamag);
		$rowmag=mysql_fetch_array($consultamag);
		$regmag_con=$rowmag[REGMAG_CON];
	    if($regmag_con=='S')
        {
            $busperm=mysql_query("SELECT Max(areas.cod_areas) AS MxDecod_areas, areas.nom_areas
            FROM permisos_citas INNER JOIN areas ON permisos_citas.serv_per = areas.cod_areas
            WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A') AND ((areas.cidi_area)='S'))
            GROUP BY areas.nom_areas");
        }
        else
        {
            $busperm=mysql_query("SELECT Max(areas.cod_areas) AS MxDecod_areas, areas.nom_areas
            FROM permisos_citas INNER JOIN areas ON permisos_citas.serv_per = areas.cod_areas
            WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='P') AND ((areas.cidi_area)='S'))
            GROUP BY areas.nom_areas");
        } 
		
        echo"
        <table class='tbl' align=center width=100%>
        <tr>
        <th>AREA</th>
		
		<td align=center><select name=areas class='caja' onchange='salto2()'>	
        <option value='$codareauto'>$desareauto</option>";
		if($codareauto==85)
		{
			echo"<option value='86'>IMAGENOLOGIA2</option>
			<option value='26'>IMAGENOLOGIA3</option>";
		}
        $n=0;
		
        while($rareper=mysql_fetch_array($busperm))
        {		
            $codare=$rareper['MxDecod_areas'];
            $nomare=$rareper['nom_areas'];
           
            if($areas==$codare)echo"<option selected value=$codare>$nomare</option>";	
            else echo"<option value=$codare>$nomare</option>";	
            		
        }
        echo"</select></td>
		
			
		
		</tr>
		<tr>
		<th>MEDICO</th>";
		
		if(empty($areas))$areas=$codare;
        $bmedi=mysql_query("SELECT medicos.nom_medi, medicos.cod_medi
        FROM medicos INNER JOIN areas_medic ON medicos.cod_medi = areas_medic.cod_med_ar
        WHERE (((areas_medic.areas_ar)='$areas')) and (((areas_medic.areas_ar)<>'')) order by medicos.nom_medi");
		
		
		
		echo"<td align=center>
        <select name=medico class='caja' onchange='salto2()'>
        <option value='0'></option>";			
        while($rmedi=mysql_fetch_array($bmedi))
        {
            $codimed=$rmedi['cod_medi'];
            $nombmed=$rmedi['nom_medi'];                    	
            if($medico==$codimed)echo"<option selected value=$codimed>$nombmed</option>";
            else echo"<option value=$codimed>$nombmed</option>";			
        }
        $busti=mysql_query("Select cod_ticita ,des_ticita  From tip_cita  where cod_ticita<=5 Order By cod_ticita");
        echo"</td>
		</tr>
		<tr>
        <th>TIPO SOLICITUD</th>";
		
		echo "<td align=center><select class='caja' name=tipoci>";
        while ($row1=mysql_fetch_array($busti))
        {
            $codtip=$row1["cod_ticita"];
            $nomtip=$row1["des_ticita"];
            if($tipoci==$codtip)echo "<option selected value='$codtip'>$nomtip</option>"; 
            else echo "<option value='$codtip'>$nomtip</option>"; 
        }        
        
        
		
		echo"</tr>";
		
        
		
		
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
            <textarea name=obsecit class='caja' rows=2 cols=30>$obsecit</textarea>
            </td></tr>";
        }			
        echo"</table>";
	   if(!empty($medico))
        {			
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
			</td></tr>
			
			</table>
			
			</td><tr>
			
			<tr><td  valign=top>					
            <table class='tbl' align=center>
            <tr><th align=center colspan=6>FECHA: $dise $vecdia<font color='#FFFFFF'>------------------</font>HORA: $horaele</td></tr>";
            if(empty($cont))$cont=0;
            //echo $vecdia;		
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
					if($Usado_horario==0)
					{
						
						echo"<td align=center><font color='#BBBBBB'>$hora</td>";
										
					}
					else
					{
						if(mysql_fetch_array($buscithor)>0)
						{
							echo"<td align=center><font color='#888888'>$hora</td>";
						}
						else
						{
							if($color1==1)
							{
								echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$hora</td>";
							}
							else
							{
								$titu=$Usado_horario.' turnos disponibles';
								echo"<td align=center><a href='#' onclick='busdia($ID_horario,\"$hora\",\"$Usado_horario\",\"$idhorsig\",\"$idhorsig1\")' title='$titu'><font color='#0000FF'>$hora</a></td>";
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
					if($Usado_horario==0)
					{
						
						echo"<td align=center><font color='#BBBBBB'>$hora</td>";
										
					}
					else
					{
						$bsig=mysql_query("SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario
						FROM horarios WHERE (((horarios.Fecha_horario)='$vecdia') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areas') AND ((horarios.ID_horario)>'$ID_horario')) ORDER BY horarios.Hora_horario");
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
						if(mysql_fetch_array($buscithor)>0)
						{
							echo"<td align=center><font color='#888888'>$hora 1</td>";
						}
						else
						{
							if($color1==1)
							{
								echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$hora</td>";
								$listo=$n;
							}
							else
							{
								if($n==$listo+1)$colsig='#FAFF9E';
								else $colsig='#FFFFFF';
								if($Usadosig>0  && $n<$nreg-1)
								{
									
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center bgcolor=$colsig><a href='#' onclick='busdia($ID_horario,\"$hora\",\"$Usado_horario\",\"$idhorsig\",\"$idhorsig1\")' title='$titu'><font color='#0000FF'>$hora</a></td>";
								}
								else
								{
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center bgcolor=$colsig><font color='#0000FF'>$hora</td>";
									
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
					if($Usado_horario==0)
					{						
						echo"<td align=center><font color='#BBBBBB'>$hora</td>";										
					}
					else
					{						
						$bsig3=mysql_query("SELECT horarios.Fecha_horario, horarios.Usado_horario, horarios.Cmed_horario, horarios.Hora_horario, horarios.Cserv_horario, horarios.ID_horario
						FROM horarios WHERE (((horarios.Fecha_horario)='$vecdia') AND ((horarios.Cmed_horario)='$medico') AND ((horarios.Cserv_horario)='$areas') AND ((horarios.ID_horario)>'$ID_horario')) ORDER BY horarios.Hora_horario");
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
							echo"<td align=center><font color='#888888'>$hora</td>";
						}
						else
						{
							if($color1==1)
							{
								echo"<td align=center bgcolor='#FAFF9E'><font color='#0000FF'>$hora</td>";
								$listo=$n;
							}
							else
							{
								if($n==$listo+1 || $n==$listo+2)$colsig='#FAFF9E';
								else $colsig='#FFFFFF';
								if($Usadosig>0 && $Usadosig1>0 && $n<$nreg-2)
								{
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center bgcolor=$colsig><a href='#' onclick='busdia($ID_horario,\"$hora\",\"$Usado_horario\",\"$idhorsig\",\"$idhorsig1\")' title='$titu'><font color='#0000FF'>$hora</a></td>";									
								}
								else
								{
									$titu=$Usado_horario.' turnos disponibles';
									echo"<td align=center bgcolor=$colsig><font color='#0000FF'>$hora</td>";
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
            ECHO "<input type=hidden name=seleccion value='$seleccion'>";
            ECHO "<input type=hidden name=fechaele value='$fechaele'>";
            ECHO "<input type=hidden name=vecdia value='$vecdia'>";
            ECHO "<input type=hidden name=horaele value='$horaele'>";
            ECHO "<input type=hidden name=valusado value='$valusado'>";
			ECHO "<input type=hidden name=horsig value='$horsig'>";
            ECHO "<input type=hidden name=horsig1 value='$horsig1'>";
			
        }
		
		
		if($n>0)
         {
             echo"
            <table align=center class='tbl'>
            <tr><th align=center height=20>
           <INPUT type=button class='boton' name='bot' value='Asignar cita' onClick='valida();'>";
            echo"</th></tr>		
            </table>
            </td></tr>
            </table>";
         }   
		
        echo"</tr>		
		
		
</td></tr>	
</table>
        <br>";
         
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
?>
</body>
</html>