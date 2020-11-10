<?php
include('connection.php');
$stmt = $conn->prepare("SELECT ID, Nombre_de_Servicio FROM Servicios");
$result = $stmt->execute();
if($result && $numRows = $stmt->rowCount() >= 1){
    $json = [];
    while($servicio = $stmt->fetch(PDO::FETCH_ASSOC)){
        $json[] = [
            "id" => $servicio["ID"],
            "nombreServicio" => utf8_encode($servicio["Nombre_de_Servicio"])
        ];
    }
    echo json_encode($json);
}

?>