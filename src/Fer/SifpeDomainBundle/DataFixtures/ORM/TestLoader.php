<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 9/10/13
 * Time: 13:58
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeDomainBundle\DataFixtures;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class TestLoader extends DataFixtureLoader
{
	/**
	 * {@inheritDoc}
	 */
	protected function getFixtures()
	{
		return  array(
			__DIR__ . '/test.yml',

		);
	}
}