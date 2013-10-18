<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeBundle\Service\EntityService;
use Fer\SifpeDomain\Model\IEntidad;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fer\SifpeDomain\Repository\IRepository;
use Fer\SifpeDomain\Model\Empresa;

class EmpresaController extends AbstractController
{

    /**
     * @DI\InjectParams({
    *     "entityService" = @DI\Inject("fer_sifpe.empresa_service"),
    * })
    */
    public function __construct(EntityService $entityService)
    {
        $this->entityService = $entityService;
    }

    /**
     * @param IEntidad $empresa
     * @ParamConverter("empresa", class="Fer\SifpeDomain\Model\Empresa")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $empresa)
    {
        return parent::deleteAction($empresa);
    }

	/**
	 * @ParamConverter("empresa", converter="fos_rest.request_body", class="Fer\SifpeDomain\Model\Empresa")
	 * @param IEntidad $empresa
	 * @return \Symfony\Component\HttpFoundation\Response|void
	 */
	public function saveAction(IEntidad $empresa) {
		return parent::saveAction($empresa);
	}


    public function indexAction()
    {
        // TODO: write logic here
    }

    public function listAction()
    {
        // TODO: write logic here
    }
}
