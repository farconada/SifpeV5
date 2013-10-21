<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeBundle\Service\EntityService;
use Fer\SifpeDomain\Model\IEntidad;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fer\SifpeDomain\Model\Cuenta;
use Fer\SifpeDomain\Repository\IRepository;

class CuentaController extends AbstractController
{

    /**
     * @DI\InjectParams({
    *     "entityService" = @DI\Inject("fer_sifpe.cuenta_service"),
    * })
    */
    public function __construct(EntityService $entityService)
    {
        $this->entityService = $entityService;
    }

    /**
     * @ParamConverter("cuenta", class="Fer\SifpeDomain\Model\Cuenta")
     * @param IEntidad $cuenta
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $cuenta)
    {
        return parent::deleteAction($cuenta);
    }

	/**
	 * @ParamConverter("cuenta", converter="fos_rest.request_body", class="Fer\SifpeDomain\Model\Cuenta")
	 * @param IEntidad $cuenta
	 * @return \Symfony\Component\HttpFoundation\Response|void
	 */
	public function saveAction(IEntidad $cuenta) {
		return parent::saveAction($cuenta);
	}

}
