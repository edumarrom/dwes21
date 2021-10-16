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

    /* $argumentos = [
        'nombre'    =>'paco',
        'ape'       => 'martinez',
        'fecha_nac' => '1997-12-24'
    ]; */

    $error = []; ?>

    <p>Los argumentos llegados al GET son: <?=mostrar_valores($_GET) ?></p>

    <?php
    $mis_campos = comprobar_parametros(CAMPOS, $error);
    if (!empty($error)) {
        mostrar_valores($mis_campos);
    } else {
        mostrar_errores($error);
    }

    $error[] = '¡Verificando que funciona el mostrar errores!';
    mostrar_errores($error);

    function comprobar_parametros(array $par, &$errores): array
    {
        $res = $par;
        if (!empty($_GET)) {
            if ($par == array_intersect_key($par, $_GET)) {   // Por algún motivo siempre da true.
                $res = array_map('trim', $_GET);
            } else {
                $errores[] = 'Los parámetros recibidos no son correctos.';
            }
        }
        return $res;
    }

    function mostrar_valores($par): void
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
