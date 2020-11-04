<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/dashboard-menu.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/registro.js"></script>
</head>
<body>
  <div class="main">
<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn close" onclick="closeNav()">&times;</a>
  <a href="#">About</a>
  <a href="#" data-toggle="modal" data-target="#staticBackdrop">Crear usuario</a>
  <a href="#">Clients</a>
  <a href="#">Contact</a>
</div>   
<div class="row">
  <div class="col-md-1">
<a href="javascript:void(0)" onclick="openNav()">
<div class="container">
<div class="bar"></div>
<div class="bar"></div>
<div class="bar"></div>
</div>
</a>
</div>
</div>
<div class="row">
<div class="col-md-4">
  Hola
</div>
<div class="col-md-4">
  Hola
</div>
<div class="col-md-4">
  Hola
</div>

</div>


<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
  Launch static backdrop modal
</button> -->





<!-- Modal -->
<?php include('includes/register-modal.php'); ?>
<!-- Button trigger modal -->

</div>
<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
</body>
</html>