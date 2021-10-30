<?php
session_start();

setcookie('aceptar_banner', '1', 1);
header('Location: index.php');
