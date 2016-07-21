<?php

namespace Fer\SifpeDomain\Model;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Fer\SifpeDomain\Model\Cuenta;

/**
 * GrupoCuenta
 *
 * @ORM\Table(name="grupo_cuenta")
 * @ORM\Entity(repositoryClass="Fer\SifpeDomain\Repository\ORM\GrupoCuentaRepository")
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
     * @var \Doctrine\Common\Collections\ArrayCollection<Cuenta>
     * @ORM\OneToMany(mappedBy="grupo", targetEntity="Cuenta")
     * @JMS\Exclude
     */
    private $cuentas;

    /**
     * @var float
     *
     * @ORM\Column(name="presupuestoMes", type="decimal", precision=10, scale=2, options={"default": 0}, nullable=true))
     * @JMS\Type("double")
     */
    protected $presupuestoMes;

    /**
     * @var float
     *
     * @ORM\Column(name="presupuestoAnual", type="decimal", precision=10, scale=2, options={"default": 0}, nullable=true))
     * @JMS\Type("double")
     */
    protected $presupuestoAnual;

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getCuentas()
    {
        return $this->cuentas;
    }

    /**
     * @param \Doctrine\Common\Collections\ArrayCollection $cuentas
     */
    public function setCuentas($cuentas)
    {
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

    /**
     * @return float
     */
    public function getPresupuestoMes()
    {
        return $this->presupuestoMes;
    }

    /**
     * @param float $presupuestoMes
     */
    public function setPresupuestoMes($presupuestoMes)
    {
        $this->presupuestoMes = $presupuestoMes;
    }

    /**
     * @return float
     */
    public function getPresupuestoAnual()
    {
        return $this->presupuestoAnual;
    }

    /**
     * @param float $presupuestoAnual
     */
    public function setPresupuestoAnual($presupuestoAnual)
    {
        $this->presupuestoAnual = $presupuestoAnual;
    }

    
}
