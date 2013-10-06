<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 06/10/13
 * Time: 11:27
 * To change this template use File | Settings | File Templates.
 */

namespace spec\Fer\SifpeBundle\Entity;

use PhpSpec\ObjectBehavior;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManager;

class IngresoRepositorySpec extends ObjectBehavior {
    public function let(
        EntityManager $em,
        ClassMetadata $classMetadata
    ) {
        $this->beConstructedWith($em, $classMetadata);
    }

    public function it_implements_my_base_repository_interface() {
        $this->shouldHaveType('Fer\SifpeBundle\Entity\IRepository');
    }
}