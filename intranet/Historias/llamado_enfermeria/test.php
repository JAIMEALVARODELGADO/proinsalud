<?php    
    include("consulta.php");
    $conecta=conexion2();
    $nuevoarray=crear_array('04');
    var_dump($nuevoarray); 
    
	
//-------------------------DATOS DE LA APLICACION-------------------------------------- 	
//	ruta 	http://192.168.4.20/intraweb/intranet/Historias/llamado_enfermeria/test.php
	
//	carpera		 		llamado_enfermeria;
//	script funciones 	consulta.php;
//	script de llamado	test.php;
	
//	Codigo de Areas a buscar
//	Urgencias 				'04'
//	Uci						'0649'
//	Hospitalizacion piso 1	'0680'
//	Hospitalizacion Piso 2	'0681'
//	Hospitalizacion Piso 4	'0682'
//	Ginecologia				'0646'
//-------------------------------------------------------------------------------------	
	

?>