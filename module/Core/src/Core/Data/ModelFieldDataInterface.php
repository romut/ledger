<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.06.2017
 * Time: 19:27
 */

namespace Core\Data;


interface ModelFieldDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getModelId();

    /**
     * @return int
     */
    public function getFieldNo();

    /**
     * @return int
     */
    public function getFieldTypeId();

    /**
     * @return string
     */
    public function getFieldName();

    /**
     * @param int $id
     * @return ModelFieldDataInterface
     */
    public function setModelId($id);

    /**
     * @param int $no
     * @return ModelFieldDataInterface
     */
    public function setFieldNo($no);

    /**
     * @param int $id
     * @return ModelFieldDataInterface
     */
    public function setFieldTypeId($id);

    /**
     * @param string $name
     * @return ModelFieldDataInterface
     */
    public function setFieldName($name);
} 