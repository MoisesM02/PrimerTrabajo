<?php
include("connection.php");
$page = 0;
$records_per_page = 0;
if (isset($_POST["pageNumber"]))
{
    $page = $_POST["pageNumber"];
    if(isset($_POST["records"])){
        $records_per_page = $_POST["records"];
    }else{
        $records_per_page = 5;
    }
}else{
    $page = 1;
    if(isset($_POST["records"])){
        $records_per_page = $_POST["records"];
    }else{
        $records_per_page = 5;
    }
}
$start_from = ($page-1)*$records_per_page;
$stmt = $conn->prepare("SELECT * from Servicios ORDER BY ID ASC LIMIT $start_from, $records_per_page;");
$result =$stmt->execute();
if($result){
$json = [];
while($servicio = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id = $servicio["ID"];
    $nombre = utf8_encode($servicio["Nombre_de_Servicio"]);
    $tipo = utf8_encode($servicio["Tipo"]);
    $gananciaEmpleado = $servicio['Ganancia_de_Empleado'];
    $gananciaCasa = $servicio["Ganancia_de_Casa"];
    $precioTotal = $servicio["Precio_Total"];
    $porcentajeEmpleado = $servicio["Porcentaje_Empleada"];
    $porcentajeCasa = $servicio["Porcentaje_Casa"];
    $tiempo = utf8_encode($servicio["Tiempo"]);
    $json[] = [
        "id" => $id,
        "nombre" => $nombre,
        "tipo" => $tipo,
        "porcentajeEmpleado" => $porcentajeEmpleado,
        "porcentajeCasa" => $porcentajeCasa,
        "gananciaEmpleado" => $gananciaEmpleado,
        "gananciaCasa" => $gananciaCasa,
        "precioTotal" => $precioTotal,
        "tiempo" => $tiempo
    ];
    }
    
$pageQuery = $conn->query("SELECT COUNT(*) from Servicios;");
// $pageResult = $pageQuery->execute();
$numOfPages = $pageQuery->fetchColumn();
$totalPages = ceil($numOfPages/$records_per_page);
$totalPagesArray = [
    "numPaginas" => $totalPages
];
$data = [$json, $totalPagesArray];
echo json_encode($data);
}else{
    echo "<h3>Hay un error al generar la tabla </h3>";
}


?>