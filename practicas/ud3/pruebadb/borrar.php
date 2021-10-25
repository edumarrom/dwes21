<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar empleado</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    if (isset($_POST['id'])) {
        $id = trim($_POST['id']);

        if (ctype_digit($id)) {
            $pdo = conectar();
            $sent = $pdo->prepare('DELETE FROM emple WHERE id = :id');
            if ($sent->execute([':id' => $id])
            && $sent->rowCount() === 1) {
                // Bien
            } else {
                // mal
            }
            header('Location: consulta3.php');
            return;
        }
    } elseif (isset($_GET['id'])) {
        // Se ha recibido un GET en lugar de un POST
        $id = trim($_GET['id']);
    } else {
        // Error: Intento de acceder a este php directamente
        header('Location: consulta3.php');
        return;
    }


    ?>
    <h3>Seguro que quiere borrar el empleado?</h3>
    <form action="borrar.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id']?>">
        <button type="submit">Sí</button>
        <button><a href="consulta3.php">No</a></button>
    </form>
</body>
</html>
