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

    public function listResumenPorCuentaAction($desdeMeses = 0) {
        $cuentasMes = $this->entityRepository->getTotalCuentasMensual($desdeMeses);
        $cuentasMesAnterior = $this->entityRepository->getTotalCuentasMensual($desdeMeses + 1);
        $resultado = array();
        foreach ($cuentasMes as $cuenta) {
            $resultado[$cuenta['cuenta']]['cantidad'] = $cuenta['cantidad'];
        }
        foreach ($cuentasMesAnterior as $cuenta) {
            $resultado[$cuenta['cuenta']]['cantidad_anterior'] = $cuenta['cantidad'];
        }

        $i=0;
        $resultadoPlain = array();
        foreach ($resultado as $cuenta => $resultadoItem) {
            $resultadoPlain[$i]['cuenta'] = $cuenta;
            $resultadoPlain[$i]['cantidad'] = isset($resultadoItem['cantidad']) ? $resultadoItem['cantidad']+0 : 0;
            $resultadoPlain[$i]['cantidad_anterior'] = isset($resultadoItem['cantidad_anterior']) ? $resultadoItem['cantidad_anterior']+0 : 0;
            $i++;
        }

        $view = $this->view($resultadoPlain, 200);
        return $this->handleView($view);
    }

    /**
     * Lista un resumen de los apuntes agrupados por mes en un año y el año anterior
     *
     * El año cero es el año año actual y se le puede indicar para cuantos años atras calcularlo
     *
     * @param int $start numero de años atras desde la fecha actual
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listResumenAnualAction($start = 0) {
        $items = $this->entityRepository->getResumenAnual($start);
        $itemsAnterior = $this->entityRepository->getResumenAnual($start+1);
        $i = 0;
        $resultado = array();
        foreach ($items as $mes) {
            $resultado[$i]['mes'] = $mes['mes'];
            $resultado[$i]['cantidad'] = $mes['cantidad'] ? $mes['cantidad'] : 0 ;
            $resultado[$i]['cantidad_anterior'] = $itemsAnterior[$i]['cantidad'] ?  $itemsAnterior[$i]['cantidad']: 0;
            $i++;
        }

        $view = $this->view($resultado, 200);
        return $this->handleView($view);

    }

}