<?php

    /**
     * filtrar_cadena
     * Recibe una cadena, la trimea y comprueba que no esté vacía.
     * Los errores generados se vuelcan al registro de errores.
     *
     * @param  string $cadena   La cadena a filtrar.
     * @param  array $errores   El registro de errores.
     * @return string|null      La cadena trimeada.
     */
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

    /**
     * filtrar_fecha
     * Recibe una cadena, la trimea y comprueba que no esté vacía.
     * A continuación se verifica si es una fecha válida.
     * Los errores generados se vuelcan al registro de errores.
     *
     * @param  string $fecha    La cadena a filtrar y validar.
     * @param  array $errores   El registro de errores.
     * @return string|null      La cadena trimeada
     */
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

    /**
     * calcular_edad
     * Devuelve la edad de una persona, a partir de la diferencia en
     * años entre la fecha actual y una cadena válida, convertida a fecha.
     * Los errores generados se vuelcan al registro de errores.
     *
     * @param  mixed $fecha_nac     La fecha de nacimiento.
     * @param  mixed $errores       El registro de errores.
     * @return string               La edad resultante.
     */
    function calcular_edad(string $fecha_nac, &$errores): string
    {
        $nacimiento = new DateTime($fecha_nac);
        $edad = $nacimiento->diff(new DateTime())->format('%y');
        return $edad;
    }

    /**
     * mostrar_errores
     * Genera en la salida estándar un listado de los errores producidos
     * durante la ejecución del programa.
     *
     * @param  mixed $errores   El registro de errores.
     * @return void             Efecto lateral en salida estándar.
     */
    function mostrar_errores(&$errores): void
    {
        foreach ($errores as $err): ?>
            <p>Error: <?=$err ?></p>
        <?php endforeach;
    }
