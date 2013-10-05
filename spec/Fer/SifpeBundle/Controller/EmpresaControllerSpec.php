<?php
namespace spec\Fer\SifpeBundle\Controller;
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 05/10/13
 * Time: 23:16
 * To change this template use File | Settings | File Templates.
 */

use PhpSpec\ObjectBehavior;
use Fer\SifpeBundle\Entity\EmpresaRepository;
use Fer\SifpeBundle\Entity\Empresa;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\RestBundle\View\ViewHandler;

class EmpresaControllerSpec extends ObjectBehavior {
    public function let(
        EmpresaRepository $repository,
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

    public function it_should_call_delete_action(
        Empresa $empresa,
        EmpresaRepository $repository
    )
    {
        $repository->remove($empresa)->shouldBeCalled();
        $this->deleteAction($empresa);
    }

    public function it_should_call_save_action(
        Empresa $empresa,
        EmpresaRepository $repository
    ){
        $repository->save($empresa)->shouldBeCalled();
        $this->saveAction($empresa);
    }
}