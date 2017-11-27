<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 19.01.2017
 * Time: 17:39
 */

namespace Core\Data;


class FileTypeData extends Data implements FileTypeDataInterface {

    private $fileTypeId, $fileTypeName;
    private $bookChapterId;
    private $fileNamePattern;

    public function getFileTypeId()
    {
        return $this->fileTypeId;
    }

    public function getFileTypeName()
    {
        return $this->fileTypeName;
    }

    public function getBookChapterId()
    {
        return $this->bookChapterId;
    }

    public function getFileNamePattern()
    {
        return $this->fileNamePattern;
    }

    public function setFileTypeId($id)
    {
        $this->set($this->fileTypeId, $id);
        return $this;
    }

    public function setFileTypeName($name)
    {
        $this->set($this->fileTypeName, $name);
        return $this;
    }

    public function setBookChapterId($id)
    {
        $this->set($this->bookChapterId, $id);
        return $this;
    }

    public function setFileNamePattern($pattern)
    {
        $this->set($this->fileNamePattern, $pattern);
        return $this;
    }
} 