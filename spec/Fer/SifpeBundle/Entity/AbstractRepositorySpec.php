<?php
namespace spec\Fer\SifpeBundle\Entity;

/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 06/10/13
 * Time: 11:15
 * To change this template use File | Settings | File Templates.
 */

use PhpSpec\ObjectBehavior;
use Fer\SifpeBundle\Entity\IEntidad;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;
use Prophecy\Argument;

class AbstractRepositorySpec extends ObjectBehavior {
    public function let(
        EntityManager $em,
        ClassMetadata $classMetadata
    ) {
        $this->beConstructedWith($em, $classMetadata);
    }

    public function it_inherits_from_doctrine_base_repository() {
        $this->shouldHaveType('Doctrine\ORM\EntityRepository');
    }

    public function it_implements_my_base_repository_interface() {
        $this->shouldHaveType('Fer\SifpeBundle\Entity\IRepository');
    }

    public function it_could_save_entities(
        IEntidad $entity,
        EntityManager $em
    ) {
        $this->save($entity);
        $em->persist($entity)->shouldBeCalled();
        $em->flush(Argument::cetera())->shouldBeCalled();
    }

    public function it_could_remove_entities(
        IEntidad $entity,
        EntityManager $em
    ) {
        $em->remove($entity)->shouldBeCalled();
        $em->flush(Argument::cetera())->shouldBeCalled();
        $this->remove($entity);
    }
}