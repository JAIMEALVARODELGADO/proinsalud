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

function saveTextAsFile(nombreArchivo_) {
    var textarea = document.getElementById("json");
    var textToWrite = textarea.value;

    var textFileAsBlob = new Blob([textToWrite], {type:'text/plain'});
    var fileNameToSaveAs = nombreArchivo_;

    var downloadLink = document.createElement("a");
    downloadLink.download = fileNameToSaveAs;
    downloadLink.innerHTML = "Descargar archivo";
    if (window.webkitURL != null) {
        // Para navegadores webkit (como Chrome)
        downloadLink.href = window.webkitURL.createObjectURL(textFileAsBlob);
    } else {
        // Para otros navegadores
        downloadLink.href = window.URL.createObjectURL(textFileAsBlob);
        downloadLink.onclick = destroyClickedElement;
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
    }
    downloadLink.click();
}

function destroyClickedElement(event) {
    document.body.removeChild(event.target);
}
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


$errores="";

$consultaent = "SELECT e.nite_emp,e.codp_emp FROM empresa e";
$consultaent = mysql_query($consultaent);
$row = mysql_fetch_array($consultaent);
$nit = $row[nite_emp];
$codigoPrestador=$row[codp_emp];

$consultafac = "SELECT CONCAT(pref_fac,nume_fac) AS numerofac,vtot_fac FROM encabezado_factura ef 
    WHERE ef.iden_fac ='$giden_fac'";
//echo "<br>".$consultafac;
$consultafac = mysql_query($consultafac);
$rowfac = mysql_fetch_array($consultafac);
$numFactura = $rowfac[numerofac];
$totalFacturado = $rowfac[vtot_fac];

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

        $errores.=$consulta->validar();
    }
    //echo"<br>".json_encode($consultas);
}
$servicios = new Servicio();
$servicios->consultas = $consultas;

//echo"<br>".json_encode($servicios);

$procedimientos=array();
//aqui se generan los procedimientos
$consultapro="SELECT pro.id_procedimiento,pro.fechainicioatencion,pro.idmipres,pro.numautorizacion,pro.codprocedimiento,pro.viaingresoservicio,pro.modalidadgruposervicio,pro.gruposervicios,pro.codservicio,pro.finalidadtecnologia,pro.tipodocumentoidentificacion,pro.numdocumentoidentificacion,pro.coddiagnosticoprincipal,pro.coddiagnosticorelacionado,pro.codcomplicacion,pro.vrservicio,pro.conceptorecaudo,pro.valorpagomoderador,pro.numfevpagomoderador,pro.consecutivo,pro.iden_fac,pro.iden_dfa
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
        $procedimiento->codDiagnosticoPrincipal = $rowpro[coddiagnosticoprincipal];
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

        $errores.=$procedimiento->validar();
    }
    //echo"<br>".json_encode($procedimientos);
}


$medicamentos=array();
//aqui se generan los medicamentos
$consultamed="SELECT med.id_medicamento,med.numautorizacion,med.idmipres,med.fechadispensadmon,med.coddiagnosticoprincipal,med.coddiagnosticorelacionado,med.tipomedicamento,med.codtecnologia,med.nomtecnologia,med.concentracion,med.unidadmedida,med.formafarmaceutica,med.unidadmindispensa,med.cantidad,med.diastratamiento,med.tipodocumentoidentificacion,med.numdocumentoidentificacion,med.vrunitmedicamento,med.vrservicio,med.conceptorecaudo,med.valorpagomoderador,med.numfevpagomoderador,med.consecutivo,med.iden_fac,med.iden_dfa
FROM nrmedicamento AS med
WHERE iden_fac='$giden_fac'";
//echo $consultamed;
$consecutivo=1;
$consultamed=mysql_query($consultamed);
if(mysql_num_rows($consultamed)<>0){
    while($rowmed=mysql_fetch_array($consultamed)){     
        $medicamento = new Medicamento();
        $medicamento->codPrestador = $codigoPrestador;
        if(!empty($rowmed[numautorizacion])){
            $medicamento->numAutorizacion = $rowmed[numautorizacion];
        }
        if(!empty($rowmed[idmipres])){
            $medicamento->idMIPRES = $rowmed[idmipres];
        }        
        $medicamento->fechaDispensAdmon = $rowmed[fechadispensadmon];
        $medicamento->codDiagnosticoPrincipal = $rowmed[coddiagnosticoprincipal];
        if(!empty($rowmed[coddiagnosticorelacionado])){
            $medicamento->codDiagnosticoRelacionado = $rowmed[coddiagnosticorelacionado];
        }
        $medicamento->tipoMedicamento = $rowmed[tipomedicamento];
        $medicamento->codTecnologiaSalud = $rowmed[codtecnologia];
        $medicamento->nomTecnologiaSalud = $rowmed[nomtecnologia];
        if(!empty($rowmed[concentracion])){
            $medicamento->concentracionMedicamento = $rowmed[concentracion];
        }
        if(!empty($rowmed[unidadmedida])){
            $medicamento->unidadMedida = $rowmed[unidadmedida];
        }
        if(!empty($rowmed[formafarmaceutica])){
            $medicamento->formaFarmaceutica = $rowmed[formafarmaceutica];
        }
        $medicamento->unidadMinDispensa = intval($rowmed[unidadmindispensa]);
        $medicamento->cantidadMedicamento = intval($rowmed[cantidad]);
        $medicamento->diasTratamiento = intval($rowmed[diastratamiento]);
        $medicamento->tipoDocumentoIdentificacion = $rowmed[tipodocumentoidentificacion];
        $medicamento->numDocumentoIdentificacion = $rowmed[numdocumentoidentificacion];
        $medicamento->vrUnitMedicamento = intval($rowmed[vrunitmedicamento]);
        $medicamento->vrServicio = intval($rowmed[vrservicio]);
        $medicamento->conceptoRecaudo = $rowmed[conceptorecaudo];
        $medicamento->valorPagoModerador = intval($rowmed[valorpagomoderador]);
        if(!empty($rowmed[numfevpagomoderador])){
            $medicamento->numFEVPagoModerador = $rowmed[numfevpagomoderador];
        }
        $medicamento->consecutivo = $consecutivo;

        //echo"<br>".json_encode($medicamento);

        $consecutivo++;
        $medicamentos[] = $medicamento;

        $errores.=$medicamento->validar();
    }
    //echo"<br>".json_encode($medicamentos);
}

