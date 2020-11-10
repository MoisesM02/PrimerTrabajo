<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/productos.css">
</head>
<body>
    <?php include("includes/menu.php")?>
    <div class="container">
        <div class="row">
        <div class="col-md-1 my-4"><span >Entradas</span></div>    
        <div class="col-md-3">
                <select class="form-control my-3" id="records_numbers">
                <option value="10">10</option>
                <option value="15">15</option>
               </select>
        </div>
        <div class="col-md-2 my-3">
        <button class="btn btn-primary" id="showModal">Añadir producto</button>
        </div>
        <div class="col-md-3 my-3">
        <input type="text" class="form-control" id="buscador">
        </div>
        <div class="col-md-1">
        <button class="btn btn-primary my-3" id="buscarProducto">Buscar</button>
        </div>
        <div class="col-md-1">
        <button id="reiniciar" class="btn btn-danger my-3">Reiniciar</button>
        </div>
        </div>
    
    <div class="tableResponsive pt-3" id="paginationData">

    </div>
   
    <div id="pages">
    </div>
    
    <?php include('includes/productos-crud.php') ?>
    </div>
    <input type="hidden" id="numOfRecords" value="10">
    <input type="hidden" id="PageNumber" value="1">


    
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/productos.js"></script>
</body>
</html>