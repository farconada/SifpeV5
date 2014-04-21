<?php

namespace Fer\SifpeBundle\Controller;
use Fer\SifpeBundle\Service\IEntityService;
use Fer\SifpeDomain\Model\IEntidad;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class GrupoCuentaController extends AbstractController
{


	/**
	 * @DI\InjectParams({
	 *     "entityService" = @DI\Inject("fer_sifpe.grupocuenta_service"),
	 * })
	 */
	public function __construct(IEntityService $entityService)
	{
		$this->entityService = $entityService;
	}

	/**
	 * @ParamConverter("grupo", class="Fer\SifpeDomain\Model\GrupoCuenta")
	 * @param IEntidad $grupo
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function deleteAction(IEntidad $grupo)
	{
		return parent::deleteAction($grupo);
	}

	/**
	 * @ParamConverter("grupo", converter="fos_rest.request_body", class="Fer\SifpeDomain\Model\GrupoCuenta")
	 * @param IEntidad $grupo
	 * @return \Symfony\Component\HttpFoundation\Response|void
	 */
	public function saveAction(IEntidad $grupo) {
		return parent::saveAction($grupo);
	}
}
