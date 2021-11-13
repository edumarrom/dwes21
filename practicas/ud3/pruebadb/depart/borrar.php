<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar departamento</title>
</head>
<body>
    <?php
    require '../comunes/auxiliar.php';
    require 'auxiliar.php';

    if (isset($_POST['id'])) {
        $id = trim($_POST['id']);

        if (ctype_digit($id)) {
            $pdo = conectar();
            $sent = $pdo->prepare('DELETE FROM depart WHERE id = :id');
            if ($sent->execute([':id' => $id])
            && $sent->rowCount() === 1) {
                // TODO: Borrar del carrito,  si existe, al departamento borrado.
            } else {
                // mal
            }
            tp('/depart/index.php');
        }
    } elseif (isset($_GET['id'])) {
        // Se ha recibido un GET en lugar de un POST
        $id = trim($_GET['id']);
    } else {
        // Error: Intento de acceder a este fichero directamente
        tp('/depart/index.php');
    }
    ?>

    <?php cabecera() ?>

    <h3>Seguro que quiere borrar el departamento? </h3>
    <form action="borrar.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id']?>">
        <button type="submit">Sí</button>
        <button><a href="/depart/index.php">No</a></button>
    </form>
</body>
</html>
