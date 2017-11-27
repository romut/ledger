<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.06.2017
 * Time: 19:25
 */

namespace Core\Data;


class ModelData extends Data implements ModelDataInterface {

    private $modelId, $modelName, $namespaceId;

    /**
     * @return int
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @return string
     */
    public function getModelName()
    {
        return $this->modelName;
    }

    /**
     * @return int
     */
    public function getNamespaceId()
    {
        return $this->namespaceId;
    }

    /**
     * @param int $id
     * @return $this|ModelDataInterface
     */
    public function setModelId($id)
    {
        $this->set($this->modelId, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return $this|ModelDataInterface
     */
    public function setModelName($name)
    {
        $this->set($this->modelName, $name);
        return $this;
    }

    /**
     * @param int $id
     * @return ModelDataInterface
     */
    public function setNamespaceId($id)
    {
        $this->set($this->namespaceId, $id);
        return $this;
    }
}