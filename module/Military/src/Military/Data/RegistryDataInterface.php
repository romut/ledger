<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 12:05
 */

namespace Military\Data;


use Core\Data\DataInterface;

interface RegistryDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getMilitaryRegistryId();

    /**
     * @return int
     */
    public function getMilitaryRegistryState();

    /**
     * @return int
     */
    public function getPersonCount();

    /**
     * @param int $id
     * @return RegistryDataInterface
     */
    public function setMilitaryRegistryId($id);

    /**
     * @param int $state
     * @return RegistryDataInterface
     */
    public function setMilitaryRegistryState($state);

    /**
     * @param int $count
     * @return RegistryDataInterface
     */
    public function setPersonCount($count);
} 