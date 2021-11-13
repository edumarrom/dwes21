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

function comprobar_cookie()
{
    return !isset($_COOKIE['aceptar_banner']);
}

function banner_cookie()
{
    if (comprobar_cookie()): ?>
        <div style="display: flex; justify-content: right; background-color: black; color: white; padding: 1em; margin: 5px 5px;">
        <form action="/aceptar_cookie.php">
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
        <h1>PruebaDB - Eduardo Martínez Romero</h1>
    </div>
    <div style="display: flex; justify-content: right;">

        <?php if ($login = logueado()) : ?>
            <?= $login['username'] ?>
            <form action="/usuarios/logout.php" method="POST" style="margin-left: .7em;">
                <button style="margin: .5em .5em; padding: .3em 1.5em;" type="submit">Cerrar sesión</button>
            </form>
        <?php else: ?>
            <form action="/usuarios/login.php" method="get">
                <button style="margin: 0 .5em; padding: .3em 1.5em; display: float" type="submit">Iniciar sesión</button>
            </form>
        <?php endif ?>
    </div>
    <!-- Función de carrito -->
    <!-- <?php carrito(); ?> -->
    <hr><?php

    return $login;
}

function carrito()
{
    // TODO: Quien crea el carrito, debe ser cualquier sitio donde sea necesario.
    if(!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    if(isset($_SESSION['carrito'])) : ?>
        <?php print_r($_SESSION['carrito']); ?>
        <form action="/carrito/vaciar.php">
            <button>Vaciar carrito</button>
        </form>
    <?php endif;
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
