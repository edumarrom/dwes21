<?php session_start() ?>
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
    require '../comunes/auxiliar.php';
    require 'auxiliar.php';

    $nombre = filtrar_trim('nombre');
    $fecha_alt = filtrar_trim('fecha_alt');
    $salario = filtrar_trim('salario');
    $depart_id = filtrar_trim('depart_id');
    $token_csrf = filtrar_trim('token_csrf');

    $error = [];

    if(isset($nombre)) {
        if ($nombre === '') {
            $error['nombre'] = 'El nombre es obligatorio.';
        }
    }

    // TODO: Validar $fecha_alt
    if (isset($fecha_alt)) {
        $valores = explode('-', $fecha_alt);
        if(count($valores) == 3) {
            [$a, $m, $d] = $valores; // Hola asignación múltiple, pero solo con arrays(?)
            if(!checkdate($m, $d, $a)) {
                $error['fecha_alt'] = 'La fecha no es válida.';
            }
        } else {
            $error['fecha_alt'] = 'La fecha es obligatoria.';
        }
    }

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

    if (isset($nombre, $fecha_alt, $salario, $depart_id)
        && empty($error)) {

            // TODO: Función que asegura que las peticiones llegan desde la misma sesión
            if (!isset($_SESSION['token_csrf'])
                || $token_csrf !== $_SESSION['token_csrf']) {
                tp('/emple/index.html');
                return;
            }

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
        tp('/emple/index.html');
    }

    cabecera();

    $token_csrf = bin2hex(random_bytes(32));
    $_SESSION['token_csrf'] = $token_csrf;

    mostrar_formulario(
        compact(
            'nombre',
            'fecha_alt',
            'salario',
            'depart_id',
            'token_csrf'
        ), $error);
    ?>
</body>
</html>
