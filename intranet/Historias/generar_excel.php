<?php
include("php/conexion2.php");

// Establecer las cabeceras para la descarga de Excel
$ext = "xls";
$nomb = date('Y-m-d'); // Corrige el formato de fecha
header('Content-Type: application/vnd.ms-excel; charset=UTF-8');
header("Content-Disposition: attachment; filename=historia.$nomb.$ext");
header("Pragma: no-cache");
header("Expires: 0");

// Obtener el valor del área desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['area'])) {
    $area = $_POST['area'];
   
    // var_dump($area);

    // Aquí puedes continuar con la lógica de generación del Excel
} else {
    die("Error: No se ha enviado el área.");
}
// var_dump($area);
// Iniciar la tabla de salida
echo "<table border=1>";
echo "<tr>
        <th>Cama</th>
        <th>Identificación</th>
        <th>Nombre</th>
        <th>Servicio</th>
        <th>Ingreso</th>
        <th>Dias Estancia</th>
        <th>Prefacturado</th>
      </tr>";

// Consulta para obtener los datos de los pacientes hospitalizados
$consulta = "SELECT 
                e.caac_ing, Max(e.id_ing) AS DCodHis, u.TDOC_USU, u.NROD_USU, e.caac_ing AS camaan, 
                concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu) AS DNom, u.FNAC_USU, 
                uc.ESTA_UCO AS DEst, e.fecin_ing, c.NEPS_CON AS DEps, 
                IF ( ht.Horas_tra > -1, ht.Horas_tra, 
                ( SUBSTRING( TIMEDIFF( SYSDATE( ) , CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, 
                ( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ) AS DHoras, 
                CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) AS DInicio, e.codius_ing AS DIdeUsu, 
                u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU, ht.ubica_tra AS cod_servicio
             FROM 
                (((Ingreso_hospitalario AS e INNER JOIN Hist_traza AS ht ON e.id_ing = ht.id_ing) 
                INNER JOIN Usuario AS u ON e.codius_ing = u.CODI_USU) 
                INNER JOIN Ucontrato AS uc ON (e.contra_ing = uc.CONT_UCO) AND (e.codius_ing = uc.CUSU_UCO)) 
                INNER JOIN Contrato AS c ON uc.CONT_UCO = c.CODI_CON
             WHERE 
                (((c.CODI_CON)='$area') AND ((ht.horas_tra)=-1) AND ((e.caac_ing)<>'RE'))
             GROUP BY 
                e.caac_ing, u.TDOC_USU, u.NROD_USU, e.caac_ing, 
                concat(u.Pnom_usu,' ',u.Snom_usu,' ',u.Pape_usu,' ',u.Sape_usu), 
                u.FNAC_USU, uc.ESTA_UCO, c.NEPS_CON, IF 
                ( ht.Horas_tra > -1, ht.Horas_tra, ( SUBSTRING( TIMEDIFF( SYSDATE( ) , 
                CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ) ) , 1, 
                ( LENGTH( TIMEDIFF( SYSDATE( ) , ht.Fecin_tra ) ) -6 ) ) +0 ) ), 
                CONCAT( DATE( ht.Fecin_tra ) , ' ', ht.Horin_tra ), e.codius_ing, 
                u.PNOM_USU, u.SNOM_USU, u.PAPE_USU, u.SAPE_USU
             ORDER BY 
                ht.ubica_tra, u.PNOM_USU";

$resultado = mysql_query($consulta) or die(mysql_error());

while ($row = mysql_fetch_array($resultado)) {
    $servicio = '';
    $cod_servicio = $row['cod_servicio'];

    if ($cod_servicio == '04') {
        $servicio = 'URGENCIAS';
    } else {
        $buscar = mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$cod_servicio'") or die(mysql_error());
        while ($fil = mysql_fetch_array($buscar)) {
            $servicio = $fil['nomb_des'];
        }
    }

    $camaactu = $row['camaan'];
    $buscam = mysql_query("SELECT nomb_des FROM destipos WHERE codi_des='$camaactu'") or die(mysql_error());
    while ($fil = mysql_fetch_array($buscam)) {
        $camasi = $fil['nomb_des'];
    }

    $ingreso = $row['DCodHis'];
    $vprefac = 0;
    $prefac = mysql_query("SELECT vtot_fac FROM encabezado_factura WHERE id_ing = '$ingreso'") or die(mysql_error());
    while ($valor = mysql_fetch_array($prefac)) {
        $vprefac = $valor['vtot_fac'];
    }

    $fechaing = $row['fecin_ing'];
    $horaing = isset($row['hora_ing']) ? $row['hora_ing'] : '00:00:00';
    $dia_est = estancia($fechaing, $horaing);

    echo "<tr>";
    echo "<td>" . $camasi . "</td>";
    echo "<td>" . $row['NROD_USU'] . "</td>";
    echo "<td>" . $row['DNom'] . "</td>";
    echo "<td>" . $servicio . "</td>";
    echo "<td>" . $row['DInicio'] . "</td>";
    echo "<td>" . $dia_est . "</td>";
    echo "<td style='text-align: right;'>" . number_format($vprefac, 0, ",", ".") . "</td>";
    echo "</tr>";
}

echo "</table>";

function estancia($fechaing, $horaing)
{
    $anno = date('Y');
    $mes = date('m');
    $dia = date('d');
    $hora = date('H');
    $minu = date('i');
    $segu = date('s');
    $numeroact = gmmktime($hora, $minu, $segu, $mes, $dia, $anno);

    $dia = substr($fechaing, 8, 2);
    $mes = substr($fechaing, 5, 2);
    $anno = substr($fechaing, 0, 4);
    $segu = substr($horaing, 6, 2);
    $minu = substr($horaing, 3, 2);
    $hora = substr($horaing, 0, 2);
    $numeroing = gmmktime($hora, $minu, $segu, $mes, $dia, $anno);

    $difer = $numeroact - $numeroing;
    $num1 = floor($difer / 60);
    $seg = $difer % 60;
    $num2 = floor($num1 / 60);
    $min = $num1 % 60;
    $dias = floor($num2 / 24);
    $horas = $num2 % 24;

    return $dias . ' Dias  ' . $horas . ' Horas  ';
}
?>
