<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 10/08/13
 * Time: 19:08
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Entity;
use Doctrine\ORM\EntityRepository;
use Fer\SifpeBundle\Entity\IEntidad;


class AbstractRepository extends EntityRepository {

    /**
     * Guarda actualizando o creado una nueva entidad dependiendo de si tiene ID
     * @param IEntidad $apunte
     */
    public function save(IEntidad $apunte) {
        if ($apunte->getId() != null) {
            // actualiza
            $this->getEntityManager()->merge($apunte);
        } else {
            // añade nuevo
            $this->getEntityManager()->persist($apunte);
        }

        $this->getEntityManager()->flush();

    }

    /**
     * Borra una entidad
     * @param IEntidad $entity
     */
    public function remove(IEntidad $entity) {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

}