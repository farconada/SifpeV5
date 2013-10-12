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
        ViewHandler $viewHandler
    ) {
        $this->beConstructedWith($repository);
        $this->viewHandler = $viewHandler;
    }

    public function it_should_extend_some_classes() {
        $this->shouldHaveType('Fer\SifpeBundle\Controller\AbstractController');
        $this->shouldNotHaveType('FOS\RestBundle\Controller\FOSRestController');
    }

    public function it_should_have_delete_action(
        Empresa $empresa,
        EmpresaRepository $repository
    )
    {
        $repository->remove($empresa)->shouldBeCalled();
        $this->deleteAction($empresa);
    }

    public function it_should_have_save_action(
        Empresa $empresa,
        EmpresaRepository $repository
    ){
        $repository->save($empresa)->shouldBeCalled();
        $this->saveAction($empresa);
    }

    public function it_should_have_index_action() {
        $this->indexAction();
    }

    public function it_should_have_list_action() {
        $this->listAction();
    }
}