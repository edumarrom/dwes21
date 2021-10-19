<?php declare(strict_types=1); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
    <?php
        require 'validar.php';
        const CAMPOS = [
            'nombre'    =>'',
            'ape'       =>'',
            'fecha_nac' =>''
        ];
        $error = [];

        $valores = comprobar_parametros(CAMPOS, $error);

        if (!primera_vez()) {
            if(empty($error)) {
                comprobar_valores($valores, $error);
            }
        }

        dibujar_formulario($valores);
        mostrar_errores($error);

        if (!primera_vez() && empty($error)):
            $edad = calcular_edad($valores['fecha_nac']);
            if ($edad != null) : ?>
                <h2>Edad (en años): <?= $edad ?></h2>
            <?php endif;
        endif;
    ?>
</body>
</html>
