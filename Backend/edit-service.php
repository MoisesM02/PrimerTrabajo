<?php
include('connection.php');
if((isset($_POST["id"]) && !empty($_POST["id"])) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["duracion"]) && isset($_POST["precioServicio"]) && isset($_POST["porcentajeEmpleado"]) && isset($_POST["porcentajeCasa"]) && isset($_POST["gananciaCasa"]) && isset($_POST["gananciaEmpleado"])){
    $id = filter_var($_POST["id"], FILTER_SANITIZE_STRING);
    $nombre = filter_var(utf8_decode($_POST["nombre"]), FILTER_SANITIZE_STRING);
    $tipo = filter_var(utf8_decode($_POST["tipo"]), FILTER_SANITIZE_STRING);
    $duracion = filter_var(utf8_decode($_POST["duracion"]), FILTER_SANITIZE_STRING);
    $precioServicio = filter_var($_POST["precioServicio"], FILTER_SANITIZE_STRING);
    $porcentajeEmpleado = filter_var($_POST["porcentajeEmpleado"], FILTER_SANITIZE_STRING);
    $porcentajeCasa = filter_var($_POST["porcentajeCasa"], FILTER_SANITIZE_STRING);
    $gananciaCasa = filter_var($_POST["gananciaCasa"], FILTER_SANITIZE_STRING);
    $gananciaEmpleado = filter_var($_POST["gananciaEmpleado"], FILTER_SANITIZE_STRING);
    
        try{
        $stmt = $conn->prepare("UPDATE Servicios SET Tiempo =:tiempo, Precio_Total =:precioTotal, Porcentaje_Casa =:porcentajeCasa, Porcentaje_Empleada =:porcentajeEmpleada, Tipo =:tipo, Nombre_de_Servicio =:nombreServicio, Ganancia_de_Empleado =:gananciaEmpleado, Ganancia_de_Casa =:gananciaCasa WHERE ID =:id");
        $result = $stmt->execute([
            
            "tiempo" => $duracion,
            "precioTotal" => $precioServicio,
            "porcentajeCasa" => $porcentajeCasa,
            "porcentajeEmpleada" => $porcentajeEmpleado,
            "tipo" => $tipo,
            "nombreServicio" =>$nombre,
            "gananciaEmpleado" => $gananciaEmpleado,
            "gananciaCasa" => $gananciaCasa,
            "id" => $id
        ]);
        if($result){
            echo "Servicio actualizado correctamente.";
        }else{
            echo "Hubo un error al actualizar los datos"; 
        }
        }catch(PDOException $e){
            throw $e;
            
        }

}else{
    echo "Debes ingresar todos los datos";
    print_r($_POST);
}

?>