<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 09.02.2016
 * Time: 14:27
 */

namespace Core\Data;


class EntryData extends Data implements EntryDataInterface {

    private $id;
    private $modelId;
    private $parentId;
    private $state = 0;

    public function getEntryId()
    {
        return $this->id;
    }

    public function getModelId()
    {
        return $this->modelId;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getEntryState()
    {
        return $this->state;
    }

    public function setEntryId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    public function setModelId($id)
    {
        $this->set($this->modelId, $id);
        return $this;
    }

    public function setParentId($id)
    {
        $this->set($this->parentId, $id);
        return $this;
    }

    public function setEntryState($state)
    {
        $this->set($this->state, $state);
        return $this;
    }
}