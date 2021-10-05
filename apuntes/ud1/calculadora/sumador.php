<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probando url parametrizada</title>
</head>
<body>
    <h1>Sumador</h1>
    <?php if(is_numeric($_GET['x'])): ?>
        <?php if(is_numeric($_GET['y'])): ?>
            <h2>La suma de <?=$_GET['x']?> y <?=$_GET['y']?> es <?= $_GET['x'] + $_GET['y']?></h2>
        <?php else: ?>
            <p>Falta operando y.</p>
        <?php endif ?>
    <?php else: ?>
        <p>Falta operando x.</p>
    <?php endif ?>
</body>
</html>
