<?php
session_start();
set_time_limit(100);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>PROGRAMA DE FACTURACIÓN</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>

</script>
</head>
<div>
  <ul class="menu">
    <li><a href="fac_3muestraripsusua.php">Usuario</a></li>
    <li><a href="fac_3muestraripscons.php">Consultas</a></li>
    <li><a href="fac_3muestraripsproc.php">Procedimientos</a></li>
    <li><a href="fac_3muestraripsmedi.php">Medicamentos</a></li>
    <li><a href="fac_3muestraripsotro.php">Otros Servicios</a></li>
    <li><a href="fac_3muestraripsurge.php">Urgencias</a></li>
    <li><a href="fac_3muestraripscons.php">Consultas</a></li>
    <li><a href="fac_3muestraripshosp.php">Hospitalización</a></li>
    <li><a href="fac_3muestraripsrnac.php">R. Nacidos</a></li>
    <li><a href="fac_3generaripsjson.php" class="activo">Generar Json</a></li>
  </ul>
</div>  
<body>
<form name='form1' method="POST" action='#' target='fr02'>
<table class="Tbl0"><tr><td class="Td0" align='center'><h2>R I P S(2275) Generar Json</h2></td></tr></table>
<?php
include('php/conexion.php');
include('php/funciones.php');

$consultaent = "SELECT e.nite_emp,e.codp_emp FROM empresa e";
$consultaent = mysql_query($consultaent);
$row = mysql_fetch_array($consultaent);
$nit = $row[nite_emp];
$codigoPrestador=$row[codp_emp];

$consultafac = "SELECT CONCAT(pref_fac,nume_fac) AS numerofac FROM encabezado_factura ef 
    WHERE ef.iden_fac ='$giden_fac'";
//echo "<br>".$consultafac;
$consultafac = mysql_query($consultafac);
$rowfac = mysql_fetch_array($consultafac);
$numFactura = $rowfac[numerofac];

$consultas=array();
//aqui se generan las consultas
$consultacon="SELECT con.id_consulta,con.fechainicioatencion,con.numautorizacion,con.codconsulta,con.modalidadgruposervicio,con.gruposervicios,con.codservicio,con.finalidadtecnologia,con.causamotivoatencion,con.coddiagnosticoprincipal,con.coddiagnosticorelacinado1,con.coddiagnosticorelacinado2,con.coddiagnosticorelacinado3,con.tipodiagnosticoprincipal,con.tipodocumentoidentificacion,con.numdocumentoidentificacion,con.vrservicio,con.conceptorecaudo,con.valorpagomoderador,con.numfevpagomoderador,con.consecutivo,con.iden_fac,con.iden_dfa 
  FROM nrconsulta AS con
  WHERE iden_fac='$giden_fac'";
//echo $consultacon;
$consecutivo=1;
$consultacon=mysql_query($consultacon);
if(mysql_num_rows($consultacon)<>0){
    while($rowcon=mysql_fetch_array($consultacon)){        
        $consulta = new Consulta();
        $consulta->codPrestador = $codigoPrestador;
        $consulta->fechaInicioAtencion = $rowcon[fechainicioatencion];
        if(!empty($rowcon[numautorizacion])){
            $consulta->numAutorizacion = $rowcon[numautorizacion];
        } 
        $consulta->codConsulta = $rowcon[codconsulta];
        $consulta->modalidadGrupoServicioTecSal = $rowcon[modalidadgruposervicio];
        $consulta->grupoServicios = $rowcon[gruposervicios];
        $consulta->codServicio = $rowcon[codservicio];
        $consulta->finalidadTecnologiaSalud = $rowcon[finalidadtecnologia];
        $consulta->causaMotivoAtencion = $rowcon[causamotivoatencion];
        $consulta->codDiagnosticoPrincipal = $rowcon[coddiagnosticoprincipal];
        if(!empty($rowcon[coddiagnosticorelacinado1])){
            $consulta->codDiagnosticoRelacinado1 = $rowcon[coddiagnosticorelacinado1];
        }
        if(!empty($rowcon[coddiagnosticorelacinado2])){
            $consulta->codDiagnosticoRelacinado2 = $rowcon[coddiagnosticorelacinado2];
        }
        if(!empty($rowcon[coddiagnosticorelacinado3])){
            $consulta->codDiagnosticoRelacinado3 = $rowcon[coddiagnosticorelacinado3];
        }
        $consulta->tipoDiagnosticoPrincipal = $rowcon[tipodiagnosticoprincipal];
        $consulta->tipoDocumentoIdentificacion = $rowcon[tipodocumentoidentificacion];
        $consulta->numDocumentoIdentificacion = $rowcon[numdocumentoidentificacion];
        $consulta->vrServicio = intval($rowcon[vrservicio]);
        $consulta->conceptoRecaudo = $rowcon[conceptorecaudo];
        $consulta->valorPagoModerador = intval($rowcon[valorpagomoderador]);
        if(!empty($rowcon[numfevpagomoderador])){
            $consulta->numFEVPagoModerador = $rowcon[numfevpagomoderador];
        }    
        $consulta->consecutivo = $consecutivo;    
        $consecutivo++;
        $consultas[] = $consulta;        
    }
    //echo"<br>".json_encode($consultas);
}
$servicios = new Servicio();
$servicios->consultas = $consultas;

