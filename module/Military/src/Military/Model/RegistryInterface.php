<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 12:40
 */

namespace Military\Model;


use Core\Model\EntryInterface;

interface RegistryInterface extends EntryInterface, \Iterator, \Countable, \ArrayAccess {

    /**
     * @return int
     */
    public function getState();

    /**
     * @return int
     */
    public function getPersonCount();

    /**
     * @param int $state
     * @return RegistryInterface
     */
    public function setState($state);

    public function addPerson(RegistryPersonInterface $person);
} 