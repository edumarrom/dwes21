<?php

use JetBrains\PhpStorm\Deprecated;

class Departamento
{
// Propiedades //
    const MAX_EMPLE = 500;

    private $id;

    public $denom;
    public $localidad;

    public function __construct($denom = null, $localidad = null)
    {
        $this->denom = $denom;
        $this->localidad = $localidad;
    }

    public function getId()
    {
        return $this-> id;
    }

    public function setId($id)
    {
        $this-> id = $id;
    }

    public function maxEmple()
    {
        return self::MAX_EMPLE;
    }
}
