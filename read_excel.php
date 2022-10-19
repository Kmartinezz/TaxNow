<?php

require 'vendor/autoload.php';
require ('db.php');

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
//$inputFileName = 'Liquidacion.xlsx';
$inputFileName = $_FILES['excel']['tmp_name'];

/**  Identify the type of $inputFileName  **/
$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
/**  Create a new Reader of the type that has been identified  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($inputFileName);
//$HojaActual = $spreadsheet -> getActiveSheet();

$Hojas = $spreadsheet->getSheetNames();
$liquidacion = 'Liquidacion';

$indices_correctos = [];
$indices_incorrectos = [];
$contador = 0;

function verificarCasilla($valor){
    if ($valor == '#VALUE!'){
        $impuesto_unico_cli = 0;
    }else{
        $impuesto_unico_cli = str_replace(',' , '.' , $valor);
    }
    return $impuesto_unico_cli;
}

foreach ($Hojas as $nombre){
    $busqueda = strpos($nombre, $liquidacion);

    if ($busqueda !== FALSE){
        array_push($indices_correctos, $contador);
        $contador ++;
    }else{
        $contador ++;
    }
    echo "<br>";
}

foreach ($indices_correctos as $i){

    $HojaActual = $spreadsheet -> getSheet($i);
    $fecha_inicio_con = $HojaActual -> getCell('C40') -> getFormattedValue();

    //VALIDAR TOTAL A PAGAR (TOTAL NO IMPONIBLE - TOTAL DESCUENTOS)

    if (strpos($fecha_inicio_con, "de") !== FALSE or $fecha_inicio_con == NULL or $fecha_inicio_con == "-"){

        array_push($indices_incorrectos, $i);

    }else{

        //RUT
        $rut_cli = $HojaActual -> getCell('C38') -> getCalculatedValue();

        //NOMBRE Y APELLIDO ESTAN EN LA MISMA CELDA, CAMBIAR ESTO EN LA BASE DE DATOS.
        $nombre_cli_x = $HojaActual -> getCell('C37') -> getCalculatedValue();
        $nombre_cli = utf8_decode($nombre_cli_x);

        //Fecha Ingreso
        $invert = explode("/", $fecha_inicio_con);
        $inicio_contrato = $invert[1]."-".$invert[0]."-".$invert[2];

        //Fecha para la base de datos
        $fecha_inicio_bd = $HojaActual -> getCell('C40') -> getFormattedValue(); 
        $invert = explode("/", $fecha_inicio_con);
        $inicio_contrato_bd = $invert[2]."/".$invert[0]."/".$invert[1];

        //Cargo
        $cargo_cli = $HojaActual -> getCell('C39') -> getCalculatedValue();

        //Direccion (EL EXCEL NO TIENE LA DIRECCION DEL CLIENTE)
        //$direccion_cli = $HojaActual -> getCell('??') -> getCalculatedValue();
        $direccion_cli = '-';

        //Telefono (EL EXCEL NO TIENE EL TELEFONO DEL CLIENTE)
        //$telefono_cli = $HojaActual -> getCell('??') -> getCalculatedValue();
        $telefono_cli = '-';

        //Dias Trabajados
        $dias_trabajado_cli = $HojaActual -> getCell('C3') -> getCalculatedValue();

        //Dias Licencia (DE DONDE TOMAR ESTOS DATOS?)
        //$dias_licencia_cli = $HojaActual -> getCell('??') -> getCalculatedValue();
        $dias_licencia_cli = 0;
        //Dias Ausencia (DE DONDE TOMAR ESTOS DATOS?)
        //$dias_ausencia_cli = $HojaActual -> getCell('??') -> getCalculatedValue();
        $dias_ausencia_cli = 0;
        //Sueldo Base
        $valorX = $HojaActual -> getCell('C8') -> getCalculatedValue();
        $sueldo_base_cli = str_replace(',' , '.' , $valorX);

        //Gratificacion
        $valorX = $HojaActual -> getCell('C9') -> getCalculatedValue();

        if ($valorX == NULL){
            $gratificacion_cli = 0;
        }else{
            $gratificacion_cli = str_replace(',' , '.' , $valorX);
        }


        //Colacion (AGREGAR A LA BASE DE DATOS)
        $valorX = $HojaActual -> getCell('C24') -> getCalculatedValue();
        $colacion_cli = str_replace(',' , '.' , $valorX);

        //Movilizacion (AGREGAR A LA BASE DE DATOS)
        $valorX = $HojaActual -> getCell('C25') -> getCalculatedValue();
        $movilizacion_cli = str_replace(',' , '.' , $valorX);

        //Variable X (DE DONDE TOMAR ESTOS DATOS?)
        //$valorX = $HojaActual -> getCell('??') -> getCalculatedValue();
        //$variable1_cli = str_replace(',' , '.' , $valorX);

        //Variable X (DE DONDE TOMAR ESTOS DATOS?)
        //$valorX = $HojaActual -> getCell('??') -> getCalculatedValue();
        //$variable2_cli = str_replace(',' , '.' , $valorX);

        //AFP
        $nomb_afp_cli = $HojaActual -> getCell('C6') -> getCalculatedValue();
        $valorX = $HojaActual -> getCell('E8') -> getCalculatedValue();
        $valor_afp_cli = str_replace(',' , '.' , $valorX);

        //Salud
        $nomb_salud_cli = $HojaActual -> getCell('D9') -> getCalculatedValue();
        $valorX = $HojaActual -> getCell('E9') -> getCalculatedValue();
        $valor_salud_cli = str_replace(',' , '.' , $valorX);

        //Impuesto Unico
        $valorX = $HojaActual -> getCell('E11') -> getCalculatedValue();
        $impuesto_unico_cli = str_replace(',' , '.' , $valorX);
        $impuesto_unico_cli = verificarCasilla($impuesto_unico_cli);

        //Seguro Cesantia
        $valorX = $HojaActual -> getCell('E12') -> getCalculatedValue();
        $seg_cesantia_cli = str_replace(',' , '.' , $valorX);

        //Anticipo
        //$anticipo_cli = $HojaActual -> getCell('C38') -> getCalculatedValue();
        $anticipo_cli = 0;

        //Total Descuento
        $total_dcto_cli = $HojaActual -> getCell('E19') -> getCalculatedValue();

        //Tipo Contrato
        $tipo_contrato_cli = $HojaActual -> getCell('C5') -> getCalculatedValue();

        //Total Imponible
        $total_imponible_cli = $HojaActual -> getCell('C19') -> getCalculatedValue();

        /* echo "Rut: " . $rut_cli;
        echo "<br>";
        echo "Nombre: " . $nombre_cli_x;
        echo "<br>";
        echo "Inicio Contrato limpio: " . $fecha_inicio_con;
        echo "<br>"; 
        echo "Inicio Contrato: " . $inicio_contrato_bd;
        echo "<br>";
        echo "Direccion: " . $direccion_cli;
        echo "<br>";
        echo "Telefono: " . $telefono_cli;
        echo "<br>";
        echo "Tipo Contrato: " . $tipo_contrato_cli;
        echo "<br>";
        echo "Dias Trabajados: " . $dias_trabajado_cli;
        echo "<br>";
        echo "Dias Licencia: " . $dias_licencia_cli;
        echo "<br>";
        echo "Dias Ausencia: " . $dias_ausencia_cli;
        echo "<br>";
        echo "Sueldo Base: " . $sueldo_base_cli;
        echo "<br>";
        echo "Gratificacion: " . $gratificacion_cli;
        echo "<br>";
        echo "Colacion: " . $colacion_cli;
        echo "<br>";
        echo "Movilizacion: " . $movilizacion_cli;
        echo "<br>";
        echo "Total Imponible: " . $total_imponible_cli;
        echo "<br>";
        echo "Nombre Salud: " . $nomb_salud_cli;
        echo "<br>";
        echo "Valor Salud: " . $valor_salud_cli;
        echo "<br>";
        echo "Nombre AFP: " . $nomb_afp_cli;
        echo "<br>";
        echo "Valor AFP: " . $valor_afp_cli;
        echo "<br>";
        echo "Anticipo: " . $anticipo_cli;
        echo "<br>";
        echo "Total Dcto: " . $total_dcto_cli;
        echo "<br>";
        echo "Impuesto Unico: " . $impuesto_unico_cli;
        echo "<br>";
        echo "Seg Cesantia: " . $seg_cesantia_cli;
        echo "<br>";
        echo "<br>";
        echo "<br>"; */

        //QUERY
        $sql = "INSERT INTO empleados (rut, nombre, inicio_contrato, direccion, telefono, tipo_contrato, dias_trabajados, dias_licencia, dias_ausencia, sueldo_base, gratificacion, colacion, movilizacion, total_imponible, salud, valor_salud,
        afp, valor_afp, anticipo, total_dctos, imp_unico, seg_cesantia) VALUES ('$rut_cli', '$nombre_cli_x', '$inicio_contrato_bd',
        '$direccion_cli', '$telefono_cli', '$tipo_contrato_cli', '$dias_trabajado_cli', '$dias_licencia_cli', '$dias_ausencia_cli', '$sueldo_base_cli', '$gratificacion_cli',
        '$colacion_cli', '$movilizacion_cli', '$total_imponible_cli', '$nomb_salud_cli', $valor_salud_cli, '$nomb_afp_cli',
        '$valor_afp_cli', $anticipo_cli, $total_dcto_cli, $impuesto_unico_cli, '$seg_cesantia_cli')";

        $result = mysqli_query($conn, $sql);
        echo $result;

    }
}
/* echo "<br>";
foreach ($indices_incorrectos as $a){
    $names = $spreadsheet->getSheetNames()[$a];
    echo "<br>";
    echo $names;
}
 */