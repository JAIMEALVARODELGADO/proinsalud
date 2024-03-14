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
    <tr><td>Lista de errores</td></tr>
    <?php echo $errores;?>
</table>


<br>
<textarea name="json" id="json" hidden="true">
<?php echo $ripsJson;?>
</textarea>
<div align="center">
    <input type="button" class='BtnGuardar' id="guardaArchivo" value="Guardar Json" onclick="saveTextAsFile('<?php echo $nombreArchivo;?>')" />
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
        if(isset($this->tipoDocumento)){
            $errores.="<tr><td>Usuario - Tipo de documento de identificación </td><tr>";
        }
        if(!isset($this->$numDocumentoIdentificacion)){
            $errores.="<tr><td>Usuario - Número de documento de identificación </td><tr>";
        }
        if(!isset($this->$tipoUsuario)){
            $errores.="<tr><td>Usuario - Tipo de usuario </td><tr>";
        }
        /*if(this->$fechaNacimiento){
            $errores="";
        }
        if(this->$codSexo){
            $errores="";
        }
        if(this->$codPaisResidencia){
            $errores="";
        }
        if(this->$codMunicipioResidencia){
            $errores="";
        }
        if(this->$codZonaTerritorialResidencia){
            $errores="";
        }
        if(this->$incapacidad){
            $errores="";
        }
        if(this->$consecutivo){
            $errores="";
        }
        if(this->$codPaisOrigen){
            $errores="";
        }
        if(this->$servicios){
            $errores="";
        }*/
        
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
}

?>    

</form>
</body>
</html>
