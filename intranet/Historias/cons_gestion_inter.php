<!-- Captura la identificaci?n del usuario a buscar -->
<html>
<head><title>Buscar Usuario</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language="Javascript">
function validar(){    
    if(document.form1.nrod_usu.value == ''){ 
        alert("Por favor ingrese la identificación"); 
        return; 
    }
    document.form1.submit();
}
function recargar(ingre_){    
    document.form1.id_ing.value=ingre_;
    document.form1.submit();
}
</script>

</head>
<body bgcolor="#E6E8FA">
<?php
include("php/conexion.php");
base_proinsalud();
?>
<!--<link rel="stylesheet" href="css/style.css" type="text/css">-->
<form name="form1" method="POST" action="cons_gestion_inter.php">

<table class='Tbl0' border='0'>
    <tr><td class='Td1' align='center'><STRONG>GESTION DE INTERCONSULTAS</strong></td></tr>
</table>

<br>
<table border='0' width="50%" align='center'>
 <tr> 
    <td align="right"><b>Identificación:</font></td>
    <td ><input type=text name="nrod_usu" size=20 maxlength=20 value="<?php echo $nrod_usu;?>">*</td>
    <td align="left"><input type="button" name="btn1" value="Buscar" onclick="validar()"></td>
</tr>
</table>
<?php
if($nrod_usu<>""){    
    muestrages($nrod_usu,$id_ing);
}
?>
</form>
</body>
</html>

<?php
function muestrages($nrod_,$id_ing){
    $sql="SELECT ih.id_ing,CONCAT(usu.pnom_usu,' ',usu.snom_usu,' ',usu.pape_usu,' ',usu.sape_usu) AS nombre,ih.fecin_ing,ih.hora_ing 
    FROM ingreso_hospitalario AS ih
    INNER JOIN usuario AS usu ON usu.codi_usu=ih.codius_ing
    WHERE usu.nrod_usu='$nrod_'";    
    //echo $sql;
    $sql=mysql_query($sql);
    if(mysql_num_rows($sql)<>0){}
    echo"<table class='Tbl0' border='0'>";
    echo "<th class='Th0'>SEL</th>";
    echo "<th class='Th0'>FECHA INGRESO</th>";
    echo "<th class='Th0'>IDENTIFICACION</th>";
    echo "<th class='Th0' colspan='4'>NOMBRE</th>";
    
    while($row=mysql_fetch_array($sql)){
        echo "<tr>";
        echo "<td class='Td0' align='center'><input type='checkbox' onclick=recargar($row[id_ing])></td>";
        echo "<td class='Td0' align='left'>".substr($row[fecin_ing],0,10)."</td>";
        echo "<td class='Td0' align='left'>".$nrod_."</td>";        
        echo "<td class='Td0' align='left'>$row[nombre]</td>";
        echo "</tr>";
        if($id_ing==$row[id_ing]){
            $sql="SELECT ges.iden_var,ges.fecha_ges,ges.descrip_ges,ges.opera_ges,nov.nomb_des AS novedad,ser.nomb_des AS servicio
            FROM gestion_ord AS ges
            INNER JOIN hist_var AS var ON var.iden_var=ges.iden_var
            INNER JOIN destipos AS ser ON ser.codi_des=var.iden_ser
            INNER JOIN hist_evo AS evo ON evo.iden_evo=var.iden_evo
            INNER JOIN destipos AS nov ON nov.codi_des=ges.novedad_ges        
            INNER JOIN ingreso_hospitalario AS ih ON ih.id_ing=evo.id_ing
            WHERE ih.id_ing='$id_ing' ORDER BY servicio,ges.iden_var,ges.fecha_ges";
            //echo $sql;

            $sql=mysql_query($sql);
            echo "<tr>";
            echo "<td class='Td0' align='center'></td>";
            echo "<td class='Td1' align='center'>Orden</td>";
            echo "<td class='Td1' align='center'>Servicio</td>";
            echo "<td class='Td1' align='center'>Fecha</td>";
            echo "<td class='Td1' align='center'>Novedad</td>";
            echo "<td class='Td1' align='center'>Descripción</td>";
            echo "<td class='Td1' align='center'>Operador</td>";
            $operador=traeoperador($row[opera_ges]);
            echo "<td class='Td0' align='left'>$operador</td>";
            echo "</tr>";
            $iden_="";
            $color='';
            while($row=mysql_fetch_array($sql)){
                if($iden_!=$row[iden_var]){
                    $iden_=$row[iden_var];
                    $color=dechex(rand(100000,1000000));
                    //echo "<br>".$color;
                }
                echo "<tr>";
                echo "<td class='Td0' align='left'></td>";
                echo "<td class='Td0' align='left'><font color='$color'>$row[iden_var]</td>";
                echo "<td class='Td0' align='left'><font color='$color'>$row[servicio]</td>";
                echo "<td class='Td0' align='left'><font color='$color'>$row[fecha_ges]</td>";
                echo "<td class='Td0' align='left'><font color='$color'>$row[novedad]</td>";
                echo "<td class='Td0' align='left'><font color='$color'>$row[descrip_ges]</td>";
                $operador=traeoperador($row[opera_ges]);
                echo "<td class='Td0' align='left'><font color='$color'>$operador</td>";
                echo "</tr>";
            }        
        }
    }            
    echo "</table>";
    echo "<input type='hidden' name='id_ing'>";
}

function traeoperador($opera_){
    $operador_="";
    $sql_="SELECT nom_medi FROM medicos WHERE cod_medi='$opera_'";
    $sql_=mysql_query($sql_);    
    if(mysql_num_rows($sql_)){
        $row_=mysql_fetch_array($sql_);
        $operador_=$row_[nom_medi];
    }
    return($operador_);
}
?>