<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar departamento</title>
</head>
<body>
    <?php
    /* MODIFICAR UN EMPLEADO */
    require '../comunes/auxiliar.php';
    require 'auxiliar.php';

    /* if(isset($_SESSION['saludo'])) {
        var_dump($_SESSION['saludo']);
    } */

    $id = filtrar_trim('id', INPUT_GET);
    $error = [];

    $pdo = conectar();

    if (isset($id)) {
        if (!ctype_digit($id)) {
            $_SESSION['mensaje_error'] = 'El ID no es correcto'.
            tp('/depart/index.php');
        }
        $sent = $pdo->prepare('SELECT *
                                 FROM depart
                                WHERE id = :id');
        $sent->execute([':id' => $id]);
        $fila = $sent->fetch(PDO::FETCH_ASSOC);

        if ($fila === false) {
            // Error
            tp('/depart/index.php');
        }
    } else {
        // Error
        tp('/depart/index.php');
    }




    $denom = filtrar_trim('denom');
    $localidad = filtrar_trim('localidad');

    if(!isset($denom, $localidad)) {
        extract($fila);
    }

    if(isset($denom)) {
        if ($denom === '') {
            $error['denom'] = 'La denominación es obligatoria.';
        }
    }

    if(isset($localidad )) {
        if ($localidad  === '') {
            $error['localidad '] = 'La localidad es obligatoria.';
        }
    }

    $pdo = conectar();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'   // Revision en clase
        && isset($denom, $localidad)
        && empty($error)) {
        $sent = $pdo->prepare('UPDATE depart
                                  SET denom = :denom
                                    , localidad = :localidad
                                WHERE id = :id');
        $sent->execute([
            ':denom' => $denom,
            ':localidad' => $localidad,
            ':id' => $id
        ]);
        tp('/depart/index.php');
    }

    cabecera();

    mostrar_formulario(
        compact(
            'denom',
            'localidad',
        ), $error,
        true
    );
    ?>
</body>
</html>
