<?php

namespace Fer\SifpeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;


/**
 * GrupoCuenta
 *
 * @ORM\Table(name="grupo_cuenta")
 * @ORM\Entity
 */
class GrupoCuenta implements IEntidad
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
	 * @var \Doctrine\Common\Collections\ArrayCollection<\Fer\SifpeBundle\Entity\Cuenta>
	 * @ORM\OneToMany(mappedBy="grupo", targetEntity="Cuenta", cascade={"all"})
     * @JMS\Exclude
	 */
	private $cuentas;

	/**
	 * @return \Doctrine\Common\Collections\ArrayCollection
	 */
	public function getCuentas() {
		return $this->cuentas;
	}

	/**
	 * @param \Doctrine\Common\Collections\ArrayCollection $cuentas
	 */
	public function setCuentas($cuentas) {
		$this->cuentas = $cuentas;
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
     * @return GrupoCuenta
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
