<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 03/08/13
 * Time: 20:37
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


abstract class ApunteController extends AbstractController {



    /**
     * @Template
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return array();
    }

}