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
     * @return \Doctrine_Collection
     */
    public function findPorMes($mesesAtras = 0) {

    }

    /**
     * Devuelve un entero que representa el numero de meses que hay registrados en la base de datos desde hoy
     *
     * @return int
     */
    public function getTotalMesesRegistrados() {

    }

    /**
     * Devuelve una lista de cuentas con el total por cuenta de cada mes
     *
     * @param int $mesesAtras Numero de meses atras para los que devolver el listado
     * @return array
     */
    public function getTotalCuentasMensual($mesesAtras = 0) {

    }

    /**
     * Devuelve el total de los apuntes de un mes para los doces meses del año de enero a dicimbre
     *
     * @param  $aniosAtras Mumero de años atras para los que devolver el listado
     * @return array
     */
    public function getResumenAnual($aniosAtras) {

    }

    public function getResumenMes($mesesAtras) {

    }


}