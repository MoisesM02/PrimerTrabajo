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
$stmt = $conn->prepare("SELECT * from Productos ORDER BY ID ASC LIMIT $start_from, $records_per_page;");
$result =$stmt->execute();
if($result){
$json = [];
while($producto = $stmt->fetch(PDO::FETCH_ASSOC)){
    $idProduct = $producto["ID"];
    $nombre = utf8_encode($producto["Nombre_de_Producto"]);
    $Codigo = $producto["Codigo_de_Producto"];
    $precioEmpleado = $producto['Precio_Empleado'];
    $precioClientes = $producto["Precio_Clientes"];
    $precioCompra = $producto["Precio_de_Compra"];
    $categoria = $producto["Categoria"];
    $cantidad = $producto["Cantidad_en_Stock"];
    $json[] = [
        "id" => $idProduct,
        "nombre" => $nombre,
        "codigo" => $Codigo,
        "precioEmpleado" => $precioEmpleado,
        "precioCliente" => $precioClientes,
        "precioCompra" => $precioCompra,
        "cantidad" => $cantidad,
        "categoria" => $categoria
    ];
    
}

$pageQuery = $conn->query("SELECT COUNT(*) from Productos;");

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