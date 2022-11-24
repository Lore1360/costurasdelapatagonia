<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="./Style/bootstrap.min.css"/>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-info">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="./index.php">INICIO</a>
        </li>
    </ul>
</nav>  

<h1>Nuestros productos</h1>
<br>
<div class="conteiner">
    <div class="row">

<?php

    include ("administrador/configuraciones/base.php");

$sentenciaSQL= $conexion->prepare("SELECT * FROM productos");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($listaProductos as $productos) { ?>
<div class="col-md-3">
<div class="card">
    <img class="card-img-top" src="./Resources/img<?php echo $productos['imagen']; ?>" alt="">
<div class="card-body">
        <h4 class="card-title"><?php echo $productos['nombre']; ?></h4>
        <!-- <p class="card-text">Gatito de tela con relleno de arroz. Ideal para esas personas que necesitan reducir el stress.</p>
    <a name="" id="" class="btn btn-primary" href="#" role="button">Ver más</a> -->
</div>
</div>
</div>
<?php } ?>

</div>
</div>
</body>
</html>