//echo"<br>".json_encode($servicios);

$procedimientos=array();
//aqui se generan los procedimientos
$consultapro="SELECT pro.id_procedimiento,pro.fechainicioatencion,pro.idmipres,pro.numautorizacion,pro.codprocedimiento,pro.viaingresoservicio,pro.modalidadgruposervicio,pro.gruposervicios,pro.codservicio,pro.finalidadtecnologia,pro.tipodocumentoidentificacion,pro.numdocumentoidentificacion,pro.coddiagnositicoprincipal,pro.coddiagnosticorelacionado,pro.codcomplicacion,pro.vrservicio,pro.conceptorecaudo,pro.valorpagomoderador,pro.numfevpagomoderador,pro.consecutivo,pro.iden_fac,pro.iden_dfa
  FROM nrprocedimiento AS pro
  WHERE iden_fac='$giden_fac'";
//echo $consultapro;
$consecutivo=1;
$consultapro=mysql_query($consultapro);
if(mysql_num_rows($consultapro)<>0){
    while($rowpro=mysql_fetch_array($consultapro)){     
        $procedimiento = new Procedimiento();
        $procedimiento->codPrestador = $codigoPrestador;
        $procedimiento->fechaInicioAtencion = $rowpro[fechainicioatencion];
        if(!empty($rowpro[idmipres])){
            $procedimiento->idMIPRES = $rowpro[idmipres];
        }
        if(!empty($rowpro[numautorizacion])){
            $procedimiento->numAutorizacion = $rowpro[numautorizacion];
        }
        $procedimiento->codProcedimiento = $rowpro[codprocedimiento];
        $procedimiento->viaIngresoServicioSalud = $rowpro[viaingresoservicio];
        $procedimiento->modalidadGrupoServicioTecSal = $rowpro[modalidadgruposervicio];
        $procedimiento->grupoServicios = $rowpro[gruposervicios];
        $procedimiento->codServicio = intval($rowpro[codservicio]);
        $procedimiento->finalidadTecnologiaSalud = $rowpro[finalidadtecnologia];
        $procedimiento->tipoDocumentoIdentificacion = $rowpro[tipodocumentoidentificacion];
        $procedimiento->numDocumentoIdentificacion = $rowpro[numdocumentoidentificacion];
        $procedimiento->codDiagnositicoPrincipal = $rowpro[coddiagnositicoprincipal];
        if(!empty($rowpro[coddiagnosticorelacionado])){
            $procedimiento->codDiagnosticoRelacionado = $rowpro[coddiagnosticorelacionado];
        }
        if(!empty($rowpro[codcomplicacion])){
            $procedimiento->codComplicacion = $rowpro[codcomplicacion];
        }
        $procedimiento->vrServicio = intval($rowpro[vrservicio]);
        $procedimiento->conceptoRecaudo = $rowpro[conceptorecaudo];
        $procedimiento->valorPagoModerador = intval($rowpro[valorpagomoderador]);
        if(!empty($rowpro[numfevpagomoderador])){
            $procedimiento->numFEVPagoModerador = $rowpro[numfevpagomoderador];
        }
        $procedimiento->consecutivo = $consecutivo;

        //echo"<br>".json_encode($procedimiento);

        $consecutivo++;
        $procedimientos[] = $procedimiento;
    }
    //echo"<br>".json_encode($procedimientos);
}


