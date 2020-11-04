<?php
include("connection.php");
$page = 0;
$records_per_page = 0;
if(isset($_POST["empleada"]) && isset($_POST["fechaInicio"]) && isset($_POST["fechaFinal"])){
if (isset($_POST["pageNumber"]) && !empty($_POST["pageNumber"]))
{
    $page = $_POST["pageNumber"];
    if(isset($_POST["records"])){
        $records_per_page = $_POST["records"];
    }else{
        $records_per_page = 10;
    }
}else{
    $page = 1;
    if(isset($_POST["records"])){
        $records_per_page = $_POST["records"];
    }else{
        $records_per_page = 10;
    }
}
$start_from = ($page-1)*$records_per_page;
$empleada = filter_var($_POST["empleada"], FILTER_SANITIZE_STRING);
$fechainicial = $_POST["fechaInicio"];
$fechaDeFin = $_POST["fechaFinal"];


if($empleada == "Todos"){
$stmt = $conn->prepare("SELECT * from LibroServicios WHERE Fecha_Inicio AND Fecha_Finalizacion BETWEEN :fechaInicio AND :fechaFinal ORDER BY ID DESC LIMIT $start_from, $records_per_page;");
$result =$stmt->execute(["fechaInicio" => $fechainicial,
"fechaFinal" =>$fechaDeFin]);

if($result && $numRows = $stmt->rowCount() >= 1){
$json = [];
while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){
    $idServicio = $registro["ID"];
    $nombreEmpleada = utf8_encode($registro["Nombre_Empleada"]);
    $tipo = utf8_encode($registro["Tipo"]);
    $usuario = utf8_encode($registro["Usuario"]);
    $precioFinal = $registro["Precio_Total"];
    $gananciaEmpleada = $registro['Ganancia_Empleada'];
    $gananciaCasa = $registro["Ganancia_Casa"];
    $descuentosEmpleada = $registro['Descuentos_Empleada'];
    $totalEmpleada = $registro['Total_Empleada'];
    $fechaInicio = date('d-M-yy H:i:s',strtotime(utf8_encode($registro['Fecha_Inicio'])));
    $fechaFinal = date('d-M-yy H:i:s',strtotime(utf8_encode($registro['Fecha_Finalizacion'])));
    $habitacion = utf8_encode($registro["Habitacion"]);
    $servicioPrestado = utf8_encode($registro["Servicio_Prestado"]);
    $Tiempo = utf8_encode($registro["Duracion_Servicio"]);
  
    $json[] = [
        "id" => $idServicio,
        "nombre" => $nombreEmpleada,
        "tipo" => $tipo,
        "usuario" => $usuario,
        "precioFinal" => $precioFinal,
        "gananciaEmpleada" => $gananciaEmpleada,
        "gananciaCasa" => $gananciaCasa,
        "descuentosEmpleada" => $descuentosEmpleada,
        "totalEmpleada" => $totalEmpleada,
        "fechaInicio" => $fechaInicio,
        "fechaFinal" => $fechaFinal,
        "habitacion" => $habitacion,
        "servicioPrestado" => $servicioPrestado,
        "tiempo" => $Tiempo
    ];
    
}

$pageQuery = $conn->prepare("SELECT COUNT(*) from LibroServicios WHERE  Fecha_Inicio Between :fechaInicio AND :fechaFinal ;");
$pageQuery->execute(["fechaInicio" => $fechainicial,
"fechaFinal" =>$fechaDeFin]);
$numOfPages = $pageQuery->fetchColumn();
$totalPages = ceil($numOfPages/$records_per_page);
$totalPagesArray = [
    "numPaginas" => $totalPages,
    "nombreEmpleada" => "Todos"
];

$data = [$json, $totalPagesArray];
echo json_encode($data);


}else{
    echo "No se encontraron los datos buscados.";
}
}else{
$stmt = $conn->prepare("SELECT * from LibroServicios WHERE Nombre_Empleada =:empleada AND (Fecha_Inicio AND Fecha_Finalizacion BETWEEN :fechaInicio AND :fechaFinal) ORDER BY ID DESC LIMIT $start_from, $records_per_page;");
$result =$stmt->execute(["empleada" => $empleada,
"fechaInicio" => $fechainicial,
"fechaFinal" =>$fechaDeFin
]);
if($result && $numRows = $stmt->rowCount() >= 1){
$json = [];
while($registro = $stmt->fetch(PDO::FETCH_ASSOC)){
    $idServicio = $registro["ID"];
    $nombreEmpleada = utf8_encode($registro["Nombre_Empleada"]);
    $tipo = utf8_encode($registro["Tipo"]);
    $usuario = utf8_encode($registro["Usuario"]);
    $precioFinal = $registro["Precio_Total"];
    $gananciaEmpleada = $registro['Ganancia_Empleada'];
    $gananciaCasa = $registro["Ganancia_Casa"];
    $descuentosEmpleada = $registro['Descuentos_Empleada'];
    $totalEmpleada = $registro['Total_Empleada'];
    $fechaInicio = $registro['Fecha_Inicio'];
    $fechaFinal = $registro['Fecha_Finalizacion'];
    $habitacion = $registro["Habitacion"];
    $servicioPrestado = utf8_encode($registro["Servicio_Prestado"]);
    $Tiempo = utf8_encode($registro["Duracion_Servicio"]);
    $json[] = [
        "id" => $idServicio,
        "nombre" => $nombreEmpleada,
        "tipo" => $tipo,
        "usuario" => $usuario,
        "precioFinal" => $precioFinal,
        "gananciaEmpleada" => $gananciaEmpleada,
        "gananciaCasa" => $gananciaCasa,
        "descuentosEmpleada" => $descuentosEmpleada,
        "totalEmpleada" => $totalEmpleada,
        "fechaInicio" => $fechaInicio,
        "fechaFinal" => $fechaFinal,
        "tipo" => $tipo,
        "habitacion" => $habitacion,
        "servicioPrestado" =>$servicioPrestado,
        "tiempo" => $Tiempo
    ];
    
}

$pageQuery = $conn->prepare("SELECT COUNT(*) from LibroServicios WHERE Nombre_Empleada =:empleada AND (Fecha_Inicio OR Fecha_Finalizacion BETWEEN :fechaInicio AND :fechaFinal)");
$pageResult = $pageQuery->execute(["empleada" => $empleada,
"fechaInicio" => $fechainicial,
"fechaFinal" =>$fechaDeFin
]);
$numOfPages = $pageQuery->fetchColumn();
$totalPages = ceil($numOfPages/$records_per_page);
$totalPagesArray = [
    "numPaginas" => $totalPages,
    "empleada" => $nombreEmpleada
];
$data = [$json, $totalPagesArray];
echo json_encode($data);

}else{
    echo "No se encontraron los datos buscados";
}
}
}else{
    echo "Debe seleccionar una fecha y una empleada";
}
?>