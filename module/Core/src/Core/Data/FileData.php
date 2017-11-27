<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 06.06.2016
 * Time: 18:16
 */

namespace Core\Data;


class FileData extends Data implements FileDataInterface {

    private $fileId;
    private $bookChapterId, $fileTypeId, $clientId, $fileMapId;
    private $state = 0;
    private $name, $size;
    private $createDate, $modifyDate, $loadDate;
    private $maxRow = 0, $errorCount = 0;

    public function getFileId()
    {
        return $this->fileId;
    }

    public function getBookChapterId()
    {
        return $this->bookChapterId;
    }

    public function getFileTypeId()
    {
        return $this->fileTypeId;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getFileMapId()
    {
        return $this->fileMapId;
    }

    public function getFileState()
    {
        return $this->state;
    }

    public function getFileName()
    {
        return $this->name;
    }

    public function getFileSize()
    {
        return $this->size;
    }

    public function getFileCreateDate()
    {
        return $this->createDate;
    }

    public function getFileModifyDate()
    {
        return $this->modifyDate;
    }

    public function getFileLoadDate()
    {
        return $this->loadDate;
    }

    public function getMaxRow()
    {
        return $this->maxRow;
    }

    public function getErrorCount()
    {
        return $this->errorCount;
    }

    public function setFileId($id)
    {
        $this->set($this->fileId, $id);
        return $this;
    }

    public function setBookChapterId($id)
    {
        $this->set($this->bookChapterId, $id);
        return $this;
    }

    public function setFileTypeId($id)
    {
        $this->set($this->fileTypeId, $id);
        return $this;
    }

    public function setClientId($id)
    {
        $this->set($this->clientId, $id);
        return $this;
    }

    public function setFileMapId($id)
    {
        $this->set($this->fileMapId, $id);
        return $this;
    }

    public function setFileState($state)
    {
        $this->set($this->state, $state);
        return $this;
    }

    public function setFileName($name)
    {
        $this->set($this->name, $name);
        return $this;
    }

    public function setFileSize($size)
    {
        $this->set($this->size, $size);
        return $this;
    }

    public function setFileCreateDate($date)
    {
        $this->set($this->createDate, $date);
        return $this;
    }

    public function setFileModifyDate($date)
    {
        $this->set($this->modifyDate, $date);
        return $this;
    }

    public function setFileLoadDate($date)
    {
        $this->set($this->loadDate, $date);
        return $this;
    }

    public function setMaxRow($maxRow)
    {
        $this->set($this->maxRow, $maxRow);
        return $this;
    }

    public function setErrorCount($count)
    {
        $this->set($this->errorCount, $count);
        return $this;
    }
}