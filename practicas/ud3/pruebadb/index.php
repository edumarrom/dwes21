<?php session_start() ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos</title>
    <style>
        table,
        td {
            border: 1px solid black;
        }

        button {
            margin: .2em .2em;
            padding: .3em 1.5em;
        }
    </style>
</head>
<body>
    <?php require 'comunes/auxiliar.php' ?>

    <?php cabecera() ?>

    <?php if (isset($_SESSION['mensaje_error'])): ?>
        <h2><?= $_SESSION['mensaje_error'] ?></h2>
        <?php unset($_SESSION['mensaje_error']) ?>
    <?php endif ?>

    <table>
        <thead>
            <th>Tabla</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            <tr>
                <td>Empleados</td>
                <td>
                    <button><a href="/emple/index.php">Acceder</a></button>
                </td>
            </tr>

            <tr>
                <td>Departamentos</td>
                <td>
                    <button><a href="/depart/index.php">Acceder</a></button>
                </td>
            </tr>
        </tbody>
    </table>
