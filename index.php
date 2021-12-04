<?php

require 'vendor/autoload.php';

//conexion
$conexion = new mysqli('siste01','usuario1','Javascript1','contabilidad');

/* comprobar la conexión */
if ($conexion->connect_errno) {
/*     printf("Conexión fallida: %s\n", $mysqli->connect_error);
 */    echo '2';
    exit();
}


class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {

    public function readCell($column, $row, $worksheetName = '') {
        // Read title row and rows 20 - 30
        if ($row>1) {
            return true;
        }
        return false;
    }
}
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();

/* $inputFileName = 'prueba.xlsx'; */
if(empty($_FILES)){
    echo '2';
    exit(0);
}
$inputFileName = $_FILES['excel']['tmp_name'];




/**  Identifica el tipo de $ inputFileName  **/
$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
/**  Cree un nuevo lector del tipo que se ha identificado **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);

//Leo  la funcion para obtener los datos de una celda en especifica mayores al
//al numero colocado en la funcion
$reader->setReadFilter( new MyReadFilter() );

/**  Cargar $ inputFileName en un objeto de hoja de cálculo  **/
$spreadsheet = $reader->load($inputFileName);
$filas  = $spreadsheet->getActiveSheet()->toArray();

/*         $consulta =  "INSERT INTO ANEXO(IDTipoAnexo,IDTipoPersona,Codigo,ApellidoPaterno,ApellidoMaterno,Nombre,RazonSocial,Direccion,IDTipodocumentoanexo,IDUbigeo,IDPais,NumDoc,TipoMoneda,TasaDetraccion,TasaPercepcion,FecReg,FecMod,IDEmpresa,UsuReg,UsuMod,Estado) VALUES 
        ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]','$row[10]','$row[11]','$row[12]','$row[13]','$row[14]','$row[15]','$row[16]','$row[17]','$row[18]','$row[19]','$row[20]')"; 
        $resultado = $conexion->query($consulta); */


echo "<table id='table_detalle' class='table_responsive' style='width:100%; table-layout:fixed'>
     <thead>
        <tr>
        <td>tanexo</td>
        <td>tpersona</td>
        <td>codigo</td>
        <td>ap</td>
        <td>am</td>
        <td>nombre</td>
        <td>razonsocial</td>
        <td>direccion</td>
        <td>tdocumento</td>
        <td>ubigeo</td>
        <td>pais</td>
        <td>documento</td>
        <td>tmoneda</td>
        <td>tdetraccion</td>
        <td>tpercepcion</td>
        </tr>
        </thead><tbody id='tbody_tabla_detalle'>";

foreach($filas as $fila){
    if($fila[0] !=''){
        echo "<tr>";
            echo"<td>".$fila[0];"</td>";
            echo"<td>".$fila[1];"</td>";
            echo"<td>".$fila[2];"</td>";
            echo"<td>".$fila[3];"</td>";
            echo"<td>".$fila[4];"</td>";
            echo"<td>".$fila[5];"</td>";
            echo"<td>".$fila[6];"</td>";
            echo"<td>".$fila[7];"</td>";
            echo"<td>".$fila[8];"</td>";
            echo"<td>".$fila[9];"</td>";
            echo"<td>".$fila[10];"</td>";
            echo"<td>".$fila[11];"</td>";
            echo"<td>".$fila[12];"</td>";
            echo"<td>".$fila[13];"</td>";
            echo"<td>".$fila[14];"</td>";
        echo "</tr>";
        
/*         $consulta =  "INSERT INTO ANEXO(IDTipoAnexo,IDTipoPersona,Codigo,ApellidoPaterno,ApellidoMaterno,Nombre,RazonSocial,Direccion,IDTipodocumentoanexo,IDUbigeo,IDPais,NumDoc,TipoMoneda,TasaDetraccion,TasaPercepcion) VALUES 
        ('$row[0]','$row[1]','$row[2]','$row[3]','$row[4]','$row[5]','$row[6]','$row[7]','$row[8]','$row[9]','$row[10]','$row[11]','$row[12]','$row[13]','$row[14]')"; 
        $string = $string.$consulta;
        $resultado = $conexion->query($consulta);  */

        
    }
}
 echo "</tbody></table>";





