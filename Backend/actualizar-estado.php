<?php
include("connection.php");
if((isset($_POST["id"]) && !empty($_POST["id"])) && (isset($_POST["tipo"]) && !empty($_POST["tipo"])) && (isset($_POST["estado"]) && !empty($_POST["estado"]))){
    $id = $_POST["id"];
    $estado = utf8_decode($_POST["estado"]);
    if($_POST["tipo"] == "Empleada"){
        $stmt = $conn->prepare("UPDATE Empleadas SET Estado =:estado WHERE ID =:id");
        $result = $stmt->execute(["estado" => $estado, "id" => $id]);
        if($result){
            echo "Se ha actualizado correctamente";
        }else{
            $conn->rollback();
            echo "Hubo un problema al modificar los datos";
        }
    }else{
        #habitación
        $stmt = $conn->prepare("UPDATE Habitaciones SET Estado =:estado WHERE ID =:id");
        $result = $stmt->execute(["estado" => $estado, "id" => $id]);
        if($result){
            echo "Se ha actualizado correctamente";
        }else{
            $conn->rollback();
            echo "Hubo un problema al modificar los datos";
        }
    }
}else{
    echo "Debe enviar todos los datos";
}

?>