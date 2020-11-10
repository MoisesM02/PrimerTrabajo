<?php
include('connection.php');
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
if(isset($_POST["parametro"])){
$parametro = utf8_decode(filter_var($_POST["parametro"], FILTER_SANITIZE_STRING));
try{
$stmt = $conn->prepare("SELECT * from Productos WHERE ID_Producto =:parametro OR Codigo_de_Producto =:parametro OR Categoria LIKE concat('%', :parametro, '%') OR Nombre_de_Producto LIKE concat('%', :parametro,'%') ORDER BY ID_Producto ASC LIMIT $start_from, $records_per_page;");
$result = $stmt->execute(["parametro" => $parametro]);
if($result){
    $json = [];
    while($producto = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id = $producto["ID_Producto"];
    $nombre = utf8_encode($producto["Nombre_de_Producto"]);
    $Codigo = $producto["Codigo_de_Producto"];
    $precioEmpleado = $producto['Precio_Empleado'];
    $precioClientes = $producto["Precio_Clientes"];
    $precioCompra = $producto["Precio_de_Compra"];
    $cantidad = $producto["Cantidad_en_Stock"];
    $categoria = utf8_encode($producto["Categoria"]);
    $json[] = [
        "id" => $id,
        "nombre" => $nombre,
        "codigo" => $Codigo,
        "precioEmpleado" => $precioEmpleado,
        "precioCliente" => $precioClientes,
        "cantidad" => $cantidad,
        "precioCompra" => $precioCompra,
        "categoria" => $categoria
    ];
    }
    $pageQuery = $conn->prepare("SELECT COUNT(*) from Productos WHERE ID_Producto =:parametro OR Codigo_de_Producto =:parametro OR Categoria LIKE concat('%', :parametro, '%') OR Nombre_de_Producto LIKE concat('%', :parametro, '%');");
$pageQuery->execute(["parametro" => $parametro]);
$numOfPages = $pageQuery->fetchColumn();
$totalPages = ceil($numOfPages/$records_per_page);
$totalPagesArray = [
    "numPaginas" => $totalPages
];
    $json = [$json, $totalPagesArray];
    echo json_encode($json);
}else{
    echo "No se encontró ningún producto";
}
}catch(Exception $e){
throw $e;
}

}else{
    echo "No se ha seleccionado encontrado ningún producto. Vuelve a intentarlo";
}

?>