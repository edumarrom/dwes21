<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
</head>
<body>
    <?php
    /* MODIFICAR UN EMPLEADO */
    require '../auxiliar.php';

    /* if(isset($_SESSION['saludo'])) {
        var_dump($_SESSION['saludo']);
    } */

    $id = filtrar_trim('id', INPUT_GET);
    $error = [];

    $pdo = conectar();

    if (isset($id)) {
        if (!ctype_digit($id)) {
            $_SESSION['mensaje_error'] = 'El ID no es correcto'.
            tp('/index.php');
        }
        $sent = $pdo->prepare('SELECT *
                                 FROM emple
                                WHERE id = :id');
        $sent->execute([':id' => $id]);
        $fila = $sent->fetch(PDO::FETCH_ASSOC);

        if ($fila === false) {
            // Error
            tp('/index.php');
        }
    } else {
        // Error
        tp('/index.php');
    }




    $nombre = filtrar_trim('nombre');
    $fecha_alt = filtrar_trim('fecha_alt');
    $salario = filtrar_trim('salario');
    $depart_id = filtrar_trim('depart_id');

    if(!isset($nombre, $fecha_alt, $salario, $depart_id)) {
        extract($fila);
    }

    if(isset($nombre)) {
        if ($nombre === '') {
            $error['nombre'] = 'El nombre es obligatorio.';
        }
    }

    // TODO: Validar $fecha_alt

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
            $sent = $pdo->prepare("SELECT COUNT(*)
                                     FROM depart
                                    WHERE id = ?"); // marcador posicional/nominal
            $sent->execute([$depart_id]);
            if ($sent->fetchColumn() === 0) {
                $error['depart_id'] = 'El departamento no existe.';
            }
        }
    }

    if (isset($nombre, $fecha_alt,  $salario, $depart_id)
        && empty($error)) {
        $sent = $pdo->prepare('UPDATE emple
                                  SET nombre = :nombre
                                    , fecha_alt = :fecha_alt
                                    , salario = :salario
                                    , depart_id = :depart_id
                                WHERE id = :id');
        $sent->execute([
            ':nombre' => $nombre,
            ':fecha_alt' => $fecha_alt,
            ':salario' => $salario,
            ':depart_id' => $depart_id,
            ':id' => $id
        ]);
        tp('/index.php');
    }

    cabecera();

    mostrar_formulario(
        compact(
            'nombre',
            'fecha_alt',
            'salario',
            'depart_id',
        ), $error,
        true
    );
    ?>
</body>
</html>
