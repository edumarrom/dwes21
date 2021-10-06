<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
    function comprobar($operador)
    {
        if (isset($operador)) {
            $x = trim($operador);
            if (!is_numeric($x)) {
                $error[] = "El parámetro $x no es correcto.";
            }
        } else {
            $error[] = 'Falta el parámetro.';
        }
    }
    ?>
</head>
<body>

</body>
</html>
