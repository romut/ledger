<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 16:00
 */

namespace Core\Data;


class RegistryEntryData extends Data implements RegistryEntryDataInterface {

    private $registryId, $entryNo, $entryId, $entryState;
    /**
     * @return int
     */
    public function getRegistryId()
    {
        return $this->registryId;
    }

    /**
     * @return int
     */
    public function getRegistryEntryNo()
    {
        return $this->entryNo;
    }

    /**
     * @return int
     */
    public function getEntryId()
    {
        return $this->entryId;
    }

    /**
     * @return int
     */
    public function getEntryState()
    {
        return $this->entryState;
    }

    /**
     * @param int $id
     * @return RegistryEntryDataInterface
     */
    public function setRegistryId($id)
    {
        $this->set($this->registryId, $id);
        return $this;
    }

    /**
     * @param int $no
     * @return RegistryEntryDataInterface
     */
    public function setRegistryEntryNo($no)
    {
        $this->set($this->entryNo, $no);
        return $this;
    }

    /**
     * @param int $id
     * @return RegistryEntryDataInterface
     */
    public function setEntryId($id)
    {
        $this->set($this->entryId, $id);
        return $this;
    }

    /**
     * @param int $state
     * @return RegistryEntryDataInterface
     */
    public function setEntryState($state)
    {
        $this->set($this->entryState, $state);
        return $this;
    }
}