$otrosServicios=array();
//aqui se generan los otros servicios
$consultaotr="SELECT otr.id_otros,otr.numautorizacion,otr.idmipres,otr.fechasuministrotecnologia,otr.tipoos,otr.codtecnologia,otr.nomtecnologia,otr.cantidados,otr.tipodocumentoidentificacion,otr.numdocumentoidentificacion,otr.vrunitos,otr.vrservicio,otr.conceptorecaudo,otr.valorpagomoderador,otr.numfevpagomoderador,otr.consecutivo,otr.iden_fac,otr.iden_dfa
FROM nrotroservicios AS otr
WHERE iden_fac='$giden_fac'";
//echo $consultaotr;
$consecutivo=1;
$consultaotr=mysql_query($consultaotr);
if(mysql_num_rows($consultaotr)<>0){
    while($rowotr=mysql_fetch_array($consultaotr)){     
        $otroServicio = new otrosServicios();
        $otroServicio->codPrestador = $codigoPrestador;
        if(!empty($rowotr[numautorizacion])){
            $otroServicio->numAutorizacion = $rowotr[numautorizacion];
        }
        if(!empty($rowotr[idmipres])){
            $otroServicio->idMIPRES = $rowotr[idmipres];
        }
        $otroServicio->fechaSuministroTecnologia = $rowotr[fechasuministrotecnologia];
        $otroServicio->tipoOS = $rowotr[tipoos];
        $otroServicio->codTecnologiaSalud = $rowotr[codtecnologia];
        if(!empty($rowotr[nomtecnologia])){
            $otroServicio->nomTecnologiaSalud = $rowotr[nomtecnologia];
        }
        $otroServicio->cantidadOS = intval($rowotr[cantidados]);
        $otroServicio->tipoDocumentoIdentificacion = $rowotr[tipodocumentoidentificacion];
        $otroServicio->numDocumentoIdentificacion = $rowotr[numdocumentoidentificacion];
        $otroServicio->vrUnitOS = intval($rowotr[vrunitos]);
        $otroServicio->vrServicio = intval($rowotr[vrservicio]);
        $otroServicio->conceptoRecaudo = $rowotr[conceptorecaudo];
        $otroServicio->valorPagoModerador = intval($rowotr[valorpagomoderador]);
        if(!empty($rowotr[nomtecnologia])){
            $otroServicio->numFEVPagoModerador = $rowotr[numfevpagomoderador];
        }
        $otroServicio->consecutivo = $consecutivo;        

        //echo"<br>".json_encode($otroServicio);

        $consecutivo++;
        $otrosServicios[] = $otroServicio;

        $errores.=$otroServicio->validar();
    }
    //echo"<br>".json_encode($otrosServicios);
}

