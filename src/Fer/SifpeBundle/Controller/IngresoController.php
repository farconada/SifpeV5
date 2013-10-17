<?php

namespace Fer\SifpeBundle\Controller;

use Fer\SifpeDomain\Model\IEntidad;
use Fer\SifpeDomain\Repository\IApunteRepository;
use Fer\SifpeDomain\Model\Ingreso;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class IngresoController extends ApunteController
{
    /** @DI\InjectParams({
     *     "ingresoRepository" = @DI\Inject("fer_sifpe.ingreso_repository"),
     *     "ingresoFinder" = @DI\Inject("fos_elastica.finder.website.ingreso")
     * })
     */
    public function __construct(IApunteRepository $ingresoRepository, $ingresoFinder)
    {
        $this->entityRepository = $ingresoRepository;
        $this->apunteFinder = $ingresoFinder;
    }

    /**
     * @param IEntidad $ingreso
     * @ParamConverter("ingreso", class="Fer\SifpeDomain\Model\Ingreso")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $ingreso)
    {
        return parent::deleteAction($ingreso);
    }

    /**
     * @ParamConverter("ingreso", converter="fos_rest.request_body", class="Fer\SifpeDomain\Model\Ingreso")
     * @param IEntidad $ingreso
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function saveAction(IEntidad $ingreso) {
        return parent::saveAction($ingreso);
    }
}
