<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_GET['x'])): ?>
        <h2>x = <?= $_GET['x']?></h2>
    <?php else: ?>
        <p>Falta operando x.</p>
    <?php endif ?>

    <?php if(isset($_GET['y'])): ?>
        <h2>y = <?= $_GET['y']?></h2>
    <?php else: ?>
        <p>Falta operando y.</p>
    <?php endif ?>

    <h2>La suma de <?=$_GET['x']?> y <?=$_GET['y']?> es <?= $_GET['x'] + $_GET['y']?></h2>
</body>
</html>
