<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 08.07.2016
 * Time: 16:46
 */

namespace Core\Model;


interface FileCellInterface extends ModelInterface {

    /**
     * @return int
     */
    public function getFileId();

    /**
     * @return int
     */
    public function getRow();

    /**
     * @return int
     */
    public function getColumn();

    /**
     * @return string
     */
    public function getValue();

    /**
     * @param int $id
     * @return FileCellInterface
     */
    public function setFileId($id);

    /**
     * @param int $row
     * @return FileCellInterface
     */
    public function setRow($row);

    /**
     * @param int $column
     * @return FileCellInterface
     */
    public function setColumn($column);

    /**
     * @param string $value
     * @return FileCellInterface
     */
    public function setValue($value);
} 