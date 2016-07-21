<?php

namespace Fer\SifpeBundle\SphinxSearch;

use Fer\SifpeBundle\Service\IFinderService;

class SphinxFinder implements IFinderService {
   private $index;
   private $sphinx;
   public function __construct($sphinxSearch, $index) {
      $this->index = $index;
      $this->sphinx = $sphinxSearch;
   }

   public function find($query) {
     $this->sphinx->setLimits(0, 9999);
     $fromDate = \DateTime::createFromFormat('Y-m-d', $query['filter']['range']['fecha']['from']);
     $toDate = \DateTime::createFromFormat('Y-m-d', $query['filter']['range']['fecha']['to']);
     $this->sphinx->setFilterBetweenDates('unixdate', $fromDate, $toDate);
     $sphinxResults = $this->sphinx->searchEx($query['query'], $this->index);
     $results = [];
     foreach ($sphinxResults['matches'] as $id => $item) {
        $results[] = $item['entity'];
     }
     return $results;

   }
}
