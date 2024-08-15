<html>
<head><title>CAMBIO DE ESTADOS DE LAS ORDENES</title>
<script language="Javascript">
function regresa()
{
	uno.esta_ncf.value=1;
	uno.action='camb_exa.php';
	uno.target='';
	uno.submit();
}
</script>

<!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
<form name="uno" method="POST">
<?php
        include('php/conexion.php');
		echo"<input type=hidden name=nord_lab value='$nord_lab'>";
        echo "<input type=hidden name=esta_ncf value='$esta_ncf'>";
        echo "<input type=hidden name=codg_ value='$codg_'>";
        echo "<input type=hidden name=grup_lab value='$grup_lab'>";
        echo "<input type=hidden name=ffin value='$ffin'>";
        echo"<input type=hidden name=iden_uco value='$iden_uco'>";
        echo"<input type=hidden name=iden_labs value='$iden_labs'>";
        echo"<input type=hidden name=opcex value='21'>";
        
        
        
        
        echo "<input type=hidden name='ano_' value='$ano_'>";
        echo "<input type=hidden name='mes_' value='$mes_'>"; 
        echo "<input type=hidden name='dia_' value='$dia_'>"; 
        echo "<input type=hidden name='labo_' value='$labo_'>";
        echo "<input type=hidden name='idel_' value='$idel_'>";
        
        $fecha= '20'.$ano_.'-'.$mes_.'-'.$dia_;
		$hora=date('H:i:s');
        //echo $fecha;
        $sql=mysql_query("UPDATE `proinsalud`.`detalle_labs` SET `fech_dlab`='$fecha', estd_dlab='CU',etdv_dlab='RE',lrem_dlab='$labo_',unid_dlab='$fecha', refe_dlab='Remitido',hora_dlab='$hora' WHERE `detalle_labs`.`iden_dlab` ='$idel_'");
        //echo $sql;

?>
<body onload="regresa()">