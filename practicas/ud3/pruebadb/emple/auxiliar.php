<?php

function mostrar_formulario(array $params, $error, $update = false)
{
    extract($params);
    ?>
    <div>
        <form action="" method="POST">
            <input type="hidden" name="token_csrf" value="<?= $token_csrf ?>">
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

            <div>
                <button type="submit" style="margin: .2em .2em; padding: .3em 1.5em;">
                    <?= ($update) ? 'Modificar' : 'Insertar' ?>
                </button>
                <button style="margin: .2em .2em; padding: .3em 1.5em;"><a href="/emple/index.php">Volver</a></button>
            </div>
        </form>
    </div><?php
}
