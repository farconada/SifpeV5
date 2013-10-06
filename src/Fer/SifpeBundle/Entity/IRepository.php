<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 06/10/13
 * Time: 17:28
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Entity;


interface IRepository {
    /**
     * Guarda actualizando o creado una nueva entidad dependiendo de si tiene ID
     * @param IEntidad $apunte
     */
    public function save(IEntidad $apunte);

    /**
     * Borra una entidad
     * @param IEntidad $entity
     */
    public function remove(IEntidad $entity);

    public function findAll();


}