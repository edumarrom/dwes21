<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probando interseccion</title>
</head>
<body>
    <?php
    /**
     * Implementa una función que reciba dos arrays de cadena y
     * realice una intersección a partir de sus claves, obteniendo
     * sólo las ocurrencias producidas con el primero.
     *
     * URL de Ejemplo:
     * http://localhost:8000/interseccion.php?nombre="paco"&ape="martinez"&fecha_nac="1997-12-24"
     */
    const CAMPOS = [
        'nombre'    =>'',
        'ape'       =>'',
        'fecha_nac' =>''
    ];
    $error = [];

    //TODO: Mejorar estas comprobaciones
    $valores = comprobar_parametros(CAMPOS, $error);
    if (empty($error)) {
        comprobar_valores($valores, $error);
        if (empty($error)) {
            mostrar_valores($valores);
        } else {
            mostrar_errores($error);
        }
    } else {
        mostrar_errores($error);
    }

    /* $error[] = '¡Verificando que funciona el mostrar errores!';
    mostrar_errores($error); */

    function comprobar_parametros(array $par, &$error): array
    {
        $res = $par;
        if (!empty($_GET)) {
            if ($par == array_intersect_key($par, $_GET)) {
                $res = array_map('trim', $_GET);
                /* mostrar_valores($res); */
            } else {
                $error[] = 'Faltan parámetros.';
            }
        }
        return $res;
    }

    function comprobar_valores($par, &$error)
    {
        extract($par);

        if ($nombre == '') {
            $error[] = 'El nombre es obligatorio.';
        }

        if ($ape == '') {
            $error[] = 'El apellido es obligatorio.';
        }

        if ($fecha_nac == '') {
            $error[] = 'La fecha es obligatoria.';
        } elseif (!comprobar_fecha($fecha_nac)) {
            $error[] = 'La fecha es incorrecta.';
        }
    }

    function comprobar_fecha($fecha)
    {
        $correcto = false;
        $valores = explode('-', $fecha);
        if(count($valores) == 3) {
            [$a, $m, $d] = $valores; // Hola asignación múltiple, pero solo con arrays(?)
        }
        if(checkdate($m, $d, $a)) {
            $correcto = true;
        }
        return $correcto;
    }

    function mostrar_valores(array $par): void
    {
        foreach ($par as $valor) :?>
            <p><?= $valor ?></p>
        <?php endforeach;
    }

    function mostrar_errores(&$errores): void
    {
        foreach ($errores as $err) :?>
            <p>Error: <?= $err ?></p>
        <?php endforeach;
    }
    ?>
</body>
</html>
