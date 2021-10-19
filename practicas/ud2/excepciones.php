<?php
/** # Excepciones.
 * Método de recuperación del flujo del programa en caso de error. */

function exception_error_handler($severidad, $mensaje, $fichero, $linea)
{
    if (!(error_reporting() & $severidad)) {
        // Este código de error no está incluido en error_reporting
        return;
    }
    throw new ErrorException($mensaje, 0, $severidad, $fichero, $linea);
}
set_error_handler("exception_error_handler");

try {
    echo 1 / 0;
} catch (TypeError | DivisionByZeroError $th) {
    echo "Se ha producido un error cuyo mensaje es: " . $th->getMessage();
} catch (Throwable $th) {
    echo "Se ha producido un error cuyo mensaje es: " . $th->getMessage();
} finally {
    echo "Esto siempre se ejecuta!"; // Se usa para cerrar recursos abiertos
}
