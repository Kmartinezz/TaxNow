<?php 

include("db.php");
/*Guardar empleado ingresado manual*/
if (isset($_POST['save_empleado'])){
    echo 'saving';
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    #inicio contrato voltear fecha o introducir un pluggin de calendario
    $inicio_contrato = $_POST['inicio_contrato'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $tipo_contrato = $_POST['tipo_contrato'];
    $dias_trabajados = $_POST['dias_trabajados'];
    $sueldo_base = $_POST['sueldo_base'];
    $gratificacion = $_POST['gratificacion'];
    $total_imponible = $_POST['total_imponible'];
    $salud = $_POST['salud'];
    $afp = $_POST['afp'];
    $anticipo = $_POST['anticipo'];
    $total_dctos = $_POST['total_dctos'];

    $query = "INSERT INTO empleados(rut, nombre, apellido, inicio_contrato,
    direccion, telefono, tipo_contrato, dias_trabajados, sueldo_base, gratificacion,
    total_imponible, salud, afp, anticipo, total_dctos) VALUES ('$rut', '$nombre', '$apellido', '$inicio_contrato',
    '$direccion', '$telefono', '$tipo_contrato', '$dias_trabajados', '$sueldo_base', '$gratificacion',
    '$total_imponible', '$salud', '$afp', '$anticipo', '$total_dctos')";
    
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed");
        echo "No se logro ingresar";
        
    }
    
    $_SESSION['message'] = 'Empleado guardado con exito!!';
    $_SESSION['message_type'] = 'success';
    header("Location: index.php");
    
    
}

/*Guardar usuario de login*/
if (isset($_POST['register'])){
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);

    $query = "INSERT INTO users (user, pass) VALUES ('$user','$pass')";

    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Query Failed");
        echo "No se logro ingresar";
        
    }
    
    $_SESSION['message'] = 'Usuario registrado con exito!!';
    $_SESSION['message_type'] = 'success';
    header("Location: login.php");

}

?>

<?php include("includes/header.php");?>
<?php include("includes/nav.php"); ?>
<h1>ERROR 404</h1>
<?php include("includes/footer.php");?>