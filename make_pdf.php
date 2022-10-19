<?php
// include class
require('resourses/fpdf.php');
require ('db.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM empleados WHERE id = $id";
    $result = mysqli_query($conn, $query);
}

/*if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM crud_empleados WHERE id = $id";
    $result = mysqli_query($conn, $query);
}*/


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    //Color de fuente
    $this -> SetTextColor(55, 96, 146);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(70,10,'LIQUIDACION DE SUELDO MENSUAL',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

while($row = $result -> fetch_assoc()){
    //FontStyle
    $pdf->SetFont('Arial', 'B',12);
    $pdf -> SetTextColor(55, 96, 146);

    $pdf -> Cell(105, 10, 'DATOS DEL TRABAJADOR', 0, 0, 'L', 0);
    $pdf -> Cell(40, 10, 'DATOS DE LA EMPRESA', 0, 0, 'L', 0);

    $pdf -> Ln(10);

    //Definimos el color de fondo junto con las letras
    $pdf -> SetDrawColor(255, 255, 255);
    $pdf -> SetFillColor(191, 191, 191);
    $pdf -> SetTextColor(55, 96, 146);

    //RUT
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(13, 6, 'R.U.T:', 0, 0, 'L', 1);
    $pdf -> Cell(27, 6, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(65, 6, $row['rut'], 0, 0, 'L', 0);
    
    //Razon Social
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(27, 6, 'Razon Social:', 0, 0, 'L', 1);
    $pdf -> Cell(13, 6, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(40, 6, 'Cambiar Esto', 0, 0, 'L', 0);

    $pdf -> Ln(7);

    //Nombre
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(18, 6, 'Nombre:', 0, 0, 'L', 1);
    $pdf -> Cell(22, 6, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(65, 6, $row['nombre'], 0, 0, 'L', 0);
    //$pdf -> Cell(54, 6, $row['apellido'], 0, 0, 'L', 0);

    //Rut Empresa
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(13, 6, 'R.U.T:', 0, 0, 'L', 1);
    $pdf -> Cell(27, 6, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(65, 6, '12.345.678-9', 0, 0, 'L', 0);

    $pdf -> Ln(7);

    //Fecha Ingreso
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(35, 6, 'Fecha de Ingreso:', 0, 0, 'L', 1);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(65, 6, $row['inicio_contrato'], 0, 0, 'L', 0);

    //Direccion
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(20, 6, 'Direccion:', 0, 0, 'L', 1);
    $pdf -> Cell(20, 6, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(60, 6, $row['direccion'], 0, 0, 'L', 0);

    $pdf -> Ln(7);

    //Cargo
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(14, 6, 'Cargo:', 0, 0, 'L', 1);
    $pdf -> Cell(26, 6, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(65, 6, 'Ingeniero En Informatica', 0, 0, 'L', 0);

    //Email
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(13, 6, 'Email:', 0, 0, 'L', 1);
    $pdf -> Cell(27, 6, '', 0, 0, 'L', 0);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(65, 6, 'CambiarEsto@gmail.com', 0, 0, 'L', 0);

    $pdf -> Ln(12);

    //Dias Trabajados -- Dias Licencia -- Dias Ausencia
    #$pdf -> SetDrawColor(255, 255, 255);
    $pdf -> SetFillColor(255, 176, 45);
    $pdf -> SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(61, 6, 'Dias Trabajados:', 0, 0, 'C', 1);
    $pdf -> Cell(3, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(61, 6, 'Dias Licencia:', 0, 0, 'C', 1);
    $pdf -> Cell(3, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(61, 6, 'Dias Ausencia:', 0, 0, 'C', 1);
    $pdf -> Ln(8);
    $pdf -> SetDrawColor(31, 73, 125);
    $pdf -> SetFillColor(55, 96, 146);
    $pdf -> SetTextColor(31, 73, 125);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(61, 6, $row['dias_trabajados'], 1, 0, 'C', 0);
    $pdf -> Cell(3, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(61, 6, '0', 1, 0, 'C', 0);
    $pdf -> Cell(3, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(61, 6, '0', 1, 0, 'C', 0);
    $pdf -> Ln(15);

    //Detalle -- Haberes -- Descuento
    $pdf -> SetDrawColor(77, 199, 223);
    $pdf -> SetFillColor(77, 199, 223);
    $pdf -> SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B',11);
    $pdf -> Cell(75, 8, 'Detalle:', 1, 0, 'C', 1);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 8, 'Haberes:', 1, 0, 'C', 1);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 8, 'Descuento:', 1, 0, 'C', 1);
    $pdf -> Ln(12);

    //Cambiar Fuente Para Titulo
    $pdf -> SetTextColor(55, 96, 146);
    $pdf->SetFont('Arial', 'B',15);
    $pdf -> Cell(59, 8, 'Haberes Afectos:', 0, 0, 'L', 0);
    $pdf -> Ln(10);

    //Volver a fuente original
    $pdf->SetFont('Arial', '',11);
    
    //Sueldo base - Gratificacion - Colacion - Movilizacion
    //Sueldo Base
    $pdf -> SetDrawColor(31, 73, 125);
    $pdf -> SetFillColor(55, 96, 146);
    $pdf -> SetTextColor(31, 73, 125);
    $pdf -> Cell(75, 6, 'Sueldo Base', 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, $row['sueldo_base'], 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(8);

    //Gratificacion
    $pdf -> Cell(75, 6, 'Gratificacion', 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, $row['gratificacion'], 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(8);

    //Colacion
    $pdf -> Cell(75, 6, 'Colacion', 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(8);

    //Movilizacion
    $pdf -> Cell(75, 6, utf8_decode('Movilización'), 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(8);

    //Colacion
    $pdf -> Cell(75, 6, '-', 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(8);

    //Colacion
    $pdf -> Cell(75, 6, '-', 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(10);

    //Cambiar Fuente Para Titulo
    $pdf -> SetDrawColor(255, 255, 255);
    $pdf -> SetFillColor(55, 96, 146);
    $pdf -> SetTextColor(55, 96, 146);
    $pdf->SetFont('Arial', 'B',15);
    $pdf -> Cell(59, 8, 'Descuentos Legales:', 0, 0, 'L', 0);
    $pdf -> Ln(10);

    //Volver a fuente original
    $pdf->SetFont('Arial', '',11);

    //Esto debe tomar datos desde la base de datos(salud)
    //AFP
    $pdf -> SetDrawColor(31, 73, 125);
    $pdf -> SetFillColor(55, 96, 146);
    $pdf -> SetTextColor(31, 73, 125);
    $pdf -> Cell(75, 6, $row['afp'], 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(8);

    //Salud
    //Este debe tomar datos desde la base de datos(afp)
    $pdf -> Cell(75, 6, 'FONASA', 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(8);

    //Impuesto Unico
    $pdf -> Cell(75, 6, 'Impuesto Unico', 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(8);

    //Movilizacion
    $pdf -> Cell(75, 6, 'Seg. Cesantia (0,6 %)', 1, 0, 'C', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 0);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 0);
    $pdf -> Ln(15);

    //Totales - Total Haberes - Total Descuento
    $pdf -> SetFillColor(75, 255, 146);
    $pdf -> SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', '',14);

    $pdf -> Cell(70, 6, 'Totales:', 0, 0, 'L', 1);
    $pdf -> Cell(10, 6, '', 0, 0, 'L', 0);

    $pdf -> SetDrawColor(31, 73, 125);
    $pdf -> SetFillColor(255, 255, 255);
    $pdf -> SetTextColor(31, 73, 125);
    $pdf -> SetLineWidth(0.9);
    $pdf->SetFont('Arial', '',11);

    $pdf -> Cell(45, 6, '0', 1, 0, 'R', 1);
    $pdf -> Cell(5, 6, '', 0, 0, 'L', 0);
    $pdf -> Cell(59, 6, '0', 1, 0, 'R', 1);
    $pdf -> Ln(10);

    //Total a pagar
    $pdf -> SetFillColor(75, 255, 146);
    $pdf -> SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', '',14);
    $pdf -> Cell(70, 6, 'Total a Pagar:', 0, 0, 'L', 1);
    $pdf -> Cell(10, 6, '', 0, 0, 'L', 0);
    $pdf -> SetDrawColor(31, 73, 125);
    $pdf -> SetFillColor(255, 255, 255);
    $pdf -> SetTextColor(31, 73, 125);
    $pdf->SetFont('Arial', '',11);
    $pdf -> Cell(109, 6, '0', 1, 0, 'R', 1);
    $pdf -> Ln(26);

    //Firma Del Trabajador
    $pdf -> SetLineWidth(0);
    $pdf -> Line(190, 252, 135, 252);

    $pdf -> Cell(134, 6, '', 0, 0, 'R', 0);
    $pdf->SetFont('Arial', 'B',11);


    //Imagen
    $pdf->Image('resourses/img/Taxnow_Footer.png', 0, 255, -180, 44);
    $pdf -> Cell(40, 6, 'FIRMA TRABAJADOR', 0, 0, 'C', 0);
}


$pdf->Output();
?>