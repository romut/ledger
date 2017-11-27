<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 12:08
 */

namespace Military\Data;


use Core\Data\Data;

class RegistryData extends Data implements RegistryDataInterface {

    private $id, $state;

    /**
     * @return int
     */
    public function getMilitaryRegistryId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getMilitaryRegistryState()
    {
        return $this->state;
    }

    /**
     * @param int $id
     * @return RegistryDataInterface
     */
    public function setMilitaryRegistryId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param int $state
     * @return RegistryDataInterface
     */
    public function setMilitaryRegistryState($state)
    {
        $this->set($this->state, $state);
        return $this;
    }
    public function setPersonCount($count)
    {}

    public function getPersonCount()
    {}

}