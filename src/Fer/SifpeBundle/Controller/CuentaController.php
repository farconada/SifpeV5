<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeBundle\Entity\IEntidad;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Fer\SifpeBundle\Entity\Cuenta;

class CuentaController extends AbstractController
{

    /**
     * @DI\InjectParams({
    *     "cuentaRepository" = @DI\Inject("fer_sifpe.cuenta_repository"),
    * })
    */
    public function __construct($cuentaRepository)
    {
        $this->entityRepository = $cuentaRepository;
    }

    /**
     * @ParamConverter("cuenta", class="FerSifpeBundle:cuenta")
     * @param \Fer\SifpeBundle\Entity\IEntidad $cuenta
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $cuenta)
    {
        return parent::deleteAction($cuenta);
    }


}
