<?php
session_start();

?>
<html>
<head>
    <link rel="stylesheet" href="css/estilo_2.css">
    <meta http-equiv="Content-Type" content="text/html; ISO-8859-1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Consulta de Terapia Fisica</title>
    
    <script lang='JavaScript'>
        function mostrarControl(iden_this){
            alert(iden_this);
            for (var i = 0; i < controlesjs.length; i++) {
                if (controlesjs[i].iden_this == iden_this) {
                    alert(controlesjs[i].iden_tcon);
                }
            }
        }

        function imprimirControl(iden_tcon){
            alert(iden_tcon);
        }
    </script>

</head>
<body>
<form name="form1" method="post" action="">
    <center><h3><font color='#A60C63'>HISTORIAL DE TERAPIA FISICA</font></h3></center>
    <table class="table1">
    <th colspan='2'>Opciones</th>
    <th>Fecha</th>
    <th>Nombre</th>
    <th>Tipo</th>
    <th>Remite</th>
    <th>Profesional</th>
    <?php
    include('php/conexion.php');
    include('php/funciones.php');

    $controles=array();

    $consulta="SELECT tf.iden_this,tf.fecha_this,ser.nomb_des,med.nom_medi,
    CONCAT(u.PNOM_USU,' ',u.SNOM_USU,' ',u.PAPE_USU,' ',u.SAPE_USU) AS nombre,
    tp.nomb_des AS tipo_terapia    
    FROM ter_historia AS tf
    INNER JOIN usuario u ON u.CODI_USU =tf.codi_usu 
    INNER JOIN destipos AS ser ON ser.codi_des=tf.servrem_this 
    INNER JOIN medicos AS med ON med.cod_medi=tf.codmedi_this 
    LEFT JOIN destipos AS tp ON tp.codi_des = tf.tipoterapia_this
    WHERE tf.codi_usu='$_SESSION[codi_usu]' ORDER BY tf.iden_this";
    //echo $consulta;
    $consulta=mysql_query($consulta);    
    while($row=mysql_fetch_array($consulta)){
        
        $control = traeControl($row['iden_this']);
        echo "<br>".$control->iden_tcon;
        $controles[] = traeControl($row['iden_this']);

        

        //echo "<br>".$terapiaControl->iden_tcon;
        

        echo "<tr>";
        echo "<td align='center'><a href='ter_impretf.php?iden_this=$row[iden_this]' target='new'><img src='img/lupa.jpg' width='20' height='20' alt='Mirar'></a></td>";
        echo "<td align='center'><a href='#' onclick='mostrarControl($row[iden_this])'>aaa</a></td>";
        echo "<td align='left'>$row[fecha_this]</td>";
        echo "<td align='left'>$row[nombre]</td>";
        echo "<td align='left'>$row[tipo_terapia]</td>";        
        echo "<td align='left'>$row[nomb_des]</td>";
        echo "<td align='left'>$row[nom_medi]</td>";
        echo "</tr>";        
    }
    /*foreach ($controles as $control) {
        echo "<br>".$control->iden_tcon;
        echo "<br>".$control->resumen_tcon;
    }*/
    ?>
    </table>
    <script>
        var controlesjs = <?php echo json_encode($controles); ?>;
    </script>
</form>
<div class="modalControl">
    <center>
    <h6>CONTROLES DE TERAPIA FISICA</h6>
    <table class="table1">
        <th>Sel</th>
        <th>Fecha Control</th>
        <th>Profesional</th>
        <th>Resumen</th>
        <?php
        foreach ($controles as $control) {
            echo "<tr>";
            echo "<td align='center'><input type='radio' onclick='imprimirControl($control->iden_tcon)'></td>";
            echo "<td align='left'>$control->fecha_tcon</td>";
            echo "<td align='left'>$control->codmedi_tcon</td>";
            echo "<td align='left'>$control->resumen_tcon</td>";
            echo "</tr>";
        }
        ?>
    </table>    
    </center>
</div>
</body>
</html>


<?php
class TerapiaControl{
    public $iden_tcon;
    public $iden_this;
    public $fecha_tcon;
    public $evolu_tcon;
    public $obser_tcon;
    public $codmedi_tcon;    
    public $resumen_tcon;

    /*public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    public function mostrarInfo() {
        return "Nombre: $this->nombre, Edad: $this->edad";
    }*/
}


function traeControl($id_){
    //include('php/conexion.php');
    $consultaControl="SELECT iden_tcon,iden_this,fecha_tcon,codmedi_tcon,resumen_tcon 
    FROM ter_control WHERE iden_this='$id_'";
    //echo $consultaControl;
    $consultaControl=mysql_query($consultaControl);
    $row=mysql_fetch_array($consultaControl);
    $terapiaControl = new TerapiaControl();
    $terapiaControl->iden_tcon = $row['iden_tcon'];
    $terapiaControl->iden_this = $row['iden_this'];
    $terapiaControl->fecha_tcon = $row['fecha_tcon'];        
    $terapiaControl->codmedi_tcon = $row['codmedi_tcon'];
    $terapiaControl->resumen_tcon = $row['resumen_tcon'];
    return $terapiaControl;
}
?>