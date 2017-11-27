<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.01.2017
 * Time: 10:17
 */

namespace Core\Model;


use Core\Data\DataInterface;
use Core\Storage\ModelStorageInterface;

interface ModelInterface {

    /**
     * @return DataInterface[]
     */
    static public function createDataArray();

    /**
     * @return string
     */
    static public function getClassFullName();

    /**
     * @return ModelStorageInterface
     */
    public function getStorage();

    /**
     * @return int
     */
    public function getIndex();

    /**
     * @return int
     */
    public function getModelId();

    /**
     * @param int $modelId
     * @return ModelInterface
     */
    public function setModelId($modelId);

    /**
     * @return bool
     */
    public function isModified();

    /**
     * @return ModelInterface
     */
    public function save();
}