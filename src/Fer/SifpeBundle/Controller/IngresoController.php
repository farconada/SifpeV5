<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeBundle\Entity\IEntidad;
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
     * @param IEntidad $ingreso
     * @ParamConverter("ingreso", class="Fer\SifpeBundle\Entity\Ingreso")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $ingreso)
    {
        return parent::deleteAction($ingreso);
    }

    /**
     * @ParamConverter("ingreso", converter="fos_rest.request_body", class="Fer\SifpeBundle\Entity\Ingreso")
     * @param IEntidad $ingreso
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function saveAction(IEntidad $ingreso) {
        return parent::saveAction($ingreso);
    }
}
