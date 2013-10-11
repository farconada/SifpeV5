<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeBundle\Entity\IEntidad;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fer\SifpeBundle\Entity\Cuenta;
use Fer\SifpeBundle\Entity\IRepository;

class CuentaController extends AbstractController
{

    /**
     * @DI\InjectParams({
    *     "cuentaRepository" = @DI\Inject("fer_sifpe.cuenta_repository"),
    * })
    */
    public function __construct(IRepository $cuentaRepository)
    {
        $this->entityRepository = $cuentaRepository;
    }

    /**
     * @ParamConverter("cuenta", class="Fer\SifpeBundle\Entity\Cuenta")
     * @param \Fer\SifpeBundle\Entity\IEntidad $cuenta
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $cuenta)
    {
        return parent::deleteAction($cuenta);
    }

	/**
	 * @ParamConverter("cuenta", converter="fos_rest.request_body", class="Fer\SifpeBundle\Entity\Cuenta")
	 * @param IEntidad $cuenta
	 * @return \Symfony\Component\HttpFoundation\Response|void
	 */
	public function saveAction(IEntidad $cuenta) {
		return parent::saveAction($cuenta);
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
