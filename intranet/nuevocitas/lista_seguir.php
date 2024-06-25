<?
session_start();
    $usucitas=$_SESSION['usucitas'];
foreach($_POST as $nombre_campo => $valor)
{ 
   $asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   eval($asignacion); 
} 
?>
<html>
<head>

    <link rel="stylesheet" href="style.css" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type='text/javascript' src='js/jquery.autocomplete.js'></script>
    <script type="text/javascript">
$().ready(function() 
    {			

        $("#course2").autocomplete("auto_nomusu.php", {
        minChars: 3,
        max: 150,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220			
        });
        $("#course2").result(function(event, data, formatted) {
        $("#course_val2").val(data['1']);
        $("#course_cod2").val(data['2']);
        });

    });
/*	
$().ready(function() 
    {			

        $("#course_val2").autocomplete("auto_codusu.php", {
        minChars: 3,
        max: 150,
        autoFill: false,
        mustMatch: false,
        matchContains: false,
        scroll: true,
        scrollHeight: 220			
        });
        $("#course_val2").result(function(event, data, formatted) {
        $("#course2").val(data['1']);
        $("#course_cod2").val(data['2']);
        });

    });
*/	
    </script>

<script language="javascript">
	function salir()
	{                
            destino=uno.opcimenu.value;
            uno.action=destino;
            uno.target='top';
            uno.submit();			
	}
        function cambia(n)
        {
            if(n==1)
            {
                if (event.keyCode == 13 && uno.cedusu.value!='')
                { 

                    uno.target='';
                    uno.action='lista_seguir.php';
                    uno.submit();

                }
            }
            if(n==3)
            {
                uno.nomusu.value=='';
                
            }
            if(n==2)
            {
                uno.cedusu.value=='';
                
            }
        }
        
	
