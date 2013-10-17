<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 06/10/13
 * Time: 11:27
 * To change this template use File | Settings | File Templates.
 */

namespace spec\Fer\SifpeDomain\Model;

use PhpSpec\ObjectBehavior;

class GastoSpec extends ObjectBehavior {

    public function it_should_implement_ientidad() {
        $this->shouldHaveType('Fer\SifpeDomain\Model\IEntidad');
    }

    public function it_should_be_an_apunte() {
        $this->shouldHaveType('Fer\SifpeDomain\Model\Apunte');
    }
}