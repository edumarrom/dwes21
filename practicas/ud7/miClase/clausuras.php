<?php

function multiplicar($v)
{
    return function ($x) use ($v) {
        return $x * $v;
    };
}

$duplicar = multiplicar(2);
$triplicar = multiplicar(3);
echo $duplicar(5);
echo $triplicar(10);
