<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos</title>
    <style>
        table,
        td {
            border: 1px solid black;
        }

        button {
            margin: .2em .2em;
            padding: .3em 1.5em;
        }
    </style>
</head>
<body>
    <?php require '../comunes/auxiliar.php' ?>

    <?php cabecera() ?>

    <?php if (isset($_SESSION['mensaje_error'])): ?>
        <h2><?= $_SESSION['mensaje_error'] ?></h2>
        <?php unset($_SESSION['mensaje_error']) ?>
    <?php endif ?>

    <?php
    // TODO: Quien crea el carrito, debe ser cualquier sitio donde sea necesario.
    if(!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if(isset($_SESSION['carrito'])) : ?>
        <?php print_r($_SESSION['carrito']); ?>
        <form action="/carrito/vaciar.php">
            <button>Vaciar carrito</button>
        </form>
    <?php endif ?>

    <form action="/expirar_cookie.php">
    <button>Expirar cookie</button>
    </form>

    <?php

    $denom = (isset($_GET['denom'])) ? $denom = trim($_GET['denom']) : null;
    $localidad = (isset($_GET['localidad'])) ? $localidad = trim($_GET['localidad']) : null;

    $query = "FROM depart d";

    $where = [];
    $execute = [];

    if(isset($denom) && $denom !== '') {
        $where[] = 'preparar(denom) LIKE preparar(:denom)';
        $execute[':denom'] = "%$denom%";
    }

    if(isset($localidad) && $localidad !== '') {
        $where[] = 'preparar(localidad) LIKE preparar(:localidad)';
        $execute[':localidad'] = "%$localidad%";
    }

    if(!empty($where)) {
        $query .= ' WHERE ' . implode(' AND ', $where);  // Concatena los where haciendo un implode del array where
    };

    /* Departamentos */
    $pdo = conectar();
    $sent = $pdo->prepare("SELECT COUNT(*) $query");
    $sent->execute($execute);

    $count = $sent->fetchColumn();

    $sent = $pdo->prepare("SELECT d.*/* , d.denom, d.localidad */ $query");
    $sent->execute($execute);
    ?>

    <h2>Departamentos</h2>
    <form action="" method="GET">
        <div>
            <label>Denominación:
                <input type="text" name="denom" size="10" value="<?= $denom ?>"/>
            </label>
            <label>Localidad:
                <input type="text" name="localidad" size="10" value="<?= $localidad ?>"/>
            </label>
        </div>
        <div>
            <button type="submit" style="margin: .5em .5em; padding: .3em 1.5em;">Filtrar</button>
        </div>
    </form>
    <table>
        <thead>
            <th>Denominación</th>
            <th>Localidad</th>
        </thead>
        <tbody>
            <?php foreach ($sent as $fila) :
                /* echo '<pre>'; print_r($fila); echo '</pre>' */
                ?>
            <tr>
                <td><?= $fila['denom'] ?></td>
                <td><?= $fila['localidad'] ?></td>
                <td>
                    <form action="/depart/borrar.php" method="get">
                        <input type="hidden" name="id" value="<?=$fila['id']?>"></input>
                        <button type="submit">Borrar</button>
                    </form>

                    <form action="/depart/modificar.php" method="get">
                        <input type="hidden" name="id" value="<?=$fila['id']?>"></input>
                        <button type="submit">Modificar</button>
                    </form>

                    <form action="/carrito/agregar.php" method="get">
                        <input type="hidden" name="id" value="<?=$fila['id']?>"></input>
                        <button type="submit">Añadir al carrito</button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Nº ocurrencias:</td>
                <td><?=$count?></td>
            </tr>
        </tfoot>
    </table>
    <div>
        <button style="margin: .5em .5em; padding: .3em 1.5em;"><a href="insertar.php">Insertar nuevo departamento</a></button>
    </div>
</body>
</html>
