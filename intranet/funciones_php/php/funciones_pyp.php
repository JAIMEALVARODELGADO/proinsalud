<?php
//funciones pyp
function conectar()
{
    $localhost = "localhost";
    $usuario   = "root";
    $pass      = "";
    $bd        = "proinsalud";
    if(!($link=  @mysql_connect($localhost, $usuario, $pass)))
    {
        echo "Error de Conexion " . mysql_error();
        exit();
    }
    if(!@mysql_select_db($bd,$link))
    {
        echo "Error al Seleccionar la Base de Datos " . mysql_error();
        exit();
    }
    return $link;
}
function CalcularEdad($fecha_de_nacimiento,$fecha_de_calculo)
{

    //$fecha_actual = date ("Y-m-d"); 	
    $array_nacimiento = explode ( "-", $fecha_de_nacimiento ); 
    $array_actual = explode ( "-", $fecha_de_calculo ); 

    $anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos aￜos 
    $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
    $dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos dￜas 

    //ajuste de posible negativo en $dￜas 
    if ($dias < 0) 
    { 
            --$meses; 
            //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual 
            switch ($array_actual[1]) 
            { 
               case 1:     $dias_mes_anterior=31; break; 
               case 2:     $dias_mes_anterior=31; break; 
               case 3:  
                            if (bisiesto($array_actual[0])) 
                            { 
                                    $dias_mes_anterior=29; break; 
                            } else { 
                                    $dias_mes_anterior=28; break; 
                            } 
               case 4:   $dias_mes_anterior=31; break; 
               case 5:   $dias_mes_anterior=30; break; 
               case 6:   $dias_mes_anterior=31; break; 
               case 7:   $dias_mes_anterior=30; break; 
               case 8:   $dias_mes_anterior=31; break; 
               case 9:   $dias_mes_anterior=31; break; 
               case 10:  $dias_mes_anterior=30; break; 
               case 11:  $dias_mes_anterior=31; break; 
               case 12:  $dias_mes_anterior=30; break; 
            } 

            $dias=$dias + $dias_mes_anterior; 
    } 

    if ($meses < 0) 
    { 
            --$anos; 
            $meses=$meses + 12; 
    } 
    $edad=array("a"=>$anos,"m"=>$meses,"d"=>$dias);

    return $edad;
}
function bisiesto($anio_actual){ 
    $bisiesto=false; 
    //probamos si el mes de febrero del aￜo actual tiene 29 dￜas 
      if (checkdate(2,29,$anio_actual)) 
      { 
            $bisiesto=true; 
    } 
    return $bisiesto; 
}
function Edad($fecha_de_nacimiento)
{
    $fecha_actual = date("Y-m-d");
    $edad = CalcularEdad($fecha_de_nacimiento, $fecha_actual);
    return $edad;
    //if($edad["m"]<10)
    //return $edad["a"] . " " . $edad["m"] . " " . $edad["d"];
}
function consultarUsuario($cod_usr,$codi_con)
{
    $link = conectar();
    $codUsua = $cod_usr;		
    if($codi_con == "")
    {
        $sql = "SELECT CODI_USU, TDOC_USU, NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU ,DIRE_USU, 
        TRES_USU, TEL2_USU, MATE_USU, NEPS_CON, TPAF_USU, CODI_CON
        FROM contrato INNER JOIN ucontrato ON contrato.CODI_CON = ucontrato.CONT_UCO
        INNER JOIN usuario ON usuario.CODI_USU = ucontrato.CUSU_UCO
        WHERE CODI_USU ='$codUsua'";         
        $resultado = mysql_query($sql,$link);
        return $resultado;
    }
    else
    {
        $sql = "SELECT CODI_USU, TDOC_USU, NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU ,DIRE_USU, 
        TRES_USU, MATE_USU, CODI_CON, NEPS_CON, TPAF_USU, CODI_CON  
        FROM contrato INNER JOIN ucontrato ON contrato.CODI_CON = ucontrato.CONT_UCO
        INNER JOIN usuario ON usuario.CODI_USU = ucontrato.CUSU_UCO
        WHERE (CODI_USU ='$codUsua') AND (contrato.CODI_CON='$codi_con')"; 
        $resultado = mysql_query($sql,$link);
        return $resultado;
    }
    mysql_close($link);
}
function CabeceraUsuario($nid_usu, $codi_con)
{
    $fecha_actual = date("Y-m-d");
    $resultado = consultarUsuario($nid_usu, $codi_con);	
    $usuario = array();    
    if(mysql_num_rows($resultado)>0)
    {        
        $rowUsuario= mysql_fetch_array($resultado);
        $edad = CalcularEdad($rowUsuario['FNAC_USU'], $fecha_actual);				

        $edad_A = $edad["a"] . " A�O(S)"; 
        $edad_M = $edad["m"] . " MES(ES)";
        $edad_D = $edad["d"] . " DIAS";    

        //CODI_USU, NROD_USU, PNOM_USU, SNOM_USU, PAPE_USU, SAPE_USU, FNAC_USU, SEXO_USU ,DIRE_USU, TRES_USU, NEPS_CON,EDAD_ANO,EDAD_MES,EDAD_DIA
        $usuario['CODI_USU']=$rowUsuario['CODI_USU'];
        $usuario['TDOC_USU']=$rowUsuario["TDOC_USU"];
        $usuario['NROD_USU']=$rowUsuario['NROD_USU'];
        $usuario['PNOM_USU']=$rowUsuario['PNOM_USU'];
        $usuario['SNOM_USU']=$rowUsuario['SNOM_USU'];
        $usuario['PAPE_USU']=$rowUsuario['PAPE_USU'];
        $usuario['SAPE_USU']=$rowUsuario["SAPE_USU"];
        $usuario['FNAC_USU']=$rowUsuario["FNAC_USU"];
        $usuario['SEXO_USU']=$rowUsuario["SEXO_USU"];
        $usuario['DIRE_USU']=$rowUsuario["DIRE_USU"];
        $usuario['MATE_USU']=$rowUsuario["MATE_USU"];    
        $usuario['TRES_USU']=$rowUsuario["TRES_USU"];
        $usuario['TEL2_USU']=$rowUsuario["TEL2_USU"];
        $usuario['NEPS_CON']=$rowUsuario["NEPS_CON"];    
        $usuario['TPAF_USU']=$rowUsuario["TPAF_USU"];
        $usuario['CODI_CON']=$rowUsuario["CODI_CON"];
        $usuario['EDAD_ANO'] = $edad_A;
        $usuario['EDAD_MES'] = $edad_M;
        $usuario['EDAD_DIA'] = $edad_D;        

        mysql_free_result($resultado);  
    }
    return $usuario;  
             
}
function consultas_adultomayor($iden)
{
    $link = conectar();
    $sql = "SELECT pyp_consultas.FECHACONS,pyp_consultas.CODCONSUL, pyp_consultas.cod_act 
		FROM pyp_consultas WHERE (pyp_consultas.cod_act ='22' OR pyp_consultas.cod_act ='23') AND pyp_consultas.NUMERIDEN= '$iden'";   	
    $res = mysql_query($sql,$link);
    $color = "<img src='img/color_rojo.png' width='20' height='20' alt='No Registra Consultas'/>";        
    $opcion = "0";
    //$pend_ctrol = array();
    while ($row = mysql_fetch_array($res))
    {
        $cod_cups = $row['CODCONSUL'];
        $cod_act  =  $row['cod_act'];   
		$fec_ulc  = explode(" ",  $row['FECHACONS']);	
        $fec_ultcons= substr($row['FECHACONS'],0,4);			
		
        if(($anio_actual-$fec_ultcons)<5)
        {
            if($cod_act == "22" )
            {           
                $color = "<img src='img/color_naranja.png' width='20' height='20' alt='Pendiente Control'/>";            
                $opcion = "1";
            }
            else if($cod_act == "23")
            {
                $color = "<img src='img/color_verde.png' width='20' height='20' alt='Consulta Completa'/>";
                $opcion = "2";
            }
            
        }
        
    }
    $valor[0] = $color;
    $valor[1] = $opcion;
	$valor[2] = $fec_ulc[0];
    return ($valor);    
}
function verificar_pacienteCronico($numid)
{    
    set_time_limit(0);
    $link = conectar();    
    $sql = "SELECT encabesadohistoria.idus_ehi, encabesadohistoria.nomb_ehi, encabesadohistoria.fnac_ehi, contrato.NEPS_CON, consultaprincipal.cod1_cpl, consultaprincipal.feca_cpl, areas.nom_areas, consultaprincipal.area_cpl, cie_10.nom_cie10, encabesadohistoria.cous_ehi
    FROM (((encabesadohistoria INNER JOIN consultaprincipal ON encabesadohistoria.numc_ehi = consultaprincipal.numc_cpl) INNER JOIN contrato ON encabesadohistoria.cont_ehi = contrato.CODI_CON) INNER JOIN areas ON consultaprincipal.area_cpl = areas.cod_areas) INNER JOIN cie_10 ON consultaprincipal.cod1_cpl = cie_10.cod_cie10
    WHERE ((((consultaprincipal.cod1_cpl) = 'I10X') OR ((consultaprincipal.cod1_cpl) = 'E119') OR ((consultaprincipal.cod1_cpl) = 'E149') OR ((consultaprincipal.cod1_cpl) = 'E106') 
    OR ((consultaprincipal.cod1_cpl) = 'E109') OR ((consultaprincipal.cod1_cpl) = 'E669') OR ((consultaprincipal.cod1_cpl) = 'E660') OR ((consultaprincipal.cod1_cpl) = 'E780') OR ((consultaprincipal.cod1_cpl) = 'E782') 
    OR ((consultaprincipal.cod1_cpl) = 'E785') OR ((consultaprincipal.cod1_cpl) = 'E784')) 
    AND ((encabesadohistoria.idus_ehi) = '". $numid ."'));";
    /*$sql = "SELECT usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU
            FROM usuario INNER JOIN pac_cronicos ON usuario.CODI_USU = pac_cronicos.iden_uco WHERE(((
            usuario.NROD_USU) = '". $numid . "'))
            GROUP BY usuario.NROD_USU, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU";*/
    
    /*$sql = "SELECT citas.Idusu_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, horarios.Cserv_horario, areas.nom_areas
        FROM areas INNER JOIN ((usuario INNER JOIN citas ON usuario.CODI_USU = citas.Idusu_citas) INNER JOIN horarios ON citas.ID_horario = horarios.ID_horario) ON areas.cod_areas = horarios.Cserv_horario
        WHERE (((usuario.NROD_USU)='$numid'))
        GROUP BY citas.Idusu_citas, usuario.PNOM_USU, usuario.SNOM_USU, usuario.PAPE_USU, usuario.SAPE_USU, horarios.Cserv_horario, areas.nom_areas
        HAVING (((horarios.Cserv_horario)='763' Or (horarios.Cserv_horario)='81'));";*/
    $res = mysql_query($sql,$link); 
    while ($row = mysql_fetch_array($res)) {
        $cod1_cpl = $row['cod1_cpl'];
        $feca_cpl = $row['feca_cpl'];
        $nom_areas= $row['nom_areas'];
        $area_cpl = $row['area_cpl'];
        $nom_cie10= $row['nom_cie10'];
    }
    if(mysql_numrows($res)>0)
    {
        return "Paciente Cronico.<br/>Ultima Consulta:$feca_cpl<br/>Servicio:$nom_areas<br/>DX:$nom_cie10";        
    }
    mysql_free_result($res);
    
    
}
function TiempoEntreFechas($fechaInicio)
{
    //$fechaInicio = "28/02/1999";
    //$fechaInicio = "2011-02-14  00:00:00";

    //$fechaActual = "29/02/2000";
    $fechaActual = date("Y-m-d");//"2000-02-29";

    $fechaAct     = explode("-", $fechaActual);
    $diaActual    = $fechaAct[2];
    $mesActual    = $fechaAct[1];
    $anioActual   = $fechaAct[0];
    /*$diaActual = substr($fechaActual, 0, 2);
    $mesActual = substr($fechaActual, 3, 5);
    $anioActual = substr($fechaActual, 6, 10);*/

    $fechaIni   = explode("-", $fechaInicio);
    $diaInicio  = $fechaIni[2];
    $mesInicio  = $fechaIni[1];
    $anioInicio = $fechaIni[0]; 
    /*$diaInicio = substr($fechaInicio, 0, 2);
    $mesInicio = substr($fechaInicio, 3, 5);
    $anioInicio = substr($fechaInicio, 6, 10);*/


      $b = 0;

    $mes = $mesInicio-1;

    if($mes==2){

    if(($anioActual%4==0 && $anioActual%100!=0) || $anioActual%400==0){

    $b = 29;

    }else{

    $b = 28;

    }

    }

    else if($mes<=7){

    if($mes==0){

     $b = 31;

    }

      else if($mes%2==0){

      $b = 30;

      }

      else{

      $b = 31;

      }

      }

      else if($mes>7){

      if($mes%2==0){

      $b = 31;

      }

      else{

      $b = 30;

      }

      }

       if(($anioInicio>$anioActual) || ($anioInicio==$anioActual && $mesInicio>$mesActual) || ($anioInicio==$anioActual && $mesInicio == $mesActual && $diaInicio>$diaActual))
      {

        //echo "La fecha de inicio ha de ser anterior a la fecha Actual";

      }
      /*else if(($anioInicio==$anioActual && $mesInicio == $mesActual && $diaInicio>$diaActual))
      {
          $anios =0;
          $dies = 0;
          $meses = 0;
      }*/
      else{

      if($mesInicio <= $mesActual){

      $anios = $anioActual - $anioInicio;

      if($diaInicio <= $diaActual){

      $meses = $mesActual - $mesInicio;

      $dies = $diaActual - $diaInicio;

      }else{

      if($mesActual == $mesInicio){

      $anios = $anios - 1;

      }

      $meses = ($mesActual - $mesInicio - 1 + 12) % 12;

      $dies = $b-($diaInicio-$diaActual);

      }



      }else{

      $anios = $anioActual - $anioInicio - 1;



      if($diaInicio > $diaActual){

      $meses = $mesActual - $mesInicio -1 +12;

      $dies = $b - ($diaInicio-$diaActual);

      }
      else{

          $meses = $mesActual - $mesInicio + 12;

          $dies = $diaActual - $diaInicio;

          }

      }
          /*echo "A&ntilde;os: ".$anios." <br />";
          echo "Meses: ".$meses." <br />";
          echo "D&iacute;as: ".$dies." <br />";*/
          $tiempo['a'] = $anios;
          $tiempo['m'] = $meses;
          $tiempo['d'] = $dies;          
          $totMeses = ($anios * 12) + $meses;
          if($tiempo['d']>28)
          {
              $totMeses= $totMeses+1;
          }
          
          $tiempo['tm'] = $totMeses;
          return $tiempo;
          //echo "<p>Total Meses: $totMeses <br>Dias: $dies</p>";

      }
}
?>