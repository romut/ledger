<?php
/**
 * Created by PhpStorm.
 * User: rom
 * Date: 02.02.2016
 * Time: 22:32
 */

namespace Core\Model;


use Core\Data\DataInterface;
use Core\Data\EntryData;
use Core\Data\RegistryData;

class Registry extends Entry implements RegistryInterface {

    /**
     * @var int
     */
    private $currentLine = 0;
    /**
     * @var EntryInterface[] $entries
     */
    private $entries = array();

    static public $tableDescriptor = array(
        'entries' => array(
            'alias' => 'e',
            'keys' => array('entry_id'),
            'auto_increment' => 'entry_id',
        ),
        'registries' => array(
            'alias' => 'r',
            'keys' => array('registry_id'),
            'relation' => array(
                'master_alias' => 'e',
                'master_key' => 'entry_id',
                'slave_key' => 'registry_id'
            ),
        ),
    );

    /**
     * @return DataInterface[]
     */
    static public function createDataArray()
    {
        return array(new EntryData(), new RegistryData());
    }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\RegistryDataInterface
     */
    protected function getData($part = 0) { return parent::getData($part); }

    /**
     * @param int $part
     * @return \Core\Data\EntryDataInterface|\Core\Data\RegistryDataInterface
     */
    protected function setData($part = 0) { return parent::setData($part); }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return EntryInterface.
     */
    public function current()
    {
        if (!isset($this->entries[$this->currentLine])) {

        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        // TODO: Implement next() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        // TODO: Implement valid() method.
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

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
        // TODO: Implement offsetExists() method.
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
        // TODO: Implement offsetGet() method.
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
        // TODO: Implement offsetSet() method.
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
        // TODO: Implement offsetUnset() method.
    }

    /**
     * @return int
     */
    public function getState()
    {
        // TODO: Implement getState() method.
    }

    /**
     * @return int
     */
    public function getEntryCount()
    {
        // TODO: Implement getEntryCount() method.
    }

    /**
     * @return FileInterface
     */
    public function getFile()
    {
        // TODO: Implement getFile() method.
    }

    /**
     * @param int $state
     * @return RegistryInterface
     */
    public function setState($state)
    {
        // TODO: Implement setState() method.
    }

    /**
     * @param FileInterface $file
     * @return RegistryInterface
     */
    public function setFile(FileInterface $file)
    {
        // TODO: Implement setFile() method.
    }

    /**
     * @param EntryInterface $entry
     * @return RegistryInterface
     */
    public function addEntry(EntryInterface $entry)
    {
        // TODO: Implement addEntry() method.
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        // TODO: Implement count() method.
    }
}