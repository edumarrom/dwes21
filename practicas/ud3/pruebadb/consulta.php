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

    $nombre = (isset($_GET['nombre'])) ? $nombre = trim($_GET['nombre']) : null;

    /* Join Empleados & Departamento */
    $sent= $pdo->query("SELECT COUNT(*)
                            FROM emple e
                       LEFT JOIN depart d
                              ON e.depart_id = d.id
                           WHERE translate(lower(nombre), 'áéíóú', 'aeiou')
                            LIKE translate(lower('%$nombre%'), 'áéíóú', 'aeiou')"); //ILIKE es una extensión de Postgre
    $count = $sent->fetchColumn();
    $sent = $pdo->query("SELECT *
                            FROM emple e
                       LEFT JOIN depart d
                              ON e.depart_id = d.id
                           WHERE translate(lower(nombre), 'áéíóú', 'aeiou')
                            LIKE translate(lower('%$nombre%'), 'áéíóú', 'aeiou')");
    ?>
    <h2>Join Empleados y Departamentos</h2>
    <form action="" method="GET">
        <div>
            <label>Nombre:
                <input type="text" name="nombre" size="10" value="<?= $nombre ?>"/>
            </label>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>
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
                <td>Nº ocurrencias:</td>
                <td><?=$count?></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
