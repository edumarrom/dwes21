<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    /* Departamentos */
    $pdo = conectar();
    $depart= $pdo->query('SELECT COUNT(*) FROM depart');
    $depart_count = $depart->fetchColumn(); // Devuelve la primera columna.
    $depart = $pdo->query('SELECT * FROM depart'); // PSOStatement implements Traversable.

    /* Empleados */
    $emple= $pdo->query('SELECT COUNT(*) FROM emple');
    $emple_count = $emple->fetchColumn();
    $emple = $pdo->query('SELECT * FROM emple');
    // $filas = $sent->fetchAll(); :^)

    /* Join Empleados & Departamento */
    $sent= $pdo->query('SELECT COUNT(*)
                            FROM emple e
                       LEFT JOIN depart d
                              ON e.depart_id = d.id');
    $count = $sent->fetchColumn();
    $sent = $pdo->query('SELECT *
                            FROM emple e
                       LEFT JOIN depart d
                              ON e.depart_id = d.id');

    ?>
    <h2>Departamentos</h2>
    <table border="1">
        <thead>
            <th>Id</th>
            <th>Denominación</th>
            <th>Localidad</th>
        </thead>
        <tbody>
            <?php foreach ($depart as $fila) :?>
            <tr>
                <td> <?= $fila['id']?> </td>
                <td><?= $fila['denom']?></td>
                <td><?= $fila['localidad']?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Número de filas:</td>
                <td><?=$depart_count?></td>
            </tr>
        </tfoot>
    </table>
    <h2>Empleados</h2>
    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>Fecha de alta</th>
            <th>Salario</th>
            <th>Departamento</th>
        </thead>
        <tbody>
            <?php foreach ($emple as $fila) :?>
            <tr>
                <td> <?= $fila['nombre']?> </td>
                <td><?= $fila['fecha_alt']?></td>
                <td><?= $fila['salario']?></td>
                <td><?= $fila['depart_id']?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Número de filas:</td>
                <td><?=$emple_count?></td>
            </tr>
        </tfoot>
    </table>
    <h2>Join Empleados y Departamentos</h2>
    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>Fecha de alta</th>
            <th>Salario</th>
            <th>Departamento</th>
            <th>Localidad</th>
        </thead>
        <tbody>
            <?php foreach ($sent as $fila) :?>
            <tr>
                <td> <?= $fila['nombre']?> </td>
                <td><?= $fila['fecha_alt']?></td>
                <td><?= $fila['salario']?></td>
                <td><?= $fila['denom']?></td>
                <td><?= $fila['localidad']?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Número de filas:</td>
                <td><?=$count?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
