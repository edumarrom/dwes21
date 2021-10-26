<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <?php
    require 'conectar.php';

    $nombre = (isset($_GET['nombre'])) ? $nombre = trim($_GET['nombre']) : null;
    $denom = (isset($_GET['denom'])) ? $denom = trim($_GET['denom']) : null;
    $salario = (isset($_GET['salario'])) ? trim($_GET['salario']) : null;

    $query = "FROM emple e
         LEFT JOIN depart d
                ON e.depart_id = d.id";

    $where = [];
    $execute = [];

    if(isset($nombre) && $nombre !== '') {
        $where[] = 'preparar(nombre) LIKE preparar(:nombre)';
        $execute[':nombre'] = "%$nombre%";
    }

    if(isset($denom) && $nombre !== '') {
        $where[] = 'preparar(denom) LIKE preparar(:denom)';
        $execute[':denom'] = "%$denom%";
    }

    if(isset($salario) && $nombre !== '') {
        if (is_numeric($salario)) {
            $where[] = 'salario = :salario';
            $execute[':salario'] = $salario;
        }
    }

    if(!empty($where)) {
        $query .= ' WHERE ' . implode(' AND ', $where);
    };

    /* Join Empleados & Departamento */

    $pdo = conectar();
    $sent = $pdo->prepare("SELECT COUNT(*) $query");
    $sent->execute($execute);

    $count = $sent->fetchColumn();

    $sent = $pdo->prepare("SELECT e.*, d.denom, d.localidad $query");
    $sent->execute($execute);
    ?>

    <h2>Join Empleados y Departamentos</h2>
    <form action="" method="GET">
        <div>
            <label>Nombre:
                <input type="text" name="nombre" size="10" value="<?= $nombre ?>"/>
            </label>
            <label>Departamento:
                <input type="text" name="denom" size="10" value="<?= $denom ?>"/>
            </label>
            <label>Salario:
                <input type="text" name="salario" size="10" value="<?= $salario ?>"/>
            </label>
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>
    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>Fecha de alta</th>
            <th>Salario</th>
            <th>Departamento</th>
            <th>Localidad</th>
        </thead>
        <tbody>
            <?php foreach ($sent as $fila) :
                /* echo '<pre>'; print_r($fila); echo '</pre>' */
                ?>
            <tr>
                <td><?= $fila['nombre']?> </td>
                <td><?= $fila['fecha_alt']?></td>
                <td><?= $fila['salario']?></td>
                <td><?= $fila['denom']?></td>
                <td><?= $fila['localidad']?></td>
                <td>
                    <form action="borrar.php" method="get">
                        <input type="hidden" name="id" value="<?=$fila['id']?>"></input>
                        <button type="submit">Borrar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <td>Nº ocurrencias:</td>
                <td><?=$count?></td>
            </tr>
        </tfoot>
    </table>
    <form action="crear.php" method="get">
        <label>Nombre:
                <input type="text" name="nombre" size="10" value="Paco"/>
        </label>
        <label>Fecha de alta:
                <input type="text" name="fecha_alt" size="10" value="2019-12-04 17:00:00"/>
        </label>
        <label>Salario:
                <input type="text" name="salario" size="10" value="2990.75"/>
        </label>
        <label>ID Departamento:
                <input type="text" name="depart_id" size="10" value="1"/>
        </label>

        <button type="submit">Crear empleado</button>
    </form>
</body>
</html>
