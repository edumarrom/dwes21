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
    require 'auxiliar.php';

    $nombre = filtrar_trim('nombre');
    $fecha_alt = filtrar_trim('fecha_alt');
    $salario = filtrar_trim('salario');
    $depart_id = filtrar_trim('depart_id');

    $error = [];

    if (isset($salario)) {
        if(!is_numeric($salario)) {
            $error['salario'] = 'El salario deber ser un número.';
        }
    }

    $pdo = conectar();

    if (isset($depart_id)) {
        if (!ctype_digit($depart_id)) {
            $error['depart_id'] = 'El departamento no existe.';
        } else {
            $sent = $pdo->prepare('SELECT COUNT(*)
                                 FROM depart
                                WHERE id = ?'); // marcador posicional/nominal
            $sent->execute([$depart_id]);
            if ($sent->fetchColumn() === 0) {
                $error['depart_id'] = 'El departamento no existe.';
            }
        }
    }

    var_dump($nombre, $fecha_alt, $salario, $depart_id);

    if (isset($nombre, $fecha_alt, $salario, $depart_id)
        && empty($error)) {
        $sent = $pdo->prepare(
            'INSERT INTO emple ( nombre, fecha_alt, salario, depart_id)
                VALUES (:nombre, :fecha_alt, :salario, :depart_id)'
        );
        if ($sent->execute([
            ':nombre' => $nombre,
            ':fecha_alt' => $fecha_alt,
            ':salario' => $salario,
            ':depart_id' => $depart_id,
        ]) || $sent->rowCount() !== 1) {
            // Ha habido un error.
        }
        header('Location: index.php');
        return;
    }
    ?>

    <div>
        <form action="" method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="<?= $nombre ?>"/>
            </div>

            <div>
                <label for="fecha_alt">Fecha de alta:</label>
                <input id="fecha_alt" type="text" name="fecha_alt" value="<?= $fecha_alt ?>"/>
            </div>

            <div>
                <label for="salario">Salario:</label>
                <input id="salario" type="text" name="salario" value="<?= $salario ?>"/>
            </div>

            <div>
                <label for="depart_id">ID Departamento:</label>
                <input id="depart_id" type="text" name="depart_id" value="<?= $depart_id ?>"/>
            </div>

            <button type="submit">Insertar</button>
        </form>
    </div>
</body>
</html>
