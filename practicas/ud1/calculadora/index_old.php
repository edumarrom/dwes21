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
    <?php $res=0 ?>
    <?php if(is_numeric($_GET['x'])): ?>
        <?php if(is_numeric($_GET['y'])): ?>
            <?php switch ($_GET['oper']) {
                case 'suma':
                    $res= $_GET['x'] + $_GET['y'];
                    break;
                case 'resta':
                    $res= $_GET['x'] - $_GET['y'];
                    break;
                case 'multi':
                    $res= $_GET['x'] * $_GET['y'];
                    break;
                case 'divi':
                    $res= $_GET['x'] / $_GET['y'];
                    break;
            } ?>
            <h2>El resultado es <?=$res ?></h2>
        <?php else: ?>
            <p>Falta operando y.</p>
        <?php endif ?>
    <?php else: ?>
        <p>Falta operando x.</p>
    <?php endif ?>
    <a href="index.html">Volver</a>
</body>
</html>
