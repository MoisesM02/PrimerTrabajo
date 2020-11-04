<?php
include('connection.php');
if(isset($_POST["id"])){    
$id = $_POST["id"];
try{
$stmt = $conn->prepare("SELECT * from Servicios WHERE ID =:id");
$result = $stmt->execute([":id" => $id]);
if($result){
    $json = [];
    while($servicio = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id = $servicio["ID"];
    $nombre = utf8_encode($servicio["Nombre_de_Servicio"]);
    $tipo = utf8_encode($servicio["Tipo"]);
    $gananciaEmpleado = $servicio['Ganancia_de_Empleado'];
    $gananciaCasa = $servicio["Ganancia_de_Casa"];
    $precioTotal = $servicio["Precio_Total"];
    $porcentajeEmpleado = $servicio["Porcentaje_Empleada"];
    $porcentajeCasa = $servicio["Porcentaje_Casa"];
    $tiempo = utf8_encode($servicio["Tiempo"]);
    $json[] = [
        "id" => $id,
        "nombre" => $nombre,
        "tipo" => $tipo,
        "porcentajeEmpleado" => $porcentajeEmpleado,
        "porcentajeCasa" => $porcentajeCasa,
        "gananciaEmpleado" => $gananciaEmpleado,
        "gananciaCasa" => $gananciaCasa,
        "precioTotal" => $precioTotal,
        "tiempo" => $tiempo
    ];
    }
    echo json_encode($json);
}else{
    echo "Hubo un error". $result->rollback();
}
}catch(Exception $e){
$pdo->rollback();
throw $e;
}

}else{
    echo "No se ha seleccionado ningún producto. Vuelve a intentarlo";
}

?>