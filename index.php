<?php include("db.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/nav.php"); ?>
<?php include("get_empleados.php");?>

<div class="m-5 container">
    
    <div class="row">
        <!-- Menu izquierdo -->
        <div class="col-md-3 table-responsive-xl mb-3">
            <?php if(isset($_SESSION['message'])){?>
                    <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php session_unset(); }?>
            <div class="card card-body ">

            <!-- Boton para ingresar liquidacion -->
            <a href="home.php" class="btn btn-primary mt-2">Ingresar Liquidacion</a>

                <form action="save_empleado.php" method="POST">
                <?php 
                    $nameList = ["rut", "nombre", "inicio_contrato", "direccion", "dias_trabajados", "sueldo_base", "gratificacion", "colacion", "afp", "salud", "imp_unico","seg_cesantia","total_imponible"];
                    $phList = ["RUT", "Nombre", "Apellido", "Fecha inicio contrato", "Direccion", "Telefono", "Tipo contrato", "Dias trabajados", "Sueldo base", "Gratificacion", "Total imponible", "Salud", "Afp", "Anticipo", "Total descuentos"];
                ?>
                <!-- ESTE ES EL MENU IZQUIERDO PARA AGREGAR USUARIOS -->
                <!-- <?//php for ($i=0; $i <15; $i++) { ?>
                    <div class="mb-3">
                        <input type="text" name=<?//= $nameList[$i];?> class="form-control"
                                placeholder=<//?= $phList[$i];?> autofocus>
                    </div>
                <?php// } ?>
                    <button type="submit" name="save_empleado" class="btn btn-primary">Submit</button> -->
                </form>
            </div>
        </div>
        <!-- Tabla con datos -->
        <div class="col-md-8 table-responsive-xxl mt-1" >
            <table class='table table-bordered table-responsive-xxl' >
                <thead>
                    <tr>
                        <th>RUT</th>
                        <th>Nombre</th>
                        <!--<th>Apellido</th>-->
                        <th>Inicio contrato</th>
                        <th>Direccion</th>
                        <th>Dias trabajados</th>
                        <th>Sueldo base</th>
                        <th>Gratificacion</th>
                        <th>Colacion</th>
                        <th>AFP</th>
                        <th>Salud</th>
                        <th>Impuesto unico</th>
                        <th>Seguro cesantia</th>
                        <th>Total imponible</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Rellenado de tabla con consulta sql -->
                    <?php 
                    
                    while($row = mysqli_fetch_array($result_empleados)){?>
                    
                    <tr>
                    <?php for ($i=0; $i < count($nameList); $i++) { ?>
                        <td><?php echo $row[$nameList[$i]]?></td>
                    <?php }?>
                        <td>
                        <a href="edit_empleado.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                            <i class="fas fa-marker"></i>
                            </a>
                            <a href="delete_empleado.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                            </a>
                            <a href="make_pdf.php?id=<?php echo $row['id']?>">
                            <i class='fa-solid fa-download' style='font-size:28px'></i>
                            </a>
                    </tr>
                    <?php };?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>

<?php include("includes/footer.php") ?>