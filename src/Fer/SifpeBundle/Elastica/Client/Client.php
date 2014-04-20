<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 20/04/14
 * Time: 17:54
 */

namespace Fer\SifpeBundle\Elastica\Client;


use FOS\ElasticaBundle\Client as BaseClient;
use Elastica\Request;
use Elastica\Exception\ExceptionInterface;
use Elastica\Response;

class Client extends BaseClient
{
    public function request($path, $method = Request::GET, $data = array(), array $query = array())
    {
        try {
            return parent::request($path, $method, $data);
        } catch (ExceptionInterface $e) {
            return new Response('{"took":0,"timed_out":false,"hits":{"total":0,"max_score":0,"hits":[]}}');
        }
    }
}