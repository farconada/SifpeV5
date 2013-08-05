<?php

namespace Fer\SifpeBundle\Controller;

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
     * @param $gasto
     * @ParamConverter("gasto", class="FerSifpeBundle:Gasto")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($gasto)
    {
        return parent::deleteAction($gasto);
    }


}