$urgencias=array();
//aqui se generan las urgencias
$consultaurg="SELECT urg.id_urgencias,urg.fechainicioatencion,urg.causamotivoatencion,urg.coddiagnosticoprincipal,urg.coddiagnosticoprincipale,urg.coddiagnosticorelacionadoe1,urg.coddiagnosticorelacionadoe2,urg.coddiagnosticorelacionadoe3,urg.condiciondestinousuarioegreso,urg.coddiagnosticocausamuerte,urg.fechaegreso,urg.consecutivo,urg.iden_fac,urg.iden_dfa  
FROM nrurgencias AS urg
WHERE iden_fac='$giden_fac'";
//echo $consultaurg;
$consecutivo=1;
$consultaurg=mysql_query($consultaurg);
if(mysql_num_rows($consultaurg)<>0){
    while($rowurg=mysql_fetch_array($consultaurg)){     
        $urgencia = new Urgencia();
        $urgencia->codPrestador = $codigoPrestador;
        $urgencia->fechaInicioAtencion = $rowurg[fechainicioatencion];
        $urgencia->causaMotivoAtencion = $rowurg[causamotivoatencion];
        $urgencia->codDiagnosticoPrincipal = $rowurg[coddiagnosticoprincipal];
        $urgencia->codDiagnosticoPrincipalE = $rowurg[coddiagnosticoprincipale];
        if(!empty($rowurg[coddiagnosticorelacionadoe1])){
            $urgencia->codDiagnosticoRelacionadoE1 = $rowurg[coddiagnosticorelacionadoe1];
        }
        if(!empty($rowurg[coddiagnosticorelacionadoe2])){
            $urgencia->codDiagnosticoRelacionadoE2 = $rowurg[coddiagnosticorelacionadoe2];
        }
        if(!empty($rowurg[coddiagnosticorelacionadoe3])){
            $urgencia->codDiagnosticoRelacionadoE3 = $rowurg[coddiagnosticorelacionadoe3];
        }        
        $urgencia->condicionDestinoUsuarioEgreso = $rowurg[condiciondestinousuarioegreso];
        if(!empty($rowurg[coddiagnosticocausamuerte])){
            $urgencia->codDiagnosticoCausaMuerte = $rowurg[coddiagnosticocausamuerte];
        }
        $urgencia->fechaEgreso = $rowurg[fechaegreso];
        $urgencia->consecutivo = $consecutivo;

        //echo"<br>".json_encode($urgencia);

        $consecutivo++;
        $urgencias[] = $urgencia;

        $errores.=$urgencia->validar();
    }
    //echo"<br>".json_encode($urgencias);
}

$hospitals=array();
//aqui se generan las hospitalizaciones
$consultahos="SELECT hos.id_hospital,hos.viaingresoservicio,hos.fechainicioatencion,hos.numautorizacion,hos.causamotivoatencion,hos.coddiagnosticoprincipal,hos.coddiagnosticoprincipale,hos.coddiagnosticorelacionadoe1,hos.coddiagnosticorelacionadoe2,hos.coddiagnosticorelacionadoe3,hos.codcomplicacion,hos.condiciondestinoegreso,hos.coddiagnosticocausamuerte,hos.fechaegreso,hos.consecutivo,hos.iden_fac,hos.iden_dfa
FROM nrhospital AS hos
WHERE iden_fac='$giden_fac'";
//echo $consultahos;
$consecutivo=1;
$consultahos=mysql_query($consultahos);
if(mysql_num_rows($consultahos)<>0){
    while($rowhos=mysql_fetch_array($consultahos)){     
        $hospital = new Hospital();
        $hospital->codPrestador = $codigoPrestador;
        $hospital->viaIngresoServicioSalud = $rowhos[viaingresoservicio];
        $hospital->fechaInicioAtencion = $rowhos[fechainicioatencion];
        if(!empty($rowhos[numautorizacion])){
            $hospital->numAutorizacion = $rowhos[numautorizacion];
        }
        $hospital->causaMotivoAtencion = $rowhos[causamotivoatencion];
        $hospital->codDiagnosticoPrincipal = $rowhos[coddiagnosticoprincipal];
        $hospital->codDiagnosticoPrincipalE = $rowhos[coddiagnosticoprincipale];
        if(!empty($rowhos[coddiagnosticorelacionadoe1])){
            $hospital->codDiagnosticoRelacionadoE1 = $rowhos[coddiagnosticorelacionadoe1];
        }
        if(!empty($rowhos[coddiagnosticorelacionadoe2])){
            $hospital->codDiagnosticoRelacionadoE2 = $rowhos[coddiagnosticorelacionadoe2];
        }
        if(!empty($rowhos[coddiagnosticorelacionadoe3])){
            $hospital->codDiagnosticoRelacionadoE3 = $rowhos[coddiagnosticorelacionadoe3];
        }
        if(!empty($rowhos[codcomplicacion])){
            $hospital->codComplicacion = $rowhos[codcomplicacion];
        }
        $hospital->condicionDestinoUsuarioEgreso = $rowhos[condiciondestinoegreso];
        if(!empty($rowhos[coddiagnosticocausamuerte])){
            $hospital->codDiagnosticoCausaMuerte = $rowhos[coddiagnosticocausamuerte];
        }
        $hospital->fechaEgreso = $rowhos[fechaegreso];
        $hospital->consecutivo = $consecutivo;

        //echo"<br>".json_encode($hospital);

        $consecutivo++;
        $hospitals[] = $hospital;

        $errores.=$hospital->validar();
    }
    //echo"<br>".json_encode($hospitals);
}

