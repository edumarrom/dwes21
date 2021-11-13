<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        button {
            margin: .2em .2em;
            padding: .3em 1.5em;
        }
    </style>
</head>
<body>
    <?php
    require '../comunes/auxiliar.php';

    $username = filtrar_trim('username');
    $password = filtrar_trim('password');

    $error = [];

    if (isset($username, $password)) {
        $pdo= conectar();

        $sent = $pdo->prepare('SELECT *
                                FROM usuarios
                                WHERE username = :username');
        $sent->execute([':username' => $username]);
        $fila = $sent->fetch();

        if ($fila !== false && password_verify($fila['username'], $fila['password'])) {
            // Correcto
            $_SESSION['login'] = [
                'id' => $fila['id'],
                'username' => $fila['username']
            ];
            tp('/index.php');
        } else {
            $error[] = 'Usuario o contraseña incorrectos.';
        }
    }
    ?>

    <?php cabecera(); ?>

    <?php foreach ($error as $err): ?>
        <p>Error: <?=$err ?></p>
    <?php endforeach;
    ?>

    <div>
        <form action="" method="post">
            <label for="username">Usuario:</label>
            <input type="text" name="username" id="username"
                    value="<?= $username ?>">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password">
            <button type="submit">Acceder</button>
            <button><a href="index.php">Volver</a></button>
        </form>
    </div>
</body>
</html>
