<?php

namespace Fer\SifpeDomainBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Fer\SifpeDomainBundle\Model\Gasto;
use Fer\SifpeDomainBundle\Model\Ingreso;
use Fer\SifpeDomainBundle\Repository\ORM\EmpresaRepository;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity(repositoryClass="EmpresaRepository")
 */
class Empresa implements IEntidad
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80)
     * @JMS\Type("string")
     */
    private $name;
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<Gasto>
	 * @ORM\OneToMany(mappedBy="empresa", targetEntity="Gasto")
     * @JMS\Exclude
	 */
	private  $gastos;
	/**
	 * @var \Doctrine\Common\Collections\ArrayCollection<Ingreso>
	 * @ORM\OneToMany(mappedBy="empresa", targetEntity="Ingreso")
     * @JMS\Exclude
	 */
	private  $ingresos;

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
     * @return Empresa
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