$recienNacidos=array();
//aqui se generan los recien nacidos
$consultarna="SELECT rna.id_nacidos,rna.tipodocumentoidentificacion,rna.numerodocumentoidentificacion,rna.fechanacimiento,rna.edadgestacional,rna.numeroconsultascprenatal,rna.codsexobiologico,rna.peso,rna.coddiagnosticoprincipal,rna.condiciondestinoegreso,rna.coddiagnosticocausamuerte,rna.fechaegreso,rna.consecutivo,rna.iden_fac
FROM nrnacidos AS rna
WHERE rna.iden_fac='$giden_fac'";
//echo $consultarna;
$consecutivo=1;
$consultarna=mysql_query($consultarna);
if(mysql_num_rows($consultarna)<>0){
    while($rowrna=mysql_fetch_array($consultarna)){     
        $recienNacido = new recienNacido();
        $recienNacido->codPrestador = $codigoPrestador;        
        $recienNacido->tipoDocumentoIdentificacion = $rowrna[tipodocumentoidentificacion];
        $recienNacido->numDocumentoIdentificacion = $rowrna[numerodocumentoidentificacion];
        $recienNacido->fechaNacimiento = $rowrna[fechanacimiento];
        $recienNacido->edadGestacional = $rowrna[edadgestacional];
        $recienNacido->numConsultasCPrenatal = intval($rowrna[numeroconsultascprenatal]);
        $recienNacido->codSexoBiologico = $rowrna[codsexobiologico];
        $recienNacido->peso = intval($rowrna[peso]);
        $recienNacido->codDiagnosticoPrincipal = $rowrna[coddiagnosticoprincipal];
        $recienNacido->condicionDestinoUsuarioEgreso = $rowrna[condiciondestinoegreso];
        if(!empty($rowrna[coddiagnosticocausamuerte])){
            $recienNacido->codDiagnosticoCausaMuerte = $rowrna[coddiagnosticocausamuerte];    
        }        
        $recienNacido->fechaEgreso = $rowrna[fechaegreso];
        $recienNacido->consecutivo = $consecutivo;

        //echo"<br>".json_encode($recienNacido);

        $consecutivo++;
        $recienNacidos[] = $recienNacido;

        $errores.=$recienNacido->validar();
    }
    //echo"<br>".json_encode($recienNacidos);
}


$servicios = new Servicio();
$servicios->consultas = $consultas;
$servicios->procedimientos = $procedimientos;
$servicios->medicamentos = $medicamentos;
$servicios->otrosServicios = $otrosServicios;
$servicios->urgencias = $urgencias;
$servicios->hospitalizacion = $hospitals;
$servicios->recienNacidos = $recienNacidos;



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

$errores.=$usuario->validar();

$usuarios=array();

$usuarios[] = $usuario;


$rips = new Rips();
$rips->numDocumentoIdObligado = $nit;
$rips->numFactura = $numFactura;
$rips->usuarios = $usuarios;

//Aqui se genera el archivo json
$ripsJson = json_encode($rips);
//echo "<br><br>".$ripsJson;

//Inicia bloque guardar archivo -- Este bloque permite guardar el json en una carpeta y luego descargarlo
/*$scarpeta=""; //carpeta donde guardar el archivo. 
//debe tener permisos 775 por lo menos 
$sfile="planos/ripsJson".$numFactura.".json"; //ruta del archivo a generar 
$fp=fopen($sfile,"w"); 
fwrite($fp,$ripsJson); 
fclose($fp);
echo"
<div>   
    <a href='".$sfile."'><img width=20 height=20 src='icons/feed_disk.png' alt='Generar Archivo' border=0></a>    
    <a href='".$sfile."'><font color=#3300FF><b>Guardar Json</font></a>
</div>
";*/
//Fin bloque guardar archivo


mysql_free_result($consultaent);
mysql_free_result($consultausu);
mysql_free_result($consultacon);
mysql_free_result($consultapro);
mysql_free_result($consultamed);
mysql_free_result($consultaotr);
mysql_free_result($consultaurg);
mysql_free_result($consultahos);
mysql_free_result($consultarna);
mysql_close();

$nombreArchivo="ripsJson".$numFactura.".json";
?>
<table class="Tbl0">
    <tr><td class='Td1'>Lista de errores</td></tr>
    <?php echo $errores;?>
</table>


<br>
<textarea name="json" id="json" hidden="true">
<?php echo $ripsJson;?>
</textarea>
<!--<div align="center">
    <input type="button" class='BtnGuardar' id="guardaArchivo" value="Guardar Json" onclick="saveTextAsFile('<?php echo $nombreArchivo;?>')" />
</div>-->
<br><br>
<div class='Td6'>
  <center><a href='#' onclick="saveTextAsFile('<?php echo $nombreArchivo;?>')"><img src='icons/feed_disk.png' width='20' height='20'>Descargar Rips</a></center>
</div>

