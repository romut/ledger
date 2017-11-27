<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.06.2017
 * Time: 19:12
 */

namespace Core\Data;


class FieldTypeData extends Data implements FieldTypeDataInterface {

    private $id;
    private $type, $class;
    private $size, $precision;
    private $template;
    private $description;

    /**
     * @return int
     */
    public function getFieldTypeId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFieldType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return string
     */
    public function getFieldTypeDescription()
    {
        return $this->description;
    }

    /**
     * @param int $id
     * @return FieldTypeDataInterface
     */
    public function setFieldTypeId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $type
     * @return FieldTypeDataInterface
     */
    public function setFieldType($type)
    {
        $this->set($this->type, $type);
        return $this;
    }

    /**
     * @param string $class
     * @return FieldTypeDataInterface
     */
    public function setClass($class)
    {
        $this->set($this->class, $class);
        return $this;
    }

    /**
     * @param int $size
     * @return FieldTypeDataInterface
     */
    public function setSize($size)
    {
        $this->set($this->size, $size);
        return $this;
    }

    /**
     * @param int $precision
     * @return FieldTypeDataInterface
     */
    public function setPrecision($precision)
    {
        $this->set($this->precision, $precision);
        return $this;
    }

    /**
     * @param string $template
     * @return FieldTypeDataInterface
     */
    public function setTemplate($template)
    {
        $this->set($this->template, $template);
        return $this;
    }

    /**
     * @param string $description
     * @return FieldTypeDataInterface
     */
    public function setFieldTypeDescription($description)
    {
        $this->set($this->description, $description);
        return $this;
    }
}