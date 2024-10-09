<?
session_start();
$usucitas=$_SESSION['usucitas'];
$areatra=$_SESSION['areatra'];
$dateh=date("Y-m-d");
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 

?>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
<script language="javascript">
    function salto()
    {
        if (event.keyCode == 13)
        {
            //uno.escontra.value='';			
            uno.action='asigna0.php';
            uno.target='area';
            uno.submit();		
        }
    }
    function salto1()
    {		
        //uno.escontra.value='';
        uno.action='asigna0.php';
        uno.target='area';
        uno.submit();			
    }    
    function salto2()
    {		
        uno.action='asigna0.php';
        uno.target='area';
        uno.submit();			
    }
    function valida()
    {		
        email=uno.correo.value;
		if(email != '')
		{
			if (/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(email))
			{} 
			else {
				alert("El formato de correo electronico es incorrecto.");
				return;
			}
		}
		
		
		val=uno.areatra.value;
        if(val=='5802')
        {
            uno.action='asignaurg.php';
        }
        else
        {
            uno.action='asignapaso.php';
        }        
        uno.target='area';
        uno.submit();
		uno.action='titulo.php';
        uno.target='titulopag';
        uno.submit();
    }
    function valhora(campo,n)
    {		
            if (!((campo.value.match(/^(0[0-9]|1[0-9]|2[0-3])$/)) && (campo.value!='')))
        {
            iden="hor"+n;
            document.getElementById(iden).style.backgroundColor = "#ff0000";
            return;
        }	
            else
        {
            iden="hor"+n;
            document.getElementById(iden).style.backgroundColor = "#FFFFFF";
            return;
        }			
    }
	function busbene(id)
	{
		
		uno.cedula.value=id;		
		uno.action='asigna0.php';
        uno.target='area';
        uno.submit();	
	}
