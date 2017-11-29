<?php

namespace Application\Service;

use Core\Storage\EntryStorageInterface;

class LedgerService implements LedgerServiceInterface {
    
    /**
     * @var EntryStorageInterface $storage
     */
    private $storage;
    private $book;
    private $user;
    
    public function __construct(EntryStorageInterface $storage)
    {
        $this->storage = $storage;
        
        $book = $storage->select('Core\Model\Book', array('book_name' => 'Main Book'));
        $storage->setBook($book);
        
        $user = $storage->select('Core\Model\User', array('login' => 'root'));
        $book->open($user);
    }
    
    public function getEntryStorage()
    {
        return $this->storage;
    }
}