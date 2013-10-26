<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 10/08/13
 * Time: 19:08
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeDomain\Repository\ORM;
use Doctrine\ORM\EntityRepository;
use Fer\SifpeDomain\Model\IEntidad;
use Fer\SifpeDomain\Repository\IRepository;

class AbstractRepository extends EntityRepository implements IRepository {

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

    public function totalByMonth(IEntidad $entidad, \DateTime $dateIni, \DateTime $dateEnd) {
        $query = $this->getEntityManager()->createQuery(
            'SELECT sum(a.cantidad) AS cantidad FROM ' .
            $this->getEntityName() .
            ' a WHERE g.fecha <=:fechaFinal AND g.fecha >=:fechaInicial GROUP BY c.id'
        );
        return $query->execute(
            array(
                'fechaInicial' => $dateIni->format('Y-m-d'),
                'fechaFinal' => $dateEnd->format('Y-m-d'),
                ''
            )
        );
    }

}