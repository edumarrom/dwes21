<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Probando url parametrizada</title>
</head>
<body>
    <h1>Estructura de selección correcta</h1>
    <?php if(isset($_GET['x'], $_GET['y'])): ?>
        <h2>x = <?= $_GET['x']?></h2>
        <h2>y = <?= $_GET['y']?></h2>
        <h2>La suma de <?=$_GET['x']?> y <?=$_GET['y']?> es <?= $_GET['x'] + $_GET['y']?></h2>
    <?php endif ?>

    <h1>Estructura de selección incorrecta</h1>
    <?php if(isset($_GET['x']) && isset($_GET['y'])):
        echo "<h2>x = {$_GET['x']}</h2>";
        echo "<h2>y = {$_GET['y']}</h2>";
    endif ?>

    <em>¿Y si quiero que me diga cuando falta un operando?</em>
    <hr/>

    <h1>Estructuras de contorl</h1>
        <h2>Vamos a recorrer el array <em>$_GET</em>:</h2>
        <ul>
        <?php foreach ($_GET as $k => $v) {
            echo "<li>La clave es $k y el valor es $v</li>";
            // alternativa, usando $_GET: echo "<li>La clave es $k y el valor es {$_GET[$k]}</li>";
        } ?>
        </ul>
</body>
</html>
