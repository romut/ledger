<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 17:40
 */

namespace Core\Data;


interface CellTypeDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getCellTypeId();

    /**
     * @return string
     */
    public function getCellTypeName();

    /**
     * @return string
     */
    public function getCellType();

    /**
     * @return mixed
     */
    public function getCellTypeClass();

    /**
     * @return int
     */
    public function getSize();

    /**
     * @return int
     */
    public function getPrecision();

    /**
     * @param int $id
     * @return CellTypeDataInterface
     */
    public function setCellTypeId($id);

    /**
     * @param string $name
     * @return CellTypeDataInterface
     */
    public function setCellTypeName($name);

    /**
     * @param string $type
     * @return CellTypeDataInterface
     */
    public function setCellType($type);

    /**
     * @param string $class
     * @return CellTypeDataInterface
     */
    public function setCellTypeClass($class);

    /**
     * @param int $size
     * @return CellTypeDataInterface
     */
    public function setSize($size);

    /**
     * @param int $precision
     * @return CellTypeDataInterface
     */
    public function setPrecision($precision);
} 