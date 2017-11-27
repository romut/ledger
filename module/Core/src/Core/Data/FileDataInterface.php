<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.06.2016
 * Time: 18:07
 */

namespace Core\Data;


interface FileDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getFileId();

    /**
     * @return int
     */
    public function getBookChapterId();

    /**
     * @return int
     */
    public function getFileTypeId();

    /**
     * @return int
     */
    public function getClientId();

    /**
     * @return int
     */
    public function getFileMapId();

    /**
     * @return int
     */
    public function getFileState();

    /**
     * @return string
     */
    public function getFileName();

    /**
     * @return int
     */
    public function getFileSize();

    /**
     * @return string
     */
    public function getFileCreateDate();

    /**
     * @return string
     */
    public function getFileModifyDate();

    /**
     * @return string
     */
    public function getFileLoadDate();

    /**
     * @return int
     */
    public function getMaxRow();

    /**
     * @return int
     */
    public function getErrorCount();

    /**
     * @param int $id
     * @return FileDataInterface
     */
    public function setFileId($id);

    /**
     * @param int $id
     * @return FileDataInterface
     */
    public function setBookChapterId($id);
    /**
     * @param $id
     * @return FileDataInterface
     */
    public function setFileTypeId($id);

    /**
     * @param int $id
     * @return FileDataInterface
     */
    public function setClientId($id);

    /**
     * @param int $id
     * @return FileDataInterface
     */
    public function setFileMapId($id);

    /**
     * @param int $state
     * @return FileDataInterface
     */
    public function setFileState($state);

    /**
     * @param $name
     * @return FileDataInterface
     */
    public function setFileName($name);

    /**
     * @param $size
     * @return FileDataInterface
     */
    public function setFileSize($size);

    /**
     * @param $date
     * @return FileDataInterface
     */
    public function setFileCreateDate($date);

    /**
     * @param $date
     * @return FileDataInterface
     */
    public function setFileModifyDate($date);

    /**
     * @param $date
     * @return FileDataInterface
     */
    public function setFileLoadDate($date);

    /**
     * @param $maxRow
     * @return FileDataInterface
     */
    public function setMaxRow($maxRow);

    /**
     * @param $count
     * @return FileDataInterface
     */
    public function setErrorCount($count);
}