<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 03/08/13
 * Time: 20:37
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


abstract class ApunteController extends AbstractController {

	/**
	 * @var \FOS\ElasticaBundle\Finder\TransformedFinder
	 */
	public $apunteFinder;

    /**
     * @Template
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * Lista los objeto gestionados por el repositorio
     * Se devuelve el listado y el total de objetos devueltos
     *
     * @param int $desdeMeses Numero de meses atras para los que mostrar el listado
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listDesdeMesAction($desdeMeses = 0) {
        $items = $this->entityRepository->findPorMes($desdeMeses);
        $output['data'] = $items;
        $output['totalPaginas'] = $this->entityRepository->getTotalMesesRegistrados();
        $view = $this->view($output, 200);
        return $this->handleView($view);
    }

    /**
     * @param $anio 2013, 2012, 2011...
     * @param $mes 01, 1, 02...
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listResumenPorCuentaAction($anio, $mes) {
        $cuentasMes = $this->entityRepository->getTotalCuentasMensual($anio, $mes);
        $resultado = array('data' => $cuentasMes, 'anio' => $anio, 'mes' => $mes);
        $view = $this->view($resultado, 200);
        return $this->handleView($view);
    }

    /**
     * Lista un resumen de los apuntes agrupados por mes en un año
     *
     * @param $anio 2013, 2012.....
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listResumenAnualAction($anio) {
        $resultado['data'] = $this->entityRepository->getResumenAnual($anio);
        $resultado['anio'] = $anio;
        $view = $this->view($resultado, 200);
        return $this->handleView($view);

    }

    /**
     * Lista para un mes el total de gastos e ingresos
     *
     * @param $anio 01, 1, 12, ....
     * @param $mes 2013, 2012....
     * @return mixed
     */
    public function listResumenMesAction($anio, $mes){
        $items = $this->entityRepository->getResumenMes($anio, $mes);
        $view = $this->view($items, 200);
        return $this->handleView($view);
    }

	/**
	 * @param $query Query para elastic search
	 * @return mixed
	 */
	public function searchAction($query) {
		$items = $this->apunteFinder->find($query);
		$view = $this->view($items, 200);
		return $this->handleView($view);
	}

}