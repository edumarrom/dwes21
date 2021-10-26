<?php
function conectar()
{
    return new PDO(
        'pgsql:host=localhost;dbname=prueba',
        'prueba',
        'prueba'
    );
}

function filtrar_trim($nombre)
{
    return filter_input(INPUT_POST, $nombre, FILTER_CALLBACK,
                        ['options' => 'trim']);
}

// TODO: Terminar function mostrar_error
function mostrar_error(&$error, $par)
{
    if (isset($error[$par])) { ?>
        <span style="color: red;"><?= $error[$par] ?></span><?php
    }
}

function mostrar_formulario(array $params, &$error)
{
    extract($params);
    ?>
    <div>
        <form action="" method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="<?= $nombre ?>"/>
            </div>

            <div>
                <label for="fecha_alt">Fecha de alta:</label>
                <input id="fecha_alt" type="text" name="fecha_alt" value="<?= $fecha_alt ?>"/>
            </div>

            <div>
                <label for="salario">Salario:</label>
                <input id="salario" type="text" name="salario" value="<?= $salario ?>"/>
            </div>

            <div>
                <label for="depart_id">ID Departamento:</label>
                <input id="depart_id" type="text" name="depart_id" value="<?= $depart_id ?>"/>
            </div>

            <button type="submit">Insertar</button>
            <button><a href="index.php">Volver</a></button>
        </form>
    </div><?php
}

/* TODO(?)
function contar_filas()
{

} */
