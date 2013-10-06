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
use Fer\SifpeBundle\Entity\GastoRepository;
use FOS\ElasticaBundle\Finder\FinderInterface;
use Fer\SifpeBundle\Entity\Gasto;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\RestBundle\View\ViewHandler;
use Prophecy\Argument;

class GastoControllerSpec extends ObjectBehavior {

    public function let (
        GastoRepository $repository,
        FinderInterface $finder,
        ContainerInterface $container,
        ViewHandler $viewHandler
    ) {
        $this->beConstructedWith($repository, $finder);

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

    public function it_should_be_an_apunte() {
        $this->shouldHaveType('Fer\SifpeBundle\Controller\ApunteController');
    }

    public function it_should_have_delete_action(
        GastoRepository $repository,
        Gasto $gasto
    ) {
        $repository->remove($gasto)->shouldBeCalled();
        $this->deleteAction($gasto);
    }

    public function it_should_have_save_action(
        GastoRepository $repository,
        Gasto $gasto
    ) {
        $repository->save($gasto)->shouldBeCalled();
        $this->saveAction($gasto);
    }

    public function it_should_have_search_action(
        FinderInterface $finder
    ) {
        $fromTime = new \DateTime();
        $toTime = new \DateTime();
        $this->searchAction('query string', $fromTime, $toTime);
        $finder->find(Argument::cetera())->shouldBeCalled();
    }
}