<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 06/10/13
 * Time: 09:19
 * To change this template use File | Settings | File Templates.
 */

namespace spec\Fer\SifpeBundle\Controller;

use PhpSpec\ObjectBehavior;
use Fer\SifpeBundle\Entity\Cuenta;
use Fer\SifpeBundle\Entity\CuentaRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\RestBundle\View\ViewHandler;

class CuentaControllerSpec  extends ObjectBehavior {
    public function let(
        CuentaRepository $repository,
        ContainerInterface $container,
        ViewHandler $viewHandler
    ) {
        $this->beConstructedWith($repository);
        /**
         * $this->handleView() hace use de este ViewHandler
         */
        $container->get('fos_rest.view_handler')->willReturn($viewHandler);
        $this->setContainer($container);
    }

    public function it_should_extend_some_classes() {
        $this->shouldHaveType('Fer\SifpeBundle\Controller\AbstractController');
        $this->shouldHaveType('FOS\RestBundle\Controller\FOSRestController');
    }

    public function it_should_have_delete_action(
        Cuenta $cuenta,
        CuentaRepository $repository
    )
    {
        $repository->remove($cuenta)->shouldBeCalled();
        $this->deleteAction($cuenta);
    }

    public function it_should_have_save_action(
        Cuenta $cuenta,
        CuentaRepository $repository
    ){
        $repository->save($cuenta)->shouldBeCalled();
        $this->saveAction($cuenta);
    }
}