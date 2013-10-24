<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 24/10/13
 * Time: 21:51
 */
namespace Fer\SifpeBundle\Service;

interface IApunteService extends IEntityService
{
    /**
     * resumen de gastos e ingresos de un mes
     * @param $anio 2013, 2012, 2011.......
     * @param $mes 01 ó 1 02 03 04
     * @return array
     */
    public function getResumenMes($anio, $mes);

    /**
     * Devuelve los Apuntes de un mes ya sea el mes actual (por defecto) o X meses atras desde este mes
     * Se tienen en cuenta los meses enteros de mes a mes y no de dia a dia,
     * Si hoy es 14-06-2011 1 mes atras devolveria los apuntes de 1 al 31 de Mayo
     *
     * @param int $mesesAtras Numero de meses atras para los que devolver el listado
     * @return mixed
     */
    public function findPorMes($mesesAtras = 0);

    /**
     * @param $queryString
     * @param \DateTime $dateIni
     * @param \DateTime $dateEnd
     * @return array
     */
    public function searchFullText($queryString, \DateTime $dateIni, \DateTime $dateEnd, $limit = 500);

    /**
     * Devuelve el total de los apuntes de un mes para los doces meses del año de enero a dicimbre
     *
     * @param $anio 2013, 2012, 2011....
     * @return array
     */
    public function getResumenAnual($anio);

    /**
     * Devuelve un entero que representa el numero de meses que hay registrados en la base de datos desde hoy
     * Los meses corresponden a las paginas de las tablas
     * @return int
     */
    public function getTotalMesesRegistrados();

    /**
     * Devuelve una lista de cuentas con el total por cuenta de cada mes
     *
     * @param $anio
     * @param $mes
     * @return array
     */
    public function getTotalCuentasMensual($anio, $mes);
}