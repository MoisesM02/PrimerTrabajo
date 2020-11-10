<?php
include("connection.php");
if((isset($_POST["id"]) && !empty($_POST["id"])) && (isset($_POST["tipo"]) && !empty($_POST["tipo"]))){
    $tipo = $_POST["tipo"];
    if($tipo == "Empleada"){
        $id = $_POST["id"];
        $stmt = $conn->prepare("SELECT Estado from Empleadas WHERE ID =:id;");
        $result = $stmt->execute(["id" => $id]);
        if($result){
            if($stmt->rowCount() >=1){
                $empleada = $stmt->fetch(PDO::FETCH_ASSOC);
                $json = ["estado" => utf8_encode($empleada["Estado"])]; 
                echo json_encode($json);
            }else{
                echo "No se ha encontrado a la empleada";
            }
        }else{
            echo "Algo salió mal al seleccionar los datos";
        }
    }else{
        #habitaciones.
        $id = $_POST["id"];
        $stmt = $conn->prepare("SELECT Estado from Habitaciones WHERE ID =:id;");
        $result = $stmt->execute(["id" => $id]);
        if($result){
            if($stmt->rowCount() >=1){
                $habitacion = $stmt->fetch(PDO::FETCH_ASSOC);
                $json = ["estado" => utf8_encode($habitacion["Estado"])]; 
                echo json_encode($json);
            }else{
                echo "No se ha encontrado la habitación";
            }
        }else{
            echo "Algo salió mal al seleccionar los datos";
        }
    }
}else{
    echo "No se han seleccionado los datos";
}
?>