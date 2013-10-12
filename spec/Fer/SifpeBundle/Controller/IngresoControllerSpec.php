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
use Fer\SifpeBundle\Entity\IngresoRepository;
use FOS\ElasticaBundle\Finder\FinderInterface;
use Fer\SifpeBundle\Entity\Ingreso;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\RestBundle\View\ViewHandler;
use Prophecy\Argument;

class IngresoControllerSpec extends ObjectBehavior {

    public function let (
        IngresoRepository $repository,
        FinderInterface $finder,
        ViewHandler $viewHandler
    ) {
        $this->beConstructedWith($repository, $finder);
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
        IngresoRepository $repository,
        Ingreso $ingreso
    ) {
        $repository->remove($ingreso)->shouldBeCalled();
        $this->deleteAction($ingreso);
    }

    public function it_should_have_save_action(
        IngresoRepository $repository,
        Ingreso $ingreso
    ) {
        $repository->save($ingreso)->shouldBeCalled();
        $this->saveAction($ingreso);
    }

    public function it_should_have_search_action(
        FinderInterface $finder
    ) {
        $fromTime = new \DateTime();
        $toTime = new \DateTime();
        $finder->find(Argument::cetera())->shouldBeCalled();
        $this->searchAction('query string', $fromTime, $toTime);
    }
}