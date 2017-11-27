<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 14:43
 */

namespace Core\Model;


use Core\Data\FileMapEntryData;

class FileMapEntry extends Model implements FileMapEntryInterface {

    static public $tableDescriptor = array(
        'file_map_entries' => array(
            'alias' => 'fme',
            'keys' => array('file_map_id', 'cell_input_no'),
        ),
    );

    static public function createDataArray() { return array(new FileMapEntryData()); }

    /**
     * @param int $part
     * @return \Core\Data\FileMapEntryDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @return int
     */
    public function getInputNo()
    {
        return $this->getData()->getInputNo();
    }

    /**
     * @return int
     */
    public function getOutputNo()
    {
        return $this->getData()->getOutputNo();
    }

    /**
     * @param int $no
     * @return FileMapEntryInterface
     */
    public function setInputNo($no)
    {
        $this->getData()->setInputNo($no);
        return $this;
    }

    /**
     * @param int $no
     * @return FileMapEntryInterface
     */
    public function setOutputNo($no)
    {
        $this->getData()->setOutputNo($no);
        return $this;
    }
}