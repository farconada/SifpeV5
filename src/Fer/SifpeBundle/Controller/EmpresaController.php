<?php

namespace Fer\SifpeBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EmpresaController extends AbstractController
{

    /**
     * @DI\InjectParams({
    *     "empresaRepository" = @DI\Inject("fer_sifpe.empresa_repository"),
    * })
    */
    public function __construct($empresaRepository)
    {
        $this->entityRepository = $empresaRepository;
    }

    /**
     * @param $empresa
     * @ParamConverter("gasto", class="FerSifpeBundle:Empresa")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($empresa)
    {
        return parent::deleteAction($empresa);
    }


}
