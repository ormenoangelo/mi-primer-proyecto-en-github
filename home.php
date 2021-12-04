<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="col-12"><br>
        <div class="card">
            <div class="card-header">
                <h5>Importar Excel</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <input type="file" id="txt_archivo" class="form-control">
                    </div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-danger" style="width:100%" onclick="Cargar_Excel()">Cargar Datos</button>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-secondary" style="width:100%" onclick="guardar_datos()">Guardar Datos</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id=div-table></div>
                    </div>
                </div>
            </div>
        </div>   
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
<script>
    document.getElementById("txt_archivo").addEventListener("change", () =>{
        var fileName = document.getElementById("txt_archivo").value;
        var idxDot = fileName.lastIndexOf(".") + 1; //La búsqueda se realiza empezando por el final de la cadena que realiza la llamada
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase(); //ingresa la cadena en minuscula
        if(extFile=="xlsx" || extFile=="xlsb"){
            //codigo
        }else{
/*             alert("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN EXCEL - USTED SUBIO UN ARCHIVO CON EXTENSION " +extFile, "warning");
 */            Swal.fire("MENSAJE DE ADVERTENCIA","SOLO SE ACEPTAN EXCEL - USTED SUBIO UN ARCHIVO CON EXTENSION " +extFile, "warning" );
            document.getElementById("txt_archivo").value="";
        }
        
    });
    
    function Cargar_Excel(){
        let archivo = document.getElementById('txt_archivo').value;
        alert(archivo.length==0)
        if(archivo.length==0){
/*             alert("Mensaje de Advertencia","Seleccione un archivo", "warning");
 */            return Swal.fire("Mensaje de Advertencia","Seleccione un archivo", "warning")
        }
        let formData = new FormData();
        let excel = $("#txt_archivo")[0].files[0];
        formData.append('excel',excel);
        $.ajax({
            url:'index.php',
            type:'POST',
            data:formData,
            contentType:false, // false cuando retornas un html;
            processData:false,
            success:function(resp){
                if(resp == '2'){
/*                        alert("Mensaje de Advertencia","Seleccione un archivo", "warning");
 */                    return Swal.fire("Mensaje de Advertencia","Seleccione un archivo", "warning")
                }else{
                    $("#div-table").html(resp);
                }

            }

        });
        return false;
    }
</script>