<?php

$pdo = new PDO('pgsql:host=localhost;dbname=prueba', 'prueba', 'prueba');

$sent = $pdo->query('SELECT * FROM depart');

/* $fila = $sent->fetch(); devuelve filas, una a una*/

/* $filas = $sent->fetchAll(); // devuelve array de filas. NO utilizarlo. */

foreach ($sent as $fila) {
    echo $fila['id'] .  '|' . $fila['nombre'] . '|' . $fila['localidad'] . "\n";
}
