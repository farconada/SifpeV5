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
use Doctrine\ORM\EntityManager;
use FOS\RestBundle\View\View;
use JMS\DiExtraBundle\Annotation as DI;
use Fer\SifpeBundle\Entity\IEntidad;
use Fer\SifpeBundle\Entity\IRepository;

abstract class AbstractController extends FOSRestController {

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
        $view = $this->view(array('msg' => 'deleted'), 200);
        return $this->handleView($view);
    }

    /**
     * @param IEntidad $entity
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function saveAction(IEntidad $entity) {
        $this->entityRepository->save($entity);
        $view = $this->view(array('msg' => 'saved'), 200);
        return $this->handleView($view);
    }

    public function listAllAction() {
        $entities = $this->entityRepository->findAll();
        $view = $this->view($entities);
        return $this->handleView($view);
    }

	public function showAction($id) {
		$entity = $this->entityRepository->find($id);
		$view = $this->view($entity, 200);
		return $this->handleView($view);
	}

}