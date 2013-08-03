<?php

namespace Fer\SifpeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\DiExtraBundle\Annotation as DI;

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


}
