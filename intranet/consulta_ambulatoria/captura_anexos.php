<?php
session_register('paciente');
session_register('Gareanh');
session_register('datos');
session_register('Gcontratonh');
session_register('numcita');
session_register('Gcod_mediconh'); 
//ECHO $Gcontratonh;
if(empty($paciente)){
    echo"<br><br><table align=center class='tbl'>
    <tr><th>POR SEGURIDAD SU SESIÓN SE CERRO. CIERRE E INGRESE NUEVAMENTE AL PROGRAMA</th></tr>
    </table>";
    exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="style.css" type="text/css"/>
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
<script type="text/javascript" src="js/jquery.js"></script>

<script languaje='JavaScript'>
function muestralabelref(){    
    if(document.form1.tipo_ref.value=='R'){
        document.getElementById('resumen').value = 'Diligencie en el orden indicado: El resumen de anamnesis y examen físico, fecha y resultado de examenes auxiliares de diagnóstico, resumen de la evolucion, diagnóstico, complicaciones, tratamientos aplicados y motivos de remisión.'
    }
    if(document.form1.tipo_ref.value=='C'){
        document.getElementById('resumen').value = 'Diligencie en el orden indicado: Fecha de inicio de atención, fecha de alta o finalización, resumen de la evolucion, fecha y resultados de examenes de apoyo diagnóstico realizados, diagnóstico, complicaciones, tratamientos empleados, pronóstico y recomendaciones.'
    }
    if(document.form1.tipo_ref.value==''){
        document.getElementById('resumen').value = ''
    }
}

function traeresumen(referen_,contraref_){    
    if(document.form1.chktraeres.checked==true){
        //alert(referen_+contraref_)
        //alert(document.form1.tipo_ref.value);
        if(document.form1.tipo_ref.value=='R'){
            document.getElementById('resumen').value = referen_;
        }
        if(document.form1.tipo_ref.value=='C'){
            document.getElementById('resumen').value = contraref_;
        }
    }
}

function validar(){
var error="";
var resumen = document.getElementById('resumen').value;
    if(document.form1.tipo_ref.value==""){
        error=error+"Seleccionar el tipo \n";
    }
    if(resumen==""){
        error=error+"LLenar la información clinica relevante \n";
    }
    if(error!=""){
        alert("Para Guardar debe:\n"+error);
        return(false);
    }
    else{
        document.form1.action='almacena.php';
        document.form1.target='';
        document.form1.submit();
    }
}
</script>

</head>	
<body onload='mensa()'>
<form name=form1 method=post>
<?php
echo "<center><table align=center width=80%>";
include ('php/conexion1.php');
echo"<TR><TD>
<table align=center class='tbl' width=100%>
<tr><th>CONDUCTA REFERENCIA / CONTRAREFERENCIA</th></tr>
</table>
<input type=hidden name=codiprg value='13'>
<br><br>";

echo "<table align=center class='tbl' width=100%>";
$archivo='tmp/13HC'.$numcita.'-'.$paciente.'.txt';
//echo $archivo;
if(file_exists($archivo)){
    $fp = fopen ($archivo, "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ){
        $reg++;
        $i = 0;
        foreach($data as $dato){
            $campo[$i]=$dato;            
            $i++ ;
        }        
        $$campo[1]=$campo[2];
        //echo "<br>".$campo[1]." ".$campo[2];
        if(strlen($codorden)==4){
            $campo1_=$campo[1]."ref";
            $$campo1_=$campo[2];            
        }        			
    }
}
ECHO"</TABLE>";

$archivo='tmp/1HC'.$numcita.'-'.$paciente.'.txt';    
if(file_exists($archivo)){
    $fp = fopen ($archivo, "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ){ 
        $reg++;
        $i = 0;
        foreach($data as $dato){
            $campo[$i]=$dato;
            $i++ ;
        }
        $$campo[1]=$campo[2];
        //echo "<br> ".$campo[1]." ".$campo[2];
    }
}

$archivo='tmp/3HC'.$numcita.'-'.$paciente.'.txt';		
if(file_exists($archivo)){
    $fp = fopen ($archivo, "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ){ 
        $reg++;
        $i = 0;
        foreach($data as $dato){
            $campo[$i]=$dato;
            $i++ ;
        }
        $$campo[1]=$campo[2];
        //echo "<br>".$campo[1]." ".$campo[2];
    }
}

$archivo='tmp/4HC'.$numcita.'-'.$paciente.'.txt';	
if(file_exists($archivo)){
    $fp = fopen ($archivo, "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ){ 
        $reg++;
        $i = 0;
        foreach($data as $dato){
            $campo[$i]=$dato;
            $i++ ;
        }
        $$campo[1]=$campo[2];
        //echo "<br>".$campo[1]." ".$campo[2];
    }
}

$medicam="";
$archivo='tmp/6HC'.$numcita.'-'.$paciente.'.txt';	
if(file_exists($archivo)){
    $fp = fopen ($archivo, "r" );
    $reg=0;    
    while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ){        
        $i = 0;
        foreach($data as $dato){
            $campo[$i]=$dato;
            $i++ ;
        }
        $$campo[1]=$campo[2];
        //echo "<br>".$campo[1]." ".$campo[2];
        if($campo[1]=='desmedi'){            
            $medicam=$medicam.$desmedi.", ";
        }
    }
}

