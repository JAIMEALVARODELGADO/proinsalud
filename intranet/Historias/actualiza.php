<html> 
<head> 
<?	//Aqui cargo las funciones para php
	include("php/funciones.php");
?>
<title>INFORMACION USUARIOS *PROINSALUD* </title> 

</head> 
<body >
<form name="form1" method="POST"  action="adi_espe.php" target="fr04">  
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?php

	//echo"iden:'$usu'";
	//echo"iden:'$usu'";
	//selección de la base de datos con la que vamos a trabajar 
	mysql_connect("localhost","root",""); 
	mysql_select_db("PROINSALUD");	
	$resultusu =mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.FNAC_USU, usuario.SEXO_USU,usuario.DIRE_USU, usuario.TRES_USU ,contrato.NEPS_CON
	FROM usuario
	INNER JOIN ucontrato AS ucontrato ON ucontrato.CUSU_UCO=usuario.CODI_USU
	INNER JOIN contrato AS contrato ON contrato.CODI_CON=ucontrato.CONT_UCO
	WHERE usuario.NROD_USU='$usu'");
	while($rowusu=mysql_fetch_array($resultusu))
	{
			echo"3";
			//$edad=calculaedad($rowusu['FNAC_USU']);
			//echo $edad;
			$nombre= "$rowusu[PNOM_USU] $rowusu[SNOM_USU]  $rowusu[PAPE_USU]";
			$iden_uco="$rowusu[CODI_USU]";
			echo "toy". $iden_uco;
			$sexo=" $rowusu[SEXO_USU]";
			$mres_usu ="$rowusu[MRES_USU]";
			$contrato="$rowusu[NEPS_CON]"; 
			$direc=$rowusu[DIRE_USU]." - ".$rowusu[TRES_USU];
			echo"<br><br><br><table border=0 width='100%'>
			<tr bgcolor=#D0D0F0 align='center'><td><font size=2 face='arial'><b>$nombre</font></span>			
			<td><font size=2 face='arial'><b>$edad</font></td>
			<td><font size=2 face='arial'><b>$direc</font></td>
			<td><font size=2 face='arial'><b>$contrato</font></td></tr>";
			$result=Mysql_query("SELECT `iden_labs`, `codi_usu`, `cod_medi`, `fchr_labs`, `fche_labs`,`nord_lab`,ctr_labs ,`hrar_labs`, `hrae_labs`, `ambi_labs`, `prog_labs`, `fina_labs`, `cama_labs`, `resp_labs` 
			FROM `encabezado_labs` WHERE codi_usu='$iden_uco'");			
			echo"<table width='100%'>
			<tr bgcolor=#D0D0F0><td align='center'><font size=2 face='arial'><STRONG>PROCEDIMIENTOS REALIZADOS DE LABORATORIO</strong></td></tr>
			</table>";			
			echo"<table width='100%' border=1>
			  <tr>
			  <td class='Td1' colspan=4 align='center'><font size=2 face='arial'><b>OPC</td>
			  <td class='Td1' align='left'><font size=2 face='arial'><b>Nº ORDEN</span></td>
			  <td class='Td1' align='left'><font size=2 face='arial'><b>FECHA DE REALIZACION</span></td>
			  <td class='Td1' align='left'><font size=2 face='arial'><b>MEDICO SOLICITANTE</span></td></tr>"; 			
			echo "<br>";
			while ($rowx = mysql_fetch_array($result))
			{		
				$nom_medi=$rowx[cod_medi];
				$iden_labs=$rowx[iden_labs];
				$nord_lab=$rowx[nord_lab];
				$cont_var=$rowx[ctr_labs];
				echo "</tr> \n";
				/*echo "				
				<td class='Td1' width=2%><a href=edit_examen.php?iden_uco=$iden_uco&iden_labs=$iden_labs><img src='icons/feed_edit.png' border=0 width=17 height=17 alt='Editar Formato' ></a>
				<td class='Td1' width=2%><a href=pag_inter.php?codig_usu=$iden_uco&iden_labs=$iden_labs><img src='icons/feed_add.png' border=0 width=17 height=17 alt='Adicionar' ></a>
				<td class='Td1' width=2%><a href=exp_fac.php?iden_uco=$iden_uco&iden_labs=$iden_labs><img src='icons/feed_delete.png' border=0 width=17 height=17 alt='Eliminar'></a>";*/
				echo"<tr><td></td><td></td><td></td>
				<td class='Td1' width=2%><a href=imprimir_.php?cod=$iden_uco&nord_lab=$nord_lab&edad=$edad target='fr01'><img src='icons/feed_magnify.png' border=0 width=17 height=17 alt='Imprimir' ></a>
				<td align='left'><font size=2 face='arial'>$rowx[nord_lab]<input  type=hidden name=fac_num value='$rowx[num_fac]'></td>
				<td align='left'><font size=2 face='arial'>$rowx[fchr_labs] - $rowx[hrae_labs]</td>";;
				$cons_medi=mysql_query("SELECT * FROM medicos WHERE cod_medi=$nom_medi");
				$rowmedi = mysql_fetch_array($cons_medi);
				$medico=$rowmedi[nom_medi];
				echo"<td align='left'>$medico<input  type=hidden name=nom_medi value='$rowx[nom_med]'></td></tr>";				
			}
	}
	/*function calculaedad($fecha_nac)
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
    }*/
			
			
?>
	
</form>
</body>
</html>