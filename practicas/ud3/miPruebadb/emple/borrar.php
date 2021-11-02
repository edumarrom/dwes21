<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar empleado</title>
</head>
<body>
    <?php
    require '../comunes/auxiliar.php';

    if (isset($_POST['id'])) {
        $id = trim($_POST['id']);

        if (ctype_digit($id)) {
            $pdo = conectar();
            $sent = $pdo->prepare('DELETE FROM emple WHERE id = :id');
            if ($sent->execute([':id' => $id])
            && $sent->rowCount() === 1) {
                // Bien
                foreach ($_SESSION['carrito'] as &$item) {
                    if ($item['id'] == $id) {
                        unset($_SESSION['carrito'][$item['id']]);
                    }
                }
            } else {
                // mal
            }
            tp('/index.php');
        }
    } elseif (isset($_GET['id'])) {
        // Se ha recibido un GET en lugar de un POST
        $id = trim($_GET['id']);
    } else {
        // Error: Intento de acceder a este fichero directamente
        tp('/index.php');
    }
    ?>

    <?php cabecera() ?>

    <h3>Seguro que quiere borrar el empleado?</h3>
    <form action="index.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id']?>">
        <button type="submit">Sí</button>
        <button><a href="/index.php">No</a></button>
    </form>
</body>
</html>