<?php

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

    public function validar(){
        $errores="";        
        if(isset($this->tipoDocumento) and !existeTipo($this->tipoDocumento,'E3')){
            $errores.="<tr><td>Usuario - Tipo de documento de identificación </td><tr>";            
        }        
        if(isset($this->numDocumentoIdentificacion) and strlen($this->numDocumentoIdentificacion) < 4){
            $errores.="<tr><td>Usuario - El número de documento de identificación no debe ser inferior a 4 caracteres </td><tr>";
        }        
        if(isset($this->tipoUsuario) and !existeTipo($this->tipoUsuario,'G3')){
            $errores.="<tr><td>Usuario - Tipo de usuario </td><tr>";
        }        
        if(isset($this->fechaNacimiento) and strlen($this->fechaNacimiento) < 10 ){
            $errores.="<tr><td>Usuario - Fecha de nacimiento </td><tr>";
        }        
        if(isset($this->codSexo) and !existeTipo($this->codSexo,'H9')){
            $errores.="<tr><td>Usuario - Sexo </td><tr>";
        }        
        if(isset($this->codPaisResidencia) and !existePais($this->codPaisResidencia)){
            $errores.="<tr><td>Usuario - País de residencia </td><tr>";
        }        
        if(isset($this->codMunicipioResidencia) and !existeMunicipio($this->codMunicipioResidencia)){
            $errores.="<tr><td>Usuario - Municipio de residencia </td><tr>";
        }        
        if(isset($this->codZonaTerritorialResidencia) and !existeTipo($this->codZonaTerritorialResidencia,'H0')){
            $errores.="<tr><td>Usuario - Zona de residencia </td><tr>";
        }
        if(isset($this->incapacidad) and empty($this->incapacidad)){
            $errores.="<tr><td>Usuario - Incapacidad </td><tr>";
        }        
        if(isset($this->codPaisOrigen) and !existePais($this->codPaisOrigen)){
            $errores.="<tr><td>Usuario - País de origen </td><tr>";
        }

        return($errores);
    }
}

class Servicio{
    public $consultas;
    public $procedimientos;
    public $urgencias;
    public $hospitalizacion;
    public $recienNacidos;
    public $medicamentos;
    public $otrosServicios;
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

    public function validar(){
        $errores="";        
        if(isset($this->fechaInicioAtencion) and strlen($this->fechaInicioAtencion) < 16){
            $errores.="<tr><td>Consultas - Fecha y hora de inicio de atención - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codConsulta) and strlen($this->codConsulta) < 6){
            $errores.="<tr><td>Consultas - El código no debe ser menor a 6 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->modalidadGrupoServicioTecSal) and !existeTipo($this->modalidadGrupoServicioTecSal,'G4')){
            $errores.="<tr><td>Consultas - Modalidad de atención - Registro ".$this->consecutivo."</td><tr>";
        }        
        if(isset($this->grupoServicios) and !existeTipo($this->grupoServicios,'G5')){
            $errores.="<tr><td>Consultas - Grupo de servicios - Registro ".$this->consecutivo."</td><tr>";
        }
        if(isset($this->codServicio) and !existeTipo($this->codServicio,'G6')){
            $errores.="<tr><td>Consultas - Servicio - Registro ".$this->consecutivo."</td><tr>";
        }
        if(isset($this->finalidadTecnologiaSalud) and !existeTipo($this->finalidadTecnologiaSalud,'G7')){
            $errores.="<tr><td>Consultas - Finalidad - Registro ".$this->consecutivo."</td><tr>";
        }        
        if(isset($this->causaMotivoAtencion) and !existeTipo($this->causaMotivoAtencion,'G8')){
            $errores.="<tr><td>Consultas - Causa motivo de atención - Registro ".$this->consecutivo."</td><tr>";
        }        
        if(isset($this->codDiagnosticoPrincipal) and strlen($this->codDiagnosticoPrincipal) < 4){
            $errores.="<tr><td>Consultas - El diagnóstico principal no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->codDiagnosticoRelacinado1) and strlen($this->codDiagnosticoRelacinado1) < 4){
            $errores.="<tr><td>Consultas - El diagnóstico relacionado 1 no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoRelacinado2) and strlen($this->codDiagnosticoRelacinado2) < 4){
            $errores.="<tr><td>Consultas - El diagnóstico relacionado 2 no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoRelacinado3) and strlen($this->codDiagnosticoRelacinado3) < 4){
            $errores.="<tr><td>Consultas - El diagnóstico relacionado 3 no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->tipoDiagnosticoPrincipal) and !existeTipo($this->tipoDiagnosticoPrincipal,'G9')){
            $errores.="<tr><td>Consultas - Tipo de diagnóstico - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->conceptoRecaudo) and !existeTipo($this->conceptoRecaudo,'H1')){
            $errores.="<tr><td>Consultas - Concepto del recaudo - Registro ".$this->consecutivo." </td><tr>";
        }        

        return($errores);
    }
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
    public $codDiagnosticoPrincipal;
    public $codDiagnosticoRelacionado;
    public $codComplicacion;
    public $vrServicio;
    public $conceptoRecaudo;
    public $valorPagoModerador;
    public $numFEVPagoModerador;
    public $consecutivo;

