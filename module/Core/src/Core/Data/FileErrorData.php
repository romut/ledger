<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 30.03.2017
 * Time: 18:27
 */

namespace Core\Data;


class FileErrorData extends Data implements FileErrorDataInterface {

    private $id, $fileId;
    private $row, $column;
    private $errorNo;
    private $description;

    /**
     * @return int
     */
    public function getFileErrorId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @return int
     */
    public function getFileRow()
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function getFileColumn()
    {
        return $this->column;
    }

    /**
     * @return int
     */
    public function getErrorNo()
    {
        return $this->errorNo;
    }

    /**
     * @return string
     */
    public function getErrorDescription()
    {
        return $this->description;
    }

    /**
     * @param int $id
     * @return FileErrorDataInterface
     */
    public function setFileErrorId($id)
    {
        $this->set($this->id, $id);
        return $this;
    }

    /**
     * @param int $id
     * @return FileErrorDataInterface
     */
    public function setFileId($id)
    {
        $this->set($this->fileId, $id);
        return $this;
    }

    /**
     * @param int $row
     * @return FileErrorDataInterface
     */
    public function setFileRow($row)
    {
        $this->set($this->row, $row);
        return $this;
    }

    /**
     * @param int $column
     * @return FileErrorDataInterface
     */
    public function setFileColumn($column)
    {
        $this->set($this->column, $column);
        return $this;
    }

    /**
     * @param int $no
     * @return FileErrorDataInterface
     */
    public function setErrorNo($no)
    {
        $this->set($this->errorNo, $no);
        return $this;
    }

    /**
     * @param string $description
     * @return FileErrorDataInterface
     */
    public function setErrorDescription($description)
    {
        $this->set($this->description, $description);
        return $this;
    }
}