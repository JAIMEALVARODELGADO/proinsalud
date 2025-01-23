<html>
<head>
    <title>TERAPIA</title>
    <link rel="stylesheet" href="css/estilo_2.css" type="text/css" />
    <meta charset="UTF-8">
    <script>
        function imprimir() {            
            window.print();
        }
    </script>
</head>
<body lang=ES>
<!--<form name="form1" method="POST">-->

<table class="table2" width="100%"><tr><th>INFORME DE PACIENTES ATENDIDOS</th></tr></table><br>

<?php
include('php/conexion.php');
include('php/funciones.php');
		$condicion="";
        $condicion2="";
        $condicion3="";        		
        if(!empty($fechaini)){
            $condicion=$condicion."th.fecha_this BETWEEN '".cambiafecha($fechaini)." 00:00:00' and '".cambiafecha($fechafin)." 23:59:00' AND ";
            $condicion2=$condicion2."tc.fecha_tcon BETWEEN '".cambiafecha($fechaini)." 00:00:00' and '".cambiafecha($fechafin)." 23:59:00' AND ";
            $condicion3=$condicion3."fecha BETWEEN '".cambiafecha($fechaini)." 00:00:00' and '".cambiafecha($fechafin)." 23:59:00' AND ";
        }
        if(!empty($contra)){$condicion3=$condicion3."cont_this='".$contra."' AND ";}
        if(!empty($identif)){$condicion3=$condicion3."nrod_usu='".$identif."' AND ";}
		
        $condicion=substr($condicion,0,strlen($condicion)-5);
        $condicion2=substr($condicion2,0,strlen($condicion2)-5);
        $condicion3=substr($condicion3,0,strlen($condicion3)-5);
		//echo "<br>".$condicion;
        //Aqui se crea una vista uniendo las consultas de primera vez y las consultas de control
        $sql_vista="CREATE OR REPLACE VIEW vista_terapia_fisica_informe AS
        SELECT '' AS iden_tcon,th.iden_this ,DATE(th.fecha_this) AS fecha,th.numero_orden_this, 
            u.NROD_USU ,CONCAT(u.PNOM_USU,' ',u.SNOM_USU ,' ',u.PAPE_USU,' ' ,u.SAPE_USU) AS nombre,
            th.cont_this,c.NEPS_CON,
            d.nomb_des AS servicio_remitente,
            c2.nom_cie10,
            m.nom_medi,'PRIMERA VEZ' AS tipo_atencion 
            FROM ter_historia th 
            INNER JOIN contrato c ON c.CODI_CON=th.cont_this
            INNER JOIN usuario u ON u.CODI_USU = th.codi_usu 
            INNER JOIN destipos d ON d.codi_des = th.servrem_this 
            INNER JOIN medicos m ON m.cod_medi = th.codmedi_this
            INNER JOIN cie_10 c2 ON c2.cod_cie10 = th.dxprinc_this 
            WHERE ".$condicion."
            UNION
            SELECT tc.iden_tcon,tc.iden_this ,DATE(tc.fecha_tcon) AS fecha,th.numero_orden_this,
            u.NROD_USU ,CONCAT(u.PNOM_USU,' ',u.SNOM_USU ,' ',u.PAPE_USU,' ' ,u.SAPE_USU) AS nombre,
            th.cont_this,c.NEPS_CON,
            d.nomb_des AS servicio_remitente,
            c2.nom_cie10,
            m.nom_medi,'CONTROL' AS tipo_atencion 
            FROM ter_control tc 
            INNER JOIN ter_historia th ON th.iden_this = tc.iden_this 
            INNER JOIN contrato c ON c.CODI_CON=th.cont_this
            INNER JOIN usuario u ON u.CODI_USU = th.codi_usu 
            INNER JOIN destipos d ON d.codi_des = th.servrem_this 
            INNER JOIN medicos m ON m.cod_medi = tc.codmedi_tcon
            INNER JOIN cie_10 c2 ON c2.cod_cie10 = th.dxprinc_this 
            WHERE ".$condicion2;
        //echo "<br>".$sql_vista;
        $sql_vista=mysql_query($sql_vista);
        mysql_query($sql_vista);


		$consulta="SELECT fecha,numero_orden_this,NROD_USU,nombre,NEPS_CON,servicio_remitente,nom_cie10,nom_medi,tipo_atencion
                FROM vista_terapia_fisica_informe 
                WHERE $condicion3
                ORDER BY fecha";

		//echo "<br>".$consulta;

        $consulta=mysql_query($consulta);

        if(mysql_num_rows($consulta)!=0) 
		{
			echo "<table class='table2'>";
			echo "<th>Fecha</th>
		    <th>Nro Orden</th>
			<th>Identificación</th>
			<th>Nombre</th>
            <th>EPS</th>
            <th>Servicio Remitente</th>
            <th>Profesional</th>
            <th>Tipo de Atención</th>";
			while($row = mysql_fetch_array($consulta))
			{                
				echo "<tr>";				
				echo "<td>".$row['fecha']."</td>";
				echo "<td>".$row['numero_orden_this']."</td>";
                echo "<td>".$row['NROD_USU']."</td>";
                echo "<td>".$row['nombre']."</td>";
                echo "<td>".$row['NEPS_CON']."</td>";
                echo "<td>".$row['servicio_remitente']."</td>";
                echo "<td>".$row['nom_medi']."</td>";
                echo "<td>".$row['tipo_atencion']."</td>";
				echo "</tr>";
			}
			echo"</table>";
            ?>
                <button onclick="imprimir()" class="btn">Imprimir</button>
            <?php
        }
        else{
            echo "
            <center>
            <h1>No hay registros con las condiciones buscadas</h1>
            </center>
            ";
        }
	  ?>
	</tr>
<!--</form>-->
</body>
</html>