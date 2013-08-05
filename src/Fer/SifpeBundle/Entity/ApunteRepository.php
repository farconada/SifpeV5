<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 03/08/13
 * Time: 20:43
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Entity;
use Doctrine\ORM\EntityRepository;

class ApunteRepository extends EntityRepository {
    /**
     * Devuelve los Apuntes de un mes ya sea el mes actual (por defecto) o X meses atras desde este mes
     * Se tienen en cuenta los meses enteros de mes a mes y no de dia a dia,
     * Si hoy es 14-06-2011 1 mes atras devolveria los apuntes de 1 al 31 de Mayo
     *
     * @param int $mesesAtras Numero de meses atras para los que devolver el listado
     * @return mixed
     */
    public function findPorMes($mesesAtras = 0) {
        $mesesAtras = $mesesAtras + 0;
        $fechaInicial = new \DateTime("first day of $mesesAtras month ago");
        $fechaFinal = new \DateTime("last day of $mesesAtras month ago");

        $qb = $this->createQueryBuilder('findPorMes');
        // se resetea el FROM porque por defecto ya incluye referencia a la tabla
        $qb->resetDQLPart('from');
        $qb->select('a')
            ->from($this->getEntityName(), 'a')
            ->where( 'a.fecha >= :fechaInicial AND a.fecha <= :fechaFinal')
            ->setParameter('fechaInicial', $fechaInicial->format('Y-m-d'))
            ->setParameter('fechaFinal', $fechaFinal->format('Y-m-d'));
        return $qb->getQuery()->execute();
    }

    /**
     * Devuelve un entero que representa el numero de meses que hay registrados en la base de datos desde hoy
     * Los meses corresponden a las paginas de las tablas
     * @return int
     */
    public function getTotalMesesRegistrados() {
        $qb = $this->createQueryBuilder('getTotalMesesRegistrados');
        // se resetea el FROM porque por defecto ya incluye referencia a la tabla
        $qb->resetDQLPart('from');
        $primerApunte = $qb->select('a')
            ->from($this->getEntityName(), 'a')
            ->orderBy('a.fecha', 'ASC')
            ->getQuery()->setMaxResults(1)->getSingleResult();

        $ultimoApunte = $qb->orderBy('a.fecha', 'DESC')
            ->getQuery()->setMaxResults(1)->getSingleResult();

        $dateInterval = $primerApunte->getFecha()->diff($ultimoApunte->getFecha());
        $mesesRegistrados = ($dateInterval->y * 12) + $dateInterval->m;

        return $mesesRegistrados;
    }

    /**
     * Devuelve una lista de cuentas con el total por cuenta de cada mes
     *
     * @param int $mesesAtras Numero de meses atras para los que devolver el listado
     * @return array
     */
    public function getTotalCuentasMensual($mesesAtras = 0) {
        $mesesAtras = $mesesAtras + 0;
        $fechaInicial = new \DateTime("first day of $mesesAtras month ago");
        $fechaFinal = new \DateTime("last day of $mesesAtras month ago");
        $query = $this->getEntityManager()->createQuery(
            'SELECT sum(g.cantidad) AS cantidad, c.name AS cuenta FROM ' .
            $this->getEntityName() .
            ' g JOIN g.cuenta c WHERE g.fecha <=:fechaFinal AND g.fecha >=:fechaInicial GROUP BY c.id'
        );
        return $query->execute(
            array(
                'fechaInicial' => $fechaInicial->format('Y-m-d'),
                'fechaFinal' => $fechaFinal->format('Y-m-d')
            )
        );
    }

    /**
     * Devuelve el total de los apuntes de un mes para los doces meses del año de enero a dicimbre
     *
     * @param  $aniosAtras Mumero de años atras para los que devolver el listado
     * @return array
     */
    public function getResumenAnual($aniosAtras) {
        // 1 de enero del año que sea
        $fechaInicial = new \DateTime('-' . $aniosAtras . ' year');
        $fechaInicial->setDate($fechaInicial->format('Y'), 1, 1);
        $fechaFinal = new \DateTime('-' . $aniosAtras . ' year');
        $fechaFinal->setDate($fechaInicial->format('Y'), 1, 1);
        $result = array();
        // para cada mes de ese año
        for ($i = 0; $i < 12; $i++) {
            $result[$i]['mes'] = $fechaInicial->format('M');
            // avanzamos 1 mes
            $fechaFinal->add(new \DateInterval('P0Y1M'));

            $query = $this->getEntityManager()->createQuery(
                'SELECT sum(a.cantidad) AS cantidad FROM ' .
                $this->getEntityName() .
                ' a WHERE a.fecha <:fechaFinal AND a.fecha >=:fechaInicial'
            );

            $res = $query->execute(
                array(
                    'fechaInicial' => $fechaInicial->format('Y-m-d'),
                    'fechaFinal' => $fechaFinal->format('Y-m-d')
                )
            );
            $result[$i]['cantidad'] = $res[0]['cantidad']+0;

            // avanzamos 1 mes
            $fechaInicial->add(new \DateInterval('P0Y1M'));
        }
        return $result;
    }

    /**
     * resumen de gastos e ingresos de un mes
     * @param $mesesAtras
     * @return array
     */
    public function getResumenMes($mesesAtras) {
        $fechaInicial = new \DateTime("first day of $mesesAtras month ago");
        $fechaFinal = new \DateTime("last day of $mesesAtras month ago");
        $result = array();

        // Gastos de ese mes
        $query = $this->getEntityManager()->createQuery(
            'SELECT sum(g.cantidad) AS cantidad
            FROM FerSifpeBundle:Gasto g
            WHERE g.fecha <:fechaFinal AND g.fecha >=:fechaInicial'
        );
        $res = $query->execute(
            array(
                'fechaInicial' => $fechaInicial->format('Y-m-d'),
                'fechaFinal' => $fechaFinal->format('Y-m-d')
            )
        );
        $result['gastos'] = $res[0]['cantidad'] ? $res[0]['cantidad']+0 : 0;

        // Ingresos de ese mes
        $query = $this->getEntityManager()->createQuery(
            'SELECT sum(i.cantidad) AS cantidad
            FROM FerSifpeBundle:Ingreso i
            WHERE i.fecha <:fechaFinal AND i.fecha >=:fechaInicial'
        );
        $res = $query->execute(
            array(
                'fechaInicial' => $fechaInicial->format('Y-m-d'),
                'fechaFinal' => $fechaFinal->format('Y-m-d')
            )
        );
        $result['ingresos'] = $res[0]['cantidad'] ? $res[0]['cantidad']+0  : 0;

        return $result;
    }


}