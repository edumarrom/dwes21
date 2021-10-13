<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <?php
        require 'calculadora.php';
        $error = [];
        $x = filtrar_operando('x', $error);
        $y = filtrar_operando('y', $error);
        $oper = filtrar_operador('oper', OPER, $error);
    ?>
    <h1>Calculadora</h1>
    <!-- TODO: Y si quitamos el action? -->
    <form action="" method="GET">
        <div>
            <!-- TODO: Primer operando acumulador -->
            <label for="op1">Primer operando: </label>
            <input id ="op1" type="text" name="x" size="10" value="<?= $x ?>"/>
        </div>
        <div>
            <label for="op2">Segundo operando: </label>
            <input id ="op2" type="text" name="y" size="10" value="<?= $y ?>"/>
        </div>
        <div>
            <label for="oper">Operación: </label>
            <select name="oper" id="oper">
                <?php foreach (OPER as $op): ?>
                    <option value="<?=$op?>" <?=selected($oper, $op) ?> >
                    <?= $op ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <button type="submit">Realizar</button>
        </div>
    </form>

    <?php
        if(isset($x, $y, $oper)) :
            if(empty($error)) :
                $resultado=calcular($x, $y, $oper, $error) ?>
                <?php if($resultado != null) : ?>
                    <h2><?=$x?> <?=$oper?> <?=$y?> = <?=$resultado ?></h2>
                <?php endif ?>
            <?php endif;
        endif;
        mostrar_errores($error);
    ?>
</body>
</html>
