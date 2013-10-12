<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 03/08/13
 * Time: 22:49
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\DiExtraBundle\Annotation as DI;
use Fer\SifpeBundle\Entity\IEntidad;
use Fer\SifpeBundle\Entity\IRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

abstract class AbstractController extends FOSRestController {

    /**
     * @Template
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @var IRepository
     */
    public $entityRepository;

    /**
     * @param IEntidad $entity
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $entity) {
        $this->entityRepository->remove($entity);
        return $this->renderResponse(array('msg' => 'deleted'), 200);
    }

    /**
     * @param IEntidad $entity
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function saveAction(IEntidad $entity) {
        $this->entityRepository->save($entity);
        return $this->renderResponse(array('msg' => 'saved'), 200);
    }

    public function listAllAction() {
        $entities = $this->entityRepository->findAll();
        return $this->renderResponse($entities, 200);
    }

	public function showAction($id) {
		$entity = $this->entityRepository->find($id);
        return $this->renderResponse($entity, 200);
	}

    public function renderResponse($output, $responseCode){
        $view = $this->view($output, $responseCode);
        return $this->handleView($view);
    }

}