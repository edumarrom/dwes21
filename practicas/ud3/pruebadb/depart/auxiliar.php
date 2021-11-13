<?php

function mostrar_formulario(array $params, $error, $update = false)
{
    extract($params);
    ?>
    <div>
        <form action="" method="POST">
            <input type="hidden" name="token_csrf" value="<?= $token_csrf ?>">
            <div>
                <label for="denom">Denominación:</label>
                <input id="denom" type="text" name="denom"
                    value="<?= $denom ?>"/>
                <?php mostrar_error($error, 'denom') ?>
            </div>

            <div>
                <label for="localidad">Localidad:</label>
                <input id="localidad" type="text" name="localidad"
                    value="<?= $localidad ?>"/>
                <?php mostrar_error($error, 'localidad') ?>
            </div>

            <div>
                <button type="submit" style="margin: .2em .2em; padding: .3em 1.5em;">
                    <?= ($update) ? 'Modificar' : 'Insertar' ?>
                </button>
                <button style="margin: .2em .2em; padding: .3em 1.5em;"><a href="/depart/index.php">Volver</a></button>
            </div>
        </form>
    </div><?php
}
