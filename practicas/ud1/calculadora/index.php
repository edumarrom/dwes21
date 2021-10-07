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
    function filtrar_numero($operando, &$errores)
    {
        $valor = null;
        if (isset($_GET[$operando])) {
            $valor = trim($_GET[$operando]);
            if (!is_numeric($valor)) {
                $errores[] = "El operando '$valor' no es correcto.";
            }
        } else {
            $errores[] = "Falta el operando '$operando'.";
        }
        return $valor;
    }

    function filtrar_opciones($operador, $opciones, &$errores)
    {
        $oper = null;
        global $error;
        if (isset($_GET[$operador])) {
            $oper = trim($_GET[$operador]);
            if (!in_array($oper, $opciones)) {
                $errores[] = "El operador '$oper' no es correcto.";
            }
        } else {
            $errores[] = 'Falta el operador.';
        }
        return $oper;
    }

    function mostrar_errores(&$errores)
    {
        foreach ($errores as $err): ?>
            <p>Error: <?=$err ?></p>
        <?php endforeach;
    }

    // Control de errores en operaciones
    function es_cero($operando, &$errores)
    {
        if(!$operando) {
            $errores[] = "No se puede dividir entre cero.";
        }
        else {
            return false;
        }
    }
    ?>

    <?php
    $error = [];
    $x = filtrar_numero('x', $error);
    $y = filtrar_numero('y', $error);
    $oper = filtrar_opciones('oper', ['suma', 'resta', 'multi', 'divi'], $error);

    if(empty($error)): ?>
        <?php switch ($oper) {
            case 'suma':
                $res= $x + $y;
                break;
            case 'resta':
                $res= $x - $y;
                break;
            case 'multi':
                $res= $x * $y;
                break;
            case 'divi':
                if (es_cero($y, $error)){
                    $res= $x / $y;
                }
                break;
        }
        if(empty($error)): ?>
            <h2>El resultado es <?=$res ?></h2>
        <?php else : ?>
            <?php mostrar_errores($error);
            endif
        ?>


    <?php endif ?>
    <a href="index.html">Volver</a>
</body>
</html>