</script>
</head>
<body lang=ES style='tab-interval:35.4pt'>
<style>
#conte {
overflow:auto;
height: 300px;
width: 1000px;
padding:5px;
margin:0 auto;
background-color: #FFFFFF;
font-size: 8px;
}
.margen_izq {
margin-left:10px;
}
</style> 
<?	
    //onload="setScrollPos('conte')"
    if(empty($usucitas))
    {
        echo" <table align=center class='tbl'>
        <tr><th>POR SEGURIDAD SU SESION SE CERRO</th></tr>
        </table>";
        exit;
    }    
    include ('php/conexion1.php');
	
	if(!empty($cedusu))
	{
		$busu = mysql_query("select CODI_USU AS codunico, NROD_USU AS cedula, CONCAT(PNOM_USU,' ',SNOM_USU,' ',PAPE_USU,' ',SAPE_USU)  AS nombre FROM usuario where NROD_USU = '$cedusu'");
		while($rusu=mysql_fetch_array($busu))
		{
			$codunico=$rusu['codunico'];
			$nomusu=$rusu['nombre'];
		}
	}
	
	
    $busgru=mysql_query("SELECT * FROM grupos Order By nomb_gru");	//grupos
    echo"<form name=uno method=post>
    <table align=center class='tbl' width=50%>
    <tr><th colspan=3 height=40>SEGUIMIENTO DE CITAS POR USUARIO</th></tr>
    <tr>
    <th height=30>USUARIO</th>
    <input type=hidden id='course_cod2' name='codunico' value=$codunico>
    <td><input type=text id='course_val2' class='caja' name='cedusu' size='20' onKeydown='cambia(2)' onKeyup='cambia(1)' value='$cedusu'></td>
    <td><input type=text id='course2' class='caja' name='nomusu' size=70 onKeydown='cambia(3)' onKeyup='cambia(1)' value='$nomusu'></td>	
    </tr>
    </table><br>";
    
    if($cedusu!='')
    {        
        $busu=mysql_query("SELECT usuario.NROD_USU, usuario.CODI_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, usuario.DIRE_USU, usuario.TRES_USU, usuario.TEL2_USU
        FROM usuario
        WHERE (((usuario.NROD_USU)='$cedusu'))");
		if(mysql_num_rows($busu)>0)
        {
            while($rusu=mysql_fetch_array($busu))
            {
                $codusu=$rusu['CODI_USU'];
                $cedula=$rusu['NROD_USU'];
                $nombre=$rusu['PNOM_USU'].' '.$rusu['SNOM_USU'].' '.$rusu['PAPE_USU'].' '.$rusu['SAPE_USU'];
                $dire=$rusu['DIRE_USU'];
                $tel1=$rusu['TRES_USU'];
                $tel2=$rusu['TEL2_USU'];
            }
            echo"
            <table align=center class='tbl' width=50%>
            <tr><th colspan=2>nombre: $nombre</th></tr>
            <tr><th>Direccion: $dire</th>
            <th>Telefonos: $tel1 - $tel2</th>
            </tr>
            </table>
            <br><br>
            ";
            $busca=mysql_query("SELECT citas.tipo_consulta, citas.Idusu_citas, contrato.NEPS_CON, medicos.nom_medi, horarios.Fecha_horario, horarios.Hora_horario, vitacora.Operacio_Vitaco, vitacora.Fopera_Vitaco, vitacora.Hopera_Vitaco, vitacora.Cod_oper_vitaco, vitacora.Nota_Vitaco, areas.nom_areas, vitacora.cmed_horario AS med, vitacora.cserv_horario AS cser, vitacora.fecha_horario AS fhor, vitacora.hora_horario AS hhor, citas.conc_cita, citas.obse_cita
			FROM ((((horarios RIGHT JOIN citas ON horarios.ID_horario = citas.ID_horario) LEFT JOIN medicos ON horarios.Cmed_horario = medicos.cod_medi) INNER JOIN vitacora ON citas.id_cita = vitacora.Codci_Vitaco) LEFT JOIN areas ON horarios.Cserv_horario = areas.cod_areas) INNER JOIN contrato ON citas.Cotra_citas = contrato.CODI_CON
			WHERE (((citas.Idusu_citas)='$codusu'))
			ORDER BY vitacora.Fopera_Vitaco DESC");
            if(mysql_num_rows($busca)>0)
            {                
                echo"
                <table align=center> 
                <tr><td>
                <div id='conte'>
                <table align=center class='tbl' width=100%>
                <tr>
                <th>MEDICO</th>
                <th>AREA</th>
                <th>ACCION</th>
                <th>FECHA CITA</th>
                <th>HORA CITA</th>
                <th>FECHA ACCION</th>
                <th>HORA ACCION</th>
                <th>OPERADOR</th>				
                <th>NOTA</th>
				<th>CONCESION</th>
				<th>TIPO CONSULTA</th>
				<th>OBSERVACION</th>
                </tr>
                ";
                while($rbus=mysql_fetch_array($busca))
                {					
					//$numcit=$rbus['Codci_Vitaco'];					
					$contra=$rbus['NEPS_CON']; 
                    $medico=$rbus['nom_medi'];
                    $fechahor=$rbus['Fecha_horario'];
                    $horahor=$rbus['Hora_horario'];
                    $accion=$rbus['Operacio_Vitaco'];
                    $fechaope=$rbus['Fopera_Vitaco'];
                    $horaope=$rbus['Hopera_Vitaco'];
                    $usuaope=$rbus['Cod_oper_vitaco'];
                    $nota=$rbus['Nota_Vitaco'];
                    $nomarea=$rbus['nom_areas'];
					$conci=$rbus['conc_cita'];
					$obseconci=$rbus['obse_cita'];
					$tipocon=$rbus['tipo_consulta'];
					
					
					include ('php/conexion1.php');					
					
					$bcon=mysql_query("select * from destipos where codi_des='$conci'");
					$rcon=mysql_fetch_array($bcon);
					$concilia=$rcon['nomb_des'];
					
					if(empty($medico))
					{
						$cmed=$rbus['med'];
						$bmed=mysql_query("select * from medicos where cod_medi ='$cmed'");
						$rmed=mysql_fetch_array($bmed);
						$medico=$rmed['nom_medi'];	
					}
					if(empty($fechahor))$fechahor=$rbus['fhor'];
					if(empty($horahor))$horahor=$rbus['hhor'];
					
					if(empty($nomarea))
					{
						$cser1=$rbus['cser'];						
						$bser=mysql_query("select * from areas where cod_areas='$cser1'");
						$rser=mysql_fetch_array($bser);
						$nomarea=$rser['nom_areas'];						
					}                    
                    include ('php/conexion.php');
                    $bope=mysql_query("select * from cut where ide_usua='$usuaope'");
                    while($rope=mysql_fetch_array($bope))
                    {
                        $usuaope=$rope['nomb_usua'];
                    }                    
                    ECHO"<tr>
                    <td>$medico</th>
                    <td>$nomarea</th>
                    <td>$accion</th>
                    <td>$fechahor</th>
                    <td>$horahor</th>
                    <td>$fechaope</th>
                    <td>$horaope</th>
                    <td>$usuaope</th>
                    <td>$nota</th>";
					if($accion=="Create_Cit")
					{	
						echo"<td>$concilia</th>
						<td align=center>$tipocon</th>
						<td>$obseconci</th>";
						
					}
					else
					{	
						echo"<td></th>
						<td></th>";						
					}
                    echo"</tr>";
                }
                ECHO"</TABLE>                 
                </div></td></tr></table>";
            }
            else
            {
                echo"
                <table align=center class='tbl' width=100%>
                <tr><th colspan=2 height=40>NO EXISTEN CITAS ASIGNADAS</th></tr>            
                </tr>
                </table>";
            }
        }
        else
        {
            echo"
            <table align=center class='tbl' width=100%>
            <tr><th colspan=2 height=40>USUARIO NO REGISTRADO</th></tr>            
            </tr>
            </table>";
        }
    }
    echo"
</table>
     </table>
     </form>";
?>
</body>
</html>