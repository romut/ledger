<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 13.01.2017
 * Time: 11:51
 */

namespace Core\Model;


use Core\Data\FileMapData;

class FileMap extends Model implements FileMapInterface {

    static public $tableDescriptor = array(
        'file_maps' => array(
            'alias' => 'fm',
            'keys' => array('file_map_id'),
            'auto_increment' => 'file_map_id',
        ),
    );

    static public function createDataArray() { return array(new FileMapData()); }

    /**
     * @var FileMapEntryInterface[]
     */
    private $fileMapEntries = array();

    /**
     * @param int $part
     * @return \Core\Data\FileMapDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    public function getId() { return $this->getData(0)->getFileMapId(); }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     */
    public function offsetExists($offset)
    {
        return true;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return isset($this->fileMapEntries[$offset]) ? $this->fileMapEntries[$offset]->getOutputNo() : $offset;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (isset($this->fileMapEntries[$offset])) {

            $this->fileMapEntries[$offset]->setOutputNo($value);
        }
        else {

            /**
             * @var FileMapEntryInterface $fileMapEntry
             */
            $fileMapEntry = $this->getStorage()->createModel('FileMapEntry');
            $fileMapEntry->setInputNo($offset);
            $fileMapEntry->setOutputNo($value);
            $this->fileMapEntries[$offset] = $fileMapEntry;
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->fileMapEntries[$offset]);
    }
}