<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 17/10/13
 * Time: 22:17
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Service;

use Fer\SifpeDomain\Model\IEntidad;
use Fer\SifpeDomain\Repository\IApunteRepository;
use FOS\ElasticaBundle\Finder\FinderInterface;

class ApunteService extends EntityService {


    /**
     * @param $queryString
     * @param \DateTime $dateIni
     * @param \DateTime $dateEnd
     * @return array
     */
    public function searchFullText($queryString, \DateTime $dateIni, \DateTime $dateEnd, $limit = 500) {
        $queryString = new \Elastica\Query\QueryString($queryString);
        $queryObj = new \Elastica\Query($queryString);
        $queryFilter = new \Elastica\Filter\Range(
            'fecha',
            array(
                'from' => $dateIni->format('Y-m-d'),
                'to' => $dateEnd->format('Y-m-d')
            )
        );
        $queryObj->setFilter($queryFilter);
        return $this->finder->find($queryObj, $limit);
    }

	/**
	 * Devuelve los Apuntes de un mes ya sea el mes actual (por defecto) o X meses atras desde este mes
	 * Se tienen en cuenta los meses enteros de mes a mes y no de dia a dia,
	 * Si hoy es 14-06-2011 1 mes atras devolveria los apuntes de 1 al 31 de Mayo
	 *
	 * @param int $mesesAtras Numero de meses atras para los que devolver el listado
	 * @return mixed
	 */
	public function findPorMes($mesesAtras = 0) {
		$this->repository->findPorMes($mesesAtras);
	}

	/**
	 * Devuelve un entero que representa el numero de meses que hay registrados en la base de datos desde hoy
	 * Los meses corresponden a las paginas de las tablas
	 * @return int
	 */
	public function getTotalMesesRegistrados() {
		$this->repository->getTotalMesesRegistrados();
	}

	/**
	 * Devuelve una lista de cuentas con el total por cuenta de cada mes
	 *
	 * @param $anio
	 * @param $mes
	 * @return array
	 */
	public function getTotalCuentasMensual($anio, $mes) {
		$this->repository->getTotalMesesRegistrados($anio, $mes);
	}

	/**
	 * Devuelve el total de los apuntes de un mes para los doces meses del año de enero a dicimbre
	 *
	 * @param $anio 2013, 2012, 2011....
	 * @return array
	 */
	public function getResumenAnual($anio) {
		$this->repository->getResumenAnual($anio);
	}

	/**
	 * resumen de gastos e ingresos de un mes
	 * @param $anio 2013, 2012, 2011.......
	 * @param $mes 01 ó 1 02 03 04
	 * @return array
	 */
	public function getResumenMes($anio, $mes) {
		$this->repository->getResumenMes($anio, $mes);
	}

}