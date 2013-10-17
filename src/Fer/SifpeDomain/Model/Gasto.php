<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 1/08/13
 * Time: 10:26
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeDomain\Model;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Fer\SifpeDomain\Repository\ORM\GastoRepository;
use Fer\SifpeDomain\Model\Empresa;
use Fer\SifpeDomain\Model\Cuenta;


/**
 * Apunte
 * @ORM\Entity(repositoryClass="Fer\SifpeDomain\Repository\ORM\GastoRepository")
 * @ORM\Table(name="gasto")
 */
class Gasto extends Apunte {

	/**
	 * @var Empresa
	 * @ORM\ManyToOne(inversedBy="gastos", targetEntity="Empresa")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id", nullable=false)
	 * @JMS\Type("Empresa")
	 */
	protected $empresa;

	/**
	 * @var Cuenta
	 * @ORM\ManyToOne(inversedBy="gastos",  targetEntity="Cuenta")
	 * @ORM\JoinColumn(name="cuenta_id", referencedColumnName="id", nullable=false)
	 * @JMS\Type("Cuenta")
	 */
	protected $cuenta;

}