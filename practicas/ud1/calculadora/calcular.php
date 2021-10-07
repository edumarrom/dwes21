<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <h1>Calculadora</h1>
    <?php
    require 'calculadora.php';

    $error = [];
    $x = filtrar_operando('x', $error);
    $y = filtrar_operando('y', $error);
    $oper = filtrar_operador('oper', OPER, $error);
    $resultado = calcular($x, $y, $oper, $error);

    if(empty($error)): ?>
        <h2>El resultado es <?=$resultado ?></h2>
    <?php else : ?>
        <?php mostrar_errores($error);
    endif
    ?>
    <a href="index.php">Volver</a>
</body>
</html>
