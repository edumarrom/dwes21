<?php
namespace X;

/* use JetBrains\PhpStorm\Deprecated; */

class Departamento
{
// Propiedades //
    const MAX_EMPLE = 500;

    private $id;

    public $denom;
    public $localidad;

    public static $numInstancias = 0;

    public function __construct($denom = null, $localidad = null)
    {
        self::$numInstancias++;
        $this->denom = $denom;
        $this->localidad = $localidad;
    }

    public static function campos()
    {
        return [
            'id', 'denom', 'localidad'];
    }

    public static function imprimeCampos()
    {
        print_r(static::campos());
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

    public function __toString()
    {
        /* return "({$this->id}) {$this->denom} {$this->localidad}"; */
        return json_encode([
            'id' => $this->id,
            'denom' => $this->denom,
            'localidad' => $this->localidad,
        ]);
    }
}
