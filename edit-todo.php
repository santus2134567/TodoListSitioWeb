<?php
include "includes/config.php";
session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php");
    die();
}

if (isset($_GET["id"])) {
    $todoId = mysqli_real_escape_string($conn, $_GET["id"]);
} else {
    header("Location: todos.php");
}

$msg = "";

if (isset($_POST["updateTodo"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $desc = mysqli_real_escape_string($conn, $_POST["desc"]);

    // Updating todo
    $sql = "UPDATE todos SET title='{$title}', description='{$desc}', date=CURRENT_TIMESTAMP WHERE id='{$todoId}'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $_POST["title"] = "";
        $_POST["desc"] = "";
        $msg = "<div class='alert alert-success'>Tarea fue actualizada</div>";
    } else {
        $msg = "<div class='alert alert-danger'>Tarea no fue actualizada</div>";
    }
}

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
$sql = "SELECT * FROM todos WHERE id='{$todoId}' AND user_id='{$user_id}'";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
    $todoData = mysqli_fetch_assoc($res);
} else {
    header("Location: todos.php");
}

?>


<!doctype html>
<html lang="en">

<head>
    <?php getHead(); ?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="bg-light">
    <?php getHeader(); ?>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card bg-dark rounded border shadow">
                    <div class="card-header px-4 py-3">
                        <h4 class="card-title">Editar Tarea</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php echo $msg; ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="title" class="form-label">Titulo</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="ingresa el titulo de tu trabajo " value="<?php echo $todoData['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Descripcion</label>
                                <textarea class="form-control" id="desc" name="desc" rows="3" required><?php echo $todoData['description']; ?></textarea>
                            </div>
                            <div>
                                <button type="submit" name="updateTodo" class="btn btn-primary me-2">Actualizar tarea</button>
                                <button type="reset" class="btn btn-danger">Reiniciar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>