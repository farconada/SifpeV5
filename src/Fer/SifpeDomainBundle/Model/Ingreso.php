<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 1/08/13
 * Time: 10:26
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeDomainBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Fer\SifpeDomainBundle\Repository\ORM\IngresoRepository;
use Fer\SifpeDomainBundle\Model\Empresa;
use Fer\SifpeDomainBundle\Model\Cuenta;

/**
 * Apunte
 *
 * @ORM\Entity(repositoryClass="IngresoRepository")
 * @ORM\Table(name="ingreso")
 */
class Ingreso extends Apunte {

	/**
	 * @var Empresa
	 * @ORM\ManyToOne(inversedBy="ingresos",  targetEntity="Empresa")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
	 */
	protected $empresa;

	/**
	 * @var Cuenta
	 * @ORM\ManyToOne(inversedBy="ingresos",  targetEntity="Cuenta")
	 * @ORM\JoinColumn(name="cuenta_id", referencedColumnName="id")
	 */
	protected $cuenta;

}