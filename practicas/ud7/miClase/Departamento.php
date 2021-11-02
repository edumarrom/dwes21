<?php

class Departamento
{
// Propiedades //
    const MAX_EMPLE = 500;

    private $id;

    public $denom;
    public $localidad;

    public function getId()
    {
        return $this-> id;
    }

    public function setId($id)
    {
        $this-> id = $id;
    }
}
