<?php

namespace Fer\SifpeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;

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
}
