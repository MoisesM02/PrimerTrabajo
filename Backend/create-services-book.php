<?php
include('connection.php');
if(isset($_POST["duracion"]) && isset($_POST["tipo"]) && isset($_POST["username"]) && isset($_POST["habitacion"]) && isset($_POST["descuentos"]) && isset($_POST["nombreServicio"]) && (isset($_POST["nombreEmpleada"]) && $_POST["nombreEmpleada"] !="Todos") && isset($_POST["precioServicio"]) && isset($_POST["gananciaCasa"]) && isset($_POST["gananciaEmpleado"]) && isset($_POST["fechaInicio"]) && isset($_POST["fechaFinal"])){
$duracion = utf8_decode($_POST["duracion"]);
$tipo = utf8_decode($_POST["tipo"]);
$username = utf8_decode($_POST["username"]);
$habitacion = utf8_decode($_POST["habitacion"]);
$descuentos = $_POST["descuentos"];
$nombreServicio = utf8_decode($_POST["nombreServicio"]);
$nombreEmpleada = utf8_decode($_POST["nombreEmpleada"]);
$precioServicio = $_POST["precioServicio"];
$gananciaCasa = $_POST["gananciaCasa"];
$gananciaEmpleado = $_POST["gananciaEmpleado"];
$fechaInicial = $_POST["fechaInicio"];
$fechaFinal = $_POST["fechaFinal"];
$totalEmpleada = $gananciaEmpleado - $descuentos;

$stmt = $conn->prepare("INSERT INTO `LibroServicios`(`ID`, `Nombre_Empleada`, `Tipo`, `Usuario`, `Precio_Total`, `Ganancia_Empleada`, `Ganancia_Casa`, `Descuentos_Empleada`, `Total_Empleada`, `Fecha_Inicio`, `Fecha_Finalizacion`, `Habitacion`, `Servicio_Prestado`, `Duracion_Servicio`) VALUES (NULL, :nombreEmpleada, :tipo, :usuario, :precioTotal, :gananciaEmpleada, :gananciaCasa, :descuentosEmpleada, :totalEmpleada, :fechaInicio, :fechaFinal, :habitacion, :nombreServicio, :duracionServicio)");
$result = $stmt->execute([
    "nombreEmpleada" => $nombreEmpleada,
    "tipo" =>$tipo,
    "usuario" => $username,
    "precioTotal" => $precioServicio,
    "gananciaEmpleada" =>$gananciaEmpleado,
    "gananciaCasa" => $gananciaCasa,
    "descuentosEmpleada" => $descuentos,
    "totalEmpleada" => $totalEmpleada,
    "fechaInicio" => $fechaInicial,
    "fechaFinal" => $fechaFinal,
    "habitacion" => $habitacion,
    "nombreServicio" => $nombreServicio,
    "duracionServicio" => $duracion
]);
if($result){
    echo "Datos agregados satisfactoriamente";
}else{
    echo "Hubo un error al insertar los datos ". $result->rollback();
}

}else{
    echo "Debe ingresar todos los datos";
    
}


?>