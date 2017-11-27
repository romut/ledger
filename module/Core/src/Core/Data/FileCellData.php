<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 08.07.2016
 * Time: 16:22
 */

namespace Core\Data;


class FileCellData extends Data implements FileCellDataInterface {

    private $fileId;
    private $row, $column;
    private $valueExt = 0;
    private $value;

    public function getFileId()
    {
        return $this->fileId;
    }

    public function getRow()
    {
        return $this->row;
    }

    public function getColumn()
    {
        return $this->column;
    }

    public function getValueExt()
    {
        return $this->valueExt;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setFileId($id)
    {
        $this->set($this->fileId, $id);
        return $this;
    }

    public function setRow($row)
    {
        $this->set($this->row, $row);
        return $this;
    }

    public function setColumn($column)
    {
        $this->set($this->column, $column);
        return $this;
    }

    public function setValueExt($valueExt)
    {
        $this->set($this->valueExt, $valueExt);
        return $this;
    }

    public function setValue($value)
    {
        $this->set($this->value, $value);
        return $this;
    }
}