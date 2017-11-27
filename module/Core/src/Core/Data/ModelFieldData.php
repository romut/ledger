<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.06.2017
 * Time: 19:31
 */

namespace Core\Data;


class ModelFieldData extends Data implements ModelFieldDataInterface {

    private $modelId;
    private $fieldNo, $fieldTypeId;
    private $name;

    /**
     * @return int
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @return int
     */
    public function getFieldNo()
    {
        return $this->fieldNo;
    }

    /**
     * @return int
     */
    public function getFieldTypeId()
    {
        return $this->fieldTypeId;
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->name;
    }

    /**
     * @param int $id
     * @return ModelFieldDataInterface
     */
    public function setModelId($id)
    {
        $this->set($this->modelId, $id);
        return $this;
    }

    /**
     * @param int $no
     * @return ModelFieldDataInterface
     */
    public function setFieldNo($no)
    {
        $this->set($this->fieldNo, $no);
        return $this;
    }

    /**
     * @param int $id
     * @return ModelFieldDataInterface
     */
    public function setFieldTypeId($id)
    {
        $this->set($this->fieldTypeId, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return ModelFieldDataInterface
     */
    public function setFieldName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }
}