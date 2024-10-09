<html> 
<head> 
<?	//Aqui cargo las funciones para php
	include("php/funciones.php");
?>
<title>LABORATORIO CLINICO *PROINSALUD* </title> 
 <script language='Javascript'>
function confirma(it,mt)
{
	//alert("envio");
		form1.it.value=it;
		form1.mcu.value=mt;
		//alert(form1.it.value);
		//alert(form1.mcu.value);
		form1.action='edi_orden.php';
		form1.submit();

}


</script>
</head> 
<body >
<form name="form1" method="POST" action="adi_espe.php" target="fr2">  
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php

	mysql_connect("localhost","root",""); 
	mysql_select_db("PROINSALUD");
	
	$fecha_actual=date('Y-m-d');
	$nuevafecha = strtotime ('-90 day' , strtotime($fecha_actual)); 
	$fecha_nueva_inicial = date ('Y-m-d',$nuevafecha);	
	
	$condicion="ucontrato.ESTA_UCO='AC' AND detalle_labs.estd_dlab<>'EL' AND detalle_labs.estd_dlab='P' AND encabezado_labs.fchr_labs>='$fecha_nueva_inicial'";
	if(!empty($usu))
	{
		$condicion=$condicion." AND usuario.NROD_USU='".$usu."'";
		//$condicion=$condicion.' AND usuario.NROD_USU='.$usu;
	}
	if(!empty($n_ord))
	{
//			$condicion2=$condicion2.'AND detalle_labs.nord_dlab='.$n_ord;
			$condicion2=$condicion2."AND detalle_labs.nord_dlab='".$n_ord."'";
	}
	$resultusu=mysql_query("SELECT usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, contrato.NEPS_CON, ucontrato.ESTA_UCO
	FROM contrato INNER JOIN (ucontrato INNER JOIN ((encabezado_labs INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU) INNER JOIN detalle_labs ON encabezado_labs.iden_labs = detalle_labs.iden_labs) ON ucontrato.CUSU_UCO = usuario.CODI_USU) ON contrato.CODI_CON = ucontrato.CONT_UCO
	WHERE ($condicion $condicion2)
	GROUP BY usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, contrato.NEPS_CON, ucontrato.ESTA_UCO");

	
	
	
	
	
	/*$resultusu =mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.DIRE_USU, usuario.TRES_USU ,
	contrato.NEPS_CON,ucontrato.ESTA_UCO
	FROM usuario
	INNER JOIN ucontrato AS ucontrato ON ucontrato.CUSU_UCO=usuario.CODI_USU
	INNER JOIN contrato AS contrato ON contrato.CODI_CON=ucontrato.CONT_UCO
	WHERE $condicion");*/
	
	//echo $resultusu;

	while($rowusu=mysql_fetch_array($resultusu))
	{
		$edad=calcuedad($rowusu['FNAC_USU']);
		//echo $edad;
		$nombre= "$rowusu[PNOM_USU] $rowusu[SNOM_USU]  $rowusu[PAPE_USU]";
		$iden_uco="$rowusu[CODI_USU]";
		//echo $iden_uco;
		$sexo=" $rowusu[SEXO_USU]";
		$mres_usu ="$rowusu[MRES_USU]";
		$contrato="$rowusu[NEPS_CON]"; 
		$direc=$rowusu[DIRE_USU]." - ".$rowusu[TRES_USU];
		echo"<br><br><br><table class='Tbl2' border=0>
		<tr bgcolor=#BED1DB align='center'><td><b>$nombre</span>
		
		<td><b>$edad</td>
		<td><b>$direc</td>
		<td><b>$contrato</td></tr>";
		
		
		$condicion="el.codi_usu='$iden_uco' AND dl.estd_dlab<>'EL' AND dl.estd_dlab='P'";
		
		if(!empty($n_ord))
		{
			//$condicion=$condicion.'AND dl.nord_dlab='.$n_ord;
			$condicion=$condicion."AND dl.nord_dlab='".$n_ord."'";
		}
		
		
		$cons=mysql_query("SELECT el.iden_labs,dl.iden_dlab ,dl.estd_dlab,el.codi_usu,dl.codigo,dl.nord_dlab,
		   el.fchr_labs, el.hrae_labs,el.cod_medi 
		   FROM detalle_labs AS dl
		   INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
		   WHERE $condicion 
		   GROUP BY el.iden_labs order by el.fchr_labs DESC");
		 
		//echo $cons;
		  
		echo"<table class='Tbl0'>
		<tr><td class='Td1' align='center'><STRONG>PROCEDIMIENTOS AUN NO REALIZADOS EN LABORATORIO CLINICO</strong></td></tr>
		</table>";
		
		echo"<table class='Tbl0' border=0>
		  <tr>
		  <td class='Td1' colspan=4 align='center'><b>OPC</td>
		  <td class='Td1' align='left'><b>Nº ORDEN</span></td>
		  <td class='Td1' align='left'><b>FECHA DE REALIZACION</span></td>
		  <td class='Td1' align='left'><b>MEDICO SOLICITANTE</span></td></tr>"; 
		
		 
		$i=0;
		
		while ($rowexa=mysql_fetch_array($cons))
		{
					 
			$iden_dlab=$rowexa['iden_dlab'];
			$codusu=$rowexa['codi_usu'];
			$iden_labs=$rowexa['iden_labs'];
			$cod=$rowexa['codigo'];
			$nord_dlab=$rowexa['nord_dlab'];
					  
					 
			$nomvar='codusu'.$i;
			echo "<input type=hidden name=codusu value=$codusu>";	
					  
			$nomvar='iden_labs'.$i;
			echo "<input type=hidden name=iden_labs value=$iden_labs>";	
								  
			$nomvar='nord_dlab'.$i;
			echo "<input type=hidden name=nord_dlab value='$nord_dlab'>";
					
			
			$cond2="detalle_labs.iden_labs='$iden_labs' and detalle_labs.estd_dlab='P' ";
				
				
			$conex=mysql_query("SELECT detalle_labs.iden_labs,detalle_labs.nord_dlab
							FROM detalle_labs
							INNER JOIN cups ON detalle_labs.codigo = cups.codigo
							 WHERE $cond2 ");
					
					//echo $conex;
					
			$mcu=1;
			while ($rowdet=mysql_fetch_array($conex))
			{
				$desc=$rowdet['descrip'];
				$nord_dlab=$rowdet['nord_dlab'];
				$nord[$mcu]=$nord_dlab;
				//echo $nord_dlab;
													
				$nomvar='cod'.$i.$mcu;
				echo "<input type=hidden name='$nomvar' value='$cod'>";
										
				$nomvar='selec'.$i.$mcu;									
				echo "<input type=hidden name='$nomvar' value=1>";										
				$cql[$mcu]=$desc;						
				$mcu++;
									
			}
		
			$i++;
			
		
		
			echo "</tr> \n";
			
			echo " 
			<tr>
			<td></td>
			<td></td>
			<td></td>
			<td class='Td1' width=2%><a href=../uci/imprimir2_.php?codusu=$iden_uco&iden_labs=$iden_labs&nd_=$nord_dlab&band=1 target='fr01'><img src='icons/feed_magnify.png' border=0 width=17 height=17 alt='Imprimir' ></a>
			<td align='center'>$nord_dlab<input  type=hidden name=fac_num value='$rowx[num_fac]'></td>
			<td align='left'>$rowexa[fchr_labs] - $rowexa[hrae_labs]</td>";;
			$cons_medi=mysql_query("SELECT * FROM medicos WHERE cod_medi='$rowexa[cod_medi]'");
			$rowmedi = mysql_fetch_array($cons_medi);
			$medico=$rowmedi[nom_medi];
			echo"<td align='left'>$medico<input  type=hidden name=nom_medi value='$rowx[nom_med]'></td></tr>";
		
		}
		
		echo "<input type=hidden name=it>";
		echo "<input type=hidden name=mcu>";
		
	}
	
	
			
	
	
	
	function calcuedad($fecha_nac)
    {
        //Esta funcion toma una fecha de nacimiento
        //desde una base de datos mysql
        //en formato aaaa/mm/dd y calcula la edad en nmeros enteros

        $dia=date("j");
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
	
</form>
</body>
</html>