    public function validar(){
        $errores="";
        if(isset($this->fechaInicioAtencion) and strlen($this->fechaInicioAtencion) < 16){
            $errores.="<tr><td>Procedimientos - Fecha  y hora de inicio de atención - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codProcedimiento) and strlen($this->codProcedimiento) < 6){
            $errores.="<tr><td>Procedimientos - El código del procedimiento no puede ser menor a 6 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->viaIngresoServicioSalud) and !existeTipo($this->viaIngresoServicioSalud,'H2')){
            $errores.="<tr><td>Procedimientos - Vía de ingreso - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->modalidadGrupoServicioTecSal) and !existeTipo($this->modalidadGrupoServicioTecSal,'G4')){
            $errores.="<tr><td>Procedimientos - Modalidad de atención - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->grupoServicios) and !existeTipo($this->grupoServicios,'G5')){
            $errores.="<tr><td>Procedimientos - Grupo de servicios - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codServicio) and !existeTipo($this->codServicio,'G6')){
            $errores.="<tr><td>Procedimientos - Servicio - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->finalidadTecnologiaSalud) and !existeTipo($this->finalidadTecnologiaSalud,'G7')){
            $errores.="<tr><td>Procedimientos - Finalidad - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoPrincipal) and strlen($this->codDiagnosticoPrincipal) < 4){
            $errores.="<tr><td>Procedimientos - El diagnóstico principal no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoRelacionado) and strlen($this->codDiagnosticoRelacionado) < 4){
            $errores.="<tr><td>Procedimientos - El diagnóstico relacionado no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codComplicacion) and strlen($this->codComplicacion) < 4){
            $errores.="<tr><td>Procedimientos - El código de la complicación no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->conceptoRecaudo) and !existeTipo($this->conceptoRecaudo,'H1')){
            $errores.="<tr><td>Procedimientos - Concepto del recaudo - Registro ".$this->consecutivo." </td><tr>";
        }          

        return($errores);
    }
}

class Medicamento{
    public $codPrestador;
    public $numAutorizacion;
    public $idMIPRES;
    public $fechaDispensAdmon;
    public $codDiagnosticoPrincipal;
    public $codDiagnosticoRelacionado;
    public $tipoMedicamento;
    public $codTecnologiaSalud;
    public $nomTecnologiaSalud;
    public $concentracionMedicamento;
    public $unidadMedida;
    public $formaFarmaceutica;
    public $unidadMinDispensa;
    public $cantidadMedicamento;
    public $diasTratamiento;
    public $tipoDocumentoIdentificacion;
    public $numDocumentoIdentificacion;
    public $vrUnitMedicamento;
    public $vrServicio;
    public $conceptoRecaudo;
    public $valorPagoModerador;
    public $numFEVPagoModerador;
    public $consecutivo;

    public function validar(){
        $errores="";
        if(isset($this->fechaDispensAdmon) and strlen($this->fechaDispensAdmon) < 16){
            $errores.="<tr><td>Medicamentos - Fecha y hora de dispensación - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoPrincipal) and strlen($this->codDiagnosticoPrincipal) < 4){
            $errores.="<tr><td>Medicamentos - El diagnóstico principal no debe ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoRelacionado) and strlen($this->codDiagnosticoRelacionado) < 4){
            $errores.="<tr><td>Medicamentos - El diagnóstico relacionado no debe ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->tipoMedicamento) and !existeTipo($this->tipoMedicamento,'H4')){
            $errores.="<tr><td>Medicamentos - Tipo de medicamento - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->codTecnologiaSalud) and empty($this->codTecnologiaSalud)){
            $errores.="<tr><td>Medicamentos - Código de medicamento - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->unidadMedida) and !existeTipo($this->unidadMedida,'H5')){
            $errores.="<tr><td>Medicamentos - Unidad de medida de medicamento - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->formaFarmaceutica) and !existeTipo($this->formaFarmaceutica,'H6')){
            $errores.="<tr><td>Medicamentos - Forma farmacéutica - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->unidadMinDispensa) and !existeTipo($this->unidadMinDispensa,'H7')){
            $errores.="<tr><td>Medicamentos - Unidad de dispensación - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->diasTratamiento) and intval($this->diasTratamiento) < 1){
            $errores.="<tr><td>Medicamentos - Los días de tratamiento deben ser mayores a 0 - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->conceptoRecaudo) and !existeTipo($this->conceptoRecaudo,'H1')){
            $errores.="<tr><td>Medicamentos - Concepto de recaudo - Registro ".$this->consecutivo." </td><tr>";
        }

        return($errores);
    }
}

class otrosServicios{
    public $codPrestador;
    public $numAutorizacion;
    public $idMIPRES;
    public $fechaSuministroTecnologia;
    public $tipoOS;
    public $codTecnologiaSalud;
    public $nomTecnologiaSalud;
    public $cantidadOS;
    public $tipoDocumentoIdentificacion;
    public $numDocumentoIdentificacion;
    public $vrUnitOS;
    public $vrServicio;
    public $conceptoRecaudo;
    public $valorPagoModerador;
    public $numFEVPagoModerador;
    public $consecutivo;

