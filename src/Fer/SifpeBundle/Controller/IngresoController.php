<?php

namespace Fer\SifpeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class IngresoController extends ApunteController
{
    /** @DI\InjectParams({
     *     "ingresoRepository" = @DI\Inject("fer_sifpe.ingreso_repository"),
     * })
     */
    public function __construct($ingresoRepository)
    {
        $this->entityRepository = $ingresoRepository;
    }

    /**
     * @param $ingreso
     * @ParamConverter("ingreso", class="FerSifpeBundle:Ingreso")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction($ingreso)
    {
        return parent::deleteAction($ingreso);
    }
}
