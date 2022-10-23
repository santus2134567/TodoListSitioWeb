<?php
include "includes/config.php";
session_start();

if (isset($_SESSION["user_email"])) {
    header("Location: todos.php");
    die();
}
?>

<!doctype html>
<html lang="en">

<head>
    <?php getHead(); ?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <center>
                    <h1 class="display-4 fw-bold lh-1 mb-3">TODO LIST</h1>
                    <p class="col-lg-10 fs-4">ORGANIZA TUS TAREAS PENDIENTES </p>
                    <img src="img/utea.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                </center>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form action="login.php" method="POST" class="p-4 p-md-5 border rounded-3 bg-light">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control " id="floatingInput" placeholder="usuario@ejemplo.com">
                        <label for="floatingInput">Usuario</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Contraseña</label>
                    </div>
                    <button name="submit" class="w-100 btn btn-lg btn-primary" type="submit">Ingresar</button>
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>
</body>

</html>