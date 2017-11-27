<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 17:40
 */

namespace Core\Data;


class CellTypeData extends Data implements CellTypeDataInterface {

    private $id, $name, $class;
    private $type;
    private $size, $precision;

    /**
     * @return int
     */
    public function getCellTypeId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCellTypeName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCellType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getCellTypeClass()
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
     * @param int $id
     * @return $this|CellTypeDataInterface
     */
    public function setCellTypeId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param string $name
     * @return $this|CellTypeDataInterface
     */
    public function setCellTypeName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }

    /**
     * @param string $type
     * @return CellTypeDataInterface
     */
    public function setCellType($type)
    {
        $this->set($this->type, $type);
        return $this;
    }

    public function setCellTypeClass($class)
    {
        $this->set($this->class, $class);
        return $this;
    }

    /**
     * @param int $size
     * @return CellTypeDataInterface
     */
    public function setSize($size)
    {
        $this->set($this->size, $size);
        return $this;
    }

    /**
     * @param int $precision
     * @return CellTypeDataInterface
     */
    public function setPrecision($precision)
    {
        $this->set($this->precision, $precision);
        return $this;
    }
}