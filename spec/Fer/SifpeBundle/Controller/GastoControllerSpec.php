<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 06/10/13
 * Time: 10:03
 * To change this template use File | Settings | File Templates.
 */

namespace spec\Fer\SifpeBundle\Controller;

use Fer\SifpeBundle\Service\ApunteService;
use PhpSpec\ObjectBehavior;
use Fer\SifpeDomain\Model\Gasto;
use Fer\SifpeDomain\Repository\ORM\GastoRepository;
use FOS\ElasticaBundle\Finder\FinderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\RestBundle\View\ViewHandler;
use Prophecy\Argument;

class GastoControllerSpec extends ObjectBehavior {

    protected $apunteService;

    public function let (
        ApunteService $apunteService,
        ViewHandler $viewHandler
    ) {
        $this->apunteService = $apunteService;
        $this->beConstructedWith($this->apunteService);
        $this->viewHandler = $viewHandler;
    }
    public function it_should_extend_some_classes() {
        $this->shouldHaveType('Fer\SifpeBundle\Controller\AbstractController');
        $this->shouldNotHaveType('FOS\RestBundle\Controller\FOSRestController');
    }

    public function it_should_be_an_apunte_controller() {
        $this->shouldHaveType('Fer\SifpeBundle\Controller\ApunteController');
    }

    public function it_should_have_delete_action(
	    ApunteService $apunteService,
        Gasto $gasto
    ) {
	    $apunteService->remove($gasto)->shouldBeCalled();
        $this->deleteAction($gasto);
    }

    public function it_should_have_save_action(
	    ApunteService $apunteService,
        Gasto $gasto
    ) {
	    $apunteService->save($gasto)->shouldBeCalled();
        $this->saveAction($gasto);
    }

    public function it_should_have_search_action(
	    ApunteService $apunteService
    ) {
        $fromTime = new \DateTime();
        $toTime = new \DateTime();
	    $apunteService->searchFullText(Argument::cetera())->shouldBeCalled();
        $this->searchAction('query string', $fromTime, $toTime);
    }

    public function it_should_have_a_listado_de_meses() {
        $desdeMes = 1;
        $this->apunteService->findPorMes($desdeMes)->shouldBeCalled();
        $this->apunteService->getTotalMesesRegistrados()->shouldBeCalled();
        $this->listDesdeMesAction($desdeMes);
    }

    public function it_should_have_a_listada_resumen_por_cuenta() {
        $mes =  5;
        $anio = 2014;
        $this->apunteService->getTotalCuentasMensual($anio, $mes)->shouldBeCalled();
        $this->listResumenPorCuentaAction($anio, $mes);
    }

    public function it_should_have_a_resumen_anual() {
        $anio = 2014;
        $this->apunteService->getResumenAnual($anio)->shouldBeCalled();
        $this->listResumenAnualAction($anio);
    }

    public function it_should_have_resumen_por_mes() {
        $anio = 2014;
        $this->apunteService->getResumenAnual($anio)->shouldBeCalled();
        $this->listResumenAnualAction($anio);
    }

    public function it_should_have_resumen_mensual() {
        $mes =  5;
        $anio = 2014;
        $this->apunteService->getResumenMes($anio, $mes)->shouldBeCalled();
        $this->listResumenMesAction($anio, $mes);
    }

    public function it_should_have_show_Action() {
        $id =1;
        $this->apunteService->find($id)->shouldBeCalled();
        $this->showAction($id);
    }
}