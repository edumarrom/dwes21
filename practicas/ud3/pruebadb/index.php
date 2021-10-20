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

    $pdo = conectar();
    $depart = $pdo->query('SELECT * FROM depart'); // PSOStatement implements Traversable.
    $emple = $pdo->query('SELECT * FROM emple');
    // $filas = $sent->fetchAll(); :^)

    ?>
    <table>
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
    </table>

    <table>
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
    </table>
</body>
</html>
