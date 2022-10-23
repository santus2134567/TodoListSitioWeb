<?php
include "includes/config.php";
session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php");
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
    <?php getHeader(); ?>
    <div class="container">
        <div class="row">
            <?php
            $todoId = mysqli_real_escape_string($conn, $_GET["id"]);
            // Get User Id based on user email
            $sql = "SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                $row = mysqli_fetch_assoc($res);
                $user_id = $row["id"];
            } else {
                $user_id = 0;
            }
            $sql1 = "SELECT * FROM todos WHERE id='{$todoId}' AND user_id='{$user_id}'";
            $res1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($res1) > 0) {
                foreach ($res1 as $todo) {
            ?>
                    <main>
                        <h1><?php echo $todo["title"]; ?></h1>
                        <p class="fs-5 col-md-8"><?php echo $todo["description"]; ?></p>

                        <div class="mb-5">
                            <a href="<?php echo 'edit-todo.php?id='. $todo['id']; ?>" class="btn btn-primary btn-lg px-4 me-2">Editar </a>
                            <a href="<?php echo 'delete-todo.php?id='. $todo['id']; ?>" class="btn btn-danger btn-lg px-4">Eliminar Tarea</a>
                        </div>
                    </main>
            <?php }
            } else {
                header("Location: todos.php");
                die();
            } ?>
        </div>
    </div>
</body>

</html>