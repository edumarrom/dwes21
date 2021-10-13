<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>
    <?php
        require 'auxiliar.php';
        $error = [];
        $nombre = 'nombre';
        $ape = 'ape';
        $fechaNac = filtrar_fecha('fechaNac', $error);
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
                <input type="text" name="nombre" size="10" value="<?= $ape ?>"/>
            </label>
        </div>
        <div>
            <label>Fecha de nacimiento:
                <!-- TODO: Cambiar tipo del input a Fecha -->
                <input type="text" name="fechaNac" size="10" value="<?= $fechaNac ?>" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"/>
            </label>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>

    <?php
        if(isset($nombre, $ape, $fechaNac)) :
            $edad=calcular_edad($fechaNac, $error); ?>
            <h2>Edad (en años): <?= $edad ?></h2>
        <?php endif ?>
</body>
</html>
