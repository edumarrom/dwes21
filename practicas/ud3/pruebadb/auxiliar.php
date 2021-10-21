<?php
function conectar()
{
    return new PDO(
        'pgsql:host=localhost;dbname=prueba',
        'prueba',
        'prueba'
    );
}

/* TODO(?)
function contar_filas()
{

} */