</script>
</head>
<body style='position:absolute;margin-top:10'>
<style>
#conte 
{
    overflow:auto;
    height: 120px;
    width: 300px;
    padding:5px;
    margin:0 auto;
    background-color: #FFFFFF;
    font-size: 8px;
}
.margen_izq 
{
    margin-left:10px;
}
</style> 
<?	
    //onload="setScrollPos('conte')"
    set_time_limit(300);
	if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }
    include ('php/conexion1.php');
	$busarea=mysql_query("SELECT Max(destipos.codi_des) AS MaxDecodi_des, destipos.nomb_des
    FROM permisos_citas INNER JOIN destipos ON permisos_citas.area_per = destipos.codi_des
    WHERE (((permisos_citas.usua_per)='$usucitas') AND ((permisos_citas.esta_per)='A'))
    GROUP BY destipos.nomb_des");
	$numrec=mysql_num_rows($busarea);
	
	
	 echo"<br><form name=uno method=post>
	 <table align=center>
    <tr><td>
    <table align=center class='tbl' width=100%>
    <tr><th colspan=2>ASIGNACION DE CITA</th></tr>
	<th width=50% align=center>TIPO</td>";
	if($numrec<>1)
	{
		echo"<td align=center><select class=caja name=areatra onchange='salto1()'>
		<option value=''></option>";	
		while($rare=mysql_fetch_array($busarea))
		{        
			
			$artra=$rare['MaxDecodi_des'];
			$nomareatra=$rare['nomb_des'];
			if($artra==$areatra)echo"<option selected value='$artra'>$nomareatra</option>";
			else echo"<option value='$artra'>$nomareatra</option>";			
		}
		echo"</select>
		</td>";
	}
	else
	{
		while($rare=mysql_fetch_array($busarea))
		{			
			$areatra=$rare['MaxDecodi_des'];
			$nomareatra=$rare['nomb_des'];
		}
		echo"<td align=center>$nomareatra</td>
		<input type=hidden name=areatra value=$areatra>
		";
		
	}
		
	echo"		
	</tr>
    </table>
	 ";
	 //echo "aaaaaaaaaa ";
	if(!empty($areatra))
	{
		$busarea=mysql_query("Select cod_areas,nom_areas From areas Order By nom_areas");
		echo"
		<br>
		<table class='tbl' align=center width=100%>
		<tr>
		<th>DOCUMENTO</th>
		<td align=center><input type=text name=cedula class='caja' onkeypress='salto()' onBlur='salto1()' value='$cedula'></td>	
		</tr>
		</table><br>";	
		$bcontra=mysql_query("SELECT usuario.NROD_USU, usuario.EMAI_USU, contrato.CODI_CON, contrato.NEPS_CON, ucontrato.ESTA_UCO, usuario.CODI_USU, usuario.TDOC_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, usuario.TEL2_USU, usuario.MRES_USU, usuario.MATE_USU, municipio.NOMB_MUN AS nomuate, usuario.TPAF_USU, usuario.DCOT_USU, ucontrato.IDEN_UCO
		FROM municipio RIGHT JOIN ((ucontrato INNER JOIN usuario ON ucontrato.CUSU_UCO = usuario.CODI_USU) INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON municipio.CODI_MUN = usuario.MATE_USU
		WHERE (((usuario.NROD_USU)='$cedula') AND contrato.ESTA_CON='A')");	
		$num=mysql_num_rows($bcontra);
	//	if($num>0)
	//	{
	//1085275773
		if(empty($cedula))exit(); 
		if($num>0)
		{    
			
			$n=0;
			while($resusu=mysql_fetch_array($bcontra))
			{		
				$nomco=$resusu['NEPS_CON'];
				$estacontra=$resusu['ESTA_UCO'];
				$codusu=$resusu['CODI_USU'];
				$tdocus=$resusu['TDOC_USU'];
				$nomusu=$resusu['PNOM_USU'].' '.$resusu['SNOM_USU'].' '.$resusu['PAPE_USU'].' '.$resusu['SAPE_USU'];
				$fecnac=$resusu['FNAC_USU'];
				$sexusu=$resusu['SEXO_USU'];
				$dirusu=$resusu['DIRE_USU'];
				$tresusu=$resusu['TRES_USU'];
				$tel2usu=$resusu['TEL2_USU'];
				$correo=$resusu['EMAI_USU'];
				$munres=$resusu['MRES_USU'];
				$munate=$resusu['nomuate'];
				$codmunate=$resusu['MATE_USU'];
				
				
				$tipafi=$resusu['TPAF_USU'];
				$docusu=$resusu['DCOT_USU'];
				$iden_uco=$resusu['IDEN_UCO'];
				$vecit[$n][0]=$nomco;
				$vecit[$n][1]=$estacontra; 
				$n++;
			}   
			echo"<input type=hidden name=codusu value=$codusu>";
			echo"<input type=hidden name=tipafi value=$tipafi>";
			echo"<input type=hidden name=iden_uco value=$iden_uco>";
			echo"<input type=hidden name=munate value=$codmunate>";
			echo"<input type=hidden name=telsi value='1'>";
			
			
			
			
			$edad=calculaedad($fecnac);
			
			if(empty($escontra))$escontra=$estacontra1;		
			$largo=strlen($escontra);
			
			//echo"<input type=hidden name=codcontra value='$contrato'>";
			//$nomcon=substr($escontra,5,$largo-5);
			//echo"<input type=hidden name=nocontra value='$nomcon'>";	
			//echo"<input type=hidden name=nocontrati value='$nomcon'>";
			echo"<input type=hidden name=codusuti value='$codusu'>";
			
				
				echo"<table class='tbl' align=center width=100%>
				<tr><th colspan=3>DATOS DEL PACIENTE</th></tr>
				<tr>
				<th rowspan=$n>CONTRATO</th>";
				for($i=0;$i<$n;$i++)
				{
					$ncontra=$vecit[$i][0];
					$escontra=$vecit[$i][1];
					echo"<td>$ncontra</td><td>$escontra</td>
					<tr>";
				}
				echo"
				<tr>
				<tr><th>CEDULA</th><td colspan=2>$cedula</td></tr>
				<tr><th>NOMBRE</th><td colspan=2>$nomusu</td></tr>
				<tr><th>EDAD</th><td colspan=2>$edad</td></tr>
				<tr><th>DOCUMENTO COTIZANTE</th><td colspan=2>$docusu</td></tr>
				<tr><th>MUNICIPIO DE RESIDENCIA</th><td colspan=2>$munres</td></tr>
				<tr><th>MUNICIPIO DE ATENCION</th><td colspan=2>$munate</td></tr>
				<tr><th>DIRECCION</th><td colspan=2>$dirusu</td></tr>
				<tr><th>TELEFONO 1</th><td colspan=2><input type=text class='caja' name=telres1 value='$tresusu'></td></tr>
				<tr><th>TELEFONO 2</th><td colspan=2><input type=text class='caja' name=telres2 value='$tel2usu'></td></tr>
				<tr><th>CORREO ELECTRONICO</th><td colspan=2><input type=text class='caja' size=40 class='caja2' name=correo value='$correo'></td></tr>
				</tr>";
			if($areatra=='5802')
			{
				$edadpac=edad($fecnac);
				if($edadpac<16)$clasi='NI';
				if($edadpac>=16 && $edadpac<65)$clasi='TO';
				if($edadpac>=65)$clasi='TE';	
				echo"<input type=hidden name=clasi value='$clasi'>";
				if($sexusu=='F')
				{		
					if($edadpac>=12 && $edadpac<=45)
					{
						echo"
						<tr><th>Materna</th>
						<td><input type=checkbox name=clasifica value='MA'>
						</td></tr>
						";
					}			
				}	
			}		
			echo"		
			</table>
			<br>";  
			$sigue=0;
			
			$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$contrato'";
			$consultamag=mysql_query($consultamag);
			$rowmag=mysql_fetch_array($consultamag);
			$regmag_con=$rowmag[REGMAG_CON];

			
			if($regmag_con=='S')
			{
				if($estado=='AC')$sigue=1;
			}
			else
			{
				$sigue=1;
			}			
			if($sigue==1)
			{
				echo"<table align=center class='tbl' width=100%>
				<tr><th align=center height=20>";
				echo"<INPUT type=button class='boton' value='aceptar' onClick='valida();'>";
				echo"</th></tr>		
				</table>";
			}
			echo"
			</td></tr>
			</table>";
			
			if($usucitas=='12991944')
			{
				$bben=mysql_query("SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.DCOT_USU, usuario.FNAC_USU, usuario.PARE_USU, destipos.nomb_des AS paren, destipos.codt_des
				FROM (usuario INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN destipos ON usuario.PARE_USU = destipos.valo_des
				WHERE (((usuario.NROD_USU)<>'$cedula') AND ((usuario.DCOT_USU)='$cedula') AND ((destipos.codt_des)='80'))");
				
				if(mysql_num_rows($bben))
				{
					echo"<br><br><table align=center class='tbl'>
					<tr>
					<th colspan=5>BENEFICIARIOS</th>
					</tr>
					<tr>
					<th>DOCUMENTO</th>
					<th>NOMBRE</th>
					<th>PARENTESCO</th>
					<th>EDAD</th>
					<th>SELECCIONAR</th>
					</tr>";
					while($rben=mysql_fetch_array($bben))
					{
						$nrodoc=$rben['NROD_USU'];
						$nomben=$rben['PNOM_USU'].' '.$rben['SNOM_USU'].' '.$rben['PAPE_USU'].' '.$rben['SAPE_USU'];
						$fnacben=$rben['FNAC_USU'];
						$paren=$rben['paren'];
						$edadben=calculaedad($fnacben);
						echo"<tr>
						<td>$nrodoc</td>
						<td>$nomben</td>
						<td>$paren</td>
						<td>$edadben</td>
						<td align=center><input type=button value='...' class='boton' onclick='busbene(\"$nrodoc\")'>...</a></td>
						</tr>";
					}
					
					echo"</table>";
				}
			}
		}
		else
		{
			echo"<br>
			<table align=center class='tbl' width=100%>
			<tr><th>DOCUMENTO NO REGISTRADO</th></tr>
			</table>";
		}
	}
    echo"</form>";	
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
                $unidad_=" A�o";
            }
            else
            {
                $unidad_=" A�os";
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
                        $unidad_=" D�a";
                }
                else
                {
                        $unidad_=" D�as";
                }
            }
        }
        return($edad_.$unidad_);  
    }
    
    function edad($fecha_nac)
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
?>
</body>
</html><html><head></head><body></body></html>