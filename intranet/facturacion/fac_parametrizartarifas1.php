<html>
<head>
<title>PROGRAMA DE FACTURACIÓN</title>

<!--Hoja de estilos del calendario --> 
<link rel="stylesheet" type="text/css" media="all" href="java/calendar/calendar-green.css" title="win2k-cold-1" /> 

<!-- librer�a principal del calendario --> 
<script type="text/javascript" src="java/calendar/calendar.js"></script> 

<!-- librer�a para cargar el lenguaje deseado --> 
<script type="text/javascript" src="java/calendar/lang/calendar-es.js"></script> 

<!-- librer�a que declara la funci�n Calendar.setup, que ayuda a generar un calendario en unas pocas l�neas de c�digo --> 
<script type="text/javascript" src="java/calendar/calendar-setup.js"></script> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<SCRIPT LANGUAGE='JavaScript'>

function leerArchivo() {
    // Obtener el elemento input de tipo file
    var fileInput = document.getElementById('archivo');
    
    // Verificar si hay un archivo seleccionado
    if (!fileInput.files || fileInput.files.length === 0) {
        alert('Por favor selecciona un archivo.');
        return;
    }
    
    // Obtener el primer archivo seleccionado
    var file = fileInput.files[0];    
    
    // Crear un objeto FileReader
    var reader = new FileReader();
    
    // Definir la función que se ejecutará cuando se complete la lectura del archivo
    reader.onload = function(event) {
        // Obtener el contenido del archivo como texto
        var fileContent = event.target.result;
        //alert(fileContent);
        // Procesar el contenido del archivo y convertirlo en un arreglo de objetos
        var dataArray = processData(fileContent);
        
        // Enviar el arreglo de objetos por AJAX a PHP        
        parametrizar(dataArray)
    };
    
    // Leer el contenido del archivo como texto
    reader.readAsText(file);
}

function processData(fileContent) {
    // Dividir el contenido del archivo en líneas
    var lines = fileContent.split('\n');
    
    var dataArray = [];
    
    // Procesar cada línea del archivo
    lines.forEach(function(line) {
        // Dividir la línea en partes (si es necesario)
        var parts = line.split(',');
        
        // Crear un objeto con los datos de la línea y agregarlo al arreglo
        var dataObject = {
            // Suponiendo que cada línea tiene dos partes: nombre y edad
            Codigo: parts[0],
            Tipo: parts[1],
            Grupo: parts[2],
            Clase: parts[3],            
            Valor: parseInt(parts[4])
        };
        
        dataArray.push(dataObject);
    });
    //console.log(dataArray);
    return dataArray;
}



function parametrizar(dataArray){
	//alert();
	//console.log(listaItems);
    //var archivo = document.getElementById("archivo").value;    
    //console.log(dataArray);

    $.ajax({			
            url: 'fac_parametrizartarifas.php', // Ruta al script PHP
            type: 'POST', // Método de envío de datos			
            data: { 'contenido': dataArray,
                    'iden_ctr':  document.getElementById("iden_ctr").value},            
            beforeSend: function() {
                // Este código se ejecuta antes de enviar la petición
                // Puedes generar tu mensaje aquí
                document.getElementById("mensaje").style.display = "block";
                $('#mensaje').text('Procesando...');
            },
            success: function(response) { // Función que se ejecuta si la solicitud es exitosa
                //console.log(response); // Imprime la respuesta del servidor en la consola				
                $('#mensaje').text(response);
                document.getElementById("mensaje").style.display = "none";
                $('#estado').text(response);
                //recargar();
            },
            error: function(jqXHR, textStatus, errorThrown) { // Función que se ejecuta si hay un error
                console.error(textStatus, errorThrown); // Imprime el error en la consola
            }
        });
}

</script>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<form name="form1" method="POST" action="" target='fr02'>
<?php
include('php/conexion.php');
$iden_ctr = $_GET['iden_ctr'];
$codi_con = $_GET['codi_con'];

//Aqui se consula el nombre del contrato
$consultacontrato = "SELECT c.neps_con, cc.nume_ctr 
FROM contrato c 
INNER JOIN contratacion cc ON cc.codi_con = c.CODI_CON  
WHERE cc.iden_ctr = '$iden_ctr'";
//echo "<br>".$consultacontrato;
$consultacontrato = mysql_query($consultacontrato);
$rowcont = mysql_fetch_array($consultacontrato);

?>
<body lang=ES  style='tab-interval:35.4pt'  >

<div id="mensaje" class="Caja1" style="display: none;"></div>

<table class="Tbl0">
  <tr><td class="Td0" align='center'>PARAMETRIZACION DE TARIFAS</td></tr>
</table>
<br>

<br><b>Entidad: </b> <?php echo $rowcont['neps_con'];?>
<br><b>Nro de contrato: </b> <?php echo $rowcont['nume_ctr'];?>
<table class="Tbl4" border='0'>
    <tr>
    <td class="Td2" align='right' width='20%'><b>Seleccione el archivo</b></td>
    <td class="Td2" align='left' width='15%'><input type="file" id="archivo" name="archivo" accept=".txt"></td>
    </tr>
    <tr>
    <td class="Td2" align='right' width='20%'><b></td>
    <td class="Td2" align='left' width='15%'></td>
    </tr>
</table>

<table class='Tbl2'>
    <tr>
        <td class='Td1'>
            <input type='button' value='Leer Archivo'  class='BtnGuardar' onclick='leerArchivo()'>
        </td>
    </tr>
</table>

<input type="hidden" id='iden_ctr' value='<?php echo $iden_ctr;?>'>

<div id="estado" class="Caja2">
    <p>Resultado de la parametrización
</div>

<?php
mysql_close();
?>
</form>
</body>
</html>
