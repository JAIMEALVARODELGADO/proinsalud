<?

//////////////////////////////////////////////////
//////////funciones para el trabajo con mysql//////////
//////////////////////////////////////////////////
   
//función para conectar con mysql y seleccionar la base de datos
FUNCTION conectar_bd() {
	IF(!($conexion=mysql_connect("localhost", "root", ""))) {
		die("MySql no responde");
	}
    IF(!mysql_select_db(base_de_datos)) {
		die("No se puede seleccionar la base de datos");
	}
    RETURN $conexion;
}
   
//función que nos desconecta del mysql
FUNCTION desconectar_bd() {
	mysql_close();
}

/////////////////////////////////////////////////
//////////////Funciones varias/////////////////////
/////////////////////////////////////////////////

//función para formatear fechas a ingresar a capturar
FUNCTION formatear_fecha($fec1){
	$sep='-';
	$d=SUBSTR($fec1,0,2);
	$m=SUBSTR($fec1,3,2);
	$a=SUBSTR($fec1,6,4);
	$fec2=$a.$sep.$m.$sep.$d;
	RETURN $fec2;
}

//generar selects dinamicos de cualquier tabla, 
//$t:tabla, $c1: campo del value,  $c2: campo que se muestra, $o: orden de los elementos
//$vd: valor por defecto, $nom: nombre del select, $f: nombre del formulario
//valores opcionales $cp: campo de parametro, $p: parametro 
//para el llamado de la funcion usar: lista($t, $c1, $c2, $o, $vd, $nom, $cp, $p) con todos los parametros
//o usar esta con lo basico: lista($t, $c1, $c2, $o, $vd, $nom, $f)

FUNCTION lista($t, $c1, $c2, $o, $vd, $nom, $cp, $p, $f){
	IF ($cp!='1'){
		$xsql="SELECT $c1, $c2 FROM $t WHERE $cp='$p' ORDER BY '$o'";
	}ELSE{
		$xsql="SELECT $c1, $c2 FROM $t ORDER BY $o";
	}
	$xres=mysql_query($xsql);
	IF ($f){
		ECHO "<select name=".$nom." OnChange=$f.submit()>";
	}ELSE{
		ECHO "<select name=".$nom.">";
	}
	WHILE ($xrow=mysql_fetch_row($xres)) {
		IF ($xrow[0]==$vd){
			ECHO "<option value=".$xrow[0]." SELECTED>".$xrow[1]."</option>";
		}ELSE{
			ECHO "<option value=".$xrow[0].">".$xrow[1]."</option>";
		}
	}
	ECHO "</select>";
	mysql_free_result($xres);
}

?>

