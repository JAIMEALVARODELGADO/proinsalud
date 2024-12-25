<?php  
        
        //include ("php/conexion1.php");
        include ("genera_cita.php");

?>

  <section class="container p-8">
        <div class="row">
          <div class="col-md-8 mx-auto">

                <?php if(isset($_SESSION['mensaje'])) { ?> 
                <div class="alert alert-<?= $_SESSION['color']; ?> alert-dismissible" role="alert">
                     <?= $_SESSION['mensaje']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset(); }?>
                <div class="card card-body">
                    <form action="festi.php" method="post" enctype="multipart/form-data" >
                        <h3 class="mb-3" style="color:#52C4BC"; align="center">Gestión Convocatoria</h3>
                                                        
                            <div class="mb-3">
                              <h5>Ingrese el id del paciente</h5>
                                <input type="number" name ="IDPaciente" class="form-control" placeholder="Ingrese id paciente" autofocus required>
                            </div>

							<div class="mb-3">
							<h5>Ingrese el id del medico 13011947</h5>
                                <input type="number" name ="IDMedico" class="form-control" placeholder="Ingrese id medico " autofocus required>
                            </div>

                            <div class="mb-3">
							<h5>Ingrese el id del servicio 80</h5>
                                <input type="number" name ="IDServicio" class="form-control" placeholder="Ingrese id servicio" autofocus required>
                            </div>

                            <div class="mb-3">
							<h5>Ingrese el id del tipo de contrato de citas 013</h5>
                                <input type="text" name ="cotra_citas" class="form-control" placeholder="Ingrese cotra_citas " autofocus required>
                            </div>

                             <div class="mb-3">
							<h5>Ingrese el id del tipo de funcionario</h5>
                                <input type="number" name ="funcionario_pen" class="form-control" placeholder="Ingrese id de funcionario" autofocus required>
                            </div>

                            <div class="mb-3">
							<h5>Ingrese el tipo de usuario de citas cotizante/beneficiario</h5>
                                <input type="text" name ="Tusua_citas" class="form-control" placeholder="Ingrese tipo de usuario" autofocus required>
                            </div>

                            <div class="mb-3">
                              <h5>Ingrese el tiempo: 44</h5>
                                <input type="number" name ="numDias" class="form-control" placeholder="Ingrese los dias" autofocus required>
                            </div>

                        
                            <div class="container-fluid h-100">
                            <div class="row w-100 align-items-center">
                                <div class="col text-center">
                                    <?php 
                                    $fecharecibida= genCita('7', '13835521', '13011947', '80', '1201008', 'Cotizante', '135',0 );
                                    echo $fecharecibida;

                                    ?>
                                </div>
                            </div>
                        </div> 


                        </div>  
                        
                    </form> 
                </div>          
            </div>
            
           
        </div>
        
    </div>
    
  </section>
  <br>

