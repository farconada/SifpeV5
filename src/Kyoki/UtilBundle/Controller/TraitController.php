<?php

namespace Kyoki\UtilBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\Event;
use Doctrine\Common\Persistence\ObjectManager;

trait TraitController
{
    /**
     * Los controladores que lo usen deben tener una propiedad
     * protected $objectManager;
     */

    /**
     * @param ObjectManager $om
     */
    protected function setObjectManager(ObjectManager $om)
    {
        $this->objectManager = $om;
    }

    public function redirectToRoute($route, $parameters = array(), $status = 302)
    {
        return $this->redirect($this->generateUrl($route, $parameters), $status);
    }

    public function getSession()
    {
        return $this->get('session');
    }

    public function persist($entity, $flush = false)
    {
        $this->getObjectManager()->persist($entity);

        if ($flush) {
            $this->flush();
        }
    }

    public function remove($entity, $flush = false)
    {
        $this->getObjectManager()->remove($entity);

        if ($flush) {
            $this->flush();
        }
    }

    public function flush($entity = null)
    {
        $this->getObjectManager()->flush($entity);
    }


    public function addFlash($type, $message = null)
    {
        $message = $message ?: sprintf('%s.%s', $this->getRequest()->attributes->get('_route'), $type);

        $this->getFlashBag()->add($type, $message);
    }

    public function getSecurity()
    {
        return $this->get('security.context');
    }

    public function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    public function getFlashBag()
    {
        return $this->getSession()->getFlashBag();
    }

    public function getParameter($name)
    {
        return $this->container->getParameter($name);
    }

    public function getLoggedUser()
    {
        return $this->get('security.context')->getToken()->getUser();
    }

    public function isLoggedUser()
    {
        return is_object($this->getLoggedUser());
    }

    public function getRequestParameter($name, $default = null, $deep = false)
    {
        return $this->getRequest()->query->get($name, $default, $deep);
    }

    /**
     * @param $repository
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    public function getRepository($repository)
    {
        return $this->getObjectManager()->getRepository($repository);
    }

    public function dispatchEvent($eventName, Event $event = null)
    {
        $dispatcher = $this->get('event_dispatcher');
        $dispatcher->dispatch($eventName, $event);
    }

    /**
     * @return \Doctrine\ODM\MongoDB\DocumentManager
     */
    public function getDocumentManager()
    {
        return $this->get('doctrine_mongodb')->getManager();
    }

    /**
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        return $this->objectManager;
    }
}
