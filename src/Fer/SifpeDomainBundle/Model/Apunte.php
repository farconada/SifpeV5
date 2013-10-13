<?php

namespace Fer\SifpeDomainBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Fer\SifpeDomainBundle\Model\Cuenta;
use Fer\SifpeDomainBundle\Model\Empresa;

/**
 * Class Apunte
 * @package Fer\SifpeDomainBundle\Model
 * @ORM\MappedSuperclass
 */
abstract class Apunte implements IEntidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Type("integer")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     * @JMS\Type("DateTime<'Y-m-d'>")
     */
    protected  $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="text", nullable=true)
     * @JMS\Type("string")
     */
    protected  $notas;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="decimal", precision=10, scale=2)
     * @JMS\Type("double")
     */
    protected  $cantidad;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Apunte
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Apunte
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;
    
        return $this;
    }

    /**
     * Get notas
     *
     * @return string 
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Set cantidad
     *
     * @param float $cantidad
     * @return Apunte
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

	/**
	 * @param Cuenta $cuenta
	 */
	public function setCuenta($cuenta) {
		$this->cuenta = $cuenta;
	}

	/**
	 * @return Cuenta
	 */
	public function getCuenta() {
		return $this->cuenta;
	}

	/**
	 * @param Empresa $empresa
	 */
	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
	}

	/**
	 * @return Empresa
	 */
	public function getEmpresa() {
		return $this->empresa;
	}
}
