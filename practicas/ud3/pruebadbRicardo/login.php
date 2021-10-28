<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
    require 'auxiliar.php';


    $username = filtrar_trim('username');
    $password = filtrar_trim('password');

    $pdo= conectar();

    $sent = $pdo->prepare('SELECT *
                             FROM usuarios
                            WHERE username = :username');

    $sent->execute([':username => $username']);
    $fila = $sent->fetch();

    if ($fila !== false && password_verify($fila, $fila['password'])) {
        // Correcto
        $_SESSION['login'] = [
            'id' => $fila['id'],
            'username' => $fila['username']
        ];
        header('Location: index.html');
        return;
    } else {
        $error[] = 'Usuario o contraseña incorrectos.';
    }


    ?>

    <?php cabecera(); ?>

    <?php foreach ($error as $err): ?>
        <p>Error: <?=$err ?></p>
    <?php endforeach;
    ?>

    <div>
        <form action="" method="post">
            <label for="uesrname"></label>
            <input type="text" name="username" id="username"
                    value="<?= $username ?>">
            <label for="password"></label>
            <input type="password" name="password" id="password">
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
