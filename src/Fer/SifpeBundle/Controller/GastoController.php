<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeBundle\Entity\IEntidad;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Fer\SifpeBundle\Entity\Gasto;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class GastoController extends ApunteController
{

    /** @DI\InjectParams({
    *     "gastoRepository" = @DI\Inject("fer_sifpe.gasto_repository"),
    * })
    */
    public function __construct($gastoRepository)
    {
        $this->entityRepository = $gastoRepository;
    }

    /**
     * @param IEntidad $gasto
     * @ParamConverter("gasto", class="Fer\SifpeBundle\Entity\Gasto")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $gasto)
    {
        return parent::deleteAction($gasto);
    }

	/**
	 * @ParamConverter("gasto", converter="fos_rest.request_body", class="Fer\SifpeBundle\Entity\Gasto")
	 * @param IEntidad $gasto
	 * @return \Symfony\Component\HttpFoundation\Response|void
	 */
	public function saveAction(IEntidad $gasto) {
		return parent::saveAction($gasto);
	}

}
