<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.03.2017
 * Time: 18:05
 */

namespace Core\Data;


interface FileErrorDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getFileErrorId();

    /**
     * @return int
     */
    public function getFileId();

    /**
     * @return int
     */
    public function getFileRow();

    /**
     * @return int
     */
    public function getFileColumn();

    /**
     * @return int
     */
    public function getErrorNo();

    /**
     * @return string
     */
    public function getErrorDescription();

    /**
     * @param int $id
     * @return FileErrorDataInterface
     */
    public function setFileErrorId($id);

    /**
     * @param int $id
     * @return FileErrorDataInterface
     */
    public function setFileId($id);

    /**
     * @param int $row
     * @return FileErrorDataInterface
     */
    public function setFileRow($row);

    /**
     * @param int $column
     * @return FileErrorDataInterface
     */
    public function setFileColumn($column);

    /**
     * @param int $no
     * @return FileErrorDataInterface
     */
    public function setErrorNo($no);

    /**
     * @param string $description
     * @return FileErrorDataInterface
     */
    public function setErrorDescription($description);
} 