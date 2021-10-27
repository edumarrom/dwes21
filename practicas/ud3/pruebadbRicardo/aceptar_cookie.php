<?php
$tiempo = time() + 3600 * 24 * 30;
setcookie('aceptar_banner', '1', $tiempo);
header('Location: index.php');
