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

class AbstractController extends FOSRestController {
    /**
     * @var EntityManager
     * @DI\Inject("doctrine.orm.entity_manager")
     */
    public $entityManager;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    public $entityRepository;

    /**
     * @param IEntidad $entity
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(IEntidad $entity) {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
        $view = $this->view(array('msg' => 'deleted'), 200);
        return $this->handleView($view);
    }

    /**
     * @param IEntidad $entity
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function saveAction(IEntidad $entity) {
        if ($entity->getId() != null) {
            // actualiza
            $this->entityManager->merge($entity);
        } else {
            // añade nuevo
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
        $view = $this->view(array('msg' => 'saved'), 200);
        return $this->handleView($view);
    }

    public function searchAction($queryString) {
        // TODO: implementar
    }

    public function listAllAction() {
        $entities = $this->entityRepository->findAll();
        $view = $this->view($entities);
        return $this->handleView($view);
    }

}