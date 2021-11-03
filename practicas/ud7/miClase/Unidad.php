<?php
/* Unidad es un departamento con características extras */
require 'Departamento.php';

class Unidad extends Departamento
{
    private $presupuesto;

    public function __construct(
        $denom = null,
        $localidad = null,
        $presupuesto = null
    )
    {
        parent::__construct($denom, $localidad);
        $this->presupuesto = 0.0; // Posibilidad de hacer setter
    }

    public static function campos()
    {
        return array_merge(parent::campos(), ['presupuesto']);
    }

    public function getPresupuesto()
    {
        return $this->presupuesto;
    }

    public function setPresupuesto($presupuesto)
    {
        $this->presupuesto = $presupuesto;
    }

    public function __toString()
    {
        $o = json_decode(parent::__toString());
        $o->presupuesto = $this->presupuesto;
        json_encode($o);
    }
}
