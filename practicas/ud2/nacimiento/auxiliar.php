<?php
    /* TODO: Filtrar-nombre? */
    function filtrar_fecha(string $fecha, &$errores): ?string
    {
        $valor = null;
        if (isset($_GET[$fecha])) {
            $valor = trim($_GET[$fecha]);
            if($valor === '') {
                $errores[] = "La fecha de nacimiento es obligatoria.";
            } else {
                $aux = new DateTime($valor);
                $anyo = $aux->format('Y');
                $mes = $aux->format('m');
                $dia = $aux->format('d');
                if (!checkdate($mes, $dia, $anyo)) {
                $errores[] = "La fecha '$valor' no es correcto.";
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
