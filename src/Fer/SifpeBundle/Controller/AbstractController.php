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
use Fer\SifpeDomain\Model\IEntidad;
use Fer\SifpeDomain\Repository\IRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;


abstract class AbstractController {

    /**
     * @DI\Inject("fos_rest.view_handler", required = true)
     */
    public $viewHandler;

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

    public function renderResponse($output, $statusCode){
        $view = View::create($output, $statusCode);
        return $this->viewHandler->handle($view);
    }

}