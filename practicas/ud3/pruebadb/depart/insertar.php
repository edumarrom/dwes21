<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear departamento</title>
</head>
<body>
    <?php
    require '../comunes/auxiliar.php';
    require 'auxiliar.php';

    $denom = filtrar_trim('denom');
    $localidad = filtrar_trim('localidad');
    $error = [];

    if(isset($denom)) {
        if ($denom === '') {
            $error['denom'] = 'La denominación es obligatoria.';
        }
    }

    if (isset($localidad)) {
        if ($localidad === '') {
            $error['localidad'] = 'La localidad es obligatoria.';
        }
    }

    $pdo = conectar();

    if (isset($denom, $localidad) && empty($error)) {
        // TODO: Función que asegura que las peticiones llegan desde la misma sesión
        /* if (!isset($_SESSION['token_csrf'])
            || $token_csrf !== $_SESSION['token_csrf']) {
            tp('/falloElToken/index.php');  // Está fallando
            return;
        } */

        $sent = $pdo->prepare(
            'INSERT INTO depart (denom, localidad)
                VALUES (:denom, :localidad)'
        );
        if ($sent->execute([
            ':denom' => $denom,
            ':localidad' => $localidad,
        ]) || $sent->rowCount() !== 1) {
            // Ha habido un error.
        }
        tp('/depart/index.php');
    }

    cabecera();

    // TODO: Token de control
    /* $token_csrf = bin2hex(random_bytes(32));
    $_SESSION['token_csrf'] = $token_csrf; */

    mostrar_formulario(
        compact(
            'denom',
            'localidad'
        ), $error);
    ?>
</body>
</html>
