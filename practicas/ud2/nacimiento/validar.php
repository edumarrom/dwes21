<?php
/* //TODO: Mejorar estas comprobaciones
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
} */

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

function calcular_edad(string $fecha_nac): string
{
    /* TODO: Revisar esta opción más práctica:
    return (new DateTime())->diff(newDatetime($fecha_nac))->y; */
    $nacimiento = new DateTime($fecha_nac);
    $edad = $nacimiento->diff(new DateTime())->format('%y');
    return $edad;
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

function dibujar_formulario($par)
{
    extract($par);
    ?>
    <h1>Formulario</h1>
    <form action="" method="GET">
        <div>
            <label>Nombre:
                <input type="text" name="nombre" size="10" value="<?= $nombre ?>"/>
            </label>
        </div>
        <div>
            <label>Apellidos:
                <input type="text" name="ape" size="10" value="<?= $ape ?>"/>
            </label>
        </div>
        <div>
            <label>Fecha de nacimiento:
                <input type="date" name="fecha_nac" size="10" value="<?= $fecha_nac ?>"/>
                <!-- <input type="text" name="fecha_nac" size="10" value="<?= $fecha_nac ?>" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"/> -->
            </label>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>
    <?php
}

function primera_vez()
{
    return empty($_GET);
}