    public function validar(){
        $errores="";
        if(isset($this->fechaSuministroTecnologia) and strlen($this->fechaSuministroTecnologia) < 16){
            $errores.="<tr><td>Otros Servicios - Fecha y hora de suministro - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->tipoOS) and !existeTipo($this->tipoOS,'H8')){
            $errores.="<tr><td>Otros Servicios - Tipo de servicio - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->codTecnologiaSalud) and empty($this->codTecnologiaSalud)){
            $errores.="<tr><td>Otros Servicios - Código de la tecnología - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->conceptoRecaudo) and !existeTipo($this->conceptoRecaudo,'H1')){
            $errores.="<tr><td>Otros Servicios - Concepto de recaudo - Registro ".$this->consecutivo." </td><tr>";
        }        

        return($errores);
    }
}

class Urgencia{
    public $codPrestador;
    public $fechaInicioAtencion;
    public $causaMotivoAtencion;
    public $codDiagnosticoPrincipal;
    public $codDiagnosticoPrincipalE;
    public $codDiagnosticoRelacionadoE1;
    public $codDiagnosticoRelacionadoE2;
    public $codDiagnosticoRelacionadoE3;
    public $condicionDestinoUsuarioEgreso;
    public $codDiagnosticoCausaMuerte;
    public $fechaEgreso;
    public $consecutivo;

    public function validar(){
        $errores="";
        if(isset($this->fechaInicioAtencion) and strlen($this->fechaInicioAtencion) < 16){
            $errores.="<tr><td>Urgencias - Fecha y hora de inicio de atención - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->causaMotivoAtencion) and !existeTipo($this->causaMotivoAtencion,'G8')){
            $errores.="<tr><td>Urgencias - Causa motivo de atención - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoPrincipal) and strlen($this->codDiagnosticoPrincipal) < 4){
            $errores.="<tr><td>Urgencias - El diagnóstico principal no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->codDiagnosticoPrincipalE) and strlen($this->codDiagnosticoPrincipalE) < 4){
            $errores.="<tr><td>Urgencias - El diagnóstico principal de egreso no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";            
        }
        //$this->codDiagnosticoRelacionadoE1='66';
        if(isset($this->codDiagnosticoRelacionadoE1) and strlen($this->codDiagnosticoRelacionadoE1) < 4){
            $errores.="<tr><td>Urgencias - El diagnóstico relacionado 1 de egreso no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->codDiagnosticoRelacionadoE2) and strlen($this->codDiagnosticoRelacionadoE2) < 4){
            $errores.="<tr><td>Urgencias - El diagnóstico relacionado 2 de egreso no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";            
        }        
        if(isset($this->codDiagnosticoRelacionadoE3) and strlen($this->codDiagnosticoRelacionadoE3) < 4){
            $errores.="<tr><td>Urgencias - El diagnóstico relacionado 3 de egreso no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->condicionDestinoUsuarioEgreso) and !existeTipo($this->condicionDestinoUsuarioEgreso,'H3')){
            $errores.="<tr><td>Urgencias - Condicion y destino del usuario - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->codDiagnosticoCausaMuerte) and strlen($this->codDiagnosticoCausaMuerte) < 4){
            $errores.="<tr><td>Urgencias - El diagnóstico de la causa de muerte no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->fechaEgreso) and strlen($this->fechaEgreso) < 16){
            $errores.="<tr><td>Urgencias - Fecha y hora de egreso - Registro ".$this->consecutivo." </td><tr>";            
        }

        return($errores);
    }
}

class Hospital{
    public $codPrestador;
    public $viaIngresoServicioSalud;
    public $fechaInicioAtencion;
    public $numAutorizacion;
    public $causaMotivoAtencion;
    public $codDiagnosticoPrincipal;
    public $codDiagnosticoPrincipalE;
    public $codDiagnosticoRelacionadoE1;
    public $codDiagnosticoRelacionadoE2;
    public $codDiagnosticoRelacionadoE3;
    public $codComplicacion;
    public $condicionDestinoUsuarioEgreso;
    public $codDiagnosticoCausaMuerte;
    public $fechaEgreso;
    public $consecutivo;

