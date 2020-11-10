<?php
include('connection.php');
if(isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["duracion"]) && isset($_POST["precioServicio"]) && isset($_POST["porcentajeEmpleado"]) && isset($_POST["porcentajeCasa"]) && isset($_POST["gananciaCasa"]) && isset($_POST["gananciaEmpleado"])){
    
    $nombre = filter_var(utf8_decode($_POST["nombre"]), FILTER_SANITIZE_STRING);
    $tipo = filter_var(utf8_decode($_POST["tipo"]), FILTER_SANITIZE_STRING);
    $duracion = filter_var(utf8_decode($_POST["duracion"]), FILTER_SANITIZE_STRING);
    $precioServicio = filter_var($_POST["precioServicio"], FILTER_SANITIZE_STRING);
    $porcentajeEmpleado = filter_var($_POST["porcentajeEmpleado"], FILTER_SANITIZE_STRING);
    $porcentajeCasa = filter_var($_POST["porcentajeCasa"], FILTER_SANITIZE_STRING);
    $gananciaCasa = filter_var($_POST["gananciaCasa"], FILTER_SANITIZE_STRING);
    $gananciaEmpleado = filter_var($_POST["gananciaEmpleado"], FILTER_SANITIZE_STRING);
    $username = filter_var(utf8_decode($_POST["username"]), FILTER_SANITIZE_STRING);
    
        try{
        $stmt = $conn->prepare("INSERT INTO Servicios (Tiempo, Precio_Total, Porcentaje_Casa, Porcentaje_Empleada, Tipo, Nombre_de_Servicio, Ganancia_de_Empleado, Ganancia_de_Casa, Usuario) VALUES(:tiempo, :precioTotal, :porcentajeCasa, :porcentajeEmpleada, :tipo, :nombreServicio, :gananciaEmpleado, :gananciaCasa, :usuario);");
        $result = $stmt->execute([
            "tiempo" => $duracion,
            "precioTotal" => $precioServicio,
            "porcentajeCasa" => $porcentajeCasa,
            "porcentajeEmpleada" => $porcentajeEmpleado,
            "tipo" => $tipo,
            "nombreServicio" => $nombre,
            "gananciaEmpleado" => $gananciaEmpleado,
            "gananciaCasa" => $gananciaCasa,
            "usuario" => $username
        ]);
        if($result){
            echo "Producto añadido correctamente.";
        }else{
            echo "Hubo un error al agregar el producto"; 
        }
        }catch(PDOException $e){
            echo "¿Qué falló?";
            throw $e;
            
        }

}else{
    echo "Debe completar todos los campos";
    print_r($_POST);
    
}

?>