$archivo='tmp/8HC'.$numcita.'-'.$paciente.'.txt';	
if(file_exists($archivo)){
    $fp = fopen ($archivo, "r" );
    $reg=0;
    while (( $data = fgetcsv ( $fp , 0 , "|" )) !== FALSE ){ 
        $reg++;
        $i = 0;
        foreach($data as $dato){
            $campo[$i]=$dato;
            $i++ ;
        }
        $$campo[1]=$campo[2];
        //echo "<br>".$campo[1]." ".$campo[2];            			
    }
}
	
echo "<table align=center class='tbl' width=100%>";
echo"<tr>";
echo"<th align=center>DIAGNOSTICO</th>";
echo"<th>CODIGO</th>";
echo"<th>DESCRIPCION</th>";

$consultamag="SELECT REGMAG_CON FROM contrato WHERE CODI_CON='$Gcontratonh'";
$consultamag=mysql_query($consultamag);
$rowmag=mysql_fetch_array($consultamag);
$regmag_con=$rowmag[REGMAG_CON];

if($regmag_con=='S')
    echo"<th>DESTINO</th>";
echo "<th>OBSERVACION</th>";
if($Gareanh=='04'){
    echo"<th>CAMA</th>";}
echo"</tr>";

echo"<tr>
<td align=center>$diagordenref</td>
<td align=center>$codordenref</td>
<td>$desordenref</td>";
if($Gcontratonh=='002')echo"<td>$nivelref-$claseordenref</td>";
echo "<td>$obseordenref</td>";
if($Gareanh=='04'){
    echo"<td align=center>$camaref</td>";
}
echo"</tr>";
echo"</table>";

$inforef="Motivo de consulta: ".$motivo;
$inforef=$inforef.", Enfermedad Actual: ".$enfeac;
$inforef=$inforef.", Revisión por sistemas: ".$revisi;
$inforef=$inforef.", Tensión Arterial: ".$tenar1."/".$tenar2;
$inforef=$inforef.", Frecuencia Respiratoria: ".$freres;
$inforef=$inforef.", Frecuencia Cardiaca: ".$fc;
$inforef=$inforef.", Temperatura: ".$tempe;
$inforef=$inforef.", Peso: ".$peso;
$inforef=$inforef.", Talla: ".$talla;
$inforef=$inforef.", IMC: ".$imc;
$inforef=$inforef.", Cintura: ".$cintura;
$inforef=$inforef.", Cadera: ".$cadera;
$inforef=$inforef.", ICC: ".$icc;

$conshall="SELECT COUNT(codi_des) AS items from destipos where codt_des='10'";
$conshall=mysql_query($conshall);
$rowha=mysql_fetch_array($conshall);
for($cont=0;$cont<$rowha[items];$cont++){
    $nomvar='item'.$cont;
    //echo "<br>".$nomvar." ".$$nomvar;
    if($$nomvar==1){
        $nomvar='codiexa'.$cont;        
        $codigo=$$nomvar;        
        $condes="SELECT nomb_des from destipos where codi_des='$codigo'";
        $condes=mysql_query($condes);
        $rowdes=mysql_fetch_array($condes);
        $nomvar="obseexa".$cont;
        $inforef=$inforef.", ".$rowdes[nomb_des].": ".$$nomvar;
    }    
}

$inforef=$inforef.", Otros Hallazgos en el Examen Físico: ".$otros;
$inforef=$inforef.". Informe de Paraclinicos:".$informe;
$inforef=$inforef.", Análisis: ".$analpv;
$inforef=$inforef.", Diagnóstico: ".$diagordenref." ".$map;
$inforef=$inforef.", Medicamentos: ".$medicam;

$infocontref="Fecha de inicio de la atención: /  /    ";
$hoy=date("d").'/'.date("m").'/'.date("Y");
$infocontref=$infocontref.", Fecha de alta de la atención: ".$hoy;
$infocontref=$infocontref.", Análisis: ".$analpv;
$infocontref=$infocontref.". Informe de Paraclinicos:".$informe;
$infocontref=$infocontref.", Diagnóstico: ".$diagordenref." ".$map;
$infocontref=$infocontref.", Medicamentos: ".$medicam;
$infocontref=$infocontref.", Pronóstico y Recomendaciones: ".$recom;

//echo "<br><br>".$inforef;
//echo "<br><br>".$infocontref;
?>
<br>
<table align=center class='tbl' width=100%>    
    <tr>
        <th align=right>Tipo:</th>   
        <td><select class='caja' name='tipo_ref' onchange='muestralabelref()'>
            <option value=''></option>            
            <option value='R'>Referencia</option>
            <option value='C'>Contrareferencia</option>
            </select>            
        </td>
    </tr>
    <tr>
        <th align=right>Información Clinica Relevante:            
        </th>
        <td><label id='descripcion'>            
            </label>
            <textarea id='resumen' name='resumen' cols='150' rows="10"></textarea>
            <br><br><input type="checkbox" id="chktraeres" onclick='traeresumen("<?php echo $inforef;?>","<?php echo $infocontref;?>")'>Traer información
        </td>
    </tr>
</table>
<script language="JavaScript">
    document.form1.tipo_ref.value='<?php echo $tipo_ref;?>';
    document.form1.resumen.value='<?php echo $resumen;?>';
</script>
<br>
<table align=center class='tbl' width=100%>
    <tr><th colspan=2 align=center valign=top height=30><a ><INPUT type=button class='boton' value=Guardar registro onClick='validar()'></th></tr>
</table>
</body>
</form>
</html>
