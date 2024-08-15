<?php
include("../hcmpv2/php/funciones.php");
include('../hcmpv2/php/conexion.php');

$consultamat="SELECT mat.iden_mat
FROM materna AS mat
INNER JOIN usuario AS usu ON usu.codi_usu=mat.codi_usu
WHERE usu.nrod_usu='$cedula'";
$consultamat=mysql_query($consultamat);
if(mysql_num_rows($consultamat)<>0){
    $rowmat=mysql_fetch_array($consultamat);
    //$iden_mat=$rowmat[iden_mat];
    //$url_="../hcmpv2/consultas_mat.php?iden_mat=$rowmat[iden_mat]";
    echo $url_;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    
    <script type="text/javascript" src="../hcmpv2/js/slidemenu.js"></script>
</head>
<?php
if(!empty($url_)){
    //echo "<body onload='document.form1.submit()'>";
}
?>

    <!--<form name="form1" action="<?php echo $url_;?>" target='Frmh2a'>-->
<form>
<body>
<body onload="slideMenu.build('sm',280,5,5,1)">

<div id="header1"> 
	<div id="nav1">
            
	<table width ="100%" align="center" border="0" cellpadding="0" cellpacing="1">
            <th bgcolor="#FF9900" ><font size='4'>Consultas de la Materna</font></th>
	</table>            
           
	<table width =100% align="center" border=1 cellpadding="0" cellpacing="1" align="center">
		<th bgcolor="#FF9900" colspan="5"><font size=2>Operacin</font></th>
		<th bgcolor="#FF9900"><font size=2>Gestacion</font></th>
		<th bgcolor="#FF9900"><font size=2>Fecha</th>
                <th bgcolor="#FF9900"><font size=2>Hora</th>
		<th bgcolor="#FF9900"><font size=2>Profesional</th>
                <th bgcolor="#FF9900"><font size=2>Servicio</th>
		<?
                $consultamat="SELECT ges.iden_ges,con.iden_con,con.fcon_con,con.hora_con,med.nom_medi,serv.nom_areas AS servicio
                FROM consulta_mat AS con                
                INNER JOIN medicos AS med ON med.cod_medi=con.usua_con
                INNER JOIN areas AS serv ON serv.cod_areas=con.arat_con
                INNER JOIN gestacion AS ges ON ges.iden_ges=.con.iden_ges
                INNER JOIN materna AS mat ON mat.iden_mat=ges.iden_mat
                INNER JOIN usuario AS us ON us.codi_usu=mat.codi_usu		
		WHERE us.nrod_usu='$cedula' ORDER BY con.fcon_con";                
                //echo $consultamat;
                $ges_=0;
                $consultamat=mysql_query($consultamat);
		while($rowmat=mysql_fetch_array($consultamat)){
                    if($rowmat[iden_ges]<>$iden_ges){
                        $ges_++;
                        $iden_ges=$rowmat[iden_ges];
                    }
                    echo "<tr>";			
                    echo "<td align='center' colspan=4><a href='../hcmpv2/impre_con.php?iden_con=$rowmat[iden_con]' target='nuevo3' title='Imprimir'><img src='../hcmpv2/img/print.ico' height='25' width='25' alt='Imprimir Evolucion' border=0></a></td>";
                    echo "<td align='center'><a href='../hcmpv2/imprimir_ordenes.php?hist=$rowmat[iden_con]' target='nuevo3' title='Imprimir Ordenes'><img src='../hcmpv2/img/feed_edit.png' height='20' width='20' alt='Imprimir Ordenes' border=0></a></td>";
                    echo "<td><font size=1></font>$ges_</td>";
                    echo "<td><font size=2>".cambiafechadmy($rowmat[fcon_con])."</font></td>";
                    echo "<td><font size=1></font>$rowmat[hora_con]</td>";
                    echo "<td><font size=1></font>$rowmat[nom_medi]</td>";
                    echo "<td><font size=1></font>$rowmat[servicio]</td>";
                    echo "</tr>";                    
		}
		?>
	</table>
	</div>
</div>
<br>
    
</form>
</body>
<html>