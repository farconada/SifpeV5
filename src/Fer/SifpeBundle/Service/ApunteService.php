<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 17/10/13
 * Time: 22:17
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Service;

use Fer\SifpeDomain\Repository\IApunteRepository;
use FOS\ElasticaBundle\Finder\FinderInterface;

class ApunteService {
    /**
     * @var IApunteRepository
     */
    private $repository;

    /**
     * @var FinderInterface
     */
    private $finder;

    /**
     * @param IApunteRepository $repository
     * @param FinderInterface $finder
     */
    public function __construct(IApunteRepository $repository, FinderInterface $finder) {
        $this->repository = $repository;
        $this->finder = $finder;
    }

    /**
     * @param $queryString
     * @param \DateTime $dateIni
     * @param \DateTime $dateEnd
     * @return array
     */
    public function searchFullText($queryString, \DateTime $dateIni, \DateTime $dateEnd) {
        $queryString = new \Elastica\Query\QueryString($queryString);
        $queryObj = new \Elastica\Query($queryString);
        $queryFilter = new \Elastica\Filter\Range(
            'fecha',
            array(
                'from' => $dateIni->format('Y-m-d'),
                'to' => $dateEnd->format('Y-m-d')
            )
        );
        $queryObj->setFilter($queryFilter);
        return $this->finder->find($queryObj, 500);
    }
}