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
use Fer\SifpeDomain\Repository\ORM\IngresoRepository;
use Fer\SifpeDomain\Model\Empresa;
use Fer\SifpeDomain\Model\Cuenta;

/**
 * Apunte
 *
 * @ORM\Entity(repositoryClass="Fer\SifpeDomain\Repository\ORM\IngresoRepository")
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