<?php

namespace Application\Service;

use Core\Storage\EntryStorageInterface;

interface LedgerServiceInterface {
 
    /**
     * @return EntryStorageInterface
     */
    public function getEntryStorage();
}