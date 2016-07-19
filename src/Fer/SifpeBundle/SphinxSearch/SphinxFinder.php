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
     $sphinxResults = $this->sphinx->searchEx($query['query'], $this->index);
     $results = [];
     foreach ($sphinxResults['matches'] as $id => $item) {
        $results[] = $item['entity'];
     }
     return $results;

   }
}
