
<html> 
<head> 
<?	//Aqui cargo las funciones para php
	include("php/funciones.php");
?>
<title>INFORMACION USUARIOS *PROINSALUD* </title> 
</head> 
<body >
<form name="form1" method="POST"  action="adi_espe.php" target="fr2">  
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php

	mysql_connect("localhost","root",""); 
	mysql_select_db("proinsalud");
	
	$condicion="ucontrato.ESTA_UCO='AC' AND detalle_labs.estd_dlab<>'EL' AND detalle_labs.estd_dlab='P' AND detalle_labs.estd_dlab<>'CU'AND detalle_labs.estd_dlab<>'PR'";
	if(!empty($usu))
	{
		$condicion=$condicion." AND usuario.NROD_USU='".$usu."'";
		//$condicion=$condicion.' AND usuario.NROD_USU='.$usu;
	}
	if(!empty($n_ord))
	{
			$condicion2=$condicion2.'AND detalle_labs.nord_dlab='.$n_ord;
	}
	/*$resultusu=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, contrato.NEPS_CON, ucontrato.ESTA_UCO
	FROM contrato INNER JOIN (ucontrato INNER JOIN ((encabezado_labs INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU) INNER JOIN detalle_labs ON encabezado_labs.iden_labs = detalle_labs.iden_labs) ON ucontrato.CUSU_UCO = usuario.CODI_USU) ON contrato.CODI_CON = ucontrato.CONT_UCO
	WHERE ($condicion $condicion2)
	GROUP BY usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, contrato.NEPS_CON, ucontrato.ESTA_UCO");*/
	$resultusu=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, contrato.NEPS_CON, ucontrato.ESTA_UCO
	FROM contrato INNER JOIN (ucontrato INNER JOIN ((encabezado_labs INNER JOIN usuario ON encabezado_labs.codi_usu = usuario.CODI_USU) INNER JOIN detalle_labs ON encabezado_labs.iden_labs = detalle_labs.iden_labs) ON ucontrato.CUSU_UCO = usuario.CODI_USU) ON contrato.CODI_CON = encabezado_labs.ctr_labs
	WHERE ($condicion $condicion2)
	GROUP BY usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU, usuario.DIRE_USU, usuario.TRES_USU, contrato.NEPS_CON, ucontrato.ESTA_UCO");
	//echo $resultusu;
	if(mysql_num_rows($resultusu)<>0)	
	{		
		//echo $resultusu;

		while($rowusu=mysql_fetch_array($resultusu))
		{
			$edad=calculaedad($rowusu['FNAC_USU']);
			//echo $edad;
			$nombre= "$rowusu[PNOM_USU] $rowusu[SNOM_USU]  $rowusu[PAPE_USU]";
			$iden_uco="$rowusu[CODI_USU]";
			$nrced=$rowusu[NROD_USU];
			//echo $iden_uco;
			$sexo=" $rowusu[SEXO_USU]";
			$mres_usu ="$rowusu[MRES_USU]";
			$contrato="$rowusu[NEPS_CON]"; 
			$direc=$rowusu[DIRE_USU]." - ".$rowusu[TRES_USU];
			echo"<br><table class='Tbl2' border=0>
			<tr bgcolor=#BED1DB align='center'>
			<td><b>$nrced</td>
			<td><b>$nombre</td>
			<td><b>$edad</td>
			<td><b>$direc</td>
			<td><b>$contrato</td></tr>
			<tr><td colspan=5><font size=1 face=arial color=red><b>NOTA: En las Ordenes Validadas no se  Adicionan ni Eliminan Examenes - solo imprimir</td></tr>";
			
			
			$condicion="el.codi_usu='$iden_uco' AND dl.estd_dlab<>'EL' AND dl.estd_dlab='P'";
			
			if(!empty($n_ord))
			{
				$condicion=$condicion.'AND dl.nord_dlab='.$n_ord;
			}
			
			
			$cons=mysql_query("SELECT el.iden_labs,dl.iden_dlab ,dl.estd_dlab,el.codi_usu,dl.codigo,dl.nord_dlab,
			   el.fchr_labs, el.hrae_labs,el.cod_medi 
			   FROM detalle_labs AS dl
			   INNER JOIN encabezado_labs AS el ON el.iden_labs = dl.iden_labs
			   WHERE $condicion 
			   GROUP BY el.iden_labs order by el.fchr_labs DESC");
			 
			//echo $cons;
			  
			echo"<table class='Tbl0'>
			<tr><td class='Td1' align='center'><STRONG>PROCEDIMIENTOS REALIZADOS DE LABORATORIO</strong></td></tr>
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
						
				
				$cond2="detalle_labs.iden_labs='$iden_labs' ";
					
					
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
				<td class='Td1' width=2%><a href=edi_orden.php?codusu=$iden_uco&nord_dlab=$nord_dlab&iden_labs=$iden_labs><img src='icons/feed_add.png' border=0 width=17 height=17 alt='Adicionar' ></a>
				<td class='Td1' width=2%><a href=eord_aux.php?iden_uco=$iden_uco&iden_labs=$iden_labs><img src='icons/feed_delete.png' border=0 width=17 height=17 alt='Eliminar'></a>
				<td class='Td1' width=2%><a href=imprimir2_.php?codusu=$iden_uco&iden_labs=$iden_labs&nd_=$nord_dlab&band=1 target='fr01'><img src='icons/feed_magnify.png' border=0 width=17 height=17 alt='Imprimir' ></a>
				<td width=2%><a href='imp_sticker.php?cod=$iden_uco&nord_lab=$nord_dlab' target='fr2'><img src='icons/barcode.png' border=0 width=17 height=17 alt='Sticker' ></a>
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
	
	
			
	}
	else
	{
		echo "<tr><td colpsan=2 align='CENTER'><B>NO EXISTEN EXEMENES PARA LA ORDEN  O LA ORDEN ESTA CUMPLIDA</td></tr>";
		
	
	}
	echo "</table>";
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
</html><html><head></head><body></body></html>