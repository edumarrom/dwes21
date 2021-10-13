<?php
    function filtrar_cadena(string $cadena, &$errores): ?string
    {
        $valor = null;

        if(isset($_GET[$cadena])){
            $valor = trim($_GET[$cadena]);
            if($valor === ''){
                $errores[] = "El campo '$cadena' no puede estar vacío.";
            }
        }

        return $valor;
    }

    function filtrar_fecha(string $fecha, &$errores): ?string
    {
       $valor = null;
       if(isset($_GET[$fecha])){
            $valor = trim($_GET[$fecha]);
            if($valor === ''){
                $errores[] = "El campo '$fecha' no puede estar vacío.";
            } else {
                $valores = explode('-', $valor);
                if (!checkdate($valores[1], $valores[2], $valores[0])) {
                    $errores[] = "La fecha '$valor' no es correcta.";
                }
            }
        }
        return $valor;
    }

    function calcular_edad(string $fecha_nac, &$errores): ?string
    {
        $edad = null;
        $nacimiento = new DateTime($fecha_nac);
        $edad = $nacimiento->diff(new DateTime())->format('%y');
        return $edad;
    }

    function mostrar_errores(&$errores): void
    {
        foreach ($errores as $err): ?>
            <p>Error: <?=$err ?></p>
        <?php endforeach;
    }
