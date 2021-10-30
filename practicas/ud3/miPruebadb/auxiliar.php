<?php
function conectar()
{
    return new PDO(
        'pgsql:host=localhost;dbname=prueba',
        'prueba',
        'prueba'
    );
}

function filtrar_trim($nombre, $metodo = INPUT_POST)
{
    return filter_input($metodo, $nombre, FILTER_CALLBACK,
                        ['options' => 'trim']);
}

function mostrar_error(&$error, $par)
{
    if (isset($error[$par])) { ?>
        <span style="color: red;"><?= $error[$par] ?></span><?php
    }
}

function mostrar_formulario(array $params, $error, $update = false)
{
    extract($params);
    ?>
    <div>
        <form action="" method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre"
                    value="<?= $nombre ?>"/>
                <?php mostrar_error($error, 'nombre') ?>
            </div>

            <div>
                <label for="fecha_alt">Fecha de alta:</label>
                <input id="fecha_alt" type="text" name="fecha_alt"
                    value="<?= $fecha_alt ?>"/>
                <?php mostrar_error($error, 'fecha_alt') ?>
            </div>

            <div>
                <label for="salario">Salario:</label>
                <input id="salario" type="text" name="salario"
                    value="<?= $salario ?>"/>
                <?php mostrar_error($error, 'salario') ?>
            </div>

            <div>
                <label for="depart_id">ID Departamento:</label>
                <input id="depart_id" type="text" name="depart_id"
                    value="<?= $depart_id ?>"/>
                <?php mostrar_error($error, 'depart_id') ?>
            </div>

            <!-- TODO: Que el texto del botón cambie si insertamos o modificamos -->
            <div>
                <button type="submit">
                    <?= ($update) ? 'Modificar' : 'Insertar' ?>
                </button>
                <button><a href="/index.php">Volver</a></button>
            </div>
        </form>
    </div><?php
}

/* TODO(?)
function contar_filas()
{

} */

function comprobar_cookie()
{
    return !isset($_COOKIE['aceptar_banner']);
}

function banner_cookie()
{
    if (comprobar_cookie()): ?>
        <div style="display: flex; justify-content: right; background-color: black; color: white; padding: 1em; margin: 5px 5px;">
        <form action="aceptar_cookie.php">
            Este sitio usa cookies.
            <button>Aceptar</button>
        </form>
    </div>

    <?php endif;
}

function logueado()
{
    return $_SESSION['login'] ?? false;
}

function cabecera()
{
    banner_cookie(); ?>
    <div style="display: flex; justify-content: left;">
        <h3>Mi PruebaDB</h3>
    </div>
    <div style="display: flex; justify-content: right;">

        <?php if ($login = logueado()) : ?>
            <?= $login['username'] ?>
            <form action="sesion/logout.php" method="POST" style="margin-left: .7em;">
                <button style="margin: .5em .5em; padding: .3em 1.5em;" type="submit">Logout</button>
            </form>
        <?php else: ?>
            <form action="sesion/login.php" method="get">
                <button style="margin: .5em .5em; padding: .3em 1.5em;" type="submit">Login</button>
            </form>
        <?php endif ?>
    </div>

    <hr><?php

    return $login;
}

function hh($cadena)
{
    return htmlspecialchars($cadena, ENT_QUOTES | ENT_SUBSTITUTE);
}

function tp($target)
{
    header("Location: $target");
    return;
}
