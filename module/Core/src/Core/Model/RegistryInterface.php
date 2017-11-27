<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:32
 */

namespace Core\Model;


interface RegistryInterface extends EntryInterface, \Iterator, \ArrayAccess, \Countable {

    /**
     * @return int
     */
    public function getState();

    /**
     * @return int
     */
    public function getEntryCount();

    /**
     * @return FileInterface
     */
    public function getFile();

    /**
     * @param int $state
     * @return RegistryInterface
     */
    public function setState($state);

    /**
     * @param FileInterface $file
     * @return RegistryInterface
     */
    public function setFile(FileInterface $file);

    /**
     * @param EntryInterface $entry
     * @return RegistryInterface
     */
    public function addEntry(EntryInterface $entry);
}