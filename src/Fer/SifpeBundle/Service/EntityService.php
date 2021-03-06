<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 18/10/13
 * Time: 8:46
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Service;

use Fer\SifpeDomain\Model\IEntidad;
use Fer\SifpeDomain\Repository\IRepository;


class EntityService implements IEntityService
{
	/**
	 * @var IRepository
	 */
	protected  $repository;

	/**
	 * @var FinderInterface
	 */
	protected  $finder;

	/**
	 * @param IRepository $repository
	 * @param  $finder
	 */
	public function __construct(IRepository $repository, $finder = null) {
		$this->repository = $repository;
		$this->finder = $finder;
	}

	/**
	 * Borra una entidad
	 * @param IEntidad $entity
	 */
	public function remove(IEntidad $entity) {
		return $this->repository->remove($entity);
	}

	public function findAll() {
		return $this->repository->findAll();
	}

	public function save(IEntidad $entity) {
		return $this->repository->save($entity);
	}

	public function find($id) {
		return $this->repository->find($id);
	}
}
