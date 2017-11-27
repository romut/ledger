<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 07.06.2016
 * Time: 17:55
 */

namespace Core\Model;


interface FileInterface extends EntryInterface, \Iterator {

    /**
     * @return FileTypeInterface
     */
    public function getFileType();

    /**
     * @return ClientInterface
     */
    public function getClient();

    /**
     * @return FileMapInterface
     */
    public function getFileMap();

    /**
     * @return int
     */
    public function getState();

    /**
     * @return int
     */
    public function getSize();

    /**
     * @return string
     */
    public function getCreateDate();

    /**
     * @return string
     */
    public function getModifyDate();

    /**
     * @return string
     */
    public function getLoadDate();

    /**
     * @return int
     */
    public function getMaxRow();

    /**
     * @return int
     */
    public function getErrorCount();

    /**
     * @param BookChapterInterface $chapter
     * @return FileInterface
     */
    public function setBookChapter(BookChapterInterface $chapter);
    
    /**
     * @param FileTypeInterface $fileType
     * @return FileInterface
     */
    public function setFileType(FileTypeInterface $fileType = null);

    /**
     * @param ClientInterface $client
     * @return FileInterface
     */
    public function setClient(ClientInterface $client = null);

    /**
     * @param FileMapInterface $fileMap
     * @return FileInterface
     */
    public function setFileMap(FileMapInterface $fileMap = null);

    /**
     * @param int $state
     * @return FileInterface
     */
    public function setState($state);

    /**
     * @param string $name
     * @return FileInterface
     */
    public function setName($name);

    /**
     * @param int $size
     * @return FileInterface
     */
    public function setSize($size);

    /**
     * @param string $date
     * @return FileInterface
     */
    public function setCreateDate($date);

    /**
     * @param string $date
     * @return FileInterface
     */
    public function setModifyDate($date);

    /**
     * @param string $date
     * @return FileInterface
     */
    public function setLoadDate($date);

    /**
     * @param FileRowInterface $row
     * @return FileInterface
     */
    public function addRow(FileRowInterface $row);

    /**
     * @param FileRowInterface $row
     * @return FileInterface
     */
    public function deleteRow(FileRowInterface $row);
}