<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 7/08/13
 * Time: 9:15
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeDomain\Repository\ORM;

use Fer\SifpeDomain\Repository\ORM\AbstractRepository;
use Fer\SifpeDomain\Model\IEntidad;

class CuentaRepository extends AbstractRepository {
	/**
	 * Guarda una cuenta
	 * Sobreescribe save() para reconstruir la relacion de objetos y que la tenga encuenta el
	 * entity manager
	 * @param IEntidad $apunte
	 */
	public function save(IEntidad $cuenta)
	{
		if($cuenta->getGrupo()) {
			$grupo = $this->getEntityManager()->find('Fer\SifpeDomain\Model\GrupoCuenta', $cuenta->getGrupo()->getId());
			$cuenta->setGrupo($grupo);
		}
		parent::save($cuenta);
	}
}