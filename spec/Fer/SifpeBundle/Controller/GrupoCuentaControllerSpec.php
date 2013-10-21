<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 06/10/13
 * Time: 09:19
 * To change this template use File | Settings | File Templates.
 */

namespace spec\Fer\SifpeBundle\Controller;

use Fer\SifpeBundle\Service\ApunteService;
use Fer\SifpeBundle\Service\EntityService;
use PhpSpec\ObjectBehavior;
use Fer\SifpeDomain\Model\GrupoCuenta;
use Fer\SifpeDomain\Repository\ORM\CuentaRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\RestBundle\View\ViewHandler;

class GrupoCuentaControllerSpec  extends ObjectBehavior {
    public function let(
        EntityService $entityService,
        ViewHandler $viewHandler
    ) {
        $this->beConstructedWith($entityService);
        $this->viewHandler = $viewHandler;
    }

    public function it_should_extend_some_classes() {
        $this->shouldHaveType('Fer\SifpeBundle\Controller\AbstractController');
        $this->shouldNotHaveType('FOS\RestBundle\Controller\FOSRestController');
    }

    public function it_should_have_delete_action(
	    GrupoCuenta $cuenta,
        EntityService $entityService
    )
    {
	    $entityService->remove($cuenta)->shouldBeCalled();
        $this->deleteAction($cuenta);
    }

    public function it_should_have_save_action(
	    GrupoCuenta $cuenta,
        EntityService $entityService
    ){
	    $entityService->save($cuenta)->shouldBeCalled();
        $this->saveAction($cuenta);
    }

    public function it_should_have_index_action() {
        $this->indexAction();
    }

    public function it_should_have_list_action() {
        $this->listAllAction();
    }
}