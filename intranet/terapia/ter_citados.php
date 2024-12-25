<?php
session_start();       
?>
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
    <meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <meta charset="UTF-8">
    <!--meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />-->
    <title>Citados de Terapia Fisica</title>
<script languaje="javascript">
function inasistencia(idcita){
    if(confirm("Desea Marcar Inasistencia?")){
        window.location.href="ter_inasistencia.php?iden_cita="+idcita;
    }
    retrun(false);
}

</script>

</head>
<body>
<?php
include('php/conexion.php');
include('php/funciones.php');
?>
<form name="form1" method="post" action="ter_control.php">
    <center><h3><font color='#A60C63'>PACIENTES CITADOS</font></h3></center>
    <table border="1">
        <th colspan="2">Opciones</th>
        <th>Identificación</th>
        <th>Nombre</th>
        <th>Contrato</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado</th>
        <?php
        $hoy=cambiafecha(hoy());
        $hoy='2024-10-11';
        $consulta="SELECT cit.id_cita,hor.fecha_horario,hor.hora_horario,
            usu.codi_usu,usu.nrod_usu,CONCAT(pnom_usu,' ',snom_usu,' ',pape_usu,' ',sape_usu) as nombre,
            con.neps_con,descrip_estaci
            FROM horarios AS hor
            INNER JOIN (citas AS cit INNER JOIN esta_cita ON cod_estaci=cit.esta_cita)            
            ON cit.id_horario=hor.id_horario
            INNER JOIN usuario AS usu ON usu.codi_usu=cit.idusu_citas
            INNER JOIN contrato AS con ON con.codi_con=cit.cotra_citas
            WHERE cit.esta_cita='1' and hor.fecha_horario='$hoy' and cmed_horario='$_SESSION[ter_codmedi_cit]' and cserv_horario='$_SESSION[ter_area]'";
        
        //echo $consulta;
        $consulta=mysql_query($consulta);
        if(mysql_num_rows($consulta)<>0){
            while($row=mysql_fetch_array($consulta)){
                echo "<tr>";
                echo "<td align='center'><a href='ter_frmterfisica.php?idcita=$row[id_cita]&codiusu=$row[codi_usu]' title='Consultar'><img src='img/ir.jpg' width='20' height='20' alt='Consultar'></a></td>";
                echo "<td align='center'><a href='#' onclick='inasistencia($row[id_cita])'><img src='img/stop.jpg' width='20' height='20' alt='Inasistencia'></a></td>";
                echo "<td>$row[nrod_usu]</td>";
                echo "<td>$row[nombre]</td>";
                echo "<td>$row[neps_con]</td>";
                echo "<td>$row[fecha_horario]</td>";
                echo "<td>".SUBSTR($row[hora_horario],11,5)."</td>";
                echo "<td>$row[descrip_estaci]</td>";
                echo "</tr>";
            }
        }
        if($_SESSION[ter_area]=='50'){            
            $consulta="SELECT usuario.codi_usu,usuario.TDOC_USU, usuario.NROD_USU, CONCAT(usuario.PNOM_USU,' ',usuario.SNOM_USU,' ',usuario.PAPE_USU,' ', usuario.SAPE_USU) AS nombre, contrato.NEPS_CON, referencia.fech_ref, referencia.asol_ref, detareferencia.iden_dre, detareferencia.tipo_dre, detareferencia.codi_dre, detareferencia.desc_dre, detareferencia.marc_dre
            FROM ((usuario 
            INNER JOIN ucontrato ON usuario.CODI_USU = ucontrato.CUSU_UCO) 
            INNER JOIN (referencia 
            INNER JOIN detareferencia ON referencia.idre_ref = detareferencia.idre_dre) ON ucontrato.IDEN_UCO = referencia.cuco_ref) 
            INNER JOIN contrato ON ucontrato.CONT_UCO = contrato.CODI_CON
            WHERE (((referencia.fech_ref)='$hoy') AND ((referencia.asol_ref)='04') AND ((detareferencia.tipo_dre)='0615') AND ((detareferencia.marc_dre)='1402'))";
            //echo $consulta;
            $consulta=mysql_query($consulta);
            if(mysql_num_rows($consulta)<>0){
                while($row=mysql_fetch_array($consulta)){                    
                    echo "<tr>";
                    echo "<td align='center'><a href='ter_frmterfisica.php?idcita=$row[iden_dre]&codiusu=$row[codi_usu]&asolref=$row[asol_ref]' title='Consultar'><img src='img/ir.jpg' width='20' height='20' alt='Consultar'></a></td>";
                    echo "<td align='center'><a href='#'><img src='img/stop.jpg' width='20' height='20' alt='Inasistencia'></a></td>";
                    echo "<td>$row[NROD_USU]</td>";
                    echo "<td>$row[nombre]</td>";
                    echo "<td>$row[NEPS_CON]</td>";
                    echo "<td>$row[fech_ref]</td>";
                    echo "<td>Urgencias</td>";
                    echo "<td></td>";
                    echo "</tr>";
                }
            }
        }
        ?>
    </table>
</form>
</body>
</html>