<?php
    const OPER = ['+', '-', '*', '/'];
    /**
     * filtrar_operando
     *
     * Filtra un operando recibido mediante GET,
     * lo trimea y comprueba si es un número. En caso contrario
     * devuelve null).
     *
     * Actualiza el array de errores en caso necesario.
     *
     * @param  string       $operando   EL operando a filtrar
     * @param  array        $errores    El array de volcado de errores
     * @return string|null              El valor del operando, o null si no es
     *                                  un número.
     */
    function filtrar_operando(string $operando, &$errores) :?string
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

    /**
     * filtrar_operador
     *
     * Filtra un operador recibido mediante GET,
     * lo trimea y comprueba si el valor se encuentra en el array
     * de opciones posibles. En caso contrario devuelve null.
     *
     * Actualiza el array de errores en caso necesario.
     *
     * @param  string       $operador   El operador a filtrar
     * @param  array        $opciones   Colección de de opciones posibles
     * @param  array        $errores    El array de volcado de errores
     * @return string|null              El valor del operador, o null si no es
     *                                  un número.
     */
    function filtrar_operador(string $operador, array $opciones, &$errores):?string
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

    /**
     * mostrar_errores
     *
     * Vuelca a la salida los mensajes de error contenido en el array de volcado
     * de errores.
     *
     * Actualiza el array de errores en caso necesario.
     *
     * @param  array    $errores    El array de volcado de errores
     * @return void                 Vuelca, si existen, los mensajes
     *                              de error guardados
     */
    function mostrar_errores(&$errores): void
    {
        foreach ($errores as $err): ?>
            <p>Error: <?=$err ?></p>
        <?php endforeach;
    }


    /**
     * es_cero
     *
     * Comprueba si un operando recibido mediante GET es cero. Si lo es, volcará
     * el incidenteen el array de errores. No devuelve nada.
     *
     * @param  mixed    $operando   El operando a comprobar
     * @param  mixed    $errores    El array de volcado de errores
     * @return void                 Vuelca, si se produce, el error
     *                              en el array de errores.
     */
    function es_cero($operando, &$errores)
    {
        if(!$operando) {
            $errores[] = "No se puede dividir entre cero.";
        }
        else {
            return false;
        }
    }

    /**
     * calcular
     *
     * Calcula una operación aritmética, a partir de dos operandos
     * y un operador recibidos mediante GET.
     *
     * @return void                 Vuelca, si se produce, el resultado
     *                              de la operación.
     */
    function calcular(
        int|float|string $x,
        int|float|string $y,
        string $oper,
        &$errores
    ): int|float|null
    {
        $res = null;
        if(empty($errores)): ?>
            <?php switch ($oper) {
                case '+':
                    $res= $x + $y;
                    break;
                case '-':
                    $res= $x - $y;
                    break;
                case '*':
                    $res= $x * $y;
                    break;
                case '/':
                    if (es_cero($y, $errores)){
                        $res= $x / $y;
                    } else {
                        $res = null;
                    }
                    break;
                default:
                    $res = null;
                    break;
            }?>
        <?php endif;

        return $res;
    }
