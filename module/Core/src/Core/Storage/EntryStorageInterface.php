<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 08.02.2016
 * Time: 18:54
 */

namespace Core\Storage;

use Core\Model\BookInterface;
use Core\Model\ClientTypeInterface;
use Core\Model\EntryInterface;
use Core\Model\EntryTypeInterface;

interface EntryStorageInterface extends ModelStorageInterface {

    /**
     * @return BookInterface
     */
    public function getBook();

    /**
     * @param BookInterface $book
     * @return EntryStorageInterface
     */
    public function setBook(BookInterface $book);

    /**
     * @param EntryInterface $entry
     * @return EntryTypeInterface
     */
    public function getEntryType(EntryInterface $entry);

    /**
     * @param string $clientTypeName
     * @return ClientTypeInterface
     */
    public function getClientType($clientTypeName);

    /**
     * @param EntryInterface $entry
     * @param int $level
     * @return bool
     */
    public function checkRight(EntryInterface $entry, $level);

    /**
     * @return EntryStorageInterface
     */
    public function resetCheckedEntries();
}