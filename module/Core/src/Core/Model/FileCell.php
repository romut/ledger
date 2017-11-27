<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 08.07.2016
 * Time: 16:47
 */

namespace Core\Model;


use Core\Data\FileCellData;
use Core\Data\FileCellDataInterface;

class FileCell extends Model implements FileCellInterface {

    static public $tableDescriptor = array(
        'file_cells' => array(
            'alias' => 'fc',
            'keys' => array('file_id', 'row', 'column'),
        ),
    );

    static public function createDataArray() { return array(new FileCellData()); }

    /**
     * @param int $part
     * @return FileCellDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    public function getFileId()
    {
        return $this->getData()->getFileId();
    }

    public function getRow()
    {
        return $this->getData()->getRow();
    }

    public function getColumn()
    {
        return $this->getData()->getColumn();
    }

    public function getValue()
    {
        return $this->getData()->getValue();
    }

    public function setFileId($id)
    {
        $this->getData()->setFileId($id);
        return $this;
    }

    public function setRow($row)
    {
        $this->getData()->setRow($row);
        return $this;
    }

    public function setColumn($column)
    {
        $this->getData()->setColumn($column);
        return $this;
    }

    public function setValue($value)
    {
        $this->getData()->setValue($value);
        return $this;
    }
}