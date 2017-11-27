<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 01.02.2017
 * Time: 17:04
 */

namespace Core\Data;


class EntryTypeData extends Data implements EntryTypeDataInterface {

    private $id, $name;
    private $modelId;

    public function getEntryTypeId()
    {
        return $this->id;
    }

    public function getEntryTypeName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @param int $id
     * @return $this|EntryTypeDataInterface
     */
    public function setEntryTypeId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return $this|EntryTypeDataInterface
     */
    public function setEntryTypeName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }

    /**
     * @param int $id
     * @return EntryTypeDataInterface
     */
    public function setModelId($id)
    {
        $this->set($this->modelId, $id);
        return $this;
    }
}