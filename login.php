
<?php include("includes/header.php");?>
<div class='container'>
    <div class="position-absolute top-0 start-50 translate-middle">
        <?php if(isset($_SESSION['message'])){?>
                <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert" >
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php session_unset(); }?>
    </div>
    <div class='position-absolute top-50 start-50 translate-middle '>   
        
        <form action="validarLogin.php" method='POST'>
            <div style='text-align: center;' >
                <h1>Inicio Sesión</h1>
                <p>Usuario</p>
                <input type="text" place_holder='Usuario' name='user'>
                <p>Contraseña</p>
                <input type="password" place_holder='Contraseña' name='pass'></br>
                <button type="submit" name="login" value = 'ingresar' class="btn btn-primary mt-2">Iniciar sesion</button>
            </div>
            
            
        </form>
        <form action="save_empleado.php" method='POST'>
            <div  style='text-align: center;' >
                <h1>Registrar</h1>
                <p>Usuario</p>
                <input type="text" place_holder='Usuario' name='user'>
                <p>Contraseña</p>
                <input type="password" place_holder='Contraseña' name='pass'></br>
                <button type="submit" name="register" value ='registrar' class="btn btn-primary mt-2">Registrar</button>
            </div>
            
            
        </form>
    </div>

</div>
<?php include("includes/footer.php");?>