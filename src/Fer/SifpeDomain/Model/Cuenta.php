<?php

namespace Fer\SifpeDomain\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;
use Fer\SifpeDomain\Model\GrupoCuenta;
use Fer\SifpeDomain\Repository\ORM\CuentaRepository;
use Fer\SifpeDomain\Model\Gasto;
use Fer\SifpeDomain\Model\Ingreso;

/**
 * Cuenta
 *
 * @ORM\Table(name="cuenta")
 * @ORM\Entity(repositoryClass="Fer\SifpeDomain\Repository\ORM\CuentaRepository")
 */
class Cuenta implements IEntidad
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
	 * @var GrupoCuenta
	 * @ORM\ManyToOne(inversedBy="cuentas",  targetEntity="GrupoCuenta")
	 * @ORM\JoinColumn(name="grupo_cuenta_id", referencedColumnName="id")
	 */
	private $grupo;
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<Gasto>
	 * @ORM\OneToMany(mappedBy="cuenta", targetEntity="Gasto")
     * @JMS\Exclude
	 */
	private  $gastos;
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<Ingreso>
	 * @ORM\OneToMany(mappedBy="cuenta", targetEntity="Ingreso")
     * @JMS\Exclude
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
	 * @return GrupoCuenta
	 */
	public function getGrupo() {
		return $this->grupo;
	}

	/**
	 * @param GrupoCuenta $grupo
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
