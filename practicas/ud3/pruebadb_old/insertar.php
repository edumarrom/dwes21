<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear empleado</title>
</head>
<body>
    <?php
    require 'conectar.php';

    $nombre = (isset($_GET['nombre'])) ? $nombre = trim($_GET['nombre']) : null;
    $fecha_alt = (isset($_GET['fecha_alt'])) ? $fecha_alt = trim($_GET['fecha_alt']) : null;
    $salario = (isset($_GET['salario'])) ? trim($_GET['salario']) : null;
    $depart_id = (isset($_GET['depart_id'])) ? $depart_id = trim($_GET['depart_id']) : null;

    $query = "INSERT INTO emple (nombre, fecha_alt, salario, depart_id)";

    $values = [];
    $execute = [];

    if(isset($nombre) && $nombre !== '') {
        $values[] = 'preparar(nombre) LIKE preparar(:nombre)';
        $execute[':nombre'] = "%$nombre%";
    }

    if(isset($fecha_alt) && $fecha_alt !== '') {
        $values[] = 'preparar(fecha_alt) LIKE preparar(:fecha_alt)';
        $execute[':fecha_alt'] = "%$fecha_alt%";
    }

    if(isset($salario) && $salario !== '') {
        if (is_numeric($salario)) {
            $values[] = 'salario = :salario';
            $execute[':salario'] = $salario;
        }
    }

    if(isset($depart_id) && $depart_id !== '') {
        if (is_numeric($depart_id)) {
            $values[] = 'depart_id = :depart_id';
            $execute[':depart_id'] = $depart_id;
        }
    }

    if(!empty($values)) {
        $query .= ' VALUES (' . implode(', ', $values) . ');';
    }

    if (false) {
        $pdo = conectar();
        $sent = $pdo->prepare("$query");
        $sent->execute($execute);
        header('Location: index.php');
        return;
    }

    /* if ($sent->execute([':id' => $id])
    && $sent->rowCount() === 1) {
        // Bien
    } else {
        // mal
    } */
    ?>

    <h3>Seguro que quiere crear el empleado?</h3>
    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>Fecha de alta</th>
            <th>Salario</th>
            <th>ID Departamento</th>
        </thead>
        <tbody>
            <tr>
                <td><?= $nombre ?> </td>
                <td><?= $fecha_alt ?></td>
                <td><?= $salario ?></td>
                <td><?= $depart_id ?></td>
            </tr>
        </tbody>
    </table>

    <form action="insertar.php" method="post">
        <button type="submit">Sí</button>
        <button><a href="index.php">No</a></button>
    </form>
</body>
</html>
