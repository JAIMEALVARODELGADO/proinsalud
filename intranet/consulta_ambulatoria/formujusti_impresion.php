<?
 
?>
<HTML>
<HEAD>
	<TITLE>New Document</TITLE> 
	</HEAD>
<BODY>
<style>
.enlace{background: #fff;font-family: Arial,Tahoma, Verdana, Helvetica, sans-serif;	font-size: 10px;}
.table1{		
	border: 1px solid #bbb;
	width: 100%;
	border-collapse: collapse;
	empty-cells: show;
	background: #FFFFFF;
}
.table1 th{
	border: 1px solid #bbb;
	padding:.2em .2em;
	text-align: left;
	font-family: arial;
	color: #000000;
	font-size: 10px;;
	empty-cells: show;
	text-decoration: none;
	font-weight: 700;	
	background-Color:#dee;	
}
.table1 td{
	font-family: arial;
	color: #000000;
	font-size: 10px;
	empty-cells: show;
	text-decoration: none;
	font-weight: 500;
	border: 1px solid #bbb;
	padding:.2em .2em;	
}

</style>
<?    
	$link=Mysql_connect("localhost","root","VJvj321");
	if(!$link)echo"no hay conexion";
	Mysql_select_db('proinsalud',$link);

	$idennop='608';
	$buscajusti="select * from form_nop where iden_nop ='$idennop'";
    $resuljusti=Mysql_query($buscajusti,$link);
    while($rowjusti=mysql_fetch_array($resuljusti))
    {
        $codproducto=$rowjusti['cmed_nop'];	
		$codiusu=$rowjusti['codi_usu'];		
		$idennop=$rowjusti['iden_nop'];		
		$idenmed=$rowjusti['iden_med'];
		$fechasol=$rowjusti['fech_pos'];
		$medico=$rowjusti['cod_medico'];
		$codcie10=$rowjusti['cod_cie10'];
		$fechadiag=$rowjusti['fcdx_nop'];	
		$casoclinico=$rowjusti['cacl_nop'];		
		$dosis=$rowjusti['dosi_nop'];				
		$cantidad=$rowjusti['cant_nop'];
		$tiempo=$rowjusti['tiem_nop'];
		$riesgo=$rowjusti['ries_nop'];
		$altera=$rowjusti['alte_nop'];
		$efecsec=$rowjusti['efes_nop'];
		$tiemres=$rowjusti['tres_nop'];
		$efecadver=$rowjusti['efad_nop'];
		$sopbiblio=$rowjusti['sbib_nop'];
		$reacciones=$rowjusti['reac_nop'];
		$efectividad=$rowjusti['efec_nop'];
		$resultados=$rowjusti['resu_nop'];
		$alternapos=$rowjusti['alpo_nop'];
		$alterproto=$rowjusti['prot_nop'];
		$nomejoria=$rowjusti['nome_nop'];
		$otro=$rowjusti['otro_nop'];
		$cual=$rowjusti['cual_nop'];
	}	
	$cadusua="select * from usuario where CODI_USU='$codiusu'";
    $resulusua=Mysql_query($cadusua,$link);
    while($rowusua=mysql_fetch_array($resulusua))
    {
        $ape1usu=$rowusua['PAPE_USU'];
        $ape2usu=$rowusua['SAPE_USU'];
        $nom1usu=$rowusua['PNOM_USU'];
        $nom2usu=$rowusua['SNOM_USU'];
        $cedula=$rowusua['NROD_USU'];
        $tdocusu=$rowusua['TDOC_USU'];
        $fnacusu=$rowusua['FNAC_USU'];
        $sexousu=$rowusua['SEXO_USU'];
        $direusu=$rowusua['DIRE_USU'];
        $teleusu=$rowusua['TRES_USU'];
        $ciudusu=$rowusua['MRES_USU'];
        $tipoafi=$rowusua['TPAF_USU'];
        $nombre=$ape1usu.' '.$ape2usu.' '.$nom1usu.' '.$nom2usu;
    }
	$anos=edad($fnacusu);
	$cadcontra="select contrato.NEPS_CON from contrato,ingreso_hospitalario where contrato.CODI_CON=ingreso_hospitalario.contra_ing and ingreso_hospitalario.codius_ing='$codiusu'";
    $resulcontra=Mysql_query($cadcontra,$link);
    while($rowcontra=mysql_fetch_array($resulcontra))
    {
        $nomcontrato=$rowcontra['NEPS_CON'];
	}	
	
	$anos=edad($fnacusu);
	
	$cadmedico="select *from medicos where cod_medi='$medico'";
    $resulmedico=Mysql_query($cadmedico,$link);
    while($rowmedico=mysql_fetch_array($resulmedico))
    {
        $nommedico=$rowmedico['nom_medi'];
		$especial=$rowmedico['espe_med'];
		$regmedico=$rowmedico['reg_medi'];
		$telemedico=$rowmedico['telf_medi'];
		$dirmedico=$rowmedico['dir__medi'];
		$ced_medi=$rowmedico['ced_medi'];		
	}
	$cadmedico="select *from destipos where codi_des='$especial'";
    $resulmedico=Mysql_query($cadmedico,$link);
    while($rowmedico=mysql_fetch_array($resulmedico))
    {       
		$especialidad=$rowmedico['nomb_des'];		
	}
	
	$cadcie1="select nom_cie10 from cie_10 where cod_cie10='$codcie10'";
	$resulcie1=Mysql_query($cadcie1,$link);
	while ($rowcie1=mysql_fetch_array($resulcie1))
	{
		$nomcie1=$rowcie1['nom_cie10'];
	}
	$cadmed="select nomb_mdi from medicamentos2 where codi_mdi='$codproducto'";
	$resulmed=Mysql_query($cadmed,$link);
	while ($rowmed=mysql_fetch_array($resulmed))
	{
		$nompro=$rowmed['nomb_mdi'];
	}
	$resriesgo='NO';
	if($riesgo=='S')$resriesgo='SI';
	$resalterna='NO';
	if($alterna=='S')$resalterna='SI';	
	$resreacciones='';
	if($reacciones=='S')$resreacciones='X';
	$resefectividad='';
	if($efectividad=='S')$resefectividad='X';
	$resresultados='';
	if($resultados=='S')$resresultados='X';	
	$resalternapos='';
	if($alternapos=='S')$resalternapos='X';
	$resalterproto='';
	if($alterproto=='S')$resalterproto='X';
	$resnomejoria='';
	if($nomejoria=='S')$resnomejoria='X';
	$resotro='';
	if($otro=='S')$resotro='X';
	$diasol=substr($fechasol,8,2);
	$messol=substr($fechasol,5,2);
	$anosol=substr($fechasol,0,4);	
	$sexo1='';$sexo2='';
	if($sexousu=='M')$sexo2='X';
	if($sexousu=='F')$sexo1='X';
	
	echo"

	<table align=center width=100% cellspacing=1 cellpadding=1 border=1 bgcolor=#FFFFFF>
		<table align=center width=100% cellspacing=0 cellpadding=0 border=1 bgcolor=#FFFFFF>
			<tr>
			<td align=center rowspan=5 width=8%><img src='img/proinsalud.gif' width=60%></td>
			<td align=center rowspan=5 width=15%><font FACE=Arial size=1><B>Profesionales de la Salud S.A.</B></font></td>
			<td align=center rowspan=5 width=44%><font FACE=Arial size=1><B>JUSTIFICACIÓN DE MEDICAMENTOS, PROCEDIMIENTOS E INSUMOS<br>NO INCLUIDOS EN EL POS O EN LA GUÍA FARMACOTERAPÉUTICA<br>INSTITUCIONAL</B></font></td>
			<td align=center rowspan=2 width=8%><font FACE=Arial size=1><B>CODIGO:</B><BR>FRFAR-34</font></td>
			<td align=center rowspan=1 width=20%><font FACE=Arial size=1><B>FECHA DE ELABORACION</B></font></td>
			</tr>
			<tr>
			<td align=center rowspan=1><font FACE=Arial size=1>1 de Febrero de 2005</font></td>
			</tr>
			<tr>
			<td align=center rowspan=3><font FACE=Arial size=1><B>VERSION:</B><BR>07</font></td>
			<td align=center rowspan=1><font FACE=Arial size=1><B>FECHA DE ACTUALIZACION</B></font></td>
			</tr>
			<tr>
			<td align=center rowspan=1><font FACE=Arial size=1>26 de Julio de 2013</font></td>
			</tr>
			<tr>
			<td align=center rowspan=1><font FACE=Arial size=1><B>HOJA</B> 1 <B>DE</B> 1</font></td>
			</tr>
		</table>
		<br>
		
<td width=100%>		
		
	<table class='table1'>
		<tr>
		<th colspan=4><b>Información de la solicitud</td> <td rowspan=4><b>Favor leer cada uno de los encabezados y diligenciar<br>puntualmente en cada campo la información solicitada.</b><br>* CUPS: Clasificación única de procedimientos en salud<br>CUM: Clasificación única de medicamentos</td>
		</tr>
		<tr>
		<td colspan=3>Fecha de diligenciamiento</td><td>Número de Autorización</td>
		</tr>
		<tr>
		<td>$diasol</td><td>$messol</td><td>$anosol</td><td rowspan=2>$idennop</td>
		</tr>
		<tr>
		<td>DD</td><td>MM</td><td>AAAA</td>
		</tr>
	</table>
	<table class='table1'>
		<tr>
		<th colspan=9><b>Información del usuario</b></td>
		</tr>
		<tr>
		<td rowspan=2>$ape1usu $ape2usu </td> 
		<td rowspan=2 colspan=2>$nom1usu  $nom2usu</td>
		<td colspan=3>Documento de identidad</td><td>Edad</td><td colspan=2>Sexo</td>
		</tr>
		<tr>
		<td>$tdocusu</td><td colspan=2>$cedula</td><td>$anos</td><td>$sexo1</td><td>$sexo2</td>
		<tr>
		<tr>
		<td>Apellidos</td><td colspan=2>Nombre(s)</td><td>Tipo</td><td colspan=2>Número</td><td>Años</td><td>F</td><td>M</td>
		<tr>		
		<tr>
		<td colspan=2>Dirección</td><td>No. telefónico</td><td colspan=2>Ciudad</td><td colspan=4>Número de afiliación</td>
		<tr>
		<tr>
		<td colspan=2>$direusu</td><td>$teleusu</td><td colspan=2>$ciudusu</td><td colspan=4>$cedula</td>
		</tr>
	</table>
		
	<table class='table1'>
		<tr>
		<th colspan=4>Medicamento, Procedimiento ó Insumo NO POS solicitado</td>
		</tr>
		<tr>
		<td colspan=3>Principio activo del medicamento nombre genérico del procedimiento o insumo</td>
		
		<td>Concentración del medicamento</td>
		</tr>
		<tr>	
		<td>CUM o CUPS*</td><td>Forma farmacéutica o Descripción</td><td>Días del tratamiento</td><td>Dosis por día</td>
		</tr>
		<tr>	
		<td>AQUI</td><td></td><td></td><td></td>
		</tr>
	</table>
	
	<table class='table1'>
		<tr>
		<th colspan=4>Campos de diligenciamiento exclusivo del medico tratante</th>
		</tr>
		<tr>
		<th  colspan=4>En su calidad de médico tratante del usuario anteriormente identificado, es necesario que diligencie completamente los siguientes campos de información del
		formato con el propósito de brindar la mayor cantidad de información posible al Comité Técnico Científico.</th>
		</tr>
		<tr>
		<th colspan=4>Información del médico tratante</th>
		</tr>
		<tr>
		<td rowspan=2></td>		
		<td colspan=2>Documento de identidad</td>
		<td>Registro Médico</td>
		</tr>
		<td>.</td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td>Nombre</td>
		<td>Tipo</td>
		<td>Número</td>
		<td>Número</td>		
		</tr>
		
		<tr>
		<td>Especialidad</td>
		<td>Dirección</td>
		<td>Número telefónico</td>
		<td>Ciudad</td>		
		</tr>
		</tr>
		<td>.</td>
		<td></td>
		<td></td>
		<td></td>
		</tr>		
	</table>
	<table class='table1'>
		<tr>
		<th colspan=5>Medicamento o Procedimiento – Insumo equivalente en el POS (para efecto de recobro ante el FOSYGA)</th>
		</tr>	
		</tr>
		<td>Principio activo del medicamento nombre genérico del procedimiento o insumo</td>
		<td>Concentración del medicamento</td>
		<td>Forma farmacéutica o Descripción</td>
		<td>Días del tratamiento</td>
		<td>Dosis por día</td>
		
		</tr>		
		</tr>
		<td>.</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>		
		</tr>
		<td>.</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>		
	</table>
	
	<table class='table1'>
	<tr>
	<th rowspan=4>Diagnóstico, evolución, clasificación y estado de la patología (Realice<br> una descripción del estado actual y / o evolución de la enfermedad)</th>
	<th colspan=7>Duración del tratamiento</th>
	<tr>	
	<th colspan=3>Desde</th><th colspan=3>Hasta</th><th colspan=3>Tiempo estimado</th>	
	</tr>
	<tr>
	<td>.</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>		
	</tr>	
	<tr>
	<td>DD</td>
	<td>MM</td>
	<td>AAAA</td>
	<td>DD</td>
	<td>MM</td>
	<td>AAAA</td>
	<td>Meses</td>		
	</tr>
</table>	
		
	<table class='table1'>
	<tr>
	<th>Diagnóstico:</th>	
	<td>.</td>
	</tr>	
	<tr>
	<th colspan=2>Resumen de la historia clínica:</td>
	</tr>
	<tr>
	<td colspan=2>.</td>
	</tr>
	<tr>
	<th>Justificación del Medicamento, Procedimiento ó Insumo NO POS solicitado</th>
	<td>¿La NO utilización pone en riesgo inmininete la vida y salud del paciente? SI [$ries] NO [ $ries]</td>
	</tr>
	<tr>
	<td  colspan=2>Descripción:</td>
	</tr>
	
	<tr>
	<td  colspan=2>Soporte Bibliográfico:</td>
	</tr>
	
	<tr>
	<th  colspan=2>
	Apreciado usuario, esta solicitud debe ser radicada en su EPS o el servicio farmaceutico si está afiliado a Magisterio junto con los
siguientes documentos soporte:<br>

1. Formula médica original completamente diligenciada, con firma y sello del médico tratante, legible.<br>
2. Fotocopia de la Epicrisis completa y actualizada.<br>
3. Fotocopia de cedula de ciudadania.<br>
EL COMITÉ TÉCNICO CIENTÍFICO NO PODRÁ ADELANTAR EL ESTUDIO DEL CASO SIN EL SUMINISTRO COMPLETO DE LA
INFORMACIÓN Y DOCUMENTACIÓN ANTERIORMENTE INDICADA.<br>	
	</th>
	</tr>
	</table>
	
	
	
	";
	
	
	function verifica($fecjus)
{
      
	 //defino fecha 1 
	 
	$ano1 = substr($fecjus,0,4); 
	$mes1 = substr($fecjus,5,2); 
	$dia1 = substr($fecjus,8,2); 

	//defino fecha 2 
	
	$dia2=date("j");
    $mes2=date("n");
    $ano2=date("Y");
	

	//calculo timestam de las dos fechas 
	$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
	$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2); 

	//resto a una fecha la otra 
	$segundos_diferencia = $timestamp1 - $timestamp2; 
	//echo $segundos_diferencia; 

	//convierto segundos en días 
	$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 

	//obtengo el valor absoulto de los días (quito el posible signo negativo) 
	$dias_diferencia = abs($dias_diferencia); 

	//quito los decimales a los días de diferencia 
	$dias_diferencia = floor($dias_diferencia); 

	


	return $dias_diferencia;         //1=justificado; 2=No justificado
}

	function edad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en números enteros

        $dia=date("j");
        $mes=date("n");
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

</BODY>
</HTML>
