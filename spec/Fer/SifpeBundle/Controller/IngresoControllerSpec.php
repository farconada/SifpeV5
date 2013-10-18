<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 06/10/13
 * Time: 10:03
 * To change this template use File | Settings | File Templates.
 */

namespace spec\Fer\SifpeBundle\Controller;

use PhpSpec\ObjectBehavior;
use Fer\SifpeDomain\Repository\ORM\IngresoRepository;
use Fer\SifpeDomain\Model\Ingreso;
use FOS\ElasticaBundle\Finder\FinderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\RestBundle\View\ViewHandler;
use Prophecy\Argument;
use Fer\SifpeBundle\Service\ApunteService;

class IngresoControllerSpec extends ObjectBehavior {

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
        Ingreso $ingreso
    ) {
	    $apunteService->remove($ingreso)->shouldBeCalled();
        $this->deleteAction($ingreso);
    }

    public function it_should_have_save_action(
	    ApunteService $apunteService,
        Ingreso $ingreso
    ) {
	    $apunteService->save($ingreso)->shouldBeCalled();
        $this->saveAction($ingreso);
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