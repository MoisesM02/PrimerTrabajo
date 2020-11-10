<?php
session_start();
function usernameValue(){
if(!isset($_SESSION["username"]) && empty($_SESSION["username"])){
    header("Location:login.php");
}else{
    echo utf8_encode($_SESSION["username"]);
}
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/servicios-crud.css">
</head>
<body>
<input type="hidden" id="username" value="<?php usernameValue();?>">
<?php include("includes/menu.php")?>
    <div class="container">
        <div class="row">
        <div class="col-md-2 my-4"><span >Entradas por página</span></div>    
        <div class="col-md-3">
                <select class="form-control my-3" id="records_numbers">
                <option value="10">10</option>
                <option value="15">15</option>
               </select>
        </div>
        <div class="col-md-3 my-3">
        <button class="btn btn-primary" id="showModal">Añadir servicio</button>
        </div>
        </div>
    
    <div class="tableResponsive pt-3" id="paginationData">

    </div>
   
    <div id="pages">
    </div>
    
    <?php include('includes/servicios-crud.php') ?>
    </div>
    <input type="hidden" id="numOfRecords" value="10">
    <input type="hidden" id="PageNumber" value="1">
    

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="js/servicios-crud.js"></script>
</body>
</html>