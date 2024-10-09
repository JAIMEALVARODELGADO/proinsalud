<html>
<head>
<meta name="terapias" content="text/html;" http-equiv="content-type" charset="utf-8">

<title>Terapias</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-blue.css" title="win2k-cold-1" /> 
<!-- librer?a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 
<!-- librer?a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 
<!-- librer?a que declara la funci?n Calendar.setup, que ayuda a generar un calendario en unas pocas l?neas de c?digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

</head>

<form name="form1" method="post" action="">
    <table class="Tbl0">
        <tr><td class='Td1' align='center'>HISTORIAL DE TERAPIA RESPIRATORIA</td></tr>
    </table>
    <?php
    include('php/conexion.php');
    include('php/funciones.php');
    base_proinsalud();
    $consultausu="SELECT codi_usu,tdoc_usu,nrod_usu,CONCAT(pnom_usu,' ',snom_usu,' ',pape_usu,' ',sape_usu) AS nombre FROM usuario WHERE nrod_usu='$nrod_usu'";    
    //echo "<br>".$consultausu;
    $consultausu=mysql_query($consultausu);    
    if(mysql_num_rows($consultausu)!=0){
        $rowusu=mysql_fetch_array($consultausu);
        echo "<table class='Tbl0'>";
        echo "<tr>";
        echo "<td class='Td0' align='right'>Tipo de Identificación:</td>";
        echo "<td class='Td0' align='left'>$rowusu[tdoc_usu]</td>";
        echo "<td class='Td0' align='right'>Número:</td>";
        echo "<td class='Td0' align='left'>$rowusu[nrod_usu]</td>";
        echo "<td class='Td0' align='right'>Nombre:</td>";
        //echo "<td class='Td0' align='right>Nombre:</td>";
            echo "<td class='Td0' align='left'>$rowusu[nombre]</td>";

        echo "</tr>"; 
        echo "</table>";

        
        $consulta="SELECT tr.iden_tre,tr.fecha_tre,med.nom_medi
        FROM tres_historia AS tr 
        INNER JOIN medicos AS med ON med.cod_medi=tr.codmedi_tre    
        WHERE tr.tipo_tre='1' AND tr.codi_usu='$rowusu[codi_usu]' ORDER BY tr.iden_tre";
        //echo "<br>".$consulta;
        $consulta=mysql_query($consulta);
            echo "<br><br><table class='Tbl0'>
            <th class='Th0'>Opciones</th>
            <th class='Th0'>Fecha de Inicio</th>
            <th class='Th0'>Profesional</th>";
        while($row=mysql_fetch_array($consulta)){
            echo "<tr>";           
            echo "<td class='Td0' align='center'><a href='../terapia/ter_impretr.php?iden_tre=$row[iden_tre]' target='new' title='Mirar Historia'><img src='../terapia/img/lupa.jpg' width='20' height='20' alt='Mirar'></a></td>";
            echo "<td class='Td0' align='left'>$row[fecha_tre]</td>";
            echo "<td class='Td0' align='left'>$row[nom_medi]</td>";
            echo "</tr>";        
        }
    }
    else{
        //echo "<center><p class=Msg>No existen registros para esta busqueda</p><center>";
        echo "<center><p class=Msg>Usuario NO encontrado</p><center>";
    }
    ?>
    </table>
</form>
</body>
</html>
