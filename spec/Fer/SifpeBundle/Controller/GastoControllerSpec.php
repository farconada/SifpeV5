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

    public function let (
        ApunteService $apunteService,
        ViewHandler $viewHandler
    ) {
        $this->beConstructedWith($apunteService);
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
}