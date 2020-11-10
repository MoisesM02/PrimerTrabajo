<?php
include("connection.php");
if((isset($_POST["nombre"]) && !empty($_POST["nombre"])) && isset($_POST["tipo"])){
    if($_POST["tipo"] == "empleada"){
    $nombre = filter_var(utf8_decode($_POST["nombre"]), FILTER_SANITIZE_STRING);
    $stmt = $conn->prepare("INSERT INTO Empleadas (Nombre_Empleada, Estado) VALUES (:nombre, 'Disponible');");
    $result = $stmt->execute(["nombre" => $nombre]);
    if($result){
        echo "Empleada agregada correctamente";
    }else{
        $conn->rollback();
        echo "Hubo un error al agregar la empleada";
    }
}else{
    $nombre = filter_var(utf8_decode($_POST["nombre"]), FILTER_SANITIZE_STRING);
    $stmt = $conn->prepare("INSERT INTO Habitaciones (Habitacion, Estado) VALUES (:nombre, 'Disponible');");
    $result = $stmt->execute(["nombre" => $nombre]);
    if($result){
        echo "Habitación agregada correctamente.";
    }else{
        $conn->rollback();
        echo "Hubo un error al agregar la habitación.";
    }
}
}else{
    echo "Debes ingresar un nombre.";
}
?>