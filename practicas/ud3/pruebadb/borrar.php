<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar empleado</title>
</head>
<body>
    <?php
    $id = (isset($_GET['id'])) ? trim($_GET['id']) : null;
    ?>
    <h3>¿Esta seguro?</h3>
    <form action="consulta3.php" method="post">
        <input type="hidden" name="id" value="<?= $_GET['id']?>">
        <button type="submit">Sí</button>
        <button><a href="consulta3.php">No</a></button>
    </form>
</body>
</html>
