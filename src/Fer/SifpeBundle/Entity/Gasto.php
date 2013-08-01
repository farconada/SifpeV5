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

/**
 * Apunte
 *
 * @ORM\Table(name="gasto")
 * @ORM\Entity
 */
class Gasto extends Apunte {

	/**
	 * @var \Fer\SifpeBundle\Entity\Empresa
	 * @ORM\ManyToOne(inversedBy="gastos", targetEntity="Empresa")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
	 */
	protected $empresa;

	/**
	 * @var \Fer\SifpeBundle\Entity\Cuenta
	 * @ORM\ManyToOne(inversedBy="gastos",  targetEntity="Cuenta")
	 * @ORM\JoinColumn(name="cuenta_id", referencedColumnName="id")
	 */
	protected $cuenta;

}