$servicios = new Servicio();
$servicios->consultas = $consultas;
$servicios->procedimientos = $procedimientos;

//echo"<br>".json_encode($servicios);

$consultausu="SELECT usu.id_usuario,usu.tipodocumento,usu.numdocumento,usu.tipousuario,usu.fechanacimiento,usu.codsexo,usu.codpaisresidencia,usu.codmunicipioresidencia,usu.codzonaresidencia,usu.incapacidad,usu.codpaisorigen,usu.iden_fac
    FROM nrusuario AS usu
    WHERE iden_fac='$giden_fac'";
//echo "<br><br>".$consultausu;
$consultausu = mysql_query($consultausu);
$rowusu = mysql_fetch_array($consultausu);

//echo "<br>doc".$rowusu[codsexo];
//aqui se genera el usuario
$usuario = new Usuario();
$usuario->tipoDocumento = $rowusu[tipodocumento];
$usuario->numDocumentoIdentificacion = $rowusu[numdocumento];
$usuario->tipoUsuario = $rowusu[tipousuario];
$usuario->fechaNacimiento = $rowusu[fechanacimiento];
$usuario->codSexo = $rowusu[codsexo];
$usuario->codPaisResidencia = $rowusu[codpaisresidencia];
$usuario->codMunicipioResidencia = $rowusu[codmunicipioresidencia];
$usuario->codZonaTerritorialResidencia = $rowusu[codzonaresidencia];
$usuario->incapacidad = $rowusu[incapacidad];
$usuario->consecutivo = 1;
$usuario->codPaisOrigen = $rowusu[codpaisorigen];
$usuario->servicios = $servicios;

$usuarios=array();
//$usuarios[] = new Usuario($usuario);
$usuarios[] = $usuario;


$rips = new Rips();
$rips->numDocumentoIdObligado = $nit;
$rips->numFactura = $numFactura;
$rips->usuarios = $usuarios;
//$rips->servicios= $servicios;

$ripsJson = json_encode($rips);
echo "<br><br>".$ripsJson;



class Rips{
    public $numDocumentoIdObligado;
    public $numFactura;
    public $tipoNota;
    public $numNota;
    public $usuarios;    
}

class Usuario{
    public $tipoDocumento;
    public $numDocumentoIdentificacion;
    public $tipoUsuario;
    public $fechaNacimiento;
    public $codSexo;
    public $codPaisResidencia;
    public $codMunicipioResidencia;
    public $codZonaTerritorialResidencia;
    public $incapacidad;
    public $consecutivo;
    public $codPaisOrigen;
    public $servicios;
}

class Servicio{
    public $consultas;
}

class Consulta{
    public $codPrestador;
    public $fechaInicioAtencion;
    public $numAutorizacion;
    public $codConsulta;
    public $modalidadGrupoServicioTecSal;
    public $grupoServicios;
    public $codServicio;
    public $finalidadTecnologiaSalud;
    public $causaMotivoAtencion;
    public $codDiagnosticoPrincipal;
    public $codDiagnosticoRelacinado1;
    public $codDiagnosticoRelacinado2;
    public $codDiagnosticoRelacinado3;
    public $tipoDiagnosticoPrincipal;
    public $tipoDocumentoIdentificacion;
    public $numDocumentoIdentificacion;
    public $vrServicio;
    public $conceptoRecaudo;
    public $valorPagoModerador;
    public $numFEVPagoModerador;
    public $consecutivo;
}

class Procedimiento{
    public $codPrestador;
    public $fechaInicioAtencion;
    public $idMIPRES;
    public $numAutorizacion;
    public $codProcedimiento;
    public $viaIngresoServicioSalud;
    public $modalidadGrupoServicioTecSal;
    public $grupoServicios;
    public $codServicio;
    public $finalidadTecnologiaSalud;
    public $tipoDocumentoIdentificacion;
    public $numDocumentoIdentificacion;
    public $codDiagnositicoPrincipal;
    public $codDiagnosticoRelacionado;
    public $codComplicacion;
    public $vrServicio;
    public $conceptoRecaudo;
    public $valorPagoModerador;
    public $numFEVPagoModerador;
    public $consecutivo;
}

mysql_free_result($consultaent);
mysql_free_result($consultausu);
mysql_free_result($consultacon);
mysql_free_result($consultapro);
mysql_close();
?>    

</form>
</body>
</html>