    public function validar(){
        $errores="";        
        if(isset($this->viaIngresoServicioSalud) and !existeTipo($this->viaIngresoServicioSalud,'H2')){
            $errores.="<tr><td>Hospitalización - Via de ingreso al servicio - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->fechaInicioAtencion) and strlen($this->fechaInicioAtencion) < 16){
            $errores.="<tr><td>Hospitalización - Fecha y hora de inicio de atención - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->causaMotivoAtencion) and !existeTipo($this->causaMotivoAtencion,'G8')){
            $errores.="<tr><td>Hospitalización - Causa motivo de atención - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoPrincipal) and strlen($this->codDiagnosticoPrincipal) < 4){
            $errores.="<tr><td>Hospitalización - El diagnóstico principal no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoPrincipalE) and strlen($this->codDiagnosticoPrincipalE) < 4){
            $errores.="<tr><td>Hospitalización - El diagnóstico principal de egreso no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoRelacionadoE1) and strlen($this->codDiagnosticoRelacionadoE1) < 4){
            $errores.="<tr><td>Hospitalización - El diagnóstico relacionado 1 de egreso no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codDiagnosticoRelacionadoE2) and strlen($this->codDiagnosticoRelacionadoE2) < 4){
            $errores.="<tr><td>Hospitalización - El diagnóstico relacionado 2 de egreso no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->codDiagnosticoRelacionadoE3) and strlen($this->codDiagnosticoRelacionadoE3) < 4){
            $errores.="<tr><td>Hospitalización - El diagnóstico relacionado 3 de egreso no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->codComplicacion) and strlen($this->codComplicacion) < 4){
            $errores.="<tr><td>Hospitalización - El diagnóstico de la complicación no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->condicionDestinoUsuarioEgreso) and !existeTipo($this->condicionDestinoUsuarioEgreso,'H3')){
            $errores.="<tr><td>Hospitalización - Condicion y destino del usuario - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->codDiagnosticoCausaMuerte) and strlen($this->codDiagnosticoCausaMuerte) < 4){
            $errores.="<tr><td>Hospitalización - El diagnóstico de la causa de muerte no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->fechaEgreso) and strlen($this->fechaEgreso) < 16){
            $errores.="<tr><td>Hospitalización - Fecha y hora de egreso - Registro ".$this->consecutivo." </td><tr>";            
        }
        
        return($errores);
    }
}

class recienNacido{
    public $codPrestador;
    public $tipoDocumentoIdentificacion;
    public $numDocumentoIdentificacion;
    public $fechaNacimiento;
    public $edadGestacional;
    public $numConsultasCPrenatal;
    public $codSexoBiologico;
    public $peso;
    public $codDiagnosticoPrincipal;
    public $condicionDestinoUsuarioEgreso;
    public $codDiagnosticoCausaMuerte;
    public $fechaEgreso;
    public $consecutivo;

    public function validar(){
        $errores="";        
        if(isset($this->tipoDocumentoIdentificacion) and !existeTipo($this->tipoDocumentoIdentificacion,'E3')){
            $errores.="<tr><td>Recien Nacidos - Tipo de documento de identificación - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->numDocumentoIdentificacion) and strlen($this->numDocumentoIdentificacion) < 4){
            $errores.="<tr><td>Recien Nacidos - El número de identificación no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->fechaNacimiento) and strlen($this->fechaNacimiento) < 16){
            $errores.="<tr><td>Recien Nacidos - Fecha y hora de nacimiento - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->edadGestacional) and (intval($this->edadGestacional) < 20 or intval($this->edadGestacional) > 40)){
            $errores.="<tr><td>Recien Nacidos - La edad gestacional debe estar entre 20 y 40 - Registro ".$this->consecutivo." </td><tr>";
        }
        if(isset($this->codSexoBiologico) and !existeTipo($this->codSexoBiologico,'H9')){
            $errores.="<tr><td>Recien Nacidos - Sexo - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->peso) and (intval($this->peso) < 500 or intval($this->peso) > 5000)){        
            $errores.="<tr><td>Recien Nacidos - El peso debe estar entre 500 y 5000 gramos - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->codDiagnosticoPrincipal) and strlen($this->codDiagnosticoPrincipal) < 4){
            $errores.="<tr><td>Recien Nacidos - El diagnóstico principal no debe ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";
        }        
        if(isset($this->condicionDestinoUsuarioEgreso) and !existeTipo($this->condicionDestinoUsuarioEgreso,'H3')){
            $errores.="<tr><td>Reien Nacidos - Condicion y destino del usuario - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->codDiagnosticoCausaMuerte) and strlen($this->codDiagnosticoCausaMuerte) < 4){
            $errores.="<tr><td>Recien Nacidos - El diagnóstico de la causa de muerte no puede ser menor a 4 caracteres - Registro ".$this->consecutivo." </td><tr>";            
        }
        if(isset($this->fechaEgreso) and strlen($this->fechaEgreso) < 16){
            $errores.="<tr><td>Recien Nacidos - Fecha y hora de egreso - Registro ".$this->consecutivo." </td><tr>";            
        }

        return($errores);
    }
}

function existeTipo($valor_,$grupo_){
    $existe = false;
    $consultatipo = "SELECT valo_des FROM destipos WHERE codt_des='$grupo_' AND valo_des='$valor_'";
    $consultatipo = mysql_query($consultatipo);
    if(mysql_num_rows($consultatipo) <> 0){
        $existe = true;
    }
    return ($existe);
}

function existePais($valor_){
    $existe = false;
    $consultapais = "SELECT codigo FROM pais WHERE codigo='$valor_'";    
    $consultapais = mysql_query($consultapais);
    if(mysql_num_rows($consultapais) <> 0){
        $existe = true;
    }
    return ($existe);
}

function existeMunicipio($valor_){
    $existe = false;
    $consultamun = "SELECT CODI_MUN FROM municipio WHERE CODI_MUN='$valor_'";
    $consultamun = mysql_query($consultamun);
    if(mysql_num_rows($consultamun) <> 0){
        $existe = true;
    }
    return ($existe);
}

?>    

</form>
</body>
</html>
