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

    <?php
    $error = [];
    if(isset($_GET['x'])) {
        $x = trim($_GET['x']);
        if (!is_numeric($x)) {
            $error[] = 'El parámetro x no es correcto.';
        }
    } else {
        al mamaero
    }

    if(isset($_GET['y'])) {
        $y = trim($_GET['y']);
        if (!is_numeric($y)) {
            $error[] = 'El parámetro y no es correcto.';
        }
    }

    if(isset($_GET['oper'])) {
        $oper = trim($_GET['oper']);
        if (!in_array('$oper', ['suma', 'resta', 'multi', 'divi'])) {
            $error[] = 'El parámetro operador no es correcto.';
        }
    }?>

    <?php foreach ($error as $err) :?>
            <p>Error: <?=$err?></p>
    <?php endforeach ?>

    <?php if(empty($error)): ?>
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
    <?php endif ?>
</body>
</html>
