<?php

namespace Fer\SifpeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cuenta
 *
 * @ORM\Table(name="cuenta")
 * @ORM\Entity
 */
class Cuenta
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80)
     */
    private $name;
	/**
	 * @var \Fer\SifpeBundle\Entity\GrupoCuenta
	 * @ORM\ManyToOne(inversedBy="cuentas",  targetEntity="GrupoCuenta")
	 * @ORM\JoinColumn(name="grupo_cuenta_id", referencedColumnName="id")
	 */
	private $grupo;
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<\Fer\SifpeBundle\Entity\Gasto>
	 * @ORM\OneToMany(mappedBy="cuenta", targetEntity="Gasto", cascade={"all"})
	 */
	private  $gastos;
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<\Fer\SifpeBundle\Entity\Ingreso>
	 * @ORM\OneToMany(mappedBy="cuenta", targetEntity="Ingreso", cascade={"all"})
	 */
	private  $ingresos;

	function __construct() {
		$this->gastos = new ArrayCollection();
		$this->ingresos = new ArrayCollection();
	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getGastos() {
		return $this->gastos;
	}

	/**
	 * @param \Doctrine\Common\Collections\ArrayCollection $gastos
	 */
	public function setGastos($gastos) {
		$this->gastos = $gastos;
	}

	/**
	 * @return \Fer\SifpeBundle\Entity\GrupoCuenta
	 */
	public function getGrupo() {
		return $this->grupo;
	}

	/**
	 * @param \Fer\SifpeBundle\Entity\GrupoCuenta $grupo
	 */
	public function setGrupo($grupo) {
		$this->grupo = $grupo;
	}

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getIngresos() {
		return $this->ingresos;
	}

	/**
	 * @param \Doctrine\Common\Collections\ArrayCollection $ingresos
	 */
	public function setIngresos($ingresos) {
		$this->ingresos = $ingresos;
	}

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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Cuenta
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
