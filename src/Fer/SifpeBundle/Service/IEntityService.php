<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 24/10/13
 * Time: 21:48
 */
namespace Fer\SifpeBundle\Service;

use Fer\SifpeDomain\Model\IEntidad;

interface IEntityService
{
    public function find($id);

    public function findAll();

    /**
     * Borra una entidad
     * @param IEntidad $entity
     */
    public function remove(IEntidad $entity);

    public function save(IEntidad $entity);
}