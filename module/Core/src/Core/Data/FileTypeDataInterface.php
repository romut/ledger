<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 17:27
 */

namespace Core\Data;


interface FileTypeDataInterface extends DataInterface {

    /**
     * @return int
     */
    public function getFileTypeId();

    /**
     * @return string
     */
    public function getFileTypeName();

    /**
     * @return int
     */
    public function getBookChapterId();

    /**
     * @return string
     */
    public function getFileNamePattern();

    /**
     * @param int $id
     * @return FileTypeDataInterface
     */
    public function setFileTypeId($id);

    /**
     * @param string $name
     * @return FileTypeDataInterface
     */
    public function setFileTypeName($name);

    /**
     * @param int $id
     * @return FileTypeDataInterface
     */
    public function setBookChapterId($id);

    /**
     * @param string $pattern
     * @return FileTypeDataInterface
     */
    public function setFileNamePattern($pattern);
}