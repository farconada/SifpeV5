<?php

namespace Fer\SifpeBundle\Features\Context;

use Symfony\Component\HttpKernel\KernelInterface;
use Behat\Symfony2Extension\Context\KernelAwareInterface;
use Behat\MinkExtension\Context\MinkContext;

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Sanpi\Behatch\Context\BehatchContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Feature context.
 */
class FeatureContext extends MinkContext //MinkContext if you want to test web
                  implements KernelAwareInterface
{
    private $kernel;
    private $parameters;

    /**
     * Initializes context with parameters from behat.yml.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
	    $this->useContext('behatch', new BehatchContext($parameters));
    }

    /**
     * Sets HttpKernel instance.
     * This method will be automatically called by Symfony2Extension ContextInitializer.
     *
     * @param KernelInterface $kernel
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Opens specified page. and replace vars
     *
     * @Given /^(?:|I )am on a URL like "(?P<page>[^"]+)"$/
     * @When /^(?:|I )go to a URL like "(?P<page>[^"]+)"$/
     */
    public function visit($page)
    {
        $date = new \DateTime();
        $date1Mes = new \DateTime("first day of 1 month ago");
        $date2Mes = new \DateTime("first day of 1 month ago");

        $page = str_replace('{esteAnio}', $date->format('Y'),$page);
        $page = str_replace('{esteMes}', $date->format('m'),$page);
        $page = str_replace('{hoy-1mes}', $date1Mes->format('Y-m-d'), $page);
        $page = str_replace('{hoy}', $date->format('Y-m-d'), $page);

        parent::visit($page);
    }
}
