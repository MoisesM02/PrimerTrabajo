<?php
include("connection.php");
if(isset($_POST["now"])){
    $ahora = $_POST["now"];
    $stmt = $conn->prepare("SELECT * FROM LibroServicios INNER JOIN (SELECT ID, Max(Nombre_Empleada) FROM LibroServicios WHERE :ahora NOT BETWEEN Fecha_Inicio AND Fecha_Finalizacion GROUP BY Nombre_Empleada) As grouppedempleadas ON LibroServicios.ID = grouppedempleadas.ID");
    $result = $stmt->execute([
        "ahora" => $ahora
    ]);
    if($result){
        if($numRows = $stmt->rowCount() >= 1){
        $json = [];
        while($empleadas = $stmt->fetch(PDO::FETCH_ASSOC)){
            $json[] = [
                "nombreEmpleada" => utf8_encode($empleadas["Nombre_Empleada"])
            ];
        }
        $data = json_encode($json);
        echo $data;
    }else{
        echo "No hay empleadas disponibles";
    }
    }else{
        echo "Hubo un error al seleccionar los datos". $result->rollback();
    }
}
?>