<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 20.07.2017
 * Time: 16:10
 */

namespace Core\Data;


class RegistryData extends Data implements RegistryDataInterface {

    private $id, $state, $entryCount, $fileId;

    /**
     * @return int
     */
    public function getRegistryId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getRegistryState()
    {
        return $this->state;
    }

    /**
     * @return int
     */
    public function getRegistryEntryCount()
    {
        return $this->entryCount;
    }

    /**
     * @return int
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @param int $id
     * @return RegistryDataInterface
     */
    public function setRegistryId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param int $state
     * @return RegistryDataInterface
     */
    public function setRegistryState($state)
    {
        $this->set($this->state, $state);
        return $this;
    }

    /**
     * @param int $count
     * @return RegistryDataInterface
     */
    public function setRegistryEntryCount($count)
    {
        $this->set($this->entryCount, $count);
        return $this;
    }

    /**
     * @param int $id
     * @return RegistryDataInterface
     */
    public function setFileId($id)
    {
        $this->set($this->fileId, $id);
        return $this;
    }
}