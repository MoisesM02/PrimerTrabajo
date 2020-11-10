<?php
include('connection.php');
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    $stmt = $conn->prepare("SELECT * from Servicios WHERE ID =:id;");
    $result = $stmt->execute(["id" => $id]);
    if($result && $stmt->rowCount() >= 1){
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
        echo "No se ha encontrado este servicio";
    }
}else{
    echo "No se ha seleccionado ningún servicio";
}

?>