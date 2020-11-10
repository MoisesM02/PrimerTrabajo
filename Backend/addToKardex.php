<?php
# Usado en recibosdeproductos.php
include "connection.php";
if (isset($_POST)) {
    $i = 7;
    try {

        foreach ($_POST as $productos) {
            foreach ($productos as $producto) {
                $id = $producto[0][2];
                $ids[] = $id;
                $username = utf8_decode($producto[0][3]);
                $nombre = utf8_decode($producto[0][0]);
                (float) $precio = $producto[0][1];
                (int) $cantidad = $producto[1][1];
                (float) $descuento = $producto[2][1];
                $total = $precio * $cantidad - ($precio * ($descuento / 100));
                $selectStmt = $conn->prepare("SELECT * FROM Kardex WHERE ID = (SELECT max(ID) FROM Kardex WHERE ID_Producto =:idProducto)");
                $selectStmt->execute(["idProducto" => $id]);
                $count = $conn->prepare("SELECT COUNT(*) FROM Kardex WHERE ID = (SELECT max(ID) FROM Kardex WHERE ID_Producto =:idProducto)");
                $count->execute(["idProducto" => $id]);
                $i = $count->fetchColumn();
                if ($i < 1) {
                    echo $i;
                    $stmt2 = $conn->prepare("INSERT INTO Kardex (ID_Producto, Nombre_Producto, Fecha, Descripcion, Valor_Unitario, Cantidad_Entradas, Valor_Entradas, Cantidad_Salidas, Valor_Salidas, Cantidad_Total, Valor_Total, Usuario, Tipo_de_Operacion) VALUES (:id, :nombre, NOW(), 'Inventario inicial', :precioCompra, :cantidadEntrada, :valorEntrada, 0, 0, :cantidadEntrada, :valorEntrada, :usuario, 'Entrada')");
                    $valorEntrada = $precio *$cantidad;
                    $result = $stmt2->execute([
                        "id" => $id,
                        "nombre" => $nombre,
                        "precioCompra" => $precio,
                        "cantidadEntrada" => $cantidad,
                        "valorEntrada" => $valorEntrada,
                        "usuario" => "Empleada 1"
                    ]);
                    if(!$result){
                        echo "Algo salió mal";
                        $conn->rollback();
                    }
                }else{
                    $lastEntry = $selectStmt->fetch(PDO::FETCH_ASSOC);
                    $antiguoValorTotal = $lastEntry["Valor_Total"];
                    $valorDeCompra = $cantidad*$precio;
                    $nuevoInventario = $lastEntry["Cantidad_Total"] + $cantidad;

                    $nuevoPrecioUnitario = ($antiguoValorTotal+($cantidad*$precio))/$nuevoInventario;
                    $nuevoValorInventario = $nuevoInventario*$nuevoPrecioUnitario;
                    $stmt2 = $conn->prepare("INSERT INTO Kardex (ID_Producto, Nombre_Producto, Fecha, Descripcion, Valor_Unitario, Cantidad_Entradas, Valor_Entradas, Cantidad_Salidas, Valor_Salidas, Cantidad_Total, Valor_Total, Usuario, Tipo_de_Operacion) VALUES (:id, :nombre, NOW(), 'Compra', :nuevoValorUnitario, :cantidadEntrada, :valorEntrada, 0, 0, :nuevoTotalInventario, :nuevoValorInventario, :usuario, 'Entrada')");
                    $result = $stmt2->execute([
                        "id" => $id,
                        "nombre" => $nombre,
                        "nuevoValorUnitario" => $nuevoPrecioUnitario,
                        "cantidadEntrada" => $cantidad,
                        "valorEntrada" => $valorDeCompra,
                        "nuevoTotalInventario" => $nuevoInventario,
                        "nuevoValorInventario" => $nuevoValorInventario,
                        "usuario" => $username
                    ]);
                    if(!$result){
                        echo "Algo salió mal";
                        $conn->rollback();
                    }
                }

                $stmt = $conn->prepare("UPDATE Productos SET Cantidad_en_Stock = Cantidad_en_Stock +:cantidad WHERE ID_Producto =:id");
                $result = $stmt->execute([
                    "cantidad" => $cantidad,
                    "id" => $id,
                ]);
            }
        }
        echo "Se ha actualizado el inventario correctamente";
    } catch (Exception $e) {
        throw $e;
        echo "Hubo un problema al actualizar";
    }
}
