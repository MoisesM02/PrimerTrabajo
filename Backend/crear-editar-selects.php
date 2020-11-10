<?php
include("connection.php");
if(isset($_POST["tipos"]) && !empty($_POST["tipos"])){
    
    $tipo = $_POST["tipos"];
    if($tipo == "Empleada"){
    
        $stmt = $conn->prepare("SELECT Nombre_Empleada, ID FROM Empleadas;");
        $result=$stmt->execute();
        if($result){
        if($stmt->rowCount() >=1){
            $json = [];
            while($empleada = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                $json[] = [
                    "id" => $empleada["ID"],
                    "nombre" => utf8_encode($empleada["Nombre_Empleada"])
                ];
            }
            echo json_encode($json);
        }else{
            $json =[];
            $json[] = ["id" => "ninguna", "nombre" => "No se han encontrado empleadas"];
            echo json_encode($json);
        }
    }else{
        echo "Hubo un problema al buscar los datos";
    }
    }else{
        $stmt = $conn->prepare("SELECT Habitacion, ID FROM Habitaciones");
        $result=$stmt->execute();
        if($result){
        if($stmt->rowCount() >=1){
            $json = [];
            while($habitacion = $stmt->fetch(PDO::FETCH_ASSOC)){
                
                $json[] = [
                    "id" => $habitacion["ID"],
                    "nombre" => utf8_encode($habitacion["Habitacion"])
                ];
            }
            echo json_encode($json);
        }else{
            $json =[];
            $json[] = ["id" => "ninguna", "nombre" => "No se han encontrado Habitaciones"];
            echo json_encode($json);
            echo "Hola";
        }
    }else{
        echo "Hubo un problema al buscar los datos";
    }
    }
}else{
    echo "Debe ingresar todos los datos";
}

?>