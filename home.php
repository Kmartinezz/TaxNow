<?php include("includes/header.php"); ?>
<?php include("includes/nav.php"); ?>

<html>
<div class='position-absolute top-50 start-50 translate-middle '>
    <div style='text-align: center;'>
        <h1>Bienvenido</h1>
        <input class="form-control" type="file" name="txt_archivo" id="txt_archivo">
        <button class="btn btn-primary mt-2" onclick="Cargar_Excel()">Subir</button>
</div>
</div>

<script>

document.getElementById("txt_archivo").addEventListener("change", () => {
    var fileName = document.getElementById("txt_archivo").value;
    var idxDot = fileName.lastIndexOf(".") + 1;
    var extFile = fileName.substr(idxDot, fileName.length).
    toLowerCase();
    if (extFile == "xlsx" || extFile == "xlsb"){
        //TO DO
    }else{
        Swal.fire("MENSAJE DE ADVERTENCIA", 
        "SOLO SE ACEPTAN ARCHIVOS EXCEL - USTED SUBIO UN ARCHIVO CON EXTENSION " + 
        extFile, "warning");
        document.getElementById("txt_archivo").value = "";
    }
});


function Cargar_Excel(){
    let archivo = document.getElementById('txt_archivo').value;
    if(archivo.length == 0){
        return Swal.fire("Mensaje de Advertencia", "Seleccione un Archivo", "Warning");
    }
    let formData = new FormData();
    let excel = $("#txt_archivo")[0].files[0];
    formData.append('excel', excel);
    $.ajax({
        url:'read_excel.php',
        type:'POST',
        data:formData,
        contentType:false,
        processData:false,
        success:function(resp){
            Swal.fire("Mensaje de Advertencia", "Archivo Subido Con Exito!!", "Warning");
            setTimeout(function(){
                window.location.href = "index.php";
            }, 2000);
            
        }
    });
    return false;
}

</script>
</html>
<?php include("includes/footer.php") ?>