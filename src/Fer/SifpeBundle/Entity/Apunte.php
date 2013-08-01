<?php

namespace Fer\SifpeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Apunte
 * @package Fer\SifpeBundle\Entity
 * @ORM\MappedSuperclass
 */
abstract class Apunte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="text")
     */
    private $notas;

    /**
     * @var float
     *
     * @ORM\Column(name="cantidad", type="decimal", precision=10, scale=2)
     */
    private $cantidad;


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
	 * @param \Fer\SifpeBundle\Entity\Cuenta $cuenta
	 */
	public function setCuenta($cuenta) {
		$this->cuenta = $cuenta;
	}

	/**
	 * @return \Fer\SifpeBundle\Entity\Cuenta
	 */
	public function getCuenta() {
		return $this->cuenta;
	}

	/**
	 * @param \Fer\SifpeBundle\Entity\Empresa $empresa
	 */
	public function setEmpresa($empresa) {
		$this->empresa = $empresa;
	}

	/**
	 * @return \Fer\SifpeBundle\Entity\Empresa
	 */
	public function getEmpresa() {
		return $this->empresa;
	}
}