<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeDomain\Model\IEntidad;
use Fer\SifpeDomain\Repository\IRepository;
use Fer\SifpeDomain\Model\Gasto;
use Fer\SifpeDomain\Repository\IApunteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fer\SifpeBundle\Service\IApunteService;

class GastoController extends ApunteController
{

    /** @DI\InjectParams({
    *     "apunteService" = @DI\Inject("fer_sifpe.gasto_service")
    * })
    */
    public function __construct(IApunteService $apunteService)
    {
        $this->entityService = $apunteService;
    }

    /**
     * @param IEntidad $gasto
     * @ParamConverter("gasto", class="Fer\SifpeDomain\Model\Gasto")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $gasto)
    {
        return parent::deleteAction($gasto);
    }

	/**
	 * @ParamConverter("gasto", converter="fos_rest.request_body", class="Fer\SifpeDomain\Model\Gasto")
	 * @param IEntidad $gasto
	 * @return \Symfony\Component\HttpFoundation\Response|void
	 */
	public function saveAction(IEntidad $gasto) {
		return parent::saveAction($gasto);
	}

}
