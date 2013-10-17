<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeDomain\Model\IEntidad;
use Fer\SifpeDomain\Repository\IRepository;
use Fer\SifpeDomain\Model\Gasto;
use Fer\SifpeDomain\Repository\IApunteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class GastoController extends ApunteController
{

    /** @DI\InjectParams({
    *     "gastoRepository" = @DI\Inject("fer_sifpe.gasto_repository"),
     *    "gastoFinder" = @DI\Inject("fos_elastica.finder.website.gasto")
    * })
    */
    public function __construct(IApunteRepository $gastoRepository, $gastoFinder)
    {
        $this->entityRepository = $gastoRepository;
	    $this->apunteFinder = $gastoFinder;
    }

    /**
     * @param IEntidad $gasto
     * @ParamConverter("gasto", class="Gasto")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $gasto)
    {
        return parent::deleteAction($gasto);
    }

	/**
	 * @ParamConverter("gasto", converter="fos_rest.request_body", class="Gasto")
	 * @param IEntidad $gasto
	 * @return \Symfony\Component\HttpFoundation\Response|void
	 */
	public function saveAction(IEntidad $gasto) {
		return parent::saveAction($gasto);
	}

}
