<?php

namespace Fer\SifpeBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @param $cuenta
     * @ParamConverter("cuenta", class="FerSifpeBundle:cuenta")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($cuenta)
    {
        return parent::deleteAction($cuenta);
    }


}
