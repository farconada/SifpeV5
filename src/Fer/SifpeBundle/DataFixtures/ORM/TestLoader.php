<?php
/**
 * Created by JetBrains PhpStorm.
 * User: fernando
 * Date: 9/10/13
 * Time: 13:58
 * To change this template use File | Settings | File Templates.
 */

namespace Fer\SifpeBundle\DataFixtures;

use Hautelook\AliceBundle\Doctrine\DataFixtures\AbstractLoader;

class TestLoader extends AbstractLoader
{
	/**
	 * {@inheritDoc}
	 */
	public function getFixtures()
	{
		return  array(
			__DIR__ . '/test.yml',

		);
	}
}
