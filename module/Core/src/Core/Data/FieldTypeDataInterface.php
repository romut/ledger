<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.06.2017
 * Time: 19:06
 */

namespace Core\Data;


interface FieldTypeDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getFieldTypeId();

    /**
     * @return string
     */
    public function getFieldType();

    /**
     * @return string
     */
    public function getClass();

    /**
     * @return int
     */
    public function getSize();

    /**
     * @return int
     */
    public function getPrecision();

    /**
     * @return string
     */
    public function getTemplate();

    /**
     * @return string
     */
    public function getFieldTypeDescription();

    /**
     * @param int $id
     * @return FieldTypeDataInterface
     */
    public function setFieldTypeId($id);

    /**
     * @param string $type
     * @return FieldTypeDataInterface
     */
    public function setFieldType($type);

    /**
     * @param string $class
     * @return FieldTypeDataInterface
     */
    public function setClass($class);

    /**
     * @param int $size
     * @return FieldTypeDataInterface
     */
    public function setSize($size);

    /**
     * @param int $precision
     * @return FieldTypeDataInterface
     */
    public function setPrecision($precision);

    /**
     * @param string $template
     * @return FieldTypeDataInterface
     */
    public function setTemplate($template);

    /**
     * @param string $description
     * @return FieldTypeDataInterface
     */
    public function setFieldTypeDescription($description);
}