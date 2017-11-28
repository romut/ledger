<?php

namespace Application\Service;

use Core\Storage\EntryStorageInterface;

class LedgerService implements LedgerServiceInterface {
    
    /**
     * @var EntryStorageInterface $storage
     */
    private $storage;
    
    public function __construct(EntryStorageInterface $storage)
    {
        $this->storage = $storage;
    }
    
    public function getEntryStorage()
    {
        return $this->storage;
    }
}