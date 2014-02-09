<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 07/02/14
 * Time: 17:37
 */

namespace spec\Fer\SifpeBundle\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Fer\SifpeDomain\Repository\IRepository;
use FOS\ElasticaBundle\Finder\FinderInterface;


class ApunteServiceSpec extends ObjectBehavior {

    protected $repository;

    protected $finder;

    public function let (
        IRepository $repository,
        FinderInterface $finder
    ) {
        $this->repository = $repository;
        $this->finder = $finder;
        $this->beConstructedWith($this->repository, $this->finder);
        $this->shouldHaveType('Fer\SifpeBundle\Service\IEntityService');
        $this->shouldHaveType('Fer\SifpeBundle\Service\IApunteService');

    }

    public function it_should_search_por_mes() {
        $dateIni = new \DateTime();
        $dateEnd = new \DateTime('-1 day');
        $queryString = 'something to search';

        $this->finder->find(
            Argument::that(
                function($arg) use ($queryString, $dateIni, $dateEnd){
                    return
                        ($arg['filter']['range']['fecha']['from'] == $dateIni->format('Y-m-d')) &&
                        ($arg['filter']['range']['fecha']['to'] == $dateEnd->format('Y-m-d')) &&
                        ($arg['query']['query_string']['query'] == $queryString)
                        ;
                }),
            Argument::type('int')
        )->shouldBeCalled();
        $this->searchFullText($queryString, $dateIni, $dateEnd);

    }
}