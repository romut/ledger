<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 15:36
 */

namespace Core\Model;


interface RegistryEntryInterface extends ModelInterface {

    /**
     * @return RegistryInterface
     */
    public function getRegistry();

    /**
     * @return int
     */
    public function getNo();

    /**
     * @return EntryInterface
     */
    public function getEntry();

    /**
     * @return int
     */
    public function getState();

    /**
     * @param RegistryInterface $registry
     * @return RegistryEntryInterface
     */
    public function setRegistry(RegistryInterface $registry);

    /**
     * @param int $no
     * @return RegistryEntryInterface
     */
    public function setNo($no);

    /**
     * @param EntryInterface $entry
     * @return RegistryEntryInterface
     */
    public function setEntry(EntryInterface $entry);

    /**
     * @param int $state
     * @return RegistryEntryInterface
     */
    public function setState($state);
} 