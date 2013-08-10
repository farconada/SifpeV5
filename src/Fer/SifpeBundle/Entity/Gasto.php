<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 1/08/13
 * Time: 10:26
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;


/**
 * Apunte
 * @ORM\Entity(repositoryClass="GastoRepository")
 * @ORM\Table(name="gasto")
 */
class Gasto extends Apunte {

	/**
	 * @var \Fer\SifpeBundle\Entity\Empresa
	 * @ORM\ManyToOne(inversedBy="gastos", targetEntity="Empresa")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     * @ORM\Column(nullable=false)
	 * @JMS\Type("Fer\SifpeBundle\Entity\Empresa")
	 */
	protected $empresa;

	/**
	 * @var \Fer\SifpeBundle\Entity\Cuenta
	 * @ORM\ManyToOne(inversedBy="gastos",  targetEntity="Cuenta")
	 * @ORM\JoinColumn(name="cuenta_id", referencedColumnName="id")
     * @ORM\Column(nullable=false)
	 * @JMS\Type("Fer\SifpeBundle\Entity\Cuenta")
	 */
	protected $cuenta;

}