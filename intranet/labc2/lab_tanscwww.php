<html>
<head><title></title>
</head>
<body >
<style type="text/css">
<!--
.Estilo6 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo7 {font-family: Arial, Helvetica, sans-serif; font-size: 11px;  }
.tm {font-family: Arial, Helvetica, sans-serif; font-size: 10px;  color:#E30909;}
-->
</style>
<?
echo $cod_usu;
echo $gfec_;
echo $ser;

 $con = mysql_connect("localhost","root","") or die (mysql_error()); 
 mysql_select_db("proinsalud",$con) or die (mysql_error());
 
 $result = mysql_query("SELECT NROD_USU,CODI_CON,CODI_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU,TPAF_USU,MATE_USU,CONT_UCO,NEPS_CON,IDEN_UCO,MRES_USU FROM usuario, ucontrato,contrato WHERE CODI_USU=CUSU_UCO AND CONT_UCO=CODI_CON  AND NROD_USU = '$cod_usu' "); 
 $row=mysql_fetch_array($result);
 echo "<tr><td width=130 bordercolor=#FFFFFF><span class=Estilo10><div align=left>Identificación:<span class=Estilo1> $row[NROD_USU]</div></span></span>
        <td width=250 bordercolor=#FFFFFF><span class=Estilo10><div align=left>Nombre:<span class=Estilo1>$rowx[PNOM_USU] $rowx[SNOM_USU] $rowx[PAPE_USU] $rowx[SAPE_USU] </span>
        <td width=170 bordercolor=#FFFFFF><span class=Estilo10><div align=left>Municipio:<span class=Estilo1 >$cod_muni</div></span><span class=Estilo11>
        <td width=150  bordercolor=#FFFFFF><span class=Estilo10>M&eacute;dico:<span class=Estilo1> $nom_medi </div></span>
        <td width=90 bordercolor=#FFFFFF><span class=Estilo10>Contrato:<span class=Estilo1>$cod_empr </div></span>
         </span></td>
        </tr>";
 
 
 
	$consdes=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, Max(usuario.CODI_USU) AS MáxDeCODI_USU, hist_var.fech_var,cups.descrip
							FROM ((hist_evo INNER JOIN (((ingreso_hospitalario INNER JOIN usuario ON ingreso_hospitalario.codius_ing = usuario.CODI_USU) INNER JOIN (ucontrato INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON) ON usuario.CODI_USU = ucontrato.CUSU_UCO) INNER JOIN hist_traza ON ingreso_hospitalario.id_ing = hist_traza.id_ing) ON hist_evo.codi_usu = usuario.CODI_USU) INNER JOIN hist_var ON hist_evo.iden_evo = hist_var.iden_evo) INNER JOIN cups ON hist_var.iden_ser = cups.codigo
							WHERE (((hist_traza.ubica_tra)=$ser) AND ((ucontrato.ESTA_UCO)='AC') AND ((hist_traza.id_ing) Is Not Null) AND ((hist_traza.horas_tra)=-1) AND ((hist_var.esta_var)='SO') AND ((cups.tipo)='1803') AND ((usuario.NROD_USU)='$cod_usu') AND ((hist_var.fech_var)='$gfec_'))
							GROUP BY usuario.NROD_USU, usuario.CODI_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.FNAC_USU, contrato.NEPS_CON, ingreso_hospitalario.fecin_ing, hist_var.fech_var
							ORDER BY hist_var.fech_var desc");



?>
</tr>
</table>
</form>
</body>
</html>
















