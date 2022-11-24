<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="../Style/style.css">
    <link rel="stylesheet" href="../Style/stylepage.css">
    <link rel="icon" href="../Resources/img/Reno_Tino.jpg" topmargin=0>
</head>
<body>
<Header>
        <div class="container">
             <p class="logo"> Desde la Patagonia para el mundo </p>
            <nav>
                <a href="#">Quienes Somos</a>
                <a href="#">Nuestros Productos</a>
                <a href="#">Nuestros Cursos</a>
                <a href="#">Contacto</a>
                <a href="./login.php">Login</a>
            </nav>
        </div>
    </Header>
    
<section class="container" id="form-contacto">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <h2 class="titulo-gral">Contactate con <span>nosotros</span></h2>
            <form action="">
                <div class="row gx-2">
                    <div class="col-md mb-3">
                        <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" required>
                    </div>
                    <br>
                    <div class="col-md mb-3">
                        <input type="text" class="form-control" placeholder="Apellido" aria-label="Apellido" required>
                    </div>
                    <br>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <input type="email" class="form-control" placeholder="Email" aria-label="Email" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col mb-3">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4"
                            placeholder="Deje su mensaje aquí" required></textarea>
                        <div id="emailHelp" class="form-text mb-3">Recuerda incluir un mensaje.</div>
                        <div class="d-grid">
                            <br>
                            <button type="submit" class="btn btn-lg btn-form">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
</body>